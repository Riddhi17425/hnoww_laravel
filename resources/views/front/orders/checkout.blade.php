@include('layouts.frontheader')

<link rel="stylesheet" href="{{ asset('public/front/css/checkout.css') }}">

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
                <div class="d-flex align-items-center justify-content-between mb-2 pb-2" style="border-bottom: 1px solid #f0f0f0;">
                    <div class="d-flex align-items-center gap-2">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#B58A46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <h4 class="payment-card-title m-0" style="font-size: 15px; font-weight: 600; color: #111111;">Payment Method</h4>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <!-- Visa Logo -->
                        <svg class="co-card-icon" viewBox="0 0 36 24" width="28" height="18"><rect width="36" height="24" rx="3" fill="#1A1F71"/><path d="M13.8 16.5l1.6-9.5h2.6l-1.6 9.5h-2.6zm6.8-9.3c-.5-.2-1.3-.4-2.3-.4-2.5 0-4.3 1.3-4.3 3.2 0 1.4 1.3 2.2 2.2 2.7.9.5 1.2.8 1.2 1.2 0 .6-.8.9-1.5.9-1 0-1.6-.2-2.4-.5l-.3-.2-.4 2.3c.7.3 1.9.6 3.2.6 2.7 0 4.5-1.3 4.5-3.3 0-1.1-.7-2-2.1-2.6-.9-.4-1.4-.7-1.4-1.2 0-.4.5-.8 1.4-.8.8 0 1.4.2 1.9.4l.2.1.3-2.3zm6.6-.2h-2c-.6 0-1.1.2-1.3.8l-3.7 8.7h2.7l.5-1.5h3.3l.3 1.5h2.4l-2.2-9.5zm-2.8 6l1.3-3.6.8 3.6h-2.1zm-15.6-5.8l-2.6 6.5-.3-1.4c-.5-1.6-2-3.3-3.7-4.1l2.4 8.7h2.7l4.1-9.7h-2.6z" fill="#FFF"/></svg>
                        <!-- Mastercard Logo -->
                        <svg class="co-card-icon" viewBox="0 0 36 24" width="28" height="18"><rect width="36" height="24" rx="3" fill="#252525"/><circle cx="14" cy="12" r="7" fill="#EB001B"/><circle cx="22" cy="12" r="7" fill="#F79E1B"/><path d="M18 6.8a6.9 6.9 0 0 1 2.6 5.2 6.9 6.9 0 0 1-2.6 5.2 6.9 6.9 0 0 1-2.6-5.2A6.9 6.9 0 0 1 18 6.8z" fill="#FF5F00"/></svg>
                        <!-- Amex Logo -->
                        <svg class="co-card-icon" viewBox="0 0 36 24" width="28" height="18"><rect width="36" height="24" rx="3" fill="#006FCF"/><path d="M6 14.5l1.2-3.2h1.5l1.2 3.2h1.5v-5h-1.6l-1.8 4.2-1.8-4.2H4v5h2zm7.5 0h4.2v-1.2h-2.6v-.7h2.3v-1.2h-2.3v-.6h2.6v-1.3h-4.2v5zm5.5 0h1.5l1.1-2.2 1.1 2.2h1.6l-1.9-3.4 1.8-3.1h-1.5l-1.1 2.1-1.1-2.1h-1.6l1.8 3.1-1.9 3.4z" fill="#FFF"/></svg>
                        <!-- Stripe Badge -->
                        <svg class="co-card-icon" viewBox="0 0 36 24" width="28" height="18"><rect width="36" height="24" rx="3" fill="#635BFF"/><path d="M16.5 10.3c0-.6.5-.9 1.3-.9 1.2 0 2.6.4 3.7 1v-3c-1.3-.5-2.6-.7-3.8-.7-3.1 0-5.2 1.6-5.2 4.2 0 4.1 5.6 3.4 5.6 5.2 0 .7-.6 1-1.5 1-1.4 0-3.1-.6-4.3-1.3v3.1c1.4.6 2.9.9 4.3.9 3.2 0 5.4-1.6 5.4-4.2-.1-4.4-5.5-3.6-5.5-5.3z" fill="#FFF"/></svg>
                    </div>
                </div>
                <div id="card-element" class="mt-3"></div>
                <div id="error-message"></div>
            </div>

            <button type="button" id="payBtn" class="co-btn-primary d-flex align-items-center justify-content-center gap-2 mt-3">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span class="btn-text">PAY SECURELY NOW</span>
                <span class="btn-loader" style="display:none;">Processing...</span>
            </button>

            <!-- ONLY POWERED BY STRIPE BADGE -->
            <div class="co-powered-stripe-only mt-3 text-center">
                <span class="d-inline-flex align-items-center gap-2" style="font-size: 13px; color: #555555; font-weight: 500;">
                    Powered by 
                    <svg viewBox="0 0 36 24" width="28" height="18" style="vertical-align: middle;"><rect width="36" height="24" rx="3" fill="#635BFF"/><path d="M16.5 10.3c0-.6.5-.9 1.3-.9 1.2 0 2.6.4 3.7 1v-3c-1.3-.5-2.6-.7-3.8-.7-3.1 0-5.2 1.6-5.2 4.2 0 4.1 5.6 3.4 5.6 5.2 0 .7-.6 1-1.5 1-1.4 0-3.1-.6-4.3-1.3v3.1c1.4.6 2.9.9 4.3.9 3.2 0 5.4-1.6 5.4-4.2-.1-4.4-5.5-3.6-5.5-5.3z" fill="#FFF"/></svg>
                    <strong style="color: #635BFF; font-size: 14px; font-weight: 700;">stripe</strong>
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
        $('#payBtn').prop('disabled', true);
        $('.btn-text').hide();
        $('.btn-loader').show();
    } else {
        $('#payBtn').prop('disabled', false);
        $('.btn-text').show();
        $('.btn-loader').hide();
    }
}


const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // <--- You MUST do this once upfront
let elements;
let paymentElement;
let clientSecret;

async function createPaymentIntent(amount) {
    const response = await fetch('checkout/process', {
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
    return data.client_secret;
}

// riddhi codes comment as per sir 
// async function mountPaymentElement(clientSecret) {
//     if (elements) {
//         elements.unmount(); // Clean up previous Elements if any
//     }
//     elements = stripe.elements({
//         clientSecret
//     });

//     //paymentElement = elements.create('payment');
//     paymentElement = elements.create('payment', {
//         layout: {
//             type: 'tabs'
//         },
//         fields: {
//             billingDetails: {
//                 address: {
//                     country: 'never' // ✅ Hides country dropdown
//                 }
//             }
//         },
//         defaultValues: {
//             billingDetails: {
//                 address: {
//                     country: 'AE' // ✅ Force UAE (Dubai)
//                 }
//             }
//         }
//     });

//     paymentElement.mount('#card-element');
// }

async function mountPaymentElement(clientSecret) {

    if (elements) {
        $('#card-element').html('');
    }

    elements = stripe.elements({
        clientSecret
    });

    paymentElement = elements.create('payment', {
        layout: {
            type: 'tabs'
        },
        fields: {
            billingDetails: {
                address: {
                    country: 'never'
                }
            }
        },
        defaultValues: {
            billingDetails: {
                address: {
                    country: 'AE'
                }
            }
        }
    });

    paymentElement.mount('#card-element');

    // STRIPE VALIDATION
    paymentElement.on('change', function(event) {

        // CLEAR ERROR
        $('#error-message').text('');

        // IF ERROR
        if (event.error) {

            $('#error-message').text(event.error.message);
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
        console.log('TEST');
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

    // $('#payBtn').hide();
    const amount = $discountedTotal;
    if (amount && amount > 0) {
        clientSecret = await createPaymentIntent(amount);
        await mountPaymentElement(clientSecret);
        $('#error-message').text(''); // Clear errors
    }

    $('#payBtn').on('click', async function() {
        // Validate form first
        // if (!$("#productInquiryForm").valid()) {
        //     return;
        // }
        setPayLoading(true); // START LOADING

        const selectedAddress = $('input[name="selected_address"]:checked').val();
        const isAddingNew = $('#addressFormWrapper').is(':visible');
        var addressId;
        if (!selectedAddress && !isAddingNew) {
            //alert('Please select an existing address or add a new one.');
            $('#error-message').text('Please select an existing address or add a new one.');
            setPayLoading(false);
            return;
        }
        if (isAddingNew) {
            // Validate form using jQuery validate
            if (!$('#productInquiryForm').valid()) {
                setPayLoading(false);
                return;
            }
        }

        if (!clientSecret || !elements) {
            $('#error-message').text('Please enter a valid amount first.');
            setPayLoading(false);
            return;
        }

        const { error: paymentElementError } = await elements.submit();
        if (paymentElementError) {
            $('#error-message').text(paymentElementError.message);
            setPayLoading(false);
            return;
        }

        if (isAddingNew) {
            setCheckoutContactValue();
            setCheckoutWhatsappValue();
            let formData = $("#productInquiryForm").serialize();
            // Save address first
            let response = await fetch("{{ route('front.checkout.store.address') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData
            });
            let data = await response.json();
            if (!data.success) {
                $('#error-message').text('Something went wrong while saving address.');
                setPayLoading(false);
                return;
            }
            addressId = data.address_id;
        } else {
            addressId = selectedAddress;
        }

        //const addressId = data.address_id;
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: sitePath + '/payment/success?address_id=' + addressId + '&gift_wrapper=' + ($('.co-gift-checkbox').is(':checked') ? 1 : 0),
                payment_method_data: {
                    billing_details: {
                        address: {
                            country: 'AE' // ✅ REQUIRED since you hide the field
                        }
                    }
                }
            },
        });
        if (error) {
            $('#error-message').text(error.message);
            setPayLoading(false);
        }
    });

});
</script>
@endpush

@include('layouts.frontfooter')