@include('layouts.frontheader')

<link rel="stylesheet" href="{{ asset('public/front/css/checkout-test.css') }}">

<style>
.theme-green .header-scrolled {
    background: #EDEAE4;
}

.theme-green .language-select .dropdown-input-lan {
    color: #0e2233;
}

.theme-green .language-select svg polyline,
.theme-green .language-select svg path {
    stroke: #0e2233;
}

@media (max-width:767px) {
    .sticky-header {
        /*background: #EDEAE4;*/
    }

}

</style>

<!-- old code  -->
<!-- <section class="mt_60 mb_120  d-none">
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


        @if($cartItems->count() > 0)
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-box">
                    <table class="table checkout-table " style="--bs-table-bg:--bs-table-bg;">
                        <thead>
                            <tr class="main-hading">
                                <th>Product</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price (In AED)</th>
                                <th>Total (In AED)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td><a href="{{ route('front.product.details', $item->product->product_url) }}"><img
                                            class="img-fluid img_1"
                                            src="{{ isset($item->product->list_page_img) ? asset('public/images/admin/product_list/'.$item->product->list_page_img) : '' }}"
                                            height="120" width="150"
                                            alt="{{ $item->product->product_name ?? 'Product Image' }}"></a></td>
                                <td>{{ $item->product->product_name ?? 'Product' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 2) }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="checkout-box">
                    <h4 class="mb-4">Payment Summary</h4>
                    <ul class="price-summary">
                        <li>Subtotal <span>{{ number_format($subTotal, 2) }} AED</span></li>
                        {{-- <li>Shipping<span>Free</span></li> --}}
                        <li class="total">You Pay <span>{{ number_format($subTotal, 2) }} AED</span></li>
                    </ul>

                    <h4 class="mb-4">Payment Options</h4>
                    <div id="card-element"></div>
                    <div id="error-message"></div>

                    <form action="" method="POST">
                        @csrf
                        <button type="button" id="payBtn" class="com_btn w-100 mt-3">
                            Pay Securely
                        </button>
                    </form>

                    <a href="{{ route('front.home') }}" class="com_btn mt-3 w-100">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center">
            <p>No Orders are Found</p>
            <a href="{{ route('front.home') }}" class="com_btn">Continue Shopping</a>
        </div>
        @endif
    </div>
</section> -->

<!-- new updat code -->


<section class="mt_60 mb_120">
   {{-- @php 
         $discountPercent = config('global_values.discount_percent', 0);
    @endphp --}}
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
            <h2 class="title_60">Secure Checkout</h2>
        </div>

        <div class="co-progress-wrapper d-none d-md-flex">
            <div class="co-progress-step">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                Cart
            </div>
            <div class="co-progress-divider"></div>
            <div class="co-progress-step active">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                Shipping
            </div>
            <div class="co-progress-divider"></div>
            <div class="co-progress-step">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                Payment
            </div>
        </div>

        @if($cartItems->count() > 0)
        <div class="row gy-3 gy-lg-0 gx-lg-5">
            <!-- LEFT : Addresses -->
            <div class="col-lg-8 col-12">
                <div class="co-left-wrapper">
                    @if($userAddresses->count() > 0)
                    <h3 class="co-summary-title mb-4">Shipping Address</h3>

                    <div class="row address-selection mb-4 gy-4" style="--bs-gutter-x: 20px;">
                        @foreach($userAddresses as $address)
                        <div class="col-lg-6 col-md-6 col-12">
                            <label class="co-address-card w-100" style="cursor:pointer;" onclick="document.querySelectorAll('.co-address-card').forEach(c => c.classList.remove('selected')); this.classList.add('selected');">
                                <div class="address-name">{{ $address->name }}</div>
                                <div class="address-details">
                                    {{ $address->address_line1 }}, {{ $address->address_line2 }}<br>
                                    {{ $address->emirate }}<br>
                                    {{ $address->contact_no }}
                                    @if(isset($address->whatsapp_no)) <br>{{ $address->whatsapp_no }} @endif
                                    @if($address->landmark) <br>Landmark: {{ $address->landmark }} @endif
                                </div>
                                <input class="co-radio-btn" type="radio" name="selected_address" value="{{ $address->id }}">
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Add New Address Button -->
                    <button type="button" id="addNewAddressBtn" class="co-btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add New Address
                    </button>

                    <!-- Address Form -->
                    <form method="POST" id="productInquiryForm" action="">
                        @csrf

                        <div id="addressFormWrapper" style="display:none;">
                            <h3 class="co-summary-title mb-4 mt-2">Enter New Address</h3>
                            <div class="row" style="--bs-gutter-x: 24px;">
                                
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Enter Full Name"
                                            value="{{ old('name') }}"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                            class="co-input-field @error('name') is-invalid @enderror">
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Contact Number <span class="text-danger">*</span></label>
                                        <input type="tel" id="checkout-contact-no" name="contact_no" placeholder="Enter contact Number"
                                            value="{{ old('contact_no') }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                            class="co-input-field checkout-contact-country-select @error('contact_no') is-invalid @enderror">
                                        <input type="hidden" name="contact_country" id="checkout-contact-country" value="">
                                        @error('contact_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Emirate <span class="text-danger">*</span></label>
                                        @php $emirates = config('global_values.emirates'); @endphp
                                        <select name="emirate" class="co-input-field co-input-select">
                                            <option value="">Select Emirate</option>
                                            @foreach($emirates as $emirate)
                                                <option value="{{ $emirate }}" {{ old('emirate') == $emirate ? 'selected' : '' }}>
                                                    {{ $emirate }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('emirate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Whatsapp Number </label>
                                        <input type="tel" id="checkout-whatsapp-no" name="whatsapp_no"
                                            value="{{ old('whatsapp_no') }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                            class="co-input-field checkout-whatsapp-country-select @error('whatsapp_no') is-invalid @enderror">
                                        <input type="hidden" name="whatsapp_country" id="checkout-whatsapp-country" value="">
                                        @error('whatsapp_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Flat/House No., Building <span class="text-danger">*</span></label>
                                        <input type="text" name="address_line1" placeholder="Enter Details" class="co-input-field" value="">
                                        @error('address_line1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Area, Street, Sector, Town <span class="text-danger">*</span></label>
                                        <input type="text" name="address_line2" placeholder="Enter Details" class="co-input-field" value="">
                                        @error('address_line2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="co-input-group">
                                        <label class="co-input-label">Landmark</label>
                                        <textarea name="landmark" placeholder="Enter Landmark" rows="2"
                                            class="co-input-field co-input-textarea @error('landmark') is-invalid @enderror">{{ old('landmark') }}</textarea>
                                        @error('landmark') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <!-- Trust Badges & Support -->
                <div class="co-trust-section">
                    <div class="co-trust-item">
                        <div class="co-trust-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                        </div>
                        <div class="co-trust-content">
                            <h5>Secure Checkout</h5>
                            <p>Your payment information is encrypted</p>
                        </div>
                    </div>

                    <!-- Support Box -->
                    <div class="co-support-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--co-primary); margin-top: 4px; flex-shrink: 0;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <div class="co-support-box-text">
                            <h4>Need help with your order?</h4>
                            <p>Call or WhatsApp us at <a href="tel:971502243720" class="co-support-box-link">+971 50 224 3720</a></p>
                        </div>
                    </div>
                </div>
                {{-- <div class="checkout-box">
                        <div class="ct_form">
                        @if($userAddresses->count() > 0)
                            <div class="ct_input mb-3">
                                <label class="sub_head">Select Address</label>
                                <select id="addressSelect" class="">
                                    <option value="">-- Choose Existing Address --</option>
                                    @foreach($userAddresses as $address)
                                        <option value="{{ $address->id }}">
                                        {{ $address->address_line1 }}, {{ $address->address_line2 }}, {{ $address->emirate }}
                                        </option>
                                        @endforeach
                                        <option value="new">Add New Address</option>
                                        </select>
                                    </div>
                                    @endif

                                    <form method="POST" id="productInquiryForm" action="{{ route('front.store.product.inquiry') }}">
                                        @csrf

                                        <div id="addressFormWrapper" style="{{ $userAddresses->count() > 0 ? 'display:none;' : '' }}">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="ct_input">
                                                        <label class="sub_head">Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                                            class="@error('name') is-invalid @enderror">
                                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="ct_input">
                                                        <label class="sub_head">Contact Number <span class="text-danger">*</span></label>
                                                        <input type="tel" id="checkout-contact-no-old" name="contact_no" placeholder="Enter contact Number"
                                                            value="{{ old('contact_no') }}"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                                            class="checkout-contact-country-select @error('contact_no') is-invalid @enderror">
                                                        <input type="hidden" name="contact_country" id="checkout-contact-country-old" value="">
                                                        @error('contact_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="ct_input">
                                                        <label class="sub_head">Emirate <span class="text-danger">*</span></label>
                                                        <input type="text" name="emirate" placeholder="Enter Emirate"
                                                            value="{{ old('emirate') }}" class="@error('emirate') is-invalid @enderror">
                                                        @error('emirate') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="ct_input">
                                                        <label class="sub_head">Address Line 1 <span class="text-danger">*</span></label>
                                                        <input type="text" name="address_line1" placeholder="Enter Address Line 1"
                                                            class="fw-medium" value="">
                                                        @error('address_line1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="ct_input">
                                                        <label class="sub_head">Address Line 2 <span class="text-danger">*</span></label>
                                                        <input type="text" name="address_line2" placeholder="Enter Address Line 2"
                                                            class="fw-medium" value="">
                                                        @error('address_line2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="ct_input">
                                                        <label class="sub_head">Landmark</label>
                                                        <textarea name="landmark" placeholder="Enter Landmark" rows="1"
                                                            class="@error('landmark') is-invalid @enderror">{{ old('landmark') }}</textarea>
                                                        @error('landmark') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                    </div> --}}
    </div>
    <!-- RIGHT : Price Summary + Payment -->
    <div class="col-lg-4 col-12">
        <div class="co-summary-wrapper">
            <h3 class="co-summary-title">Order Summary</h3>

            <!-- Compact Items List -->
            <div class="co-compact-items">
                @foreach($cartItems as $item)
                <div class="co-compact-item">
                    <div class="co-compact-img-wrap">
                        <div class="co-compact-badge">{{ $item->quantity }}</div>
                        <img src="{{ isset($item->product->list_page_img) ? asset('public/images/admin/product_list/'.$item->product->list_page_img) : '' }}" alt="{{ $item->product->product_name ?? 'Product' }}">
                    </div>
                    <div class="co-compact-info">
                        <h5>{{ $item->product->product_name ?? 'Product' }}</h5>
                    </div>
                    <div class="co-compact-price">
                        {{ number_format($item->price * $item->quantity, 2) }} AED
                    </div>
                </div>
                @endforeach
            </div>

            <label class="co-gift-wrapper">
                <div class="co-gift-wrapper-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 12 20 22 4 22 4 12"></polyline>
                        <rect x="2" y="7" width="20" height="5"></rect>
                        <line x1="12" y1="22" x2="12" y2="7"></line>
                        <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path>
                        <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path>
                    </svg>
                     <p class="co-gift-text">Want Gift Wrapping?</p>
                </div>
                <input type="checkbox" name="gift_wrapper" value="1" class="co-gift-checkbox">
            </label>

            <div class="co-summary-item">
                <span class="co-summary-label">Subtotal</span>
                <span class="co-summary-val">{{ number_format($subTotal, 2) }} AED</span>
            </div>
            <div class="co-summary-item">
                <span class="co-summary-label">Delivery</span>
                <span class="co-delivery-val">Calculated based on Qty</span>
            </div>

            <hr class="co-summary-divider">
            <hr class="co-summary-divider-2">

            <div class="co-total-row">
                <span class="co-total-label">Total to Pay</span>
                <span class="co-total-val" id="you-pay">{{ number_format($subTotal, 2) }} AED</span>
            </div>

            <div class="payment-methods-card">
                <div class="co-payment-header">
                    <div class="co-payment-header-left">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#B58A46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <h4 class="co-payment-header-title">Payment Method</h4>
                    </div>
                    <span class="co-secure-badge">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        SSL Secure
                    </span>
                </div>

                <!-- 4 Selectable Payment Method Tabs -->
                <div class="co-payment-tabs-grid">
                    <button type="button" class="co-pay-tab-btn active" data-tab="card" id="tabBtnCard">
                        <span class="co-tab-icon">
                            <svg width="18" height="13" viewBox="0 0 24 18" fill="none">
                                <rect width="24" height="18" rx="3" fill="#1e293b"/>
                                <rect y="4" width="24" height="3" fill="#64748b"/>
                                <circle cx="6" cy="12" r="2" fill="#e2e8f0"/>
                            </svg>
                        </span>
                        <span>Cards</span>
                    </button>
                    <button type="button" class="co-pay-tab-btn" data-tab="apple_pay" id="tabBtnApplePay">
                        <span class="co-tab-icon">
                            <svg width="15" height="15" viewBox="0 0 170 170" fill="currentColor">
                                <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.67-7.81-11.96-14.31-6.19-9.35-11.05-19.86-14.57-31.54-3.52-11.68-5.28-22.75-5.28-33.22 0-14.45 3.69-26.4 11.08-35.84 7.39-9.44 16.59-14.28 27.6-14.52 5.02 0 10.51 1.34 16.48 4.02 5.97 2.68 9.77 4.07 11.4 4.17 1.45 0 5.48-1.5 12.09-4.5 6.61-3 12.44-4.32 17.5-3.97 12.98.65 23.36 5.56 31.13 14.73-11.36 6.86-16.92 16.41-16.68 28.65.23 9.77 4.07 17.84 11.52 24.21 7.45 6.37 16.29 10.02 26.52 10.95-2.23 6.97-5.02 14.07-8.37 21.3m-37.49-114.65c0-6.19 2.23-12.21 6.69-18.06 4.46-5.85 10.15-9.87 17.07-12.06.33 2.12.5 4.02.5 5.7 0 6.08-2.34 12.1-7.02 18.06-4.68 5.96-10.42 9.92-17.24 11.88v-5.52z"/>
                            </svg>
                        </span>
                        <span>Apple Pay</span>
                    </button>
                    <button type="button" class="co-pay-tab-btn" data-tab="google_pay" id="tabBtnGooglePay">
                        <span class="co-tab-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.24v3.15C3.26 21.36 7.34 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.24C.45 8.15 0 9.92 0 12s.45 3.85 1.24 5.42l4.04-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.24 6.58l4.04 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                        </span>
                        <span>Google Pay</span>
                    </button>
                    {{-- <button type="button" class="co-pay-tab-btn" data-tab="link" id="tabBtnLink">
                        <span class="co-tab-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11" fill="#00D66F"/>
                                <path d="M9.2 7.4L12.8 10.8H14.8V13.2H12.8Q11.8 15.2 9.4 16.8L8.0 15.3Q10.2 13.8 11.2 12L8.0 9.0L9.2 7.4Z" fill="#000000"/>
                            </svg>
                        </span>
                        <span>Link</span>
                    </button> --}}
                </div>

                <!-- Tab 1: Cards Panel -->
                <div class="co-tab-panel active" id="tab-panel-card">
                    <!-- Cards tab uses unified card container below -->
                </div>

                <!-- Tab 2: Apple Pay Panel -->
                <div class="co-tab-panel" id="tab-panel-apple_pay" style="display: none;">
                    <div class="co-wallet-panel-card">
                        <div class="co-wallet-icon-wrapper">
                            <svg width="22" height="22" viewBox="0 0 170 170" fill="#000000">
                                <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.67-7.81-11.96-14.31-6.19-9.35-11.05-19.86-14.57-31.54-3.52-11.68-5.28-22.75-5.28-33.22 0-14.45 3.69-26.4 11.08-35.84 7.39-9.44 16.59-14.28 27.6-14.52 5.02 0 10.51 1.34 16.48 4.02 5.97 2.68 9.77 4.07 11.4 4.17 1.45 0 5.48-1.5 12.09-4.5 6.61-3 12.44-4.32 17.5-3.97 12.98.65 23.36 5.56 31.13 14.73-11.36 6.86-16.92 16.41-16.68 28.65.23 9.77 4.07 17.84 11.52 24.21 7.45 6.37 16.29 10.02 26.52 10.95-2.23 6.97-5.02 14.07-8.37 21.3m-37.49-114.65c0-6.19 2.23-12.21 6.69-18.06 4.46-5.85 10.15-9.87 17.07-12.06.33 2.12.5 4.02.5 5.7 0 6.08-2.34 12.1-7.02 18.06-4.68 5.96-10.42 9.92-17.24 11.88v-5.52z"/>
                            </svg>
                        </div>
                        <h5 class="co-wallet-title">Apple Pay</h5>
                        <p class="co-wallet-subtitle">Fast, seamless checkout with Touch ID or Face ID.</p>

                        <div id="stripe-apple-pay-element"></div>

                        <button type="button" class="co-apple-pay-btn" id="directApplePayBtn">
                            <svg width="20" height="20" viewBox="0 0 170 170" fill="currentColor">
                                <path d="M150.37 130.25c-2.45 5.66-5.35 10.87-8.71 15.66-4.58 6.53-8.33 11.05-11.22 13.56-4.48 4.12-9.28 6.23-14.42 6.35-3.69 0-8.14-1.05-13.32-3.18-5.19-2.12-9.97-3.17-14.34-3.17-4.58 0-9.49 1.05-14.75 3.17-5.26 2.13-9.5 3.24-12.74 3.35-4.35.13-9.16-1.9-14.42-6.08-3.69-3.04-7.67-7.81-11.96-14.31-6.19-9.35-11.05-19.86-14.57-31.54-3.52-11.68-5.28-22.75-5.28-33.22 0-14.45 3.69-26.4 11.08-35.84 7.39-9.44 16.59-14.28 27.6-14.52 5.02 0 10.51 1.34 16.48 4.02 5.97 2.68 9.77 4.07 11.4 4.17 1.45 0 5.48-1.5 12.09-4.5 6.61-3 12.44-4.32 17.5-3.97 12.98.65 23.36 5.56 31.13 14.73-11.36 6.86-16.92 16.41-16.68 28.65.23 9.77 4.07 17.84 11.52 24.21 7.45 6.37 16.29 10.02 26.52 10.95-2.23 6.97-5.02 14.07-8.37 21.3m-37.49-114.65c0-6.19 2.23-12.21 6.69-18.06 4.46-5.85 10.15-9.87 17.07-12.06.33 2.12.5 4.02.5 5.7 0 6.08-2.34 12.1-7.02 18.06-4.68 5.96-10.42 9.92-17.24 11.88v-5.52z"/>
                            </svg>
                            <span>Pay with Apple Pay</span>
                        </button>
                        <div id="apple-pay-msg-box" class="mt-2 text-start" style="display: none;"></div>
                        <p class="co-wallet-notice mt-2">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            Available on Safari using Apple devices (iPhone, iPad, Mac)
                        </p>
                    </div>
                </div>

                <!-- Tab 3: Google Pay Panel -->
                <div class="co-tab-panel" id="tab-panel-google_pay" style="display: none;">
                    <div class="co-wallet-panel-card">
                        <div class="co-wallet-icon-wrapper">
                            <svg width="22" height="22" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.24v3.15C3.26 21.36 7.34 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.24C.45 8.15 0 9.92 0 12s.45 3.85 1.24 5.42l4.04-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.24 6.58l4.04 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                        </div>
                        <h5 class="co-wallet-title">Google Pay</h5>
                        <p class="co-wallet-subtitle">Fast checkout with cards saved in your Google Account.</p>

                        <div id="stripe-google-pay-element"></div>

                        <button type="button" class="co-google-pay-btn" id="directGooglePayBtn">
                            <svg width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.24v3.15C3.26 21.36 7.34 24 12 24z"/>
                                <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.24C.45 8.15 0 9.92 0 12s.45 3.85 1.24 5.42l4.04-3.15z"/>
                                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.24 6.58l4.04 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                            </svg>
                            <span>Pay with Google Pay</span>
                        </button>
                        <div id="google-pay-msg-box" class="mt-2 text-start" style="display: none;"></div>
                        <p class="co-wallet-notice mt-2">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            Available on Chrome/Android with cards saved to Google Wallet
                        </p>
                    </div>
                </div>

                {{--
                <!-- Tab 4: Link Panel -->
                <div class="co-tab-panel" id="tab-panel-link" style="display: none;">
                    <div class="co-wallet-panel-card mb-3">
                        <div class="co-wallet-icon-wrapper" style="width: 52px; height: 52px; background: transparent; box-shadow: none; margin: 0 auto 10px auto; display: flex; align-items: center; justify-content: center;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="11" fill="#00D66F"/>
                                <path d="M9.2 7.4L12.8 10.8H14.8V13.2H12.8Q11.8 15.2 9.4 16.8L8.0 15.3Q10.2 13.8 11.2 12L8.0 9.0L9.2 7.4Z" fill="#000000"/>
                            </svg>
                        </div>
                        <h5 class="co-wallet-title">Stripe Link (1-Click Checkout)</h5>
                        <p class="co-wallet-subtitle">Pay with your saved cards across any site supporting Stripe Link.</p>

                        <!-- Stripe Official Link Email Verification Element -->
                        <div id="stripe-link-auth-element" class="text-start mb-2"></div>

                        <!-- Status message when Link account is verified -->
                        <div id="link-auth-status" class="mt-2 text-start" style="display: none;"></div>

                        <div id="link-card-notice" class="mt-2 text-start" style="font-size: 12px; color: #475569; background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 10px 12px; line-height: 1.4;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" style="vertical-align: -2px; margin-right: 4px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <span id="link-card-notice-text">Enter your Link account email above. If you have saved cards in Link, a 6-digit verification code will be sent for instant checkout.</span>
                        </div>

                        <p class="co-wallet-notice mt-3">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            Link securely stores your payment info for instant 1-click checkout.
                        </p>
                    </div>
                </div>
                --}}

                <!-- Unified Card Inputs Container (Preserves Stripe iframe in DOM without reload) -->
                <div id="card-element-container">
                    <div id="payment-loader" class="text-center py-4">
                        <div class="spinner-border spinner-border-sm" role="status" style="color: #B58A46;">
                            <span class="visually-hidden">Loading card form...</span>
                        </div>
                        <p class="mt-2 mb-0" style="font-size: 13px; color: #64748B;">Loading secure card inputs...</p>
                    </div>
                    <div id="card-element" class="mt-1" style="display: none;"></div>
                </div>

                <div id="error-message" style="display: none;"></div>
            </div>

            <button type="button" id="payBtn" class="co-btn-primary mt-3">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span class="btn-text">PAY SECURELY NOW</span>
                <span class="btn-loader" style="display:none;">Processing...</span>
            </button>

            <!-- ONLY POWERED BY STRIPE BADGE -->
            <div class="co-powered-stripe-only mt-3 text-center">
                <span class="d-inline-flex align-items-center gap-2" style="font-size: 13px; color: #555555; font-weight: 500;">
                    Powered by
                    <!-- <svg viewBox="0 0 36 24" width="28" height="18" style="vertical-align: middle;"><rect width="36" height="24" rx="3" fill="#635BFF"/><path d="M16.5 10.3c0-.6.5-.9 1.3-.9 1.2 0 2.6.4 3.7 1v-3c-1.3-.5-2.6-.7-3.8-.7-3.1 0-5.2 1.6-5.2 4.2 0 4.1 5.6 3.4 5.6 5.2 0 .7-.6 1-1.5 1-1.4 0-3.1-.6-4.3-1.3v3.1c1.4.6 2.9.9 4.3.9 3.2 0 5.4-1.6 5.4-4.2-.1-4.4-5.5-3.6-5.5-5.3z" fill="#FFF"/></svg> -->
                    <strong style="color: #635BFF; font-size: 14px; font-weight: 700;">Stripe</strong>
                </span>
            </div>

            <a href="{{ route('front.home') }}" class="co-return-store">Return to Store</a>
        </div>
    </div>
    </div>
    </div>
    @else
    <div class="text-center">
        <p>No Orders are Found</p>
        <a href="{{ route('front.home') }}" class="com_btn">Continue Shopping</a>
    </div>
    @endif
    </div>
</section>


@push('script')
<script>
var $discountedTotal = parseFloat(@json($subTotal));

$(document).ready(function () {
    // FOR DISCOUNT CALCULATION
   {{-- var subTotal = parseFloat(@json($subTotal));
   var discountPercent = parseFloat(@json($discountPercent));
   $cartSubTotal =  subTotal; // Assuming this value is set from the server-side
   $discount = ($cartSubTotal * discountPercent) / 100; // Calculate discount based on global value
   $discountedTotal = $cartSubTotal - $discount; // Calculate total after discount      
    $('#discounted-values').text(`- AED ${$discount.toFixed(2)}`); // Display discount  
    $('#you-pay').text(`AED ${$discountedTotal.toFixed(2)}`); --}} // Display total after discount 
}); 

function setPayLoading(state) {
    if (state) {
        $('#payBtn, #directApplePayBtn, #directGooglePayBtn').prop('disabled', true);
        $('.btn-text').hide();
        $('.btn-loader').show();
        $('#directApplePayBtn, #directGooglePayBtn').css('opacity', '0.6');
    } else {
        $('#payBtn, #directApplePayBtn, #directGooglePayBtn').prop('disabled', false);
        $('.btn-text').show();
        $('.btn-loader').hide();
        $('#directApplePayBtn, #directGooglePayBtn').css('opacity', '1');
    }
}


//const stripeKey = "{{ trim(config('services.stripe.key') ?: env('STRIPE_KEY') ?: '') }}";
const stripeKey = "pk_test_51T2UjrBLdEEnW2TMuiMSWDcf3LBixdC7EY0qFpZNR6Q78FMHVKa5abv42Af3ookZYKXxwXgVdIBTsGtTYAAApRLb00gMZ6x1bi";
if (!stripeKey) {
    console.error('Stripe publishable key is missing! Please check STRIPE_KEY in .env and run php artisan config:clear');
}
const stripe = Stripe(stripeKey);
let elements;
let paymentElement;
let clientSecret;

async function createPaymentIntent(amount) {
    const response = await fetch("{{ route('front.checkout.test.process') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            amount
        })
    });
    const data = await response.json();
    if (!response.ok || !data.client_secret) {
        console.error('Payment intent error:', data);
        throw new Error(data.message || 'Unable to initialize Stripe payment. Please check credentials.');
    }
    return data.client_secret;
}

async function mountPaymentElement(clientSecret) {

    if (elements) {
        $('#card-element').html('');
    }

{{--
    // Appearance customization – using Stripe defaults for simplicity.
    const appearance = {
        theme: 'stripe',
        // variables and rules have been omitted to rely on default styling.
    };
--}}

    elements = stripe.elements({
        clientSecret
    });

    paymentElement = elements.create('payment', {
        layout: {
            type: 'tabs',
            defaultCollapsed: false,
        },
        wallets: {
            applePay: 'never',
            googlePay: 'never',
            link: 'never',
        },
        fields: {
            billingDetails: {
                name: 'auto',
                email: 'auto',
                address: {
                    country: 'never'
                }
            }
        },
        defaultValues: {
            billingDetails: {
                name: "{{ auth()->check() ? addslashes(auth()->user()->name) : '' }}",
                email: "{{ auth()->check() ? addslashes(auth()->user()->email) : '' }}",
                address: {
                    country: 'AE'
                }
            }
        }
    });

    paymentElement.mount('#card-element');

    {{--
    // Stripe Link authentication block is commented out as the Link payment method is disabled.
    // This preserves the code for reference without affecting functionality.
    // try {
    //     const linkAuthElement = elements.create('linkAuthentication', {
    //         defaultValues: {
    //             email: "{{ auth()->check() ? addslashes(auth()->user()->email) : '' }}"
    //         }
    //     });
    //     linkAuthElement.mount('#stripe-link-auth-element');
    //
    //     linkAuthElement.on('change', function(event) {
    //         if (event.authenticated) {
    //             $('#link-card-notice').hide();
    //             $('#link-auth-status').html('<div style="background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:10px 14px; border-radius:8px; font-size:13px; font-weight:600;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" style="vertical-align:-3px;margin-right:6px;"><polyline points="20 6 9 17 4 12"/></svg>Link Account Verified: Your saved payment method is ready.</div>').show();
    //             if (currentPaymentTab === 'link') {
    //                 $('#card-element-container').slideUp(200);
    //             }
    //         } else {
    //             $('#link-auth-status').hide().html('');
    //             $('#link-card-notice').show();
    //             if (event.value && event.value.email) {
    //                 $('#link-card-notice-text').text('No saved Link account found with this email. Enter card details below to complete payment and save your card to Link for 1-click checkout next time.');
    //             } else {
    //                 $('#link-card-notice-text').text('Enter your Link account email above. If you have saved cards in Link, a 6-digit verification code will be sent for instant checkout.');
    //             }
    //             if (currentPaymentTab === 'link') {
    //                 $('#card-element-container').slideDown(200);
    //             }
    //         }
    //     });
    // } catch(e) {
    //     console.warn('Stripe Link Authentication Element error:', e);
    // }
    --}}

    paymentElement.on('ready', function() {
        $('#payment-loader').hide();
        $('#card-element').fadeIn(200);
    });

    // STRIPE VALIDATION
    paymentElement.on('change', function(event) {

        // CLEAR ERROR
        $('#error-message').text('').hide();

        // IF ERROR
        if (event.error) {
            $('#error-message').text(event.error.message).show();
            return;
        }

    });
}

$(document).ready(async function() {
    const checkoutContactInput = document.querySelector("#checkout-contact-no");
    const checkoutContactCountry = document.querySelector("#checkout-contact-country");
    let checkoutContactIti = null;

    if (checkoutContactInput && window.intlTelInput)
    {
        /*
        // OLD CODE - AUTO DETECT COUNTRY USING IP    
        checkoutContactIti = window.intlTelInput(checkoutContactInput, {
            initialCountry: "auto",
            separateDialCode: true,
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => {
                        callback(data.country_code.toLowerCase());
                    })
                    .catch(() => {
                        callback("ae"); // fallback country
                    });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        }); */

        // NEW CODE - FIXED UAE FLAG AND +971 COUNTRY CODE
        checkoutContactIti = window.intlTelInput(checkoutContactInput, {
            initialCountry: "ae",
            onlyCountries: ["ae"],
            separateDialCode: true,
            allowDropdown: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    }

    const checkoutWhatsappInput = document.querySelector("#checkout-whatsapp-no");
    const checkoutWhatsappCountry = document.querySelector("#checkout-whatsapp-country");
    let checkoutWhatsappIti = null;

    if (checkoutWhatsappInput && window.intlTelInput)
    {
        /*
        // OLD CODE - AUTO DETECT COUNTRY USING IP    
        checkoutWhatsappIti = window.intlTelInput(checkoutWhatsappInput, {
            initialCountry: "auto",
            separateDialCode: true,
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => {
                        callback(data.country_code.toLowerCase());
                    })
                    .catch(() => {
                        callback("ae"); // fallback country
                    });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        }); */

        // NEW CODE - FIXED UAE FLAG AND +971 COUNTRY CODE
        checkoutWhatsappIti = window.intlTelInput(checkoutWhatsappInput, {
            initialCountry: "ae",
            onlyCountries: ["ae"],
            separateDialCode: true,
            allowDropdown: false,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    }

    // function setCheckoutWhatsappValue() {
    //     // if (!checkoutWhatsappInput || !checkoutWhatsappIti) {
    //     //     return;
    //     // }
    //     const countryData = checkoutWhatsappIti.getSelectedCountryData();
    //     const rawNumber = checkoutWhatsappInput.value.replace(/\D/g, "");
    //     // checkoutWhatsappCountry.value = countryData.name || "";
    //     // checkoutWhatsappInput.value = rawNumber ? `${countryData.dialCode}${rawNumber}` : "";
    //     //Remove already-added dial code (prevents duplication like 919191...)
    //     const dialCode = countryData.dialCode;
    //     if (rawNumber.startsWith(dialCode)) {
    //         rawNumber = rawNumber.slice(dialCode.length);
    //     }
    //     checkoutWhatsappCountry.value = countryData.name || "";
    //     //Ensure we only prepend dial code once
    //     checkoutWhatsappInput.value = rawNumber ? `${dialCode}${rawNumber}` : "";
    // }
    
    function setCheckoutContactValue() {
        if (!checkoutContactIti) return;
        const countryData = checkoutContactIti.getSelectedCountryData();
        let rawNumber = checkoutContactInput.value.replace(/\D/g, "");
        const dialCode = countryData.dialCode;
        if (rawNumber.startsWith(dialCode)) {
            rawNumber = rawNumber.slice(dialCode.length);
        }
        checkoutContactCountry.value = countryData.name || "";
        checkoutContactInput.value = rawNumber ? `${dialCode}${rawNumber}` : "";
    }

    function setCheckoutWhatsappValue() {

        const countryData = checkoutWhatsappIti.getSelectedCountryData();
    
        let rawNumber = checkoutWhatsappInput.value.replace(/\D/g, "");
    
        const dialCode = countryData.dialCode;
    
        // Remove duplicate dial code
        if (rawNumber.startsWith(dialCode)) {
            rawNumber = rawNumber.slice(dialCode.length);
        }
    
        checkoutWhatsappCountry.value = countryData.name || "";
    
        // Add dial code once only
        checkoutWhatsappInput.value = rawNumber
            ? `${dialCode}${rawNumber}`
            : "";
    }

    // Check on page load
    if ($('input[name="selected_address"]').length === 0) {
        // No existing addresses
        $('#addressFormWrapper').show();
        $('#addNewAddressBtn').hide();
    }

    // Add New Address button click
    $('#addNewAddressBtn').on('click', function() {
        $('#addressFormWrapper').slideDown();
        $('input[name="selected_address"]').prop('checked', false);
    });

    // Hide form if existing address selected
    $('input[name="selected_address"]').on('change', function() {
        $('#addressFormWrapper').slideUp();
    });

    $("#productInquiryForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            contact_no: {
                required: true,
                digits: true,
                minlength: 7,
                maxlength: 15
            },
            whatsapp_no: {
                //required: true,
                digits: true,
                minlength: 7,
                maxlength: 15
            },
            emirate: {
                required: true,
            },
            address_line1: {
                required: true,
                minlength: 3
            },
            address_line2: {
                required: true,
                minlength: 3
            },
            landmark: {
                required: false,
                minlength: 5
            }
        },
        messages: {
            name: {
                required: "Please enter your full name",
                minlength: "Name must be at least 3 characters long"
            },
            contact_no: {
                required: "Please enter your contact number",
                digits: "Only numeric values are allowed",
                minlength: "Contact number must be at least 7 digits",
                maxlength: "Contact number cannot exceed 15 digits"
            },
            whatsapp_no: {
                //required: "Please enter your Whatsapp number",
                digits: "Only numeric values are allowed",
                minlength: "Whatsapp number must be at least 7 digits",
                maxlength: "Whatsapp number cannot exceed 15 digits"
            },
            emirate: {
                required: "Please select emirate",
            },
            address_line1: {
                required: "Please enter your Details",
                minlength: "Details must be at least 3 characters"
            },
            address_line2: {
                required: "Please enter your Details",
                minlength: "Details must be at least 3 characters"
            },
            landmark: {
                minlength: "Landmark must be at least 5 characters long"
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    let currentPaymentTab = 'card';
    let paymentRequest = null;
    let canUseApplePay = false;
    let canUseGooglePay = false;

    // TAB SWITCHING HANDLER
    $('.co-pay-tab-btn').on('click', function() {
        const tab = $(this).data('tab');
        currentPaymentTab = tab;

        // Active state
        $('.co-pay-tab-btn').removeClass('active');
        $(this).addClass('active');

        // Clear errors in all message areas
        $('#error-message, #apple-pay-msg-box, #google-pay-msg-box, #link-msg-box').text('').hide();

        // Reset button classes
        $('#payBtn').removeClass('btn-link-mode btn-apple-mode btn-google-mode');

        if (tab === 'card') {
            $('.co-tab-panel').removeClass('active').hide();
            $('#tab-panel-card').addClass('active').show();
            $('#card-element-container').show();
            $('#payBtn').removeClass('d-none').show();
            $('#payBtn .btn-text').html('PAY SECURELY NOW');
        } else if (tab === 'link') {
            $('.co-tab-panel').removeClass('active').hide();
            $('#tab-panel-link').addClass('active').fadeIn(150);
            if ($('#link-auth-status').is(':visible')) {
                $('#card-element-container').hide();
            } else {
                $('#card-element-container').show();
            }
            $('#payBtn').removeClass('d-none').show();
            $('#payBtn').addClass('btn-link-mode');
            $('#payBtn .btn-text').html('<svg width="20" height="20" viewBox="0 0 24 24" fill="none" style="vertical-align:middle;margin-right:8px;"><circle cx="12" cy="12" r="11" fill="#000000"/><path d="M9.2 7.4L12.8 10.8H14.8V13.2H12.8Q11.8 15.2 9.4 16.8L8.0 15.3Q10.2 13.8 11.2 12L8.0 9.0L9.2 7.4Z" fill="#00D66F"/></svg>PAY WITH LINK');
        } else if (tab === 'apple_pay') {
            $('.co-tab-panel').removeClass('active').hide();
            $('#card-element-container').hide();
            $('#tab-panel-apple_pay').addClass('active').fadeIn(150);
            $('#payBtn').addClass('d-none').hide();
            $('#payBtn .btn-text').html('PAY WITH APPLE PAY');
        } else if (tab === 'google_pay') {
            $('.co-tab-panel').removeClass('active').hide();
            $('#card-element-container').hide();
            $('#tab-panel-google_pay').addClass('active').fadeIn(150);
            $('#payBtn').addClass('d-none').hide();
            $('#payBtn .btn-text').html('PAY WITH GOOGLE PAY');
        }
    });

    // DIRECT BUTTONS TRIGGER MAIN HANDLER
    $('#directApplePayBtn').on('click', function() {
        $('#payBtn').click();
    });
    $('#directGooglePayBtn').on('click', function() {
        $('#payBtn').click();
    });

    function initPaymentRequest(amount) {
        try {
            paymentRequest = stripe.paymentRequest({
                country: 'AE',
                currency: 'aed',
                total: {
                    label: 'Order Total',
                    amount: Math.round(amount * 100),
                },
                requestPayerName: true,
                requestPayerEmail: true,
            });

            paymentRequest.canMakePayment().then(function(result) {
                console.log("Stripe canMakePayment result:", result);
                if (result) {
                    if (result.applePay) {
                        canUseApplePay = true;
                        try {
                            const prAppleBtn = elements.create('paymentRequestButton', {
                                paymentRequest: paymentRequest,
                                style: {
                                    paymentRequestButton: {
                                        type: 'buy',
                                        theme: 'dark',
                                        height: '44px',
                                    }
                                }
                            });
                            prAppleBtn.mount('#stripe-apple-pay-element');
                            $('#directApplePayBtn').hide();
                        } catch(e) {
                            console.warn("Apple Pay button mount error:", e);
                        }
                    }
                    if (result.googlePay) {
                        canUseGooglePay = true;
                        try {
                            const prGoogleBtn = elements.create('paymentRequestButton', {
                                paymentRequest: paymentRequest,
                                style: {
                                    paymentRequestButton: {
                                        type: 'buy',
                                        theme: 'light',
                                        height: '44px',
                                    }
                                }
                            });
                            prGoogleBtn.mount('#stripe-google-pay-element');
                            $('#directGooglePayBtn').hide();
                        } catch(e) {
                            console.warn("Google Pay button mount error:", e);
                        }
                    }
                } else {
                    console.warn("Stripe canMakePayment returned null (No supported wallet ready on this browser/device).");
                }
            }).catch(function(err) {
                console.error("Stripe canMakePayment error:", err);
            });

            paymentRequest.on('paymentmethod', async function(ev) {
                setPayLoading(true);
                const currentSitePath = (typeof sitePath !== 'undefined' ? sitePath : "{{ url('/') }}");

                // Resolve address ID before confirming payment
                let resolvedAddressId = null;
                const selectedAddress = $('input[name="selected_address"]:checked').val();
                const isAddingNew = $('#addressFormWrapper').is(':visible');

                if (selectedAddress) {
                    // Existing address selected
                    resolvedAddressId = selectedAddress;
                } else if (isAddingNew) {
                    // Validate and save new address first
                    if (!$('#productInquiryForm').valid()) {
                        ev.complete('fail');
                        $('#error-message').html('<strong>Please complete the required delivery address fields above.</strong>').show();
                        $('html, body').animate({ scrollTop: $('#addressFormWrapper').offset().top - 80 }, 400);
                        setPayLoading(false);
                        return;
                    }
                    setCheckoutContactValue();
                    setCheckoutWhatsappValue();
                    try {
                        let addrResponse = await fetch("{{ route('front.checkout.test.store.address') }}", {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: $('#productInquiryForm').serialize()
                        });
                        let addrData = await addrResponse.json();
                        if (!addrData.success) {
                            ev.complete('fail');
                            $('#error-message').text('Something went wrong while saving address.').show();
                            setPayLoading(false);
                            return;
                        }
                        resolvedAddressId = addrData.address_id;
                    } catch(addrErr) {
                        ev.complete('fail');
                        $('#error-message').text('Address save failed. Please try again.').show();
                        setPayLoading(false);
                        return;
                    }
                } else {
                    // No address selected and no new address form open
                    ev.complete('fail');
                    $('#error-message').text('Please select a delivery address or enter a new address above.').show();
                    setPayLoading(false);
                    return;
                }

                const { paymentIntent, error: confirmError } = await stripe.confirmCardPayment(
                    clientSecret,
                    { payment_method: ev.paymentMethod.id }
                );

                if (confirmError) {
                    ev.complete('fail');
                    $('#error-message').text(confirmError.message).show();
                    setPayLoading(false);
                } else {
                    ev.complete('success');
                    window.location.href = currentSitePath + '/checkout-test/payment/success?address_id=' + resolvedAddressId + '&payment_intent=' + paymentIntent.id + '&redirect_status=succeeded&gift_wrapper=' + ($('.co-gift-checkbox').is(':checked') ? 1 : 0);
                }
            });
        } catch(e) {
            console.warn('PaymentRequest initialization:', e);
        }
    }

    //const amount = $discountedTotal;
    const amount = 2;
    if (amount && amount > 0) {
        try {
            clientSecret = await createPaymentIntent(amount);
            if (clientSecret) {
                await mountPaymentElement(clientSecret);
                initPaymentRequest(amount);
                $('#error-message').text('').hide();
            } else {
                $('#payment-loader').html('<p class="text-danger mb-0" style="font-size:13px;">Unable to initialize payment gateway. Please refresh.</p>');
            }
        } catch (err) {
            console.error('Payment Gateway Init Error:', err);
            const errMsg = err.message || 'Please refresh.';
            $('#payment-loader').html('<p class="text-danger mb-0" style="font-size:13px;">Payment initialization error: ' + errMsg + '</p>');
        }
    }

    $('#payBtn').on('click', async function() {
        setPayLoading(true); // START LOADING

        try {
            const selectedAddress = $('input[name="selected_address"]:checked').val();
            const isAddingNew = $('#addressFormWrapper').is(':visible');
            var addressId;
            if (!selectedAddress && !isAddingNew) {
                const selMsg = 'Please select a delivery address or enter a new address above.';
                if (currentPaymentTab === 'apple_pay') {
                    $('#apple-pay-msg-box').html(selMsg).show();
                    $('#error-message, #google-pay-msg-box, #link-msg-box').hide();
                } else if (currentPaymentTab === 'google_pay') {
                    $('#google-pay-msg-box').html(selMsg).show();
                    $('#error-message, #apple-pay-msg-box, #link-msg-box').hide();
                } else if (currentPaymentTab === 'link') {
                    $('#link-msg-box').html('<div style="background:#FFFBEB; border:1px solid #FDE68A; color:#92400E; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;">' + selMsg + '</div>').show();
                    $('#error-message, #apple-pay-msg-box, #google-pay-msg-box').hide();
                } else {
                    $('#error-message').html(selMsg).show();
                    $('#apple-pay-msg-box, #google-pay-msg-box, #link-msg-box').hide();
                }
                setPayLoading(false);
                return;
            }
            if (isAddingNew) {
                if (!$('#productInquiryForm').valid()) {
                    const reqMsg = '<strong>Please complete the required delivery address fields above.</strong>';
                    if (currentPaymentTab === 'apple_pay') {
                        $('#apple-pay-msg-box').html(reqMsg).show();
                        $('#error-message, #google-pay-msg-box, #link-msg-box').hide();
                    } else if (currentPaymentTab === 'google_pay') {
                        $('#google-pay-msg-box').html(reqMsg).show();
                        $('#error-message, #apple-pay-msg-box, #link-msg-box').hide();
                    } else if (currentPaymentTab === 'link') {
                        $('#link-msg-box').html('<div style="background:#FFFBEB; border:1px solid #FDE68A; color:#92400E; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;">' + reqMsg + '</div>').show();
                        $('#error-message, #apple-pay-msg-box, #google-pay-msg-box').hide();
                    } else {
                        $('#error-message').html(reqMsg).show();
                        $('#apple-pay-msg-box, #google-pay-msg-box, #link-msg-box').hide();
                    }
                    $('html, body').animate({
                        scrollTop: $('#addressFormWrapper').offset().top - 80
                    }, 400);
                    setPayLoading(false);
                    return;
                }
            }

            // Apple Pay Handler
            if (currentPaymentTab === 'apple_pay') {
                if (paymentRequest && canUseApplePay) {
                    paymentRequest.show();
                } else {
                    const appleNotice = '<div style="background:#FFFBEB; border:1px solid #FDE68A; color:#92400E; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;"><strong>Apple Pay is not available on this device/browser.</strong><br>Apple Pay requires <strong>Safari</strong> on an Apple device (iPhone, iPad, Mac) with an active card in Apple Wallet.<br>Please select the <strong>Cards</strong> option above to pay.</div>';
                    $('#apple-pay-msg-box').html(appleNotice).show();
                    $('#error-message').hide().text('');
                }
                setPayLoading(false);
                return;
            }

            // Google Pay Handler
            if (currentPaymentTab === 'google_pay') {
                if (paymentRequest && canUseGooglePay) {
                    paymentRequest.show();
                } else {
                    const googleNotice = '<div style="background:#FFFBEB; border:1px solid #FDE68A; color:#92400E; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;"><strong>Google Pay is not ready on this browser/device.</strong><br>Google Pay requires <strong>Google Chrome</strong> with a saved card in your Google Account.<br>Please select the <strong>Cards</strong> or <strong>Link</strong> option above to pay.</div>';
                    $('#google-pay-msg-box').html(googleNotice).show();
                    $('#error-message').hide().text('');
                }
                setPayLoading(false);
                return;
            }

            // Save Address for Link or Cards if adding new
            if (isAddingNew) {
                setCheckoutContactValue();
                setCheckoutWhatsappValue();
                let formData = $("#productInquiryForm").serialize();
                let response = await fetch("{{ route('front.checkout.test.store.address') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: formData
                });
                let data = await response.json();
                if (!data.success) {
                    $('#error-message').text('Something went wrong while saving address.').show();
                    setPayLoading(false);
                    return;
                }
                addressId = data.address_id;
            } else {
                addressId = selectedAddress;
            }

            const currentSitePath = (typeof sitePath !== 'undefined' ? sitePath : "{{ url('/') }}");

            // LINK PAYMENT HANDLER
            if (currentPaymentTab === 'link') {
                if (!clientSecret || !elements) {
                    $('#link-msg-box').html('<div style="background:#FEF2F2; border:1px solid #FECACA; color:#991B1B; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;">Payment gateway not initialized. Please refresh the page.</div>').show();
                    setPayLoading(false);
                    return;
                }

                const { error: linkSubmitError } = await elements.submit();
                if (linkSubmitError) {
                    $('#link-msg-box').html('<div style="background:#FEF2F2; border:1px solid #FECACA; color:#991B1B; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;">' + linkSubmitError.message + '</div>').show();
                    setPayLoading(false);
                    return;
                }

                const { error: linkConfirmError } = await stripe.confirmPayment({
                    elements: elements,
                    confirmParams: {
                        return_url: currentSitePath + '/checkout-test/payment/success?address_id=' + addressId + '&gift_wrapper=' + ($('.co-gift-checkbox').is(':checked') ? 1 : 0),
                    }
                });

                if (linkConfirmError) {
                    $('#link-msg-box').html('<div style="background:#FEF2F2; border:1px solid #FECACA; color:#991B1B; padding:10px 12px; border-radius:8px; font-size:12px; line-height:1.4;">' + linkConfirmError.message + '</div>').show();
                    setPayLoading(false);
                }
                return;
            }

            // CARDS PAYMENT HANDLER
            if (!clientSecret || !elements) {
                $('#error-message').text('Please enter a valid amount first.').show();
                setPayLoading(false);
                return;
            }

            const { error: paymentElementError } = await elements.submit();
            if (paymentElementError) {
                $('#error-message').text(paymentElementError.message).show();
                setPayLoading(false);
                return;
            }

            const userEmailVal = "{{ auth()->check() ? addslashes(auth()->user()->email) : '' }}";

            const { error } = await stripe.confirmPayment({
                elements: elements,
                confirmParams: {
                    return_url: currentSitePath + '/checkout-test/payment/success?address_id=' + addressId + '&gift_wrapper=' + ($('.co-gift-checkbox').is(':checked') ? 1 : 0),
                    payment_method_data: {
                        billing_details: {
                            name: "{{ auth()->check() ? addslashes(auth()->user()->name) : '' }}",
                            email: userEmailVal,
                            address: {
                                country: 'AE'
                            }
                        }
                    }
                },
            });

            if (error) {
                $('#error-message').text(error.message).show();
                setPayLoading(false);
            }
        } catch (err) {
            console.error('Payment Error:', err);
            $('#error-message').text(err.message || 'Payment processing encountered an issue. Please try again.').show();
            setPayLoading(false);
        }
    });

});
</script>
@endpush

@include('layouts.frontfooter')