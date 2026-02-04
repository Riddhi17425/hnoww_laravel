@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/atelier-banner.png') }}" alt="checkout banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Secure Checkout</h2>
        <p class="para">Review Your Order & Complete Your Purchase</p>
    </div>
</section>

<section class="mt_120">
    <div class="container">

        @if($cartItems->count() > 0)
        <div class="row">

            <!-- LEFT : Order Summary -->
            <div class="col-lg-8 col-12">
                <div class="checkout-box">
                    <h4 class="mb-4">Order Summary</h4>

                    <table class="table checkout-table">
                        <thead>
                            <tr>
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
                                    <td><a href="{{ route('front.product.details', $item->product->product_url) }}"><img class="img-fluid img_1" src="{{ isset($item->product->list_page_img) ? asset('public/images/admin/product_list/'.$item->product->list_page_img) : '' }}" height="120" width="150" alt="{{ $item->product->product_name ?? 'Product Image' }}"></a></td>
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

            <!-- RIGHT : Price Summary + Payment -->
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

                    <!-- Stripe Placeholder -->
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
            body: JSON.stringify({ amount })
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

    $(document).ready(async function () {
        const amount = @json($subTotal);
        if (amount && amount > 0) {
            clientSecret = await createPaymentIntent(amount);
            await mountPaymentElement(clientSecret);
            $('#error-message').text(''); // Clear errors
        }

        $('#payBtn').on('click', async function () {
            if (!clientSecret) {
                $('#error-message').text('Please enter a valid amount first.');
                return;
            }
            const { error } = await stripe.confirmPayment({
                elements,
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
