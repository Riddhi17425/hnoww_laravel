@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/contact-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head mb-3">Login</h2>
        <p class="para sec_in_mb">Sign in to Place Orders!</p>
    </div>
</section>

<section class="mt_60 mb_120">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-lg-4">
            <div class="ct_form">
                <form method="POST" id="loginForm" action="{{ route('front.login.post') }}">
                @csrf
                    <div class="ct_input mb-3">
                        <label for="email" class="sub_head">Email Address <span class="text-danger">*</span></label>
                        <input type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your Email Address"
                            class="form-control">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="ct_input mb-3">
                        <label for="password" class="sub_head">Password <span class="text-danger">*</span></label>
                        <input type="password"
                            id="password"
                            name="password"
                            placeholder="Enter password"
                            class="form-control">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="com_btn bg-transparent" type="submit">Login</button> 
                        <div>
                            <a href="{{ route('front.register') }}">Not Registered? Register First</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('script')
<script>
var formSubmitted = false;
$( document ).ready(function() {
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,
                noSpamEmail: true,
                uniqueEmail: "contact_inquiries"
            },
            password:{
                required: true,
                minlength: 6,
                maxlength: 30,
            },
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
            },
            password: {
                required: "Please enter your Password",
                minlength: "Password must be at least 2 characters",
                maxlength: "Password cannot be longer than 50 characters",
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            // error.addClass('invalid-feedback');
            // if (element.attr("name") === "g-recaptcha-response") {
            //     error.insertAfter(".g-recaptcha"); 
            // } else {
                error.insertAfter(element);
            //}
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            if (!formSubmitted) {
                formSubmitted = true;
                const btn = $(form).find('button[type="submit"]');
                if (btn.length) {
                    btn.prop('disabled', true).text('Submitting...');
                }
                form.submit();
            }
        }
    });
});

</script>
@endpush
@include('layouts.frontfooter')