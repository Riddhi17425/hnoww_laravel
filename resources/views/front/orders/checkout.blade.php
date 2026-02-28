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

@media (max-width: 768px) {
    /* Table structure ko block mein badalna */
    .shopping-summery, 
    .shopping-summery tbody, 
    .checkout-table-row, 
    .checkout-table-row td {
        display: block !important;
        width: 100% !important;
    }

    .summary-wrapper
    {
        padding:0px;
    }

    /* Header hide karna */
    .shopping-summery thead {
        display: none !important;
    }

    /* Har row ko ek card banana */
    .checkout-table-row {
        position: relative !important;
        padding: 15px 15px 15px 115px !important; /* Left space for image */
        margin-bottom: 20px !important;
        /* border: 1px solid #f0f0f0 !important;
        border-radius: 12px !important;
        background: #fff !important;
        min-height: 125px !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.03); */
    }

    /* 1. Image (Left Side) */
    .checkout-table-row td:first-child {
        position: absolute !important;
        top: 15px !important;
        left: 15px !important;
        width: 85px !important;
        padding: 0 !important;
        border: none !important;
    }

    .checkout-table-row td:first-child img {
        width: 85px !important;
        height: 85px !important;
        object-fit: cover;
        /* border-radius: 8px; */
    }

    /* 2. Product Name (Top Middle) */
    .checkout-table-row td:nth-child(2) {
        padding: 0 35px 5px 0 !important; /* Space for trash icon */
        text-align: left !important;
        border: none !important;
        font-weight: 700;
        font-size: 16px;
        color: #1a1a1a;
        font-family: var(--heading-font);
    }

    /* 3. Unit Price (Name ke niche) */
    .checkout-table-row td:nth-child(4) { /* Price column */
        padding: 0 !important;
        text-align: left !important;
        border: none !important;
        color: #777;
        font-size: 14px;
        margin-bottom: 8px;
    }

    /* 4. Quantity Pill (Bottom Left) */
    .checkout-table-row td:nth-child(3) { /* Quantity column */
        padding: 5px 0 0 0 !important;
        border: none !important;
        display: flex;
        justify-content: flex-start;
    }

    /* Quantity Pill Shape */
    .increment_decrement {
        display: inline-flex;
        align-items: center;
        border: 1px solid #eee;
        border-radius: 30px; /* Pill Shape */
        padding: 3px 12px;
        background: #fdfdfd;
    }

    /* 5. Total Price (Bottom Right) */
    .checkout-table-row td:nth-child(5) { /* Total column */
        position: absolute !important;
        bottom: 15px !important;
        right: 15px !important;
        padding: 0 !important;
        border: none !important;
        width: auto !important;
    }

    .checkout-table-row td:nth-child(5):before {
        content: "AED "; /* Currency prefix agar chahiye */
        font-size: 12px;
    }

    .checkout-table-row td:nth-child(5) {
        font-size: 18px;
        font-weight: 700;
        color: #b5a48b; /* Gold shade */
    }

    /* 6. Trash Icon (Top Right) - Agar aapne add kiya hai */
    .checkout-table-row td:last-child {
        position: static !important;
        top: 10px !important;
        right: 10px !important;
        padding: 0 !important;
        border: none !important;
    }

    /* Labels hide karna */
    .checkout-table-row td:before {
        display: none !important;
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
            <!-- LEFT : Order Summary -->
            <div class="col-lg-8 col-12">
                <div class="checkout-box">
                    <div class="table-responsive">
                        <table class="table checkout-table shopping-summery" style="--bs-table-bg:--bs-table-bg;">
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
                            <tr class="checkout-table-row">
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
            </div>

            <!-- RIGHT : Price Summary + Payment -->
            <div class="col-lg-4 col-12">
                <div class="checkout-box summary-wrapper">
                    <h5 class="sub_head mb-4">Payment Summary</h5>

                    <div class="summary-details">
                        <div class="summary-row">
                            <span class="label">Subtotal</span>
                            <span class="value"><span class="d-lg-none">AED</span> <br />{{ number_format($subTotal, 2) }} AED</span>
                        </div>
                    </div>

                    <hr class="summary-divider">

                    <div class="summary-row total-row">
                        <span class="sub_head">You Pay</span>
                        <span class="sub_head" id="you-pay">{{ number_format($subTotal, 2) }} AED</span>
                    </div>

                    <div class="payment_cont">
                        <h5 class="sub_head mb-4">Payment Options</h5>

                        {{-- <div class="faq_cont">
                            <div class="faq_cont_acco">
                                <h6 class="according_head sub_head" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-1-1" aria-expanded="false" aria-controls="collapse-1-1">
                                    Credit Card
                                </h6>

                                <div id="collapse-1-1" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion-1">
                                    <div class="accordion-body"> --}}
                                        <div id="card-element"></div>
                                        <div id="error-message"></div>
                                    {{-- </div>
                                </div>
                            </div> --}}

                            {{-- <div class="faq_cont_acco">
                                <h6 class="according_head sub_head" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-1-2" aria-expanded="false" aria-controls="collapse-1-2">
                                    option 2
                                </h6>

                                <div id="collapse-1-2" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion-2">
                                    <div class="accordion-body">
                                        <p>
                                            Shipping usually takes 3–5 business days depending
                                            on your location.
                                        </p>
                                    </div>
                                </div>
                            </div> --}}

                        </div>
                    </div>

                    <!-- Stripe Placeholder -->
                    <form action="" method="POST">
                        @csrf
                        <button type="button" id="payBtn" class="com_btn w-100 bg-transparent">
                            Pay Securely
                        </button>
                    </form>

                    <!-- <a href="{{ route('front.home') }}" class="com_btn text-center mt-3 w-100">
                        Continue Shopping
                    </a> -->
                    <a href="{{ route('front.home') }}" class="btn-continue">
                        CONTINUE SHOPPING
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
</section>


@push('script')
<script>
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

async function mountPaymentElement(clientSecret) {
    if (elements) {
        elements.unmount(); // Clean up previous Elements if any
    }
    elements = stripe.elements({ clientSecret });

    //paymentElement = elements.create('payment');
    paymentElement = elements.create('payment', {
        layout: { type: 'tabs' },
        fields: {
            billingDetails: {
                address: {
                    country: 'never'   // ✅ Hides country dropdown
                }
            }
        },
        defaultValues: {
            billingDetails: {
                address: {
                    country: 'AE'     // ✅ Force UAE (Dubai)
                }
            }
        }
    });

    paymentElement.mount('#card-element');
}

$(document).ready(async function() {
    const amount = @json($subTotal);
    if (amount && amount > 0) {
        clientSecret = await createPaymentIntent(amount);
        await mountPaymentElement(clientSecret);
        $('#error-message').text(''); // Clear errors
    }

    $('#payBtn').on('click', async function() {
        if (!clientSecret) {
            $('#error-message').text('Please enter a valid amount first.');
            return;
        }
        const { error } = await stripe.confirmPayment({ elements,
            confirmParams: {
                return_url: sitePath + '/payment/success',
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
        }
    });

});
</script>
@endpush

@include('layouts.frontfooter')