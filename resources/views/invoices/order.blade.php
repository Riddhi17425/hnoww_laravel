<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number ?? $order->id }}</title>
    <style>
        @page { margin: 34px 38px; }
        body { font-family: DejaVu Sans, sans-serif; color: #263238; font-size: 11px; line-height: 1.5; }
        .topbar { width: 100%; table-layout: fixed; border-collapse: collapse; }
        .topbar td { vertical-align: middle; padding: 0; }
        .brand { text-align: center; padding: 2px 0 14px !important; }
        .brand img { width: 158px; height: auto; }
        .order-meta { background: #f8f7f3; border-top: 2px solid #c7b58c; color: #806d43; font-size: 11px; font-weight: bold; padding: 8px 12px !important; text-align: center; }
        .order-meta .issued { color: #777; font-size: 10px; font-weight: normal; padding-left: 14px; }
        .header-rule { width: 100%; height: 0; border-bottom: 3px solid #c7b58c; margin-top: 0; }
        .summary { width: 100%; margin-top: 22px; }
        .summary td { width: 50%; vertical-align: top; padding: 12px 14px; background: #f8f7f3; border-left: 2px solid #c7b58c; }
        .label { color: #9a8658; font-size: 9px; font-weight: bold; letter-spacing: 1px; text-transform: uppercase; }
        .summary strong { color: #263238; }
        .items { width: 100%; border-collapse: collapse; margin-top: 25px; }
        .items th { background: #c7b58c; color: #fff; padding: 10px 8px; font-size: 9px; letter-spacing: .5px; text-align: left; text-transform: uppercase; }
        .items td { border-bottom: 1px solid #e9e5dc; padding: 10px 8px; }
        .items tbody tr:nth-child(even) td { background: #fbfaf8; }
        .right { text-align: right !important; }
        .totals { width: 48%; margin: 17px 0 0 auto; border-collapse: collapse; }
        .totals td { padding: 6px 8px; border-bottom: 1px solid #eeeae2; }
        .totals .grand-total td { border-top: 2px solid #c7b58c; border-bottom: 0; color: #8c7950; font-size: 14px; font-weight: bold; padding-top: 10px; }
        .payment { margin-top: 16px; color: #555; }
        .payment span { color: #0d5e4c; font-weight: bold; text-transform: uppercase; }
        .footer { border-top: 1px solid #e4dfd3; color: #8a877d; font-size: 9px; margin-top: 34px; padding-top: 10px; text-align: center; }
    </style>
</head>
<body>
    <table class="topbar">
        <tr>
            <td class="brand"><img src="{{ public_path('images/front/footer-logo.svg') }}" alt="HNOWW"></td>
        </tr>
        <tr>
            <td class="order-meta">
                Order #{{ $order->order_number ?? $order->id }}
                <span class="issued">Issued {{ optional($order->created_at)->format('d M Y') }}</span>
            </td>
        </tr>
    </table>
    <div class="header-rule"></div>

    <table class="summary">
        <tr>
            <td>
                <div class="label">Billed to</div>
                <strong>{{ $order->user->name ?? 'Customer' }}</strong><br>
                {{ $order->user->email ?? '' }}
            </td>
            <td>
                <div class="label">Delivery address</div>
                <strong>{{ $order->orderAddress->name ?? ($order->user->name ?? 'Customer') }}</strong><br>
                {{ $order->orderAddress->address_line1 ?? '' }}
                {{ $order->orderAddress->address_line2 ?? '' }}<br>
                {{ $order->orderAddress->emirate ?? '' }}
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr><th>Item</th><th class="right">Unit price (AED)</th><th class="right">Qty</th><th class="right">Amount (AED)</th></tr>
        </thead>
        <tbody>
        @foreach ($order->orderProducts as $item)
            <tr>
                <td>{{ $item->product->product_name ?? 'Product' }}</td>
                <td class="right">{{ number_format($item->price ?? 0, 2) }}</td>
                <td class="right">{{ $item->quantity ?? 0 }}</td>
                <td class="right">{{ number_format($item->subtotal ?? (($item->price ?? 0) * ($item->quantity ?? 0)), 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr><td>Subtotal</td><td class="right">AED {{ number_format($order->subtotal ?? 0, 2) }}</td></tr>
        <tr><td>Shipping</td><td class="right">AED {{ number_format($order->shipping_charges ?? 0, 2) }}</td></tr>
        @if (($order->discount ?? 0) > 0)
            <tr><td>Discount</td><td class="right">- AED {{ number_format($order->discount, 2) }}</td></tr>
        @endif
        <tr class="grand-total"><td>Total</td><td class="right">AED {{ number_format($order->order_total ?? 0, 2) }}</td></tr>
    </table>

    <div class="payment">Payment status: <span>{{ ucfirst($order->payment_status ?? 'Unpaid') }}</span></div>
    <div class="footer">Thank you for shopping with HNOWW</div>
</body>
</html>
