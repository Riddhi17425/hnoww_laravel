@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/contact-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head mb-3">Registration</h2>
        <p class="para sec_in_mb">Sign Up to Place Orders!</p>
    </div>
</section>

<section class="mt_60 mb_120">
    <div class="container">
        <div class="ct_form">
            <form method="POST" id="registerForm" action="{{ route('front.register.post') }}">
                @csrf
                <div class="row">
                    <!-- Full Name -->
                    <div class="col-lg-6">
                        <div class="ct_input">
                            <label for="full_name" class="sub_head">Full Name</label> <span class="text-danger">*</span>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="Enter your Full Name" pattern="[A-Za-z\s]{2,50}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                            @error('full_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-lg-6">
                        <div class="ct_input">
                            <label for="email" class="sub_head">Email Address</label> <span class="text-danger">*</span>
                            <input type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your Email Address"
                            >

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-lg-4">
                        <div class="ct_input">
                            <label for="phone" class="sub_head">Phone Number</label> <span class="text-danger">*</span>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" placeholder="Enter your Phone Number" 
                            >
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="col-4">
                        <div class="ct_input">
                            <label for="password" class="sub_head">Password</label> <span class="text-danger">*</span>
                            <input type="password" id="password" name="password" placeholder="Enter password" rows="1">
                            @error('password')
                                <small class="text-danger">{{ $password }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="ct_input">
                            <label for="password_confirmation" class="sub_head">Confirm Password</label> <span class="text-danger">*</span>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                placeholder="Enter Confirm Password" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <div class="ct_input">
                            <label for="address" class="sub_head">Address</label>
                            <textarea id="address" name="address" placeholder="Enter Address" rows="1">{{ old('address') }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $address }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-center">
                        <button class="com_btn bg-transparent" type="submit">Register</button> 
                        <a class="" href="{{ route('front.login') }}">Already Register ? Login </a>
                    </div>

                </div>
            </form>
        </div>

    </div>
</section>

@push('script')
<script>
var formSubmitted = false;
$( document ).ready(function() {
    $("#registerForm").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                lettersonly: true
            },
            password:{
                required: true,
                minlength: 6,
                maxlength: 30,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true,
                noSpamEmail: true,
                uniqueEmail: "contact_inquiries"
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
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
            },
            phone: {
                required: "Please enter your Contact number"
            },
            password: {
                required: "Please enter your Password",
                minlength: "Password must be at least 2 characters",
                maxlength: "Password cannot be longer than 50 characters",
            },
            password_confirmation: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            },
            address: {
                minlength: "Address atlease 5 characters",
                maxlength: "Address cannot be longer than 500 characters"
            },
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