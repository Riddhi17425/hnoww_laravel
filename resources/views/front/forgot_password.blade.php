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
</style>

<section id="reg_login">
    <div class="container">
            <div class="reg_login_child {{ ($pageVal ?? 'login') === 'register' ? 'active' : '' }}">

                {{-- FORGOT PASSWORD --}}
                <div class="user signinBx">
                    <div class="imgBx"><img src="{{ asset('public/images/front/login.webp')}}" alt="images" /></div>
                    <div class="formBx">
                        <!-- Forgot Password Box -->
                        <div class="ct_form">
                            <h3 class="title_60">Forogt Password</h3>
                            <form method="POST" id="forgotPasswordForm" action="{{ route('front.post.forgot.password') }}">
                            @csrf
                                <div class="ct_input">
                                    <label for="email">Enter Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button class="com_btn bg-transparent w-100" type="submit">Verify</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
</section>

@push('script')
    <script>
        $(document).ready(function () {
            $("#forgotPasswordForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        noSpamEmail: true,
                    },
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address",
                        noSpamEmail: "This email address is not allowed",
                    },
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function (element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function (form) {
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

        function toggleForm() {
            document.querySelector(".reg_login_child").classList.toggle("active");
        }

        function togglePasswordSvg(inputId, el) {
            const input = document.getElementById(inputId);

            if (input.type === "password") {
                input.type = "text";
                el.classList.add("active");
            } else {
                input.type = "password";
                el.classList.remove("active");
            }
        }
    </script>

@endpush

@include('layouts.frontfooter')