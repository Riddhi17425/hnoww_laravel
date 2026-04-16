<?php

namespace App\Services;

use App\Models\Blessing;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ElevenLabsTextToSpeechService
{
    public function getBlessingAudioPath(Blessing $blessing): ?string
    {
        $fallbackPath = $this->getFallbackAudioPath($blessing);
        $text = trim((string) ($blessing->audio_content ?: $blessing->description));
        $outputFormat = (string) config('services.elevenlabs.output_format', 'mp3_44100_128');

        if ($text === '') {
            Log::warning('Blessing audio text is empty', [
                'blessing_id' => $blessing->id,
            ]);
            return $fallbackPath;
        }

        if (!$this->isConfigured()) {
            Log::warning('ElevenLabs is not configured, using fallback audio when available', [
                'blessing_id' => $blessing->id,
                'has_fallback' => (bool) $fallbackPath,
            ]);
            return $fallbackPath;
        }

        $targetDirectory = public_path('images/admin/blessing/audios/elevenlabs/');
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        $fileHash = md5($blessing->id . '|' . $text . '|' . $this->voiceId() . '|' . $this->modelId() . '|' . $outputFormat . '|' . json_encode($this->voiceSettings()));
        $targetPath = $targetDirectory . 'blessing_' . $blessing->id . '_' . $fileHash . '.mp3';

        if (file_exists($targetPath) && filesize($targetPath) > 0) {
            Log::info('Serving cached ElevenLabs blessing audio', [
                'blessing_id' => $blessing->id,
                'audio_path' => $targetPath,
            ]);
            return $targetPath;
        }

        $endpoint = rtrim((string) config('services.elevenlabs.base_url', 'https://api.elevenlabs.io'), '/')
            . '/v1/text-to-speech/' . $this->voiceId()
            . '?output_format=' . urlencode($outputFormat);

        $response = Http::timeout(60)
            ->withHeaders([
                'xi-api-key' => $this->apiKey(),
                'Accept' => 'audio/mpeg',
                'Content-Type' => 'application/json',
            ])
            ->post($endpoint, array_filter([
                'text' => $text,
                'model_id' => $this->modelId(),
                'voice_settings' => $this->voiceSettings(),
            ], function ($value) {
                return $value !== null;
            }));

        $contentType = (string) $response->header('Content-Type', '');
        $isAudioResponse = Str::startsWith(strtolower($contentType), 'audio/');

        if (!$response->successful() || !$isAudioResponse) {
            Log::error('ElevenLabs TTS request failed', [
                'blessing_id' => $blessing->id,
                'status' => $response->status(),
                'content_type' => $contentType,
                'body' => $response->body(),
            ]);

            if ($fallbackPath) {
                return $fallbackPath;
            }

            throw new Exception('ElevenLabs request failed.');
        }

        file_put_contents($targetPath, $response->body());

        Log::info('Generated ElevenLabs blessing audio', [
            'blessing_id' => $blessing->id,
            'audio_path' => $targetPath,
        ]);

        return $targetPath;
    }

    protected function getFallbackAudioPath(Blessing $blessing): ?string
    {
        if (!$blessing->audio_file) {
            return null;
        }

        $path = public_path('images/admin/blessing/audios/' . $blessing->audio_file);

        return file_exists($path) ? $path : null;
    }

    protected function isConfigured(): bool
    {
        return (bool) ($this->apiKey() && $this->voiceId());
    }

    protected function apiKey(): ?string
    {
        return config('services.elevenlabs.api_key');
    }

    protected function voiceId(): ?string
    {
        return config('services.elevenlabs.voice_id');
    }

    protected function modelId(): string
    {
        return (string) config('services.elevenlabs.model_id', 'eleven_multilingual_v2');
    }

    protected function voiceSettings(): ?array
    {
        $settings = array_filter([
            'stability' => $this->normalizeFloat(config('services.elevenlabs.stability')),
            'similarity_boost' => $this->normalizeFloat(config('services.elevenlabs.similarity_boost')),
            'style' => $this->normalizeFloat(config('services.elevenlabs.style')),
            'use_speaker_boost' => $this->normalizeBool(config('services.elevenlabs.use_speaker_boost')),
        ], function ($value) {
            return $value !== null;
        });

        return $settings === [] ? null : $settings;
    }

    protected function normalizeFloat($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (float) $value;
    }

    protected function normalizeBool($value): ?bool
    {
        if ($value === null || $value === '') {
            return null;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}