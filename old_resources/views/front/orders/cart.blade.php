@include('layouts.frontheader')
<style>
.theme-green .header-scrolled {
    background: #EDEAE4;
}

.theme-green .language-select .dropdown-input-lan {
    color: #0e2233;
}

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
                <span>Your Selection</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Shopping Bag</h2>
        </div>

        <!-- Shopping Cart -->
        <div class="shopping-cart">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        @php $subTotal = 0; @endphp
                        <!-- Shopping Summery -->
                        <table class="table shopping-summery" style="--bs-table-bg:--bs-table-bg;">
                            <thead>
                                <tr class="main-hading">
                                    <th>PRODUCT</th>
                                    <th>NAME</th>
                                    <th>UNIT PRICE (IN AED)</th>
                                    <th>QUANTITY</th>
                                    <th>TOTAL (IN AED)</th>
                                    <th>
                                        <!-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 3H15M3 6H21M10 16V11M14 16V11M5 6H19L18.1245 19.133C18.0544 20.1836 17.1818 21 16.1289 21L7.8461 21C6.79171 21 5.91842 20.1814 5.85028 19.1292L5 6Z"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg> -->
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="cart_item_list">
                                <form action="" method="POST" id="cart-update-form">
                                    @csrf
                                    @if(isset($cartData) && count($cartData) > 0 && is_countable($cartData) > 0)
                                    @foreach($cartData as $key=>$cart)
                                    @php $subTotal += ($cart->price * $cart->quantity) @endphp
                                    <tr id="cart-row-{{$cart->id}}" class="cart-item-row">
                                        <td class="image" data-title="Product Image">
                                            <a href="{{ route('front.product.details', $cart->product->product_url) }}"><img
                                                    class="img-fluid img_1"
                                                    src="{{ isset($cart->product->list_page_img) ? asset('public/images/admin/product_list/'.$cart->product->list_page_img) : '' }}"
                                                    height="120" width="150"
                                                    alt="{{ $cart->product->product_name ?? 'Product Image' }}"></a>
                                        </td>
                                        <td class="" data-title="Product Name">
                                            <p class="product-name"><a href=""
                                                    target="_blank">{{ $cart->product->product_name ?? '' }}</a></p>
                                        </td>
                                        <td class="price" data-title="Price"><span class="unit-price"
                                                data-price="{{ $cart->price }}">{{ $cart->price ?? '' }}</span></td>
                                        <td>
                                            <!-- <div class="increment_decrement_area"> -->
                                            <div class="increment_decrement" data-product-id="{{ $cart->product_id }}"
                                                data-stock="{{ $cart->product->product_stock }}"
                                                data-cart-id="{{ $cart->id }}">
                                                <button class="dec_btn" data-call="cart" type="button">−</button>
                                                <span class="span_value">{{$cart->quantity ?? 1}}</span>
                                                <input type="hidden" class="qty_input" id="product-qty"
                                                    value="{{$cart->quantity ?? 1}}">
                                                <button class="inc_btn" data-call="cart" type="button">+</button>
                                            </div>
                                            <!-- </div> -->

                                        </td>
                                        <td class="total-amount cart_single_price" data-title="Total"><span
                                                class="row-total">
                                                {{ $cart->price ? ($cart->price * $cart->quantity) : '' }}</span></td>
                                        <td><a href="javascript:void(0);" class="delete-cart-item"
                                                data-id="{{ $cart->id }}">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9 3H15M3 6H21M10 16V11M14 16V11M5 6H19L18.1245 19.133C18.0544 20.1836 17.1818 21 16.1289 21L7.8461 21C6.79171 21 5.91842 20.1814 5.85028 19.1292L5 6Z"
                                                        stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td class="text-center">
                                            There are no any carts available. <a href="{{ route('front.home') }}"
                                                class="com_btn">Continue shopping</a>
                                        </td>
                                    </tr>
                                    @endif

                                </form>
                            </tbody>
                        </table>
                    </div>
                    @if($cartData->count() > 0)
                    <!-- <div class="col-4" id="calculation-section">
                     
                        <div class="total-right">
                            <ul>
                                <li class="order_subtotal" data-price="">Cart Subtotal <span
                                        id="cart-subtotal">{{ $subTotal ?? 0 }} AED </span></li>
                                <li class="last" id="order_total_price">You Pay <span id="you-pay">{{ $subTotal ?? 0 }}
                                        AED </span></li>
                            </ul>
                            <div class="button5">
                                <a href="{{ route('front.checkout.view') }}" class="com_btn">Checkout</a>
                                <a href="{{ route('front.home') }}" class="com_btn">Continue shopping</a>
                            </div>
                        </div>
                       
                    </div> -->

                    <div class="col-4" id="calculation-section">
                        <div class="summary-wrapper">
                            <h3 class="title_40 mb-4">Summary</h3>
                            <div class="summary-details">
                                <div class="summary-row">
                                    <span class="label">Subtotal</span>
                                    <span class="value" id="cart-subtotal">AED
                                        {{ number_format($subTotal ?? 0, 2) }}</span>
                                </div>

                                {{-- <div class="summary-row">
                                    <span class="label">Shipping</span>
                                    <span class="value text-muted">Calculated at checkout</span>
                                </div> --}}
                            </div>

                            <hr class="summary-divider">

                            <div class="summary-row total-row">
                                <span class="sub_head">Total</span>
                                <span class="sub_head" id="you-pay">AED {{ number_format($subTotal ?? 0, 2) }}</span>
                            </div>
                            

                            <div class="summary-actions">
                                <a href="{{ route('front.checkout.view') }}" class="com_btn w-100 text-center">
                                    PROCEED TO CHECKOUT
                                </a>
                                <a href="{{ route('front.home') }}" class="btn-continue">
                                    CONTINUE SHOPPING
                                </a>
                            </div>

                            <p class="summary-disclaimer">
                                Every object is an offering. Shipping timelines may vary based on your location and
                                customization requests.
                            </p>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </div>
        <!--/ End Shopping Cart -->
    </div>
</section>

@push('script')
<script src="{{ asset('public/js/front/cart.js') }} "></script>
<script>
$(document).on('change', '.input-number', function() {
    clearTimeout(window.cartTimer);
    window.cartTimer = setTimeout(function() {
        $('#cart-update-form').submit();
    }, 300); // debounce
});
</script>

@endpush
@include('layouts.frontfooter')