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
