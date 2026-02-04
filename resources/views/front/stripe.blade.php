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

<h2>Pay with Card (AED)</h2>

<input type="number" id="amount" placeholder="Amount in AED">
<button id="payBtn">Pay</button>

<div id="card-element"></div>
<div id="error-message"></div>

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

        const response = await fetch('stripe', {
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

        if (result.error) {
            document.getElementById('error-message').textContent = result.error.message;
        } else {
            alert('Payment Successful!');
        }
    });
</script> --}}

<script>
const stripe = Stripe("{{ env('STRIPE_KEY') }}"); // <--- You MUST do this once upfront
let elements;
let paymentElement;
let clientSecret;

async function createPaymentIntent(amount) {
    const response = await fetch('stripe', {
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
    paymentElement = elements.create('payment');
    paymentElement.mount('#card-element');
}

$(document).ready(function () {   
    $('#amount').on('change', async function () {
        const amount = $(this).val();

        if (amount && amount > 0) {
            clientSecret = await createPaymentIntent(amount);
            await mountPaymentElement(clientSecret);
            $('#error-message').text(''); // Clear errors
        }
    });

    $('#payBtn').on('click', async function () {
        if (!clientSecret) {
            $('#error-message').text('Please enter a valid amount first.');
            return;
        }
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: window.location.href // or your success page URL
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
