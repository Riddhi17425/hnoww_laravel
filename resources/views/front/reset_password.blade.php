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
            <div class="reg_login_child">

                <div class="user signinBx">
                    <div class="formBx">
                        <!-- change passowrd -->
                        <div class="ct_form">
                            <h3 class="title_60">Reset Password</h3>
                            <form method="POST" id="resetPasswordForm" action="{{ route('front.password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">
                                <div class="ct_input password_wrap">
                                    <input type="text" value="{{$email}}" readonly>
                                    <input type="password" id="new_password" name="new_password" placeholder="Enter New Password" required>
                                    <span class="toggle_password" onclick="togglePasswordSvg('new_password', this)">
                                        <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                        <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                                stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                <div class="ct_input password_wrap">
                                    <input type="password" id="confirm_password" name="new_password_confirmation"
                                        placeholder="Confirm New Password" required>

                                    <span class="toggle_password" onclick="togglePasswordSvg('confirm_password', this)">
                                        <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                        <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                                stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                <div class="text-center">
                                    <button class="com_btn bg-transparent w-100" type="submit">Set</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="imgBx"><img src="{{ asset('public/front/images/login.png')}}" alt="images" /></div>
                </div>

            </div>
        </div>
</section>

@push('script')
    <script>

        $(document).ready(function () {

            $("#resetPasswordForm").validate({
                rules: {
                    new_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 30,
                    },
                    new_password_confirmation: {
                        required: true,
                        equalTo: "#new_password"
                    },
                },
                messages: {
                    new_password: {
                        required: "Please enter your New Password",
                        minlength: "Password must be at least 2 characters",
                        maxlength: "Password cannot be longer than 50 characters",
                    },
                    new_password_confirmation: {
                        required: "Please confirm your Confirm password",
                        equalTo: "Passwords do not match"
                    }
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