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
}
