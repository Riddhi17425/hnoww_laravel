@include('layouts.frontheader')
<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/ceremonial-objects-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head"> Ceremonial Objects</h2>
        <p class="para mb-0">Objects that anchor your rituals in beauty and meaning.</p>
    </div>
</section>

<section class="mt_60">
    <div class="container">
        <div class="him_wrapper">
            @if(isset($products) && is_countable($products) && count($products) > 0)
            @foreach($products as $key => $val)
                <div>
                    <div class="mb-2 mb-md-4 ceremonial_box">
                        <img class="img-fluid" src="{{asset('public/images/admin/product_list/'.$val->list_page_img)}}" alt="wedding_prod">

                        <div class="inquire_bespoke">
                            <a href="javascript:void(0);" class="inquire_link" data-bs-toggle="modal" data-bs-target="#ceremonialInquiry" data-ceremonial-name="{{ $val->product_name }}" data-ceremonial-id="{{ $val->id }}">
                                Inquire for <br> Ceremonial <br>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
                                        fill="none">
                                        <path
                                            d="M30.0501 8.93311L8.93555 30.0476M30.0501 8.93311H13.8081M30.0501 8.93311V25.175"
                                            stroke="white" stroke-width="1.77185" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>

                    <h3 class="sub_head">{{$val->product_name ?? ''}}</h3>
                    {{-- <p class="mb-0">
                        A ceremonial beginning, held in form. 
                    </p> --}}
                    <p class="my-3">
                    {!! $val->short_description ?? '' !!}
                    </p>
                    <a href="javascript:void(0);" class="com_btn" data-bs-toggle="modal" data-bs-target="#ceremonialInquiry" data-ceremonial-name="{{ $val->product_name }}" data-ceremonial-id="{{ $val->id }}">Available through the H Noww Wedding Concierge.</a>
                </div>
            @endforeach
            @endif

            {{-- <!-- Item 2 -->
            <div>
                <div class="mb-2 mb-md-4 ceremonial_box">
                    <img class="img-fluid" src="{{asset('public/images/front/ceremonial2.webp')}}" alt="him_prod">

                    <div class="inquire_bespoke">
                        <a href="#" class="inquire_link">
                            Inquire for <br> Bespoke <br>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
                                    fill="none">
                                    <path
                                        d="M30.0501 8.93311L8.93555 30.0476M30.0501 8.93311H13.8081M30.0501 8.93311V25.175"
                                        stroke="white" stroke-width="1.77185" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <h3 class="sub_head">The Golden Path Ceremony Tray</h3>
                <p class="mb-0">
                    A ceremonial beginning, held in form. 
                </p>
                
                 <p class="my-3">
                   Used during haldi, mehendi, and welcome rituals, this tray marks the formal start of the wedding ceremonies. It is often the first object guests encounter.
                </p>
                
                <a href="#" class="com_btn"> Available through the H Noww Wedding Concierge. </a>
            </div>

            <!-- Item 2 -->
            <div>
                <div class="mb-2 mb-md-4 ceremonial_box">
                    <img class="img-fluid" src="{{asset('public/images/front/ceremonial3.webp')}}" alt="him_prod">

                    <div class="inquire_bespoke">
                        <a href="#" class="inquire_link">
                            Inquire for <br> Bespoke <br>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
                                    fill="none">
                                    <path
                                        d="M30.0501 8.93311L8.93555 30.0476M30.0501 8.93311H13.8081M30.0501 8.93311V25.175"
                                        stroke="white" stroke-width="1.77185" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <h3 class="sub_head">The Lotus Treasure Box</h3>
                <p class="mb-0">
                    A carved lotus-inspired mithai box for engagement sweets, roka trays, or trousseau gifting.
                    Designed for laddoos, dry mithai, or handwritten notes, it becomes a keepsake long after the
                    sweets are gone
                </p>
            </div>

            <!-- Item 2 -->
            <div>
                <div class="mb-2 mb-md-4 ceremonial_box">
                    <img class="img-fluid" src="{{asset('public/images/front/ceremonial4.webp')}}" alt="him_prod">

                    <div class="inquire_bespoke">
                        <a href="#" class="inquire_link">
                            Inquire for <br> Bespoke <br>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
                                    fill="none">
                                    <path
                                        d="M30.0501 8.93311L8.93555 30.0476M30.0501 8.93311H13.8081M30.0501 8.93311V25.175"
                                        stroke="white" stroke-width="1.77185" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <h3 class="sub_head">The Lotus Treasure Box</h3>
                <p class="mb-0">
                    A carved lotus-inspired mithai box for engagement sweets, roka trays, or trousseau gifting.
                    Designed for laddoos, dry mithai, or handwritten notes, it becomes a keepsake long after the
                    sweets are gone
                </p>
            </div>

            <!-- Item 2 -->
            <div>
                <div class="mb-2 mb-md-4 ceremonial_box">
                    <img class="img-fluid" src="{{asset('public/images/front/ceremonial5.webp')}}" alt="him_prod">

                    <div class="inquire_bespoke">
                        <a href="#" class="inquire_link">
                            Inquire for <br> Bespoke <br>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
                                    fill="none">
                                    <path
                                        d="M30.0501 8.93311L8.93555 30.0476M30.0501 8.93311H13.8081M30.0501 8.93311V25.175"
                                        stroke="white" stroke-width="1.77185" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <h3 class="sub_head">The Lotus Treasure Box</h3>
                <p class="mb-0">
                    A carved lotus-inspired mithai box for engagement sweets, roka trays, or trousseau gifting.
                    Designed for laddoos, dry mithai, or handwritten notes, it becomes a keepsake long after the
                    sweets are gone
                </p>
            </div>

            <!-- Item 2 -->
            <div>
                <div class="mb-2 mb-md-4 ceremonial_box">
                    <img class="img-fluid" src="{{asset('public/images/front/ceremonial6.webp')}}" alt="him_prod">

                    <div class="inquire_bespoke">
                        <a href="#" class="inquire_link">
                            Inquire for <br> Bespoke <br>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39"
                                    fill="none">
                                    <path
                                        d="M30.0501 8.93311L8.93555 30.0476M30.0501 8.93311H13.8081M30.0501 8.93311V25.175"
                                        stroke="white" stroke-width="1.77185" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>

                <h3 class="sub_head">The Lotus Treasure Box</h3>
                <p class="mb-0">
                    A carved lotus-inspired mithai box for engagement sweets, roka trays, or trousseau gifting.
                    Designed for laddoos, dry mithai, or handwritten notes, it becomes a keepsake long after the
                    sweets are gone
                </p>
            </div> --}}

        </div>
    </div>
</section>

<section class="cta_footer mt_120">
    <div class="container">
        <div class="cta_ftwrapper">
            <div>
                <p class="sub_head mb-0">
                    <span>
                        <svg width="146" height="11" viewBox="0 0 146 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.6666 5.33325C10.6666 8.27877 8.27877 10.6666 5.33325 10.6666C2.38773 10.6666 -8.13802e-05 8.27877 -8.13802e-05 5.33325C-8.13802e-05 2.38773 2.38773 -8.13802e-05 5.33325 -8.13802e-05C8.27877 -8.13802e-05 10.6666 2.38773 10.6666 5.33325ZM145.333 5.33325V6.33325L5.33325 6.33325V5.33325V4.33325L145.333 4.33325V5.33325Z"
                                fill="url(#paint0_linear_32_115)" />
                            <defs>
                                <linearGradient id="paint0_linear_32_115" x1="145.333" y1="5.83325" x2="5.33325"
                                    y2="5.83325" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#F8F7F3" stop-opacity="0" />
                                    <stop offset="1" stop-color="#F8F7F3" />
                                </linearGradient>
                            </defs>
                        </svg>

                    </span>
                    <span>Build His Ritual.</span>
                    <span>
                        <svg width="146" height="11" viewBox="0 0 146 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M134.667 5.33325C134.667 8.27877 137.054 10.6666 140 10.6666C142.946 10.6666 145.333 8.27877 145.333 5.33325C145.333 2.38773 142.946 -8.13802e-05 140 -8.13802e-05C137.054 -8.13802e-05 134.667 2.38773 134.667 5.33325ZM0 5.33325L0 6.33325L140 6.33325V5.33325V4.33325L0 4.33325L0 5.33325Z"
                                fill="url(#paint0_linear_32_114)" />
                            <defs>
                                <linearGradient id="paint0_linear_32_114" x1="0" y1="5.83325" x2="140" y2="5.83325"
                                    gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#F8F7F3" stop-opacity="0" />
                                    <stop offset="1" stop-color="#F8F7F3" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                </p>
            </div>
            <div>
                <a href="javascript:void(0)" class="btn_2">SHOP GIFTS FOR HIM</a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade audio_modal" id="ceremonialInquiry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ceremonialInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0">
                        <h5 class="modal-title" id="ceremonialInquiryLabel">Ceremonial Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="ceremonialInquiryForm" action="{{ route('front.store.ceremonial.inquiry') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text"
                                name="name"
                                value="{{ old('name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Inquiry For Ceremonial</label>
                        <input type="text" class="form-control mb-3" id="ceremonial_name" value="" disabled>
                        <input type="hidden" name="ceremonial_id" id="ceremonial_id" value="">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text"
                                name="contact_no"
                                value="{{ old('contact_no') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                class="form-control @error('contact_no') is-invalid @enderror">

                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message"
                                    rows="4"
                                    class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="com_btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="com_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
$(document).ready(function () {
    $('#ceremonialInquiry').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let ceremonialName = button.data('ceremonial-name');
        let ceremonialId = button.data('ceremonial-id');

        $('#ceremonial_name').val(ceremonialName);
        $('#ceremonial_id').val(ceremonialId);
    });
    
    $("#ceremonialInquiryForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                lettersonly: true
            },
            email: {
                required: true,
                email: true,
                noSpamEmail: true,
                //uniqueEmail: true
                uniqueEmail: "ceremonial_inquiries"
            },
            contact_no: {
                required: true,
                validPhone: true,
                number:true,
            },
            message: {
                maxlength: 300
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters",
                maxlength: "Name cannot be longer than 50 characters",
                lettersonly: "Only letters and spaces are allowed"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
            },
            contact_no: {
                required: "Please enter your Contact number"
            },
            comment: {
                maxlength: "Message cannot be longer than 300 characters"
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            // error.addClass('invalid-feedback');
            // if (element.attr("name") === "g-recaptcha-response") {
            //     error.insertAfter(".g-recaptcha"); // show error below CAPTCHA
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