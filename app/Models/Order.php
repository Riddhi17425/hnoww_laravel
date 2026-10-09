<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'guest_email_verified_at' => 'datetime',
        'guest_order_token_expires_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . ($order->id ?? 'G');
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderAddress()
    {
        return $this->belongsTo(UserAddress::class, 'order_address_id', 'id');
    }

    public function isDelivered(): bool
    {
        $status = strtolower((string) ($this->status ?? ''));
        $shippingStatus = strtolower((string) ($this->shipping_status ?? ''));

        return in_array($status, ['delivered'], true) || in_array($shippingStatus, ['delivered'], true);
    }

    public function getOrderNumberDisplay(): string
    {
        return !empty($this->order_number)
            ? $this->order_number
            : 'ORD-' . ($this->id ?? 'G');
    }

    public function getCustomerTypeLabel(): string
    {
        return $this->user_id ? 'Normal User' : 'Guest User';
    }

    public function getCustomerDetails(): array
    {
        if ($this->user_id && $this->user) {
            return [
                'type' => 'Normal User',
                'name' => $this->user->name ?? '-',
                'email' => $this->user->email ?? '-',
                'phone' => $this->user->phone ?? '-',
            ];
        }

        return [
            'type' => 'Guest User',
            'name' => '-',
            'email' => $this->guest_email ?? '-',
            'phone' => '-',
        ];
    }

    public function guestOrderAccessUrl(): string
    {
        if (empty($this->guest_order_token)) {
            return '';
        }

        return route('front.guest.order.access', ['token' => $this->guest_order_token]);
    }

    public function guestOrderTokenIsValid(?string $token = null): bool
    {
        if (empty($this->guest_order_token) || $this->isDelivered()) {
            return false;
        }

        $checkToken = $token ?? $this->guest_order_token;

        if ($this->guest_order_token_expires_at && now()->greaterThan($this->guest_order_token_expires_at)) {
            return false;
        }

        return hash_equals((string) $this->guest_order_token, (string) $checkToken);
    }
}
