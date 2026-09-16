<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class WebhookController extends Controller
{
    public function handleStripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        Log::info('Stripe webhook received: ' . $payload);
        $signature = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        if (empty($payload) || empty($signature) || empty($secret)) {
            Log::warning('Stripe webhook request missing payload/signature/secret.');
            return response()->json(['error' => 'Invalid webhook request'], 400);
        }

        try {
            $event = Webhook::constructEvent($payload, $signature, $secret);
        } catch (SignatureVerificationException $e) {
            Log::warning('Stripe webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\UnexpectedValueException $e) {
            Log::warning('Stripe webhook payload is invalid: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        if ($event->type === 'payment_intent.succeeded') {
            $this->updateOrderPaymentStatus($event->data->object->id, 'paid', 'confirmed');
        }

        if ($event->type === 'payment_intent.payment_failed') {
            $this->updateOrderPaymentStatus($event->data->object->id, 'failed', 'failed');
        }

        if ($event->type === 'payment_intent.processing') {
            $this->updateOrderPaymentStatus($event->data->object->id, 'processing', 'pending');
        }

        if ($event->type === 'payment_intent.canceled') {
            $this->updateOrderPaymentStatus($event->data->object->id, 'canceled', 'canceled');
        }

        if (!in_array($event->type, [
            'payment_intent.succeeded',
            'payment_intent.payment_failed',
            'payment_intent.processing',
            'payment_intent.canceled',
        ], true)) {
            Log::info('Stripe webhook event received but not handled: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }

    protected function updateOrderPaymentStatus($paymentIntentId, $paymentStatus, $orderStatus)
    {
        if (empty($paymentIntentId)) {
            return;
        }

        $order = Order::where('stripe_payment_intent', $paymentIntentId)->first();

        if (!$order) {
            Log::info('Stripe webhook received for unknown payment intent: ' . $paymentIntentId);
            return;
        }

        $order->payment_status = $paymentStatus;
        $order->status = $orderStatus;
        $order->save();
    }

    public function handleQuickupWebhook(Request $request){
        $payload = $request->getContent();
        $signature = $request->header('X-Signature');
        $secret = (string) env('QUICKUP_WEBHOOK_SECRET', '');

        if (empty($payload)) {
            Log::warning('Quiqup webhook received with an empty payload.');
            return response()->json(['error' => 'Invalid payload'], 400);
        }
        \Log::info('Quiqup webhook received: ' . $payload);
        if ($secret && (!$signature || !$this->hasValidWebhookSignature($payload, $signature, $secret))) {
            Log::warning('Quiqup webhook signature verification failed.');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = json_decode($payload, true);
        if (!is_array($data)) {
            Log::warning('Quiqup webhook payload is not valid JSON.');
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        if (isset($data['type']) && $data['type'] !== 'order') {
            return response()->json(['status' => 'ignored']);
        }

        $order = $data['payload'] ?? $data['order'] ?? $data;
        if (!is_array($order)) {
            return response()->json(['error' => 'Invalid order payload'], 422);
        }

        $quickupOrderId = data_get($order, 'id');
        $partnerOrderNumber = data_get($order, 'partner_order_id');
        $localOrder = Order::where('quiqup_order_id', (string) $quickupOrderId)
            ->when($partnerOrderNumber, fn ($query) => $query->orWhere('order_number', $partnerOrderNumber))
            ->first();

        if (!$localOrder) {
            Log::warning('Quiqup webhook received for unknown order.', [
                'quiqup_order_id' => $quickupOrderId,
                'partner_order_id' => $partnerOrderNumber,
            ]);
            return response()->json(['status' => 'ignored']);
        }

        $localOrder->fill(array_filter([
            'quiqup_order_id' => $quickupOrderId,
            'quiqup_parcel_barcode' => data_get($order, 'items.0.parcel_barcode'),
            'quiqup_tracking_url' => data_get($order, 'tracking_url')
                ?: data_get($order, 'destination.tracking_url'),
            'shipping_status' => data_get($order, 'state')
                ?: data_get($order, 'status')
                ?: data_get($order, 'last_event'),
        ]))->save();

        Log::info('Quiqup webhook processed.', [
            'order_id' => $localOrder->id,
            'shipping_status' => $localOrder->shipping_status,
        ]);

        return response()->json(['status' => 'success']);
    }

    protected function hasValidWebhookSignature(string $payload, string $signature, string $secret)
    {
        $expectedSignature = hash_hmac('sha1', $payload, $secret);
        $providedSignature = str_starts_with($signature, 'sha1=')
            ? substr($signature, 5)
            : $signature;

        return hash_equals($expectedSignature, $providedSignature);
    }
}
