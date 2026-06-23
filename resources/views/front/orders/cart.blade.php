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

    .increment_decrement {
        transform: scale(.6);
        transform-origin: left;
    }
}

/* Checkout Authentication Modal Styling */
#checkoutAuthModal .modal-content {
    background-color: #faf9f6; /* Soft warm luxury background */
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.02'/%3E%3C/svg%3E"); /* Subtle noise texture */
    border: 1px solid var(--gold-color);
    border-radius: 0px; /* Sharp, modern, architectural look */
    box-shadow: 0 20px 50px rgba(14, 34, 51, 0.15) !important;
    padding: 20px;
}

#checkoutAuthModal .modal-header {
    border-bottom: none;
    padding-bottom: 0;
    position: relative;
}

#checkoutAuthModal .modal-title {
    /* font-family: var(--heading-font);
    font-size: 26px;
    font-weight: 400;
    color: var(--dark-900);
    letter-spacing: 0.5px;
    text-transform: uppercase; */
}

#checkoutAuthModal .btn-close {
    background-color: transparent;
    border: 1px solid rgba(199, 181, 140, 0.3);
    border-radius: 50%;
    padding: 0.5rem;
    position: absolute;
    top: 0;
    right: 0;
    opacity: 0.7;
    transition: all 0.3s ease;
    background-size: 10px;
}

#checkoutAuthModal .btn-close:hover {
    opacity: 1;
    border-color: var(--gold-color);
    background-color: rgba(199, 181, 140, 0.1);
}

#checkoutAuthModal .modal-body {
    padding-top: 15px;
}

/* #checkoutAuthModal .auth-step p {
    font-family: var(--body-font);
    font-size: 14.5px;
    color: #666;
    line-height: 1.6;
    margin-bottom: 25px;
} */

/* Floating labels custom style for luxury look */
#checkoutAuthModal .form-floating {
    margin-bottom: 20px;
}

#checkoutAuthModal .form-floating .form-control {
    background-color: transparent !important;
    border: none;
    border-bottom: 1px solid rgba(14, 34, 51, 0.2);
    border-radius: 0;
    padding: 20px 0 0 0;
    height: 50px;
    font-size: 16px;
    color: var(--dark-900);
    box-shadow: none !important;
    transition: border-color 0.3s ease;
}

#checkoutAuthModal .form-floating .form-control:focus {
    border-bottom-color: var(--gold-color);
}

#checkoutAuthModal .form-floating label {
    padding: 12px 0;
    color: var(--dark-900);
    transition: all 0.3s ease;
    pointer-events: none;
    transform-origin: 0 0;
}

#checkoutAuthModal .form-floating .form-control:focus ~ label,
#checkoutAuthModal .form-floating .form-control:not(:placeholder-shown) ~ label {
    color: var(--gold-color);
    transform: scale(0.85) translateY(-12px);
}

/* Submit and Action Buttons */
#checkoutAuthModal .btn-auth-primary {
    width: 100%;
    background-color: var(--dark-900);
    color: var(--white-color);
    border: 1px solid var(--dark-900);
     border-color: var(--dark-900);
    /* padding: 14px 20px;
    font-size: 15px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    cursor: pointer;
    border-radius: 0; */
}
/* 
#checkoutAuthModal .btn-auth-primary:hover {
    background-color: var(--gold-color);
    border-color: var(--gold-color);
    color: var(--white-color);
} */

#checkoutAuthModal .btn-auth-secondary {
    display: inline-block;
    background: transparent;
    border: none;
    color: var(--secondary-color);
    font-size: 13px;
    font-weight: 500;
    text-transform: uppercase;
    /* letter-spacing: 1px; */
    padding: 8px 16px;
    margin-top: 10px;
    transition: all 0.3s ease;
    text-decoration: none;
    cursor: pointer;
}

#checkoutAuthModal .btn-auth-secondary:hover {
    color: var(--dark-900);
    text-decoration: underline;
}

/* Alert Styling */
#checkoutAuthModal .alert-danger {
    border-radius: 0;
    border: 1px solid #d32f2f;
    background-color: #fff5f5;
    color: #d32f2f;
    font-size: 13.5px;
    padding: 12px 16px;
}

/* JQuery Validation Error */
#checkoutAuthModal .text-danger.mt-1 {
    font-size: 12.5px;
    color: #d32f2f !important;
    text-align: left;
    margin-top: 4px !important;
}
</style>
<section class="mt_60 mb_120">
    {{-- @php 
         $discountPercent = config('global_values.discount_percent', 0);
    @endphp --}}
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span>
                    <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Your Selection</span>
                <span>
                    <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        @php $subTotal = 0; @endphp
                        <!-- Shopping Summery -->
                        <div class="table-responsive" id="cart_item_list" style="overflow-x: visible;">
                            @if(isset($cartData) && count($cartData) > 0 && is_countable($cartData) > 0)
                            <table class="table shopping-summery" id="cartTable" style="--bs-table-bg:--bs-table-bg;">
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
                                <tbody>
                                    <form action="" method="POST" id="cart-update-form">
                                        @csrf
                                        @foreach($cartData as $key=>$cart)
                                        @php $subTotal += ($cart->price * $cart->quantity) @endphp
                                        <tr id="cart-row-{{$cart->id}}" class="cart-item-row">
                                            <td class="image" data-title="Product Image">
                                                <a
                                                    href="{{ route('front.product.details', $cart->product->product_url) }}"><img
                                                        class="img-fluid img_1"
                                                        src="{{ isset($cart->product->list_page_img) ? asset('public/images/admin/product_list/'.$cart->product->list_page_img) : '' }}"
                                                        height="120" width="150"
                                                        alt="{{ $cart->product->product_name ?? 'Product Image' }}"></a>
                                            </td>
                                            <td class="" data-title="Product Name">
                                                <p class="product-name mb-0"><a href=""
                                                        target="_blank">{{ $cart->product->product_name ?? '' }}</a></p>
                                            </td>
                                            <td class="price" data-title="Price"> <span class="unit-price"
                                                    data-price="{{ $cart->price }}">{{ $cart->price ?? '' }}</span></td>
                                            <td>
                                                <!-- <div class="increment_decrement_area"> -->
                                                <div class="increment_decrement"
                                                    data-product-id="{{ $cart->product_id }}"
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
                                            <td class="total-amount cart_single_price" data-title="Total"> <span
                                                    class="d-block d-lg-none">AED</span> <span class="row-total">
                                                    {{ $cart->price ? ($cart->price * $cart->quantity) : '' }}</span>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="delete-cart-item"
                                                    data-id="{{ $cart->id }}">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9 3H15M3 6H21M10 16V11M14 16V11M5 6H19L18.1245 19.133C18.0544 20.1836 17.1818 21 16.1289 21L7.8461 21C6.79171 21 5.91842 20.1814 5.85028 19.1292L5 6Z"
                                                            stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </form>
                                </tbody>
                            </table>
                            @else
                            <div class="text-center">
                                <img class="img-fluid" style="" src="{{asset('public/images/front/emty_cart.webp')}}"
                                    alt="about us banner">
                                <h5 class="sub_head my-3">Your shopping bag is currently empty.</h5>
                                <a href="{{ route('front.home') }}" class="com_btn mt-2">Continue shopping</a>

                            </div>
                            @endif
                        </div>
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
                    <div class="col-lg-4" id="calculation-section">
                        <div class="summary-wrapper">
                            <h3 class="title_40 mb-4">Summary</h3>
                            <div class="summary-details">
                                <div class="summary-row">
                                    <span class="label">Subtotal</span>
                                    <span class="value" id="cart-subtotal">AED
                                        {{ number_format($subTotal ?? 0, 2) }}</span>
                                </div>
                                 
                                {{-- <div class="summary-row">
                                    <span class="label">Discount (FLAT 15% OFF)</span>
                                    <span class="value text-muted" id="discounted-values"></span>
                                </div> --}}
                       
                            </div>
                            <hr class="summary-divider">
                            <div class="summary-row total-row">
                                <span class="sub_head">Total</span>
                                <span class="sub_head" id="you-pay">AED {{ number_format($subTotal ?? 0, 2) }}</span>
                            </div>
                            <div class="summary-actions">
                                <a class="com_btn w-100 text-center @auth @else user_icon @endauth" @auth href="{{ route('front.checkout.view') }}" @else data-bs-toggle="modal" data-bs-target="#checkoutAuthModal" @endauth>
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

<!-- Checkout Authentication Modal -->
<div class="modal fade auth_modal" id="checkoutAuthModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title w-100 text-center title_40" id="checkoutAuthTitle">Login to Checkout</p>
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" id="closeCheckoutAuthModalBtn"></button>
            </div>
            <div class="modal-body text-center">
                <div class="ct_form">
                    <form id="checkout-auth-form">
                        @csrf

                        <div id="checkout-auth-alert" class="alert alert-danger d-none py-2 px-3 mb-3 text-start"></div>

                        <div id="step-email" class="auth-step">
                            <p>Please enter your email address to continue.</p>
                            <div class="form-floating">
                                <input type="email" name="email" id="checkout_email" class="form-control shadow-none" placeholder=" " required>
                                <label for="checkout_email">Email address</label>
                            </div>
                            <div class="d-flex flex-column align-items-center gap-2 mt-4">
                                <button type="button" id="btn-email-next" class="btn-auth-primary com_btn">Continue</button>
                                <button type="button" class="btn-auth-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>

                        <div id="step-login" class="auth-step d-none">
                            <p>This email is already registered. Please enter your password to continue.</p>
                            <div class="form-floating password_wrap">
                                <input type="password" name="password" id="checkout_password" class="form-control shadow-none" placeholder=" ">
                                <label for="checkout_password">Password</label>
                                <span class="toggle_password" onclick="togglePasswordSvg('checkout_password', this)">
                                    <!-- 👁 Eye (show) -->
                                    <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    <!-- 🙈 Eye Off (hide) -->
                                    <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                            stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column align-items-center gap-2 mt-4">
                                <button type="submit" id="btn-login-submit" class="btn-auth-primary com_btn">Login & Checkout</button>
                                <button type="button" id="btn-login-back" class="btn-auth-secondary"><- Back</button>
                            </div>
                        </div>

                        <div id="step-register" class="auth-step d-none">
                            <p>It looks like you are new to HNOWW. Create an account to complete your checkout.</p>
                            <div class="form-floating">
                                <input type="text" name="name" id="checkout_name" class="form-control shadow-none" placeholder=" ">
                                <label for="checkout_name">Full Name</label>
                            </div>
                            <div class="form-floating password_wrap">
                                <input type="password" name="reg_password" id="checkout_reg_password" class="form-control shadow-none" placeholder=" ">
                                <label for="checkout_reg_password">Password (min 6 characters)</label>
                                <span class="toggle_password" onclick="togglePasswordSvg('checkout_reg_password', this)">
                                    <!-- 👁 Eye (show) -->
                                    <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    <!-- 🙈 Eye Off (hide) -->
                                    <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                            stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            <div class="form-floating password_wrap">
                                <input type="password" name="reg_password_confirmation" id="checkout_reg_password_confirmation" class="form-control shadow-none" placeholder=" ">
                                <label for="checkout_reg_password_confirmation">Confirm Password</label>
                                <span class="toggle_password" onclick="togglePasswordSvg('checkout_reg_password_confirmation', this)">
                                    <!-- 👁 Eye (show) -->
                                    <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                            stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    <!-- 🙈 Eye Off (hide) -->
                                    <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                            stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column align-items-center gap-2 mt-4">
                                <button type="submit" id="btn-register-submit" class="btn-auth-primary com_btn">Register & Checkout</button>
                                <button type="button" id="btn-register-back" class="btn-auth-secondary"><span>
                                    <- </span> Back</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('public/js/front/cart.js') }} "></script>

<script>
{{-- var discountPercent = parseFloat(@json($discountPercent));
$(document).ready(function () {
    // FOR DISCOUNT CALCULATION
    var subTotal = parseFloat(@json($subTotal)); 
    $cartSubTotal =  subTotal; // Assuming this value is set from the server-side
    $discount = ($cartSubTotal * discountPercent) / 100; // Calculate discount based on global value
    $discountedTotal = $cartSubTotal - $discount; // Calculate total after discount    
    $('#discounted-values').text(`- AED ${$discount.toFixed(2)}`); // Display discount  
    $('#you-pay').text(`AED ${$discountedTotal.toFixed(2)}`); // Display total after discount
}); --}}

$(document).on('change', '.input-number', function() {
    clearTimeout(window.cartTimer);
    window.cartTimer = setTimeout(function() {
        $('#cart-update-form').submit();
    }, 300); // debounce
});
window.appData = {
    emptyCartImage: "{{ asset('public/images/front/emty_cart.webp') }}",
    homeUrl: "{{ route('front.home') }}"
};

$(document).ready(function() {
    var isRegistered = false;
    var userEmail = '';
    var checkoutAuthValidator = $('#checkout-auth-form').validate({
        ignore: ':hidden',
        errorElement: 'div',
        errorClass: 'text-danger mt-1',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            name: {
                required: true,
                minlength: 2
            },
            reg_password: {
                required: true,
                minlength: 6
            },
            reg_password_confirmation: {
                required: true,
                equalTo: '#checkout_reg_password'
            }
        },
        messages: {
            email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.'
            },
            password: {
                required: 'Please enter your password.',
                minlength: 'Password must be at least 6 characters.'
            },
            name: {
                required: 'Please enter your name.',
                minlength: 'Name must be at least 2 characters.'
            },
            reg_password: {
                required: 'Please enter a password.',
                minlength: 'Password must be at least 6 characters.'
            },
            reg_password_confirmation: {
                required: 'Please confirm your password.',
                equalTo: 'Password and confirm password must match.'
            }
        }
    });

    $('#btn-email-next').click(function() {
        var emailInput = $('#checkout_email');
        var email = emailInput.val().trim();

        emailInput.val(email);
        if (!emailInput.valid()) {
            return;
        }

        hideError();
        $('#btn-email-next').prop('disabled', true).text('Checking...');

        $.ajax({
            url: "{{ route('front.checkout.check-email') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                email: email
            },
            success: function(response) {
                $('#btn-email-next').prop('disabled', false).text('Next');
                if (response.success) {
                    userEmail = email;
                    if (response.registered) {
                        isRegistered = true;
                        $('#checkoutAuthTitle').text('Welcome Back');
                        $('#step-email').addClass('d-none');
                        $('#step-login').removeClass('d-none');
                        $('#checkout_password').attr('required', true);
                    } else {
                        isRegistered = false;
                        $('#checkoutAuthTitle').text('Create Account');
                        $('#step-email').addClass('d-none');
                        $('#step-register').removeClass('d-none');
                        $('#checkout_name').attr('required', true);
                        $('#checkout_reg_password').attr('required', true);
                        $('#checkout_reg_password_confirmation').attr('required', true);
                    }
                } else {
                    showError(response.message);
                }
            },
            error: function(xhr) {
                $('#btn-email-next').prop('disabled', false).text('Next');
                showError(getAjaxErrorMessage(xhr));
            }
        });
    });

    $('#btn-login-back, #btn-register-back').click(function() {
        hideError();
        $('#checkoutAuthTitle').text('Continue to Checkout');
        $('.auth-step').addClass('d-none');
        $('#step-email').removeClass('d-none');

        $('#checkout_password').removeAttr('required').val('');
        $('#checkout_name').removeAttr('required').val('');
        $('#checkout_reg_password').removeAttr('required').val('');
        $('#checkout_reg_password_confirmation').removeAttr('required').val('');
        checkoutAuthValidator.resetForm();
    });

    $('#checkout-auth-form').submit(function(e) {
        e.preventDefault();
        hideError();

        if (!$(this).valid()) {
            return;
        }

        var submitBtn = isRegistered ? $('#btn-login-submit') : $('#btn-register-submit');
        var originalBtnText = submitBtn.text();
        submitBtn.prop('disabled', true).text('Processing...');

        var url = isRegistered ? "{{ route('front.checkout.login') }}" : "{{ route('front.checkout.register') }}";

        var formData = {
            _token: "{{ csrf_token() }}",
            email: userEmail
        };

        if (isRegistered) {
            formData.password = $('#checkout_password').val();
        } else {
            formData.name = $('#checkout_name').val().trim();
            formData.reg_password = $('#checkout_reg_password').val();
            formData.reg_password_confirmation = $('#checkout_reg_password_confirmation').val();
        }

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect_url;
                } else {
                    submitBtn.prop('disabled', false).text(originalBtnText);
                    showError(response.message);
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).text(originalBtnText);
                showError(getAjaxErrorMessage(xhr));
            }
        });
    });

    $('#checkoutAuthModal').on('hidden.bs.modal', function () {
        hideError();
        $('#checkoutAuthTitle').text('Continue to Checkout');
        $('.auth-step').addClass('d-none');
        $('#step-email').removeClass('d-none');
        $('#checkout_email').val('');
        $('#checkout_password').removeAttr('required').val('');
        $('#checkout_name').removeAttr('required').val('');
        $('#checkout_reg_password').removeAttr('required').val('');
        $('#checkout_reg_password_confirmation').removeAttr('required').val('');
        checkoutAuthValidator.resetForm();
        isRegistered = false;
        userEmail = '';
    });

    function showError(msg) {
        $('#checkout-auth-alert').text(msg).removeClass('d-none');
    }

    function hideError() {
        $('#checkout-auth-alert').addClass('d-none').text('');
    }

    function getAjaxErrorMessage(xhr) {
        if (xhr.responseJSON && xhr.responseJSON.message) {
            return xhr.responseJSON.message;
        }

        return 'Something went wrong. Please try again.';
    }
});

function togglePasswordSvg(inputId, el) {
    const input = document.getElementById(inputId);

    if (input.type === "password") {
        input.type = "text";
        el.classList.add("active");
    } else {
        input.type = "password";
        el.classList.remove("active");
    }
}
</script>
@endpush
@include('layouts.frontfooter')
