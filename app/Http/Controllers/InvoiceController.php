<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function customerDownload($orderId)
    {
        $order = Order::where('user_id', auth()->id())
            ->with(['user', 'orderAddress', 'orderProducts.product'])
            ->findOrFail($orderId);

        return $this->download($order);
    }

    public function guestDownload($token)
    {
        $order = Order::where('guest_order_token', $token)
            ->where(function ($query) {
                $query->whereNull('guest_order_token_expires_at')
                    ->orWhere('guest_order_token_expires_at', '>', now());
            })
            ->firstOrFail();

        if ($order->isDelivered()) {
            abort(410, 'This guest order link has expired.');
        }

        $sessionAccess = session('guest_order_access_' . $order->id);
        if (!$sessionAccess
            || !isset($sessionAccess['token'], $sessionAccess['expires_at'])
            || !hash_equals((string) $token, (string) $sessionAccess['token'])
            || now()->greaterThan($sessionAccess['expires_at'])) {
            abort(403, 'Verify the guest order access link before downloading the invoice.');
        }

        $order->load(['user', 'orderAddress', 'orderProducts.product']);

        return $this->download($order);
    }

    public function adminDownload($orderId)
    {
        $order = Order::with(['user', 'orderAddress', 'orderProducts.product'])->findOrFail($orderId);

        return $this->download($order);
    }

    private function download(Order $order)
    {
        $fileName = 'Invoice-' . ($order->order_number ?? $order->id) . '.pdf';

        return Pdf::loadView('invoices.order', compact('order'))
            ->setPaper('a4')
            ->download($fileName);
    }
}
