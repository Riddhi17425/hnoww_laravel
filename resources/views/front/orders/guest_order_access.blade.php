@include('layouts.frontheader')

<style>
    .guest-order-wrap {
        max-width: 560px;
        margin: 80px auto;
        padding: 40px 28px;
        border: 1px solid #d8d0c7;
        background: #fff;
        box-shadow: 0 12px 35px rgba(0,0,0,0.04);
    }
    .guest-order-wrap h2 {
        font-family: 'Times New Roman', serif;
        font-size: 38px;
        margin-bottom: 18px;
    }
    .guest-order-wrap p {
        color: #554f4a;
        margin-bottom: 22px;
    }
    .guest-order-wrap .alert {
        margin-bottom: 18px;
    }
    .otp-input {
        width: 100%;
        letter-spacing: 0.35rem;
        text-align: center;
        font-size: 22px;
        padding: 16px 12px;
        border: 1px solid #d6cfc5;
        border-radius: 0;
    }
    .guest-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 14px 28px;
        border: 1px solid #1e1e1e;
        background: #1e1e1e;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="guest-order-wrap">
        <h2>Verify Your Order</h2>
        <p>We sent a one-time password to <strong>{{ $order->guest_email }}</strong>. Enter it below to access this order securely.</p>

        <div id="guest-order-alert" class="alert d-none"></div>

        <form id="guest-order-otp-form" method="POST" action="{{ route('front.guest.order.verify', ['token' => $token]) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="otp" id="guest_order_otp" class="otp-input" maxlength="6" inputmode="numeric" placeholder="••••••" required>
            </div>
            <button type="submit" class="guest-btn">Verify OTP</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#guest-order-otp-form').on('submit', function (e) {
            var otp = $('#guest_order_otp').val().trim();
            var alertBox = $('#guest-order-alert');

            if (!/^[0-9]{6}$/.test(otp)) {
                e.preventDefault();
                alertBox.removeClass('d-none alert-success').addClass('alert-danger').text('Please enter a valid 6-digit OTP.');
                return;
            }
        });
    });
</script>

@include('layouts.frontfooter')
