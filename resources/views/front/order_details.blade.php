@include('layouts.frontheader')
<link rel="stylesheet" href="{{ asset('public/front/css/custom-profile.css') }}">
<style>
    .theme-green .header-scrolled {
        background: #EDEAE4;
    }

    .theme-green .language-select .dropdown-input-lan {
        color: #0e2233;
    }
    </style>

<section class="mt_60 mb_120">
    <div class="container">
        <!-- Header -->
        <div class="section_header text-center mb-5">
            <p class="sub_head mb-0 justify-content-center d-flex align-items-center gap-3" style="color: #B58A46; text-transform: uppercase; font-size: 14px; letter-spacing: 2px;">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46" /></svg></span>
                <span>My Orders</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46" /></svg></span>
            </p>
            <h2 class="title_60" style="color: #B58A46; font-family: 'Playfair Display', serif; font-size: 48px; margin-top: 10px;">Order Details</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4">
                    <a href="{{ route('front.home') }}" class="btn-back d-inline-flex align-items-center" style="color: #0e2233; text-decoration: none; font-weight: 500; transition: color 0.3s;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        Back to Profile
                    </a>
                </div>

                <div class="order_details_card p-4 p-md-5" style="background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <!-- Order Header -->
                    <div class="order_header d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h4 class="mb-1" style="font-family: 'Playfair Display', serif; color: #0e2233;">Order #{{ $order->id }}</h4>
                            <p class="text-muted mb-0" style="font-size: 14px;">Placed on: {{ $order->date }}</p>
                        </div>
                        <div class="mt-3 mt-md-0">
                            <span class="badge bg-primary" style="font-weight: 500; padding: 8px 16px; border-radius: 4px; font-size: 14px; background-color: #B58A46 !important; letter-spacing: 1px;">{{ $order->status }}</span>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: #f0eee5;">

                    <!-- Product List -->
                    <div class="order_items">
                        <h5 class="mb-4" style="font-family: 'Playfair Display', serif; color: #0e2233;">Items in your order</h5>
                        
                        <!-- Dummy Item 1 -->
                        <div class="order_item_row d-flex align-items-center mb-4 pb-4 border-bottom">
                            <div class="item_img_box me-4" style="flex-shrink: 0;">
                                <img src="{{ asset('public/images/front/placeholder.png') }}" alt="Product" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #e5e5e5; background: #fdfbf7;" onerror="this.onerror=null; this.src='https://via.placeholder.com/100x100?text=Product';">
                            </div>
                            <div class="item_info flex-grow-1">
                                <h6 class="mb-1" style="font-size: 16px; color: #0e2233; font-weight: 600;">Luxury Golden Vase</h6>
                                <p class="text-muted mb-1" style="font-size: 13px;">Color: Gold | Size: Medium</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="fw-bold" style="color: #B58A46;">AED 450.00</span>
                                    <span class="text-muted">Qty: 1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dummy Item 2 -->
                        <div class="order_item_row d-flex align-items-center mb-4 pb-4 border-bottom">
                            <div class="item_img_box me-4" style="flex-shrink: 0;">
                                <img src="{{ asset('public/images/front/placeholder.png') }}" alt="Product" class="img-fluid rounded" style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #e5e5e5; background: #fdfbf7;" onerror="this.onerror=null; this.src='https://via.placeholder.com/100x100?text=Product';">
                            </div>
                            <div class="item_info flex-grow-1">
                                <h6 class="mb-1" style="font-size: 16px; color: #0e2233; font-weight: 600;">Premium Desk Organizer</h6>
                                <p class="text-muted mb-1" style="font-size: 13px;">Color: Walnut</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="fw-bold" style="color: #B58A46;">AED 750.00</span>
                                    <span class="text-muted">Qty: 1</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <!-- Addresses -->
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="address_box p-4" style="background: #fdfbf7; border-radius: 8px; border: 1px solid #f0eee5; height: 100%;">
                                <h6 class="mb-3" style="font-family: 'Playfair Display', serif; color: #0e2233; font-size: 18px;">Shipping Address</h6>
                                <p class="mb-1 fw-bold" style="font-size: 15px;">Ravi Jadav</p>
                                <p class="mb-1 text-muted" style="font-size: 14px;">123 Luxury Avenue, Suite 45</p>
                                <p class="mb-1 text-muted" style="font-size: 14px;">Dubai Marina, Dubai</p>
                                <p class="mb-1 text-muted" style="font-size: 14px;">United Arab Emirates</p>
                                <p class="mt-3 mb-0 text-muted" style="font-size: 14px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                    +971 50 123 4567
                                </p>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-md-6">
                            <div class="summary_box p-4" style="background: #fff; border-radius: 8px; border: 1px solid #e5e5e5; height: 100%;">
                                <h6 class="mb-4" style="font-family: 'Playfair Display', serif; color: #0e2233; font-size: 18px;">Order Summary</h6>
                                
                                <div class="d-flex justify-content-between mb-3 text-muted" style="font-size: 15px;">
                                    <span>Subtotal</span>
                                    <span>AED 1,200.00</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3 text-muted" style="font-size: 15px;">
                                    <span>Shipping</span>
                                    <span>Free</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3 text-muted" style="font-size: 15px;">
                                    <span>Taxes</span>
                                    <span>Included</span>
                                </div>
                                
                                <hr class="my-3" style="border-color: #f0eee5;">
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="color: #0e2233; font-size: 18px;">Grand Total</span>
                                    <span class="fw-bold" style="color: #B58A46; font-size: 22px;">{{ $order->total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <button class="com_btn">Download Invoice</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')
