@include('layouts.frontheader')

<style>
    body {
        background: #f5f2ee;
    }

    .guest-order-wrap {
        max-width: 680px;
        margin: 80px auto;
        padding: 42px 30px 32px;
        border: 1px solid #d9d0c7;
        background: rgba(255,255,255,0.8);
        box-shadow: 0 18px 50px rgba(17, 24, 39, 0.06);
    }

    .guest-order-wrap h2 {
        font-family: 'Times New Roman', serif;
        font-size: clamp(2.5rem, 4vw, 4rem);
        margin-bottom: 18px;
        color: #1d2c3b;
        text-align: center;
        letter-spacing: -0.04em;
        font-weight: 500;
    }

    .guest-order-wrap p {
        color: #4d4a45;
        margin-bottom: 22px;
        font-size: 1.05rem;
        line-height: 1.7;
        text-align: center;
    }

    .guest-order-wrap .alert {
        margin-bottom: 18px;
    }

    .otp-box {
        max-width: 420px;
        margin: 0 auto;
        padding: 30px 20px;
        border: 1px solid #d8d0c7;
        background: #fff;
    }

    .otp-input {
        width: 100%;
        letter-spacing: 0.5rem;
        text-align: center;
        font-size: 2rem;
        padding: 16px 12px;
        border: 1px solid #d6cfc5;
        border-radius: 0;
        background: #fff;
        color: #1d2c3b;
    }

    .guest-btn {
        display: block;
        width: 100%;
        margin-top: 20px;
        padding: 16px 28px;
        border: 1px solid #1d2c3b;
        background: #1d2c3b;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .guest-btn:hover {
        background: #0f1b29;
    }
</style>

<div class="container">
    <div class="guest-order-wrap">
        <h2>Verify Your Order</h2>
        <p>We sent a one-time password to <strong>{{ $order->guest_email }}</strong>. Enter it below to access this order securely.</p>

        <div id="guest-order-alert" class="alert d-none"></div>

        <form id="guest-order-otp-form" method="POST" action="{{ route('front.guest.order.verify', ['token' => $token]) }}">
            @csrf
            <div class="otp-box">
                <div class="form-group">
                    <input type="text" name="otp" id="guest_order_otp" class="otp-input" maxlength="6" inputmode="numeric" placeholder="••••••" required>
                </div>
                <button type="submit" class="guest-btn">Verify OTP</button>
            </div>
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
