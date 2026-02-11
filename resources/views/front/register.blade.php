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

<!-- ------------------------------- -->

<section id="reg_login">
    <div class="container">
        {{-- <div class="reg_login_child"> --}}
            <div class="reg_login_child {{ ($pageVal ?? 'login') === 'register' ? 'active' : '' }}">

                {{-- SIGN IN --}}
                <div class="user signinBx">
                    <div class="imgBx"><img src="{{ asset('public/front/images/login.png')}}" alt="images" /></div>
                    <div class="formBx">
                        <!--sign form-->
                        <div class="ct_form">
                            <h3 class="title_60">Sign In</h3>
                            <form method="POST" id="loginForm" action="{{ route('front.login.post') }}">
                                @csrf
                                <div class="ct_input">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        placeholder="Enter Email Address">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="ct_input password_wrap">
                                    <input type="password" id="login_passwordS" name="password"
                                        placeholder="Enter Password">

                                    <span class="toggle_password" onclick="togglePasswordSvg('login_passwordS', this)">
                                        <!-- 👁 Eye (show) -->
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

                                        <!-- 🙈 Eye Off (hide) -->
                                        <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                                stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                <div class="ct_input">
                                    <div class="options">
                                        <label class="remember-me" for="remember">
                                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <span>Remember me</span>
                                        </label>
                                        <div class="forgot-password">
                                            <a href="{{route('front.get.forgot.password')}}" style="color:var(--dark-900);">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button class="com_btn bg-transparent w-100" type="submit">Login</button>
                                    <div class="mt-3">
                                        <p>Already Have An Account? <a href="javascript:void(0);"
                                                onclick="toggleForm();" style="color:var(--dark-900);"><u> Sign
                                                    Up</u></a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- SIGN UP --}}
                <div class="user signupBx">
                    <div class="formBx">
                        <div class="ct_form">
                            <h3 class="title_60">Sign Up</h3>
                            <form method="POST" id="registerForm" action="{{ route('front.register.post') }}">
                                @csrf
                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-lg-6">
                                        <div class="ct_input">
                                            <input type="text" id="full_name" name="full_name"
                                                value="{{ old('full_name') }}" placeholder="Enter Full Name"
                                                pattern="[A-Za-z\s]{2,50}"
                                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                                            @error('full_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="ct_input">
                                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                                placeholder="Enter Phone Number">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-lg-12">
                                        <div class="ct_input">
                                            <input type="email" id="email" name="r_email" value="{{ old('email') }}"
                                                placeholder="Enter Email Address">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-12">

                                        <div class="ct_input password_wrap">
                                            <input type="password" id="r_password" name="r_password"
                                                placeholder="Enter Password">

                                            <span class="toggle_password"
                                                onclick="togglePasswordSvg('r_password', this)">
                                                <!-- 👁 Eye (show) -->
                                                <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                        stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>

                                                <!-- 🙈 Eye Off (hide) -->
                                                <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                                        stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">

                                        <div class="ct_input password_wrap">
                                            <input type="password" id="regi_com_password" name="r_password_confirmation"
                                                placeholder="Enter Confirm password">

                                            <span class="toggle_password"
                                                onclick="togglePasswordSvg('regi_com_password', this)">
                                                <!-- 👁 Eye (show) -->
                                                <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                        stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>

                                                <!-- 🙈 Eye Off (hide) -->
                                                <svg class="eye-close" width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2 2L22 22M6.71277 6.7226C3.66479 8.79527 2 12 2 12C2 12 5.63636 19 12 19C14.0503 19 15.8174 18.2734 17.2711 17.2884M11 5.05822C11.3254 5.02013 11.6588 5 12 5C18.3636 5 22 12 22 12C22 12 21.3082 13.3317 20 14.8335M14 14.2361C13.4692 14.7111 12.7684 15 12 15C10.3431 15 9 13.6569 9 12C9 11.1763 9.33193 10.4302 9.86932 9.88808"
                                                        stroke="#000" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>

                                    </div>
                                    <!-- Submit -->
                                    <div class="col-12">
                                        <div class="text-center">
                                            <button class="com_btn bg-transparent w-75" type="submit">Register</button>
                                            <div class="mt-3">
                                                <p>Don't Have An Account? <a href="javascript:void(0);"
                                                        onclick="toggleForm();" style="color:var(--dark-900);"><u>Sign
                                                            in</u></a></p>
                                            </div>
                                        </div>

                                    </div>
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
            $("#registerForm").validate({
                rules: {
                    full_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                        lettersonly: true
                    },
                    r_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 30,
                    },
                    r_password_confirmation: {
                        required: true,
                        equalTo: "#r_password"
                    },
                    r_email: {
                        required: true,
                        email: true,
                        noSpamEmail: true,
                        uniqueEmail: "users"
                    },
                    phone: {
                        required: true,
                        validPhone: true,
                        //number:true,
                    },
                    address: {
                        minlength: 5,
                        maxlength: 500
                    },
                },
                messages: {
                    full_name: {
                        required: "Please enter your Full name",
                        minlength: "Name must be at least 2 characters",
                        maxlength: "Name cannot be longer than 50 characters",
                        lettersonly: "Only letters and spaces are allowed"
                    },
                    r_email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address",
                        noSpamEmail: "This email address is not allowed",
                    },
                    phone: {
                        required: "Please enter your Contact number"
                    },
                    r_password: {
                        required: "Please enter your Password",
                        minlength: "Password must be at least 2 characters",
                        maxlength: "Password cannot be longer than 50 characters",
                    },
                    r_password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    address: {
                        minlength: "Address atlease 5 characters",
                        maxlength: "Address cannot be longer than 500 characters"
                    },
                },
                errorElement: 'div',
                errorPlacement: function (error, element) {
                    // error.addClass('invalid-feedback');
                    // if (element.attr("name") === "g-recaptcha-response") {
                    //     error.insertAfter(".g-recaptcha"); 
                    // } else {
                    error.insertAfter(element);
                    //}
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

            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        noSpamEmail: true,
                        uniqueEmail: "contact_inquiries"
                    },
                    password: {
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
                errorPlacement: function (error, element) {
                    // error.addClass('invalid-feedback');
                    // if (element.attr("name") === "g-recaptcha-response") {
                    //     error.insertAfter(".g-recaptcha"); 
                    // } else {
                    error.insertAfter(element);
                    //}
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
        // document.querySelectorAll(".toggle-form").forEach((link) => {
        //     link.addEventListener("click", function(e) {
        //         e.preventDefault();
        //         toggleForm();
        //     });
        // });

        const rememberCheckbox = document.getElementById("remember");
        if (localStorage.getItem("rememberMe") === "true") {
            rememberCheckbox.checked = true;
        }
        rememberCheckbox.addEventListener("change", () => {
            localStorage.setItem("rememberMe", rememberCheckbox.checked);
        });

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