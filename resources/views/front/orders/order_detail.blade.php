@include('layouts.frontheader')
<style>
    .theme-green .header-scrolled {
        background: #EDEAE4;
    }

    .theme-green .language-select .dropdown-input-lan {
        color: #0e2233;
    }

    .status_pill {
        display: inline-block;
        width: fit-content;
        padding: 5px 10px;
        background-color: #0d5e4c;
        border-radius: 20px;
        color: white;
        font-size: 14px;
    }

    .status_green {
        background-color: #0d5e4c;
    }

    .status_red {
        background-color: #C3181E;
    }

    .order_detail_card {
        border: 1px solid var(--gold-color);
        padding: 10px;
    }
    .ordered_card {
    border: 1px solid #ddd;
    padding: 5px 10px;
}
.order_detail_table th{width:13%;}
.ordered_card .sub_head {font-size:20px;color:#111;padding-left:8px;}

    @media (max-width:767px) {
        .sticky-header {
            /*background: #EDEAE4;*/
        }
    }
</style>

<section class="mt_60 mb_120">
    <div class="container">

        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Your Order</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Order Detail</h2>
        </div>

        <div class="shopping-cart">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="order_detail_wrapper my-4">
                        <div class="order_detail_head">
                            <div class="table-responsive">
                                <table class="table shopping-summery mb-0" style="--bs-table-bg:--bs-table-bg;">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">Order Created On</th>
                                            <th scope="col" class="text-nowrap">Order</th>
                                            <th scope="col" class="text-nowrap">Order Status</th>
                                            <th scope="col" class="text-nowrap">Payment Status</th>
                                            <th scope="col" class="text-nowrap">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($orderDetails->created_at)->format('M d, Y') }}</td>
                                            <td><span>#</span>{{$orderDetails->order_number ?? $orderDetails->id}}</td>
                                            <td><span class="status_pill @if(strtolower($orderDetails->stauts) == 'confirmed') 'status_red' @else 'status_green' @endif">{{strtoupper($orderDetails->status) ?? '-'}}</span></td>
                                            <td><span class="status_pill @if(strtolower($orderDetails->stauts) == 'paid') 'status_red' @else 'status_green' @endif">{{strtoupper($orderDetails->payment_status) ?? '-'}}</span></td>
                                            <td>{{number_format($orderDetails->order_total, 2) ?? '-'}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="order_detail_wrapper order_detail_card">
                        <div class="order_detail_head my-4">
                            <h5 class="sub_head pb-2 text-center">
                                <!--Product in this Order-->
                                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                                            fill="#B58A46" />
                                    </svg>
                                </span>
                                <span>Product in this Order</span>
                                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                            fill="#B58A46" />
                                    </svg>
                                </span>
                                </h5>
                            @if (isset($orderDetails->orderProducts) && is_countable($orderDetails->orderProducts) && count($orderDetails->orderProducts) > 0)
                            <div class="row gy-3">
                                @foreach ($orderDetails->orderProducts as $item)
                                <div class="col-lg-4">
                                    <div class="d-flex gap-2 ordered_card">
                                        <a href="{{ route('front.product.details', $item->product->product_url) }}"><img class="img-fluid img_1" src="{{ isset($item->product->list_page_img) ? asset('public/images/admin/product_list/'.$item->product->list_page_img) : asset('public/images/no-image.png') }}" height="120" 
                                        width="150" alt="{{$item->product->product_name ?? 'No Image'}}"></a>
                                        <div class="d-flex flex-column">
                                            <p class="mb-1"><b>Name:</b> <span>{{ $item->product->product_name ?? 'N/A' }}</span></p>
                                            <p class="mb-1"><b>Price:</b> <span>{{ number_format($item->price, 2) ?? '-' }}</span></p>
                                            <p class="mb-1"><b>Qty:</b> <span>{{ $item->quantity ?? '1' }}</span></p>
                                            <p class="mb-1"><b>Subtotal:</b> <span>{{ number_format($item->subtotal, 2) ?? '-' }}</span></p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!--<div class="col-lg-4">-->
                                <!--    <div class="d-flex gap-2 ordered_card">-->
                                <!--        <img class="img-fluid img_1" src="https://intelliworkz.co/hnoww_laravel/public/images/admin/product_list/desire1.png" height="120" width="150" alt="The Desert Rose">-->
                                <!--        <div class="d-flex flex-column">-->
                                <!--            <p class="mb-1"><b>Name:</b> <span>The Desert Rose</span></p>-->
                                <!--            <p class="mb-1"><b>Qty:</b> <span>1</span></p>-->
                                <!--            <p class="mb-1"><b>Price:</b> <span>900.00</span></p>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-lg-4">-->
                                <!--    <div class="d-flex gap-2 ordered_card">-->
                                <!--        <img class="img-fluid img_1" src="https://intelliworkz.co/hnoww_laravel/public/images/admin/product_list/desire1.png" height="120" width="150" alt="The Desert Rose">-->
                                <!--        <div class="d-flex flex-column">-->
                                <!--            <p class="mb-1"><b>Name:</b> <span>The Desert Rose</span></p>-->
                                <!--            <p class="mb-1"><b>Qty:</b> <span>1</span></p>-->
                                <!--            <p class="mb-1"><b>Price:</b> <span>900.00</span></p>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="col-lg-4">-->
                                <!--    <div class="d-flex gap-2 ordered_card">-->
                                <!--        <img class="img-fluid img_1" src="https://intelliworkz.co/hnoww_laravel/public/images/admin/product_list/desire1.png" height="120" width="150" alt="The Desert Rose">-->
                                <!--        <div class="d-flex flex-column">-->
                                <!--            <p class="mb-1"><b>Name:</b> <span>The Desert Rose</span></p>-->
                                <!--            <p class="mb-1"><b>Qty:</b> <span>1</span></p>-->
                                <!--            <p class="mb-1"><b>Price:</b> <span>900.00</span></p>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('front.order.view') }}" class="com_btn add_to_cart_btn" data-product-id="9"> Back to Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')