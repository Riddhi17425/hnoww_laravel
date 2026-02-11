@extends('admin.layouts.app')

@section('title', 'Orders Details')

@section('content')

<div class="container-fluid">

    {{-- Page Title --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Order Details</h4>
        <span class="badge bg-light text-dark px-3 py-2">
            Order #{{ $order->order_number }}
        </span>
    </div>

    {{-- Order + User Info --}}
    <div class="row g-4 mb-4">

        {{-- Order Info --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 text-primary">
                        <i class="bi bi-receipt"></i> Order Summary
                    </h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Status</span>
                        <span class="badge
                            {{ $order->status == 'confirmed' ? 'bg-success' :
                               ($order->status == 'canceled' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Payment</span>
                        <span class="badge
                            {{ $order->payment_status == 'paid' ? 'bg-success' :
                               ($order->payment_status == 'failed' ? 'bg-danger' : 'bg-secondary') }}">
                            {{ ucfirst($order->payment_status ?? 'Un-paid') }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Order Date</span>
                        <span>{{ $order->created_at->format('d M Y, h:i A') }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fs-5 fw-bold">
                        <span>Total</span>
                        <span class="text-success">₹{{ number_format($order->order_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- User Info --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 text-dark">
                        <i class="bi bi-person-circle"></i> Customer Details
                    </h6>

                    <p class="mb-2"><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Products --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h6 class="fw-bold mb-3">
                <i class="bi bi-box-seam"></i> Ordered Products
            </h6>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderProducts as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img
                                        src="{{ isset($item->product->list_page_img)
                                            ? asset('public/images/admin/product_list/'.$item->product->list_page_img)
                                            : asset('public/images/no-image.png') }}"
                                        class="rounded border me-3"
                                        width="70"
                                        alt="">
                                    <div>
                                        <div class="fw-semibold">
                                            {{ $item->product->product_name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">₹{{ number_format($item->price, 2) }}</td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark px-3">
                                    {{ $item->quantity }}
                                </span>
                            </td>
                            <td class="text-end fw-bold">
                                ₹{{ number_format($item->subtotal, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
