@include('layouts.frontheader')
<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/digital-editions-banner.png')}}" alt="him banner">
    <div class="hero_content_inner">
        <h2 class="main_head mb-3">The 2025 Digital Editions</h2>
        <p class="para sec_in_mb">A curated study of our latest rituals, objects, and bespoke services.</p>
    </div>
</section>

<section class="mt_60 request_catalogue_para">
    <div class="container">
        <p class="text-center sub_head">To preserve the intimacy of our collection, access to the Digital Catalogue
            is granted via a unique security key valid for 30 days. Upon request, your personal credentials will be
            sent to your inbox. Should you wish to revisit the collection after your viewing window has closed, we
            invite you to renew your request</p>
    </div>
</section>
<section class="mt_60 mb_120">
    <div class="container">
        <div class="ct_form">
            <form method="POST" id="requestCatalogueForm" action="{{ route('front.store.request.catalogue') }}">
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
                    <div class="col-lg-6">
                        <div class="ct_input">
                            <label for="phone" class="sub_head">Phone Number</label> <span class="text-danger">*</span>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" placeholder="Enter your Phone Number" 
                            >

                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Interest -->
                    <div class="col-lg-6">
                        <div class="ct_input">
                            <label class="sub_head">Interest</label> <span class="text-danger">*</span>
                            @php $interest = config('global_values.request_catalogue_interest'); @endphp
                            <select name="interest">
                                <option value="">Select Interest</option>
                                @foreach($interest as $key => $val)
                                    <option value="{{ $key }}" {{ old('interest') }}>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>

                            @error('interest')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-center">
                        <button class="com_btn bg-transparent" type="submit">Request Private Access</button>
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
    $("#requestCatalogueForm").validate({
        rules: {
            full_name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                lettersonly: true
            },
            email: {
                required: true,
                email: true,
                noSpamEmail: true,
                uniqueEmail: "request_catalogues"
            },
            phone: {
                required: true,
                validPhone: true,
                //number:true,
            },
            interest: {
                required: true,
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
                required: "Please enter your Phone number"
            },
            interest:{
                required: "Please select Interest"
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