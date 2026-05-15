<!DOCTYPE html>
<html>
<head>
    <title>Stripe UAE Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<style>
    #card-element {
        border: 1px solid #ccc;
        padding: 12px;
        border-radius: 6px;
        max-width: 400px;
        margin-top: 10px;
    }

    #payBtn {
        margin-top: 10px;
        padding: 8px 16px;
        cursor: pointer;
    }

    #error-message {
        color: red;
        margin-top: 10px;
    }
</style>
<body>

<h4 class="mb-4">Payment Options</h4>
<div id="card-element"></div>
<div id="error-message"></div>
<button id="payBtn">Pay</button>

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js" type="text/javascript"></script>
{{-- <script>
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements({ clientSecret: '{{env('STRIPE_SECRET')}}' });
    // const card = elements.create('card', {
    //     hidePostalCode: true
    // });
    // card.mount('#card-element');
    const paymentElement = elements.create('payment');
    paymentElement.mount('#card-element');

    document.getElementById('payBtn').addEventListener('click', async () => {
        const amount = document.getElementById('amount').value;

        const response = await fetch('stripe-post', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ amount })
        });

        const data = await response.json();

        const result = await stripe.confirmCardPayment(data.client_secret, {
            payment_method: {
                card: card
            }
        });
        console.log("RESULT - " + JSON.stringify(result));
        if (result.error) {
            document.getElementById('error-message').textContent = result.error.message;
        } else {
            alert('Payment Successful!');
        }
    });
</script> --}}

<script>
    var sitePath = "{{ url('/') }}";
    const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // <--- You MUST do this once upfront
    let elements;
    let paymentElement;
    let clientSecret;

    async function createPaymentIntent(amount) {
        const response = await fetch('stripe-post', {
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
            layout: { type: 'tabs' }, // ✅ wallets show on top if supported
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
        const amount = 10;
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

</body>
</html>
