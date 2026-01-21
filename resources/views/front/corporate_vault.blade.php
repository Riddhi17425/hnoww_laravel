@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/corporate-vault-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">The Corporate Vault</h2>
        <p class="para my-3">Gifts of permanence for partners of consequence</p>
        <a href="#" class="com_btn border-white bg-white" data-bs-toggle="modal" data-bs-target="#requestCorporateProposal">Request Corporate catalogue</a>
    </div>
</section>

<section class="mt_60 request_catalogue_para">
    <div class="container">
        <p class="text-center sub_head_inter" style="color:#666666">A curated collection of architectural desk objects,
            ritual instruments, and heritage pieces designed for the
            modern executive. Every object is customizable, crafted from solid materials, and engineered to earn its
            place on a CEO's desk.</p>
    </div> 

</section>

<section class="mt_60">
    <div class="container">
        <div class="section_header text-start">
            <div class="gesture_filter">
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">I am seeking a solution for</h3>
                    <select class="dropdown" id="corporate_category">
                        <option value=""> All </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_url }}" {{ request()->segment(2) == $category->category_url ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="corporate_slider">
            @if(isset($products) && is_countable($products) && count($products) > 0)
                @foreach($products as $key => $val)
                    <div class="desire_box">
                        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/admin/product_list/'. $val->list_page_img)}}" alt="images">
                        <div class="desire_box_bot_child">
                            <div>
                                <h3 class="sub_head">{{$val->product_name ?? ''}}</h3>
                                <p>{!! $val->short_description !!}</p>
                                <p class="price">AED {{$val->product_price ?? ''}} @if(isset($val->moq)) | MOQ {{$val->moq }} @endif</p>
                            </div>

                            <a href="{{ route('front.product.details', $val->product_url) }}">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                    <path d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                        stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/product-not-found.png')}}" alt="images">
                </div>
            @endif
        </div>
    </div>
</section>

@if(isset($corporateKits) && is_countable($corporateKits) && count($corporateKits) > 0)
<section class="mt_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>CURATED</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Corporate Kits</h2>
            <p>Pre-designed ensembles for specific corporate milestones. Ships in one master "Vault" box.</p>
        </div>

        <div class="cor_kits_slider">
            @foreach ($corporateKits as $key => $val)
                <div class="slider">
                    <div class="corporatekits">
                        <div>
                            <img class="img-fluid" src="{{asset('public/images/front/corporate-kits.png')}}" alt="images">
                        </div>

                        <div class="corporate_kit_content">
                            <h3 class="title_40">{{ $val->title ?? '' }}</h3>
                            <p class="mb-3">{!! $val->short_description !!}</p>
                            <div class="">{!! $val->large_description !!}</div>
                            <h5 class="sub_head_inter">
                                <span>AED {{ $val->price_range ?? '' }} </span>
                                <span class="mx-3" style="color: #D0C2AA;">|</span>
                                <span>MOQ: {{ $val->moq }} Units</span>
                            </h5>

                            <a href="javascript:void(0);" class="com_btn" data-bs-toggle="modal" data-bs-target="#requestCorporateKitProposal"> REQUEST CORPORATE PROPOSAL </a>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>

    </div>
</section>
@endif

<section class="mt_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>The</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">VIP Boardroom Set</h2>
            <p>A sculptural power trio for the highest-level corporate spaces.</p>
        </div>
        <div class="vip_board">
            <div class="vip_board_lt">
                <img class="img-fluid" src="{{asset('public/images/front/signature-pairings.png')}}" alt="images">
            </div>

            <div class="vip_board_rt">
                <h3 class="title_40">A curated triad of modern ritual objects crafted to elevate executive meetings and leadership spaces</h3>
                <div class="vip_board_content">
                    <div class="vip_board_item">
                        <h4 class="sub_head">- The Hydration Ritual Set</h4>
                        <p> (Geometric Glass + Honeycomb Coaster)</p>

                        <h4 class="sub_head"> – The Scribe’s Cradle</h4>
                        <p> (Bent Brass Pen Stand with Saddle Leather Inlay)</p>

                        <h4 class="sub_head"> – The Meridian Block</h4>
                        <p> (Brushed Brass Card Holder)</p>
                    </div>

                    <div class="vip_board_item">
                        <h5 class="sub_head_inter">
                            <span>AED 950 – 1,300 </span>
                            <span class="mx-3" style="color: #D0C2AA;">|</span>
                            <span>MOQ: 10 Units</span>
                        </h5>
                        <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#requestCorporateProposal"> REQUEST
                            CORPORATE PROPOSAL </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt_80">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>the</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Trust Builder</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/builder1.png')}}" alt="images">
                    <h3 class="sub_head">The Branding Promise</h3>
                    <p class="mb-0">"Permanent Marking." We do not print; we etch. Your brand becomes part of the object's history.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/builder2.png')}}" alt="images">
                    <h3 class="sub_head">The Journal</h3>
                    <p class="mb-0">Essays on design, ritual, and the modern home.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/builder3.png')}}" alt="images">
                    <h3 class="sub_head">Bespoke Commissions</h3>
                    <p class="mb-0">Work with the Atelier to create a personal ritual object.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="cta_footer mt_60">
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
                </p>
            </div>
            <div>
                {{-- <a href="javascript:void(0)" class="btn_2">Discuss a custom hamper brief with the H Noww team</a> --}}
            </div>
        </div>
    </div>
</section>

<!-- Corporate Kit Request -->
<div class="modal fade corporate_vault_modal" id="requestCorporateKitProposal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="requestCorporateKitProposalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="container">
                <div class="text-center my-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('front.store.corporate.kit.request') }}" id="requestCorporateKitProposalForm" class="ct_form">
                    @csrf
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="k_full_name" id="k_full_name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" placeholder="Enter your Full Name" value="{{ old('k_full_name') }}">
                                    @error('k_full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Company Organization <span class="text-danger">*</span></label>
                                    <input type="text" name="k_company_name" placeholder="Enter your Company Organization Name" id="k_company_name" value="{{ old('k_company_name') }}">
                                    @error('k_company_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="k_phone" id="k_phone" placeholder="Enter your WhatsApp Phone Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" value="{{ old('phone') }}">
                                    @error('k_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="k_email" placeholder="Enter your Email Address" id="k_email" value="{{ old('k_email') }}">
                                    @error('k_email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Product of Interest (MULTISELECT) -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Product of Interest <span class="text-danger">*</span></label>
                                    <select id="k_product_of_interest" name="k_product_of_interest[]" multiple>
                                        @if(isset($corporateKits) && is_countable($corporateKits) && count($corporateKits) > 0)
                                            @foreach($corporateKits as $value)
                                                <option value="{{ $value->id }}" {{ collect(old('k_product_of_interest'))->contains($value->id) ? 'selected' : '' }}>
                                                    {{ $value->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="product_kit_error"></div>
                                    @error('k_product_of_interest') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Quantity Range -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Quantity Range <span class="text-danger">*</span></label>
                                    <select name="k_quantity_range" id="k_quantity_range">
                                        <option value="">Select</option>
                                        @foreach(config('global_values.quality_range') as $key => $value)
                                            <option value="{{ $key }}" {{ old('k_quantity_range') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('k_quantity_range') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Approximate Budget</label>
                                    <input type="text" placeholder="Enter Approximate Budget" name="k_budget" id="k_budget" value="{{ old('k_budget') }}">
                                    @error('k_budget') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Branding -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Branding Requirements</label>
                                    <input type="text" placeholder="e.g. Logo etching, Custom box colour" name="k_branding_requirements" id="k_branding_requirements" value="{{ old('k_branding_requirements') }}">
                                </div>
                            </div>

                            <!-- Delivery Date -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Delivery Timeline <span class="text-danger">*</span></label>
                                    <input type="date" name="k_delivery_date" id="k_delivery_date" value="{{ old('k_delivery_date') }}">
                                    @error('k_delivery_date') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="ct_input">
                                    <label class="sub_head">Message / Notes</label>
                                    <textarea name="k_message" placeholder="Enter Message" id="k_message">{{ old('k_message') }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="com_btn">REQUEST CORPORATE QUOTE</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
$( document ).ready(function() {
    $('#corporate_category').on('change', function() {
        var slug = $(this).val(); // get selected value
        if(slug) {
            // Replace 'your.route.name' with your actual route name
            window.location.href = "{{ route('front.corporate.vault', ':slug') }}".replace(':slug', slug);
        } else {
            // Optional: redirect to route without category if "All" selected
            window.location.href = "{{ route('front.corporate.vault') }}";
        }
    });

    $("#requestCorporateKitProposalForm").validate({
        ignore: [],
        rules: { 
            k_full_name: { 
                required: true, 
                minlength: 2, 
                maxlength: 50, 
                lettersonly: true 
            },
            k_company_name: { 
                required: true 
            },
            k_phone: { 
                required: true, 
                number: true, 
                validPhone: true 
            },
            k_email: { 
                required: true, 
                email: true, 
                noSpamEmail: true, 
                uniqueEmail: "corporate_kit_requests" 
            },
            'k_product_of_interest[]': { 
                required: true 
            },
            k_quantity_range: { 
                required: true 
            },
            k_delivery_date: { 
                required: true, 
                date: true, 
                minDate: true 
            },
            k_message:{
                maxlength:500,
            }
        },
        messages: {
            k_full_name: {
                required: "Please enter your full name",
                minlength: "Full name must be at least 2 characters",
                maxlength: "Full name cannot exceed 50 characters",
                lettersonly: "Full name can only contain letters and spaces"
            },
            k_company_name: {
                required: "Please enter your company or organization name"
            },
            k_phone: {
                required: "Please enter your phone number",
                number: "Phone number must contain only digits",
                validPhone: "Enter a valid phone number"
            },
            k_email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
                uniqueEmail: "This email is already used"
            },
            'k_product_of_interest[]': {
                required: "Please select at least one product of interest"
            },
            k_quantity_range: {
                required: "Please select a quantity range"
            },
            k_delivery_date: {
                required: "Please select a delivery date",
                date: "Enter a valid date",
                minDate: "Delivery date must be after today"
            },
            k_message:{
                maxlength: "Message cannot exceed 50 characters",
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            if (element.attr('name') === 'product_of_interest[]') {
                $('#product_kit_error').append(error);
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            if (!cFormSubmitted) {
                cFormSubmitted = true;
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