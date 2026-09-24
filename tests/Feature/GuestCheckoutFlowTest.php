<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\PasswordResetOtp;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GuestCheckoutFlowTest extends TestCase
{
    public function test_guest_order_access_link_is_generated()
    {
        $order = new Order([
            'id' => 128,
            'guest_email' => 'guest@example.com',
            'guest_order_token' => 'secure-token-123',
            'guest_order_token_expires_at' => now()->addDay(),
        ]);

        $url = $order->guestOrderAccessUrl();

        $this->assertIsString($url);
        $this->assertStringContainsString('/guest-order/', $url);
        $this->assertStringContainsString('secure-token-123', $url);
    }

    public function test_guest_order_verification_redirects_to_order_details_page()
    {
        $order = Order::create([
            'user_id' => null,
            'guest_email' => 'guest@example.com',
            'guest_order_token' => 'redirect-token-123',
            'guest_order_token_expires_at' => now()->addDay(),
            'status' => 'confirmed',
            'subtotal' => 100,
            'discount_percent' => 0,
            'discount' => 0,
            'shipping_charges' => 0,
            'order_total' => 100,
        ]);

        PasswordResetOtp::create([
            'email' => 'guest@example.com',
            'otp' => Hash::make('123456'),
            'expires_at' => now()->addMinutes(10),
        ]);

        $response = $this->post(route('front.guest.order.verify', ['token' => 'redirect-token-123']), [
            'otp' => '123456',
        ]);

        $response->assertRedirect(route('front.guest.order.details', ['token' => 'redirect-token-123']));
    }
}
