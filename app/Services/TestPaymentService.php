<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class TestPaymentService
{
    public function __construct()
    {
        $secret = trim(config('services.stripe.secret') ?: env('STRIPE_SECRET') ?: '');
        Stripe::setApiKey($secret);
    }

    public function createPaymentIntent($amount, $email = null)
    {
        $currency = trim(config('services.stripe.currency') ?: env('STRIPE_CURRENCY') ?: 'AED');
        $params = [
            'amount' => $amount * 100, // AED in fils
            'currency' => $currency,
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ];

        if ($email) {
            $params['receipt_email'] = $email;
        }

        return PaymentIntent::create($params);
    }
}
