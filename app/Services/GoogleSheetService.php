<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleSheetService
{
    public function send(string $sheetName, array $data): bool
    {
        try
        {
            $webhookUrl = config('services.google_sheet.webhook_url');
            if (empty($webhookUrl))
            {
                Log::error('Google Sheet webhook URL is not configured.');
                return false;
            }

            $response = Http::timeout(15)
                ->post($webhookUrl, [
                    'sheet_name' => $sheetName,
                    'data'       => $data,
                ]);

            if (!$response->successful())
            {
                Log::error('Google Sheet request failed.', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }
            return true;
        } 
        catch (\Exception $e)
        {
            Log::error('Google Sheet integration failed: ' . $e->getMessage());
            return false;
        }
    }
}