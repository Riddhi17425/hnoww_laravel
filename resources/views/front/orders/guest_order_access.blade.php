@include('layouts.frontheader')

<style>

    .theme-green .header-scrolled {
    background: #EDEAE4;
}

.theme-green .language-select .dropdown-input-lan {
    color: #0e2233;
}

    .guest-order-section {
        padding: 60px 0;
    }

    .guest-order-wrap {
        max-width: 560px;
        margin: 0 auto;
        padding: 40px;
        background-color: #faf9f6;
        border: 1px solid var(--gold-color);
        border-radius: 0;
        box-shadow: 0 20px 50px rgba(14, 34, 51, 0.15);
        text-align: center;
    }

    .guest-order-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--gold-color);
        border-radius: 50%;
        color: var(--gold-color);
    }

    .guest-order-wrap .guest-order-desc {
        margin: 12px 0 30px;
    }

    .guest-order-wrap .guest-order-desc strong {
        display: block;
        margin-top: 4px;
        color: var(--dark-900);
        word-break: break-all;
    }

    .guest-order-wrap .alert {
        border-radius: 0;
        border: 1px solid #d32f2f;
        background-color: #fff5f5;
        color: #d32f2f;
        font-size: 13.5px;
        padding: 12px 16px;
        text-align: left;
    }

    .guest-otp-field {
        text-align: left;
    }

    .guest-otp-field label {
        font-size: 13px;
        text-transform: uppercase;
        color: var(--secondary-color);
    }

    .guest-otp-field .otp-input {
        width: 100%;
        height: 60px;
        margin-top: 6px;
        padding: 0 0 0 0.9rem;
        border: none;
        border-bottom: 1px solid rgba(14, 34, 51, 0.25);
        border-radius: 0;
        background: transparent;
        color: var(--dark-900);
        font-size: 28px;
        letter-spacing: 0.9rem;
        text-align: center;
        box-shadow: none;
        outline: none;
        transition: border-color 0.3s ease;
    }

    .guest-otp-field .otp-input::placeholder {
        color: rgba(14, 34, 51, 0.25);
        letter-spacing: 0.9rem;
    }

    .guest-otp-field .otp-input:focus {
        border-bottom-color: var(--gold-color);
    }

    .guest-order-wrap .guest-note {
        margin: 14px 0 0;
        font-size: 13px;
        color: #777;
    }

    .guest-order-wrap .com_btn {
        width: 100%;
        margin-top: 28px;
    }

    @media (max-width: 575px) {
        .guest-order-section {
            padding: 150px 0 70px;
        }

        .guest-order-wrap {
            padding: 30px 20px;
        }
    }
</style>

<section class="guest-order-section">
    <div class="container">
        <div class="guest-order-wrap">
            <div class="guest-order-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="10" width="16" height="11" rx="1"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                </svg>
            </div>

            <p class="title_40 mb-0">Verify Your Order</p>
            <p class="guest-order-desc">
                We sent a one-time password to
                <strong>{{ $order->guest_email }}</strong>
            </p>

            <div id="guest-order-alert" class="alert d-none"></div>
            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form id="guest-order-otp-form" method="POST" action="{{ route('front.guest.order.verify', ['token' => $token]) }}">
                @csrf
                <div class="guest-otp-field">
                    <label for="guest_order_otp">Enter OTP</label>
                    <input type="text" name="otp" id="guest_order_otp" class="otp-input" maxlength="6" inputmode="numeric" autocomplete="one-time-code" placeholder="······" required>
                </div>
                <p class="guest-note">OTP is valid for 10 minutes.</p>
                <button type="submit" class="com_btn bg-transparent">Verify OTP</button>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#guest_order_otp').on('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 6);
        });

        $('#guest-order-otp-form').on('submit', function (e) {
            var otp = $('#guest_order_otp').val().trim();
            var alertBox = $('#guest-order-alert');

            if (!/^[0-9]{6}$/.test(otp)) {
                e.preventDefault();
                alertBox.removeClass('d-none').text('Please enter a valid 6-digit OTP.');
            }
        });
    });
</script>

@include('layouts.frontfooter')
