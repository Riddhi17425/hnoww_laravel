<?php

namespace App\Services;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createPaymentIntent($amount)
    {
        return PaymentIntent::create([
            'amount' => $amount * 100, // AED in fils
            'currency' => env('STRIPE_CURRENCY'),
            //'payment_method_types' => ['card', 'apple_pay'],
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
    }
}
