@include('layouts.frontheader')

<section class="wedding_vault">
    <div class="container">
        <h1 class="main_head">The H Noww Wedding Vault</h1>
        <h2 class="wedding_h2 mb-4">A private curation of ceremonial objects, heirloom gifts, and bespoke hampers for
            modern
            weddings.</h2>
        <p class="text-white">This space is reserved for brides, grooms, and planners working directly with H Noww.<br>
            Enter your access code to explore our private Wedding Vault.</p>
        <div class="wedding_vault_form mb-5">
            <form id="unlockWeddingVaultForm" action="{{ route('front.wedding-vault.send-email') }}" method="POST">
                @csrf
                    <input type="email" name="unlock_email" id="unlock_email" placeholder="Enter your email address" required><br>
                    <input type="text" name="otp" id="otp" placeholder="Enter OTP" style="display:none;">
                    <div id="vaultMessage" class="auto-hide" style="color: rgb(215, 5, 36); margin-top: 7px;"></div>
                    <div id="unlock_email_error"></div><br/>
                    <button type="submit" class="com_btn">
                        <span class="btn-text">UNLOCK THE VAULT</span>
                        <span class="btn-loader" style="display:none;">Submitting...</span>
                    </button>

            </form>
            {{-- <div id="vaultMessage" class="auto-hide" style="color: green; margin-top: 7px;"></div> --}}
        </div>
    </div>
    <a class="wedding_btn d-none d-lg-block" href="javascript:void(0);">
        <div>
            Don’t have a code? Request access from the H Noww Wedding Concierge.
        </div>
        <div><svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.9974 1L1 29.9974M29.9974 1H7.69171M29.9974 1V23.3057" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </a>
</section>

<a class="wedding_btn  d-lg-none" href="javascript:void(0);">
    <div>
        Don’t have a code? Request access from the H Noww Wedding Concierge.
    </div>
    <div><svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M29.9974 1L1 29.9974M29.9974 1H7.69171M29.9974 1V23.3057" stroke="white" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
</a>

@push('script')
<script>
let otpSent = false;
let verifyOtpUrl = "{{ route('front.wedding-vault.verify-otp') }}";

$("#unlockWeddingVaultForm").validate({
    rules: {
        unlock_email: {
            required: true,
            email: true,
            noSpamEmail: true,
        }
    },
    messages: {
        unlock_email: {
            required: "Please enter your email",
            email: "Please enter a valid email address"
        }
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") === "unlock_email") {
            error.appendTo("#unlock_email_error");
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var $form = $(form);
        var $btn = $form.find('button[type="submit"]');
        var $btnText = $btn.find('.btn-text');
        var $btnLoader = $btn.find('.btn-loader');

        $btn.prop('disabled', true);
        $btnText.hide();
        $btnLoader.show();

        $.ajax({
            url: otpSent ? verifyOtpUrl : $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(res) {
                console.log(res);
                if (res.success && !otpSent) {
                    otpSent = true;
                    $('#otp').show();
                    $btnText.text('VERIFY OTP').show();
                    $('#vaultMessage')
                        .text(res.message)
                        .css({'display':'block', 'color':'green', 'margin-top':'7px'});
                } 
                else if (res.success && otpSent) {
                    window.location.href = res.redirect;
                } 
                else {
                    $('#vaultMessage')
                        .text(res.message)
                        .css({'display':'block', 'color':'white', 'margin-top':'7px'});
                }
            },
            error: function() {
                $('#vaultMessage').text('Something went wrong. Please try again.');
            },
            complete: function() {
                $btn.prop('disabled', false);
                $btnLoader.hide();
                if (otpSent) {
                    $btnText.text('VERIFY OTP').show();
                } else {
                    $btnText.text('UNLOCK THE VAULT').show();
                }
            }
        });

        return false;
    }
});

</script>
@endpush

@include('layouts.frontfooter')