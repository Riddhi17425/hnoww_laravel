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

<section class="mt_60 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="pro_details">
                    <div class="left nav flex-column" id="productTab" role="tablist">
                        @if(isset($productDetailImages) && $productDetailImages != '')
                        @foreach($productDetailImages as $key => $val)
                        <button class="nav-link @if($key == 0) active @endif" data-bs-toggle="tab"
                            data-bs-target="#img1_{{ $key }}"> {{-- ✅ fix here --}}
                            <img src="{{ asset('public/images/admin/product_detail/'.$val)}}" alt="Sample Product">
                        </button>
                        @endforeach
                        @endif
                        {{-- <button class="nav-link" data-bs-toggle="tab" data-bs-target="#img2">
                            <img src="{{ asset('public/images/front/desire1.webp')}}" alt="Sample Product">
                        </button>

                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#img3">
                            <img src="{{ asset('public/images/front/desire2.webp')}}" alt="Sample Product">
                        </button>

                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#img4">
                            <img src="{{ asset('public/images/front/desire3.webp')}}" alt="Sample Product">
                        </button> --}}
                    </div>

                    <div class="tab-content">
                        @if(isset($productDetailImages) && $productDetailImages != '')
                        @foreach($productDetailImages as $key => $val)
                        <div class="tab-pane fade show @if($key == 0) active @endif" id="img1_{{ $key }}">
                            {{-- ✅ fix here --}}
                            <div class="zoom-container">
                                <img class="zoom-image img-fluid"
                                    src="{{ asset('public/images/admin/product_detail/'.$val)}}"
                                    alt="Product Detail Image">
                                <div class="zoom-lens"></div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                        {{-- <div class="tab-pane fade" id="img2">
                            <div class="zoom-container">
                                <img class="zoom-image img-fluid" src="{{ asset('public/images/front/desire1.webp')}}"
                        alt="Sample Product">
                        <div class="zoom-lens"></div>
                    </div>
                </div>

                <div class="tab-pane fade" id="img3">
                    <div class="zoom-container">
                        <img class="zoom-image img-fluid" src="{{ asset('public/images/front/desire2.webp')}}"
                            alt="Sample Product">
                        <div class="zoom-lens"></div>
                    </div>
                </div>

                <div class="tab-pane fade" id="img4">
                    <div class="zoom-container">
                        <img class="zoom-image img-fluid" src="{{ asset('public/images/front/desire3.webp')}}"
                            alt="Sample Product">
                        <div class="zoom-lens"></div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
    <div class="col-lg-5">
        <div class="pro_details_right">
            <h2 class="main_head">{{ $product->product_name ?? '' }}</h2>
            <p class="">{{ $product->short_note ?? '' }}</p>
            <!--<p class="sub_head_inter para">{!! $product->short_description ?? '' !!}</p>-->
            <h4 class="sub_head_inter">AED {{ $product->product_price ?? '' }} @if(isset($product->moq)) | MOQ
                {{$product->moq }} @endif</h4>

            {{-- <div class="increment_decrement_area">
                <div class="increment_decrement">
                    <button class="dec_btn"><svg width="16" height="2" viewBox="0 0 16 2" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 0.75H14.75" stroke="#666666" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <span class="span_value">1</span>

                            <button class="inc_btn"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.75 0.75V16.75M0.75 8.75H16.75" stroke="#666666" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    @auth
                        <a href="" class="com_btn">Add to Cart </a>
                    @else
                        <a href="javascript:void(0)" class="com_btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                            Add to Cart
                        </a>
                    @endauth
                    <!--<a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry">Enquire Now </a>-->
                </div>
            </div> --}}

            <div class="increment_decrement_area">
                <div class="increment_decrement" data-product-id="{{ $product->id }}" data-stock="{{ $product->product_stock }}">
                    <button class="dec_btn" data-call="detail" type="button">−</button>
                    <span class="span_value">1</span>
                    <input type="hidden" class="qty_input" id="product-qty" value="1">
                    <button class="inc_btn" data-call="detail" type="button">+</button>
                </div>
                @auth
                    <a href="javascript:void(0)" class="com_btn add_to_cart_btn" data-product-id="{{ $product->id }}"> Add to Cart</a>
                @else
                    <a href="javascript:void(0)" class="com_btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal"> Add to Cart </a>
                @endauth
            </div>


            @if(isset($product->large_description) && $product->large_description != '')
            <h4 class="sub_head mb-4">The Story</h4>
            <div class="mb-4">
                {!! $product->large_description ?? '' !!}
                {{-- <h4 class="sub_head mb-4">The Story</h4>
                    <p>Rasa is the Sanskrit word for essence, taste, and the emotional core of art. This
                        set is curated to evoke the "essence of delight" in your home.</p>
                    <p>At its heart lies a hand-hammered brass and copper sculpture bowl—a vessel of warmth and texture.
                        Paired with the Illumi aromatic bliss set, it transforms the atmosphere through fragrance and
                        flame. Accompanied by a limited edition print and a poetic blessing, The Rasa is not just a
                        gift, but a complete sensory ceremony designed to spark joy.</p> --}}
            </div>
            @endif
            @if(isset($product->large_description) && $product->large_description != '')
            <h4 class="sub_head mb-4">Material</h4>
            <div class="pro_details_info_list">
                {!! $product->dimensions ?? '' !!}
                {{-- <h4 class="sub_head mb-4">Dimensions</h4>
                    <ul>
                        <li><b>Bowl Diameter:</b> 20–22 cm (Approx.)</li>
                        <li><b>Box Dimensions:</b> 30 cm x 25 cm x 10 cm</li>
                        <li><b>Weight:</b> ~1.8 kg (Full Set)</li>
                    </ul> --}}
            </div>
            @endif

            @if(isset($product->care_maintenance) && $product->care_maintenance != '')
            <div>
                <div class="d-flex align-items-center gap-3 mt-4 mb-2">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 30 28" fill="none">
                            <path class="heart-path"
                                d="M22.1426 1C23.0312 1.00003 23.9132 1.19019 24.7393 1.56152C25.5655 1.93295 26.3221 2.4794 26.9629 3.1748V3.17578C27.6039 3.87135 28.1169 4.70101 28.4678 5.62012C28.8187 6.53946 29 7.52807 29 8.52734C28.9999 9.52647 28.8187 10.5144 28.4678 11.4336C28.1607 12.2379 27.7296 12.9738 27.1973 13.6113L26.9629 13.8789L15 26.8594L3.03711 13.8789C1.74115 12.4726 1.0001 10.5486 1 8.52734C1 6.50595 1.74106 4.58125 3.03711 3.1748C4.33058 1.77138 6.0665 1.00001 7.85742 1C9.64834 1 11.3843 1.7714 12.6777 3.1748L14.2646 4.89648L15 5.69434L15.7354 4.89648L17.3213 3.1748C17.9622 2.47924 18.7195 1.933 19.5459 1.56152C20.3719 1.19024 21.254 1 22.1426 1Z"
                                stroke="#c7b58c" stroke-width="2" />
                        </svg>
                    </span>
                    <span>
                        <p class="mb-0 sub_head">Care and maintenance</p>
                    </span>
                </div>
                <p class="m-0">{!! $product->care_maintenance ?? '' !!}</p>
            </div>
            @endif
        </div>
    </div>
    </div>
</section>

@if(isset($productTab) && is_countable($productTab) && count($productTab) > 0)
<section class="mt_60 mb-5">
    <div class="container">
        <div class="modern-tabs">
            <ul class="nav nav-tabs" id="filledTabs" role="tablist">
                @foreach($productTab as $key => $val)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == 0) active @endif" {{-- ✅ first tab active --}}
                        id="tab-{{ $key }}" {{-- ✅ unique ID --}} data-bs-toggle="tab"
                        data-bs-target="#tab-content-{{ $key }}" {{-- ✅ unique target --}} type="button" role="tab"
                        aria-controls="tab-content-{{ $key }}" aria-selected="@if($key == 0) true @else false @endif">
                        {{ $val->title ?? '' }}
                    </button>
                </li>
                @endforeach
                <!-- TAB 2 -->
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-content-3"
                        type="button" role="tab" aria-controls="tab-content-3" aria-selected="false">
                        Materials & Craft
                    </button>
                </li> --}}

            </ul>

            <div class="tab-content" id="filledTabsContent">
                @foreach($productTab as $key => $val)
                <div class="tab-pane fade @if($key == 0) show active @endif" {{-- ✅ only first tab active --}}
                    id="tab-content-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}">
                    {!! $val->details ?? '' !!}
                </div>
                @endforeach
                {{-- <div class="tab-pane fade" id="tab-content-3" role="tabpanel" aria-labelledby="tab-3">
                    <h4 class="sub_head mb-4">Ritual / Use</h4>
                    <ul class="pro_details_info_list mb-0">
                        <li><b>The Centerpiece: </b>Place the hammered bowl on a coffee table or console to ground the
                            space with warm metal tones.</li>
                        <li><b>The Awakening: </b>Light the Illumi burner during evening gatherings to fill the room
                            with the "essence of joy."</li>
                        <li><b>The Offering: </b>Use the bowl to hold fresh flower petals or floating candles as a daily
                            gesture of welcome.</li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endif

<section class="mt_80 mb_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Pairs</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Beautifully With</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            @if(isset($similarProduct) && is_countable($similarProduct) && count($similarProduct) > 0)
            @foreach($similarProduct as $key => $val)
            <div class="col-md-4">
                <a class="him_prod" href="{{ route('front.product.details', $val->product_url) }}">
                    <div class="him_prod_top mb-2 mb-md-4">
                        {{-- <img class="img-fluid img_1" src="{{ asset('public/images/front/desire1.webp')}}"
                        alt="him_prod"> --}}
                        <img class="img-fluid img_1"
                            src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}"
                            alt="{{ $val->product_name ?? 'Product Image' }}">
                    </div>
                    <div>
                        <div>
                            <h3 class="sub_head">{{ $val->product_name ?? '' }}</h3>
                            <p class="mb-0">{!! $val->short_description ?? '' !!}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
            {{-- <div class="col-md-4">
                <a class="him_prod" href="javascript:void(0)">
                    <div class="him_prod_top mb-2 mb-md-4">
                        <img class="img-fluid img_1" src="{{ asset('public/images/front/desire2.webp')}}"
            alt="him_prod">
        </div>

        <div>
            <div>
                <h3 class="sub_head">The Pearl Diver’s Ledger</h3>
                <p class="mb-0">A sanctuary for deep thinking.</p>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-4">
        <a class="him_prod" href="javascript:void(0)">
            <div class="him_prod_top mb-2 mb-md-4">
                <img class="img-fluid img_1" src="{{ asset('public/images/front/desire3.webp')}}" alt="him_prod">
            </div>

            <div>
                <div>
                    <h3 class="sub_head">The Pearl Diver’s Ledger</h3>
                    <p class="mb-0">A sanctuary for deep thinking.</p>
                </div>
            </div>
        </a>
    </div> --}}
    </div>

    </div>
</section>

<div class="modal fade audio_modal" id="productInquiry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="productInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0">
                        <h5 class="modal-title" id="productInquiryLabel">Product Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="productInquiryForm" action="{{ route('front.store.product.inquiry') }}">
                        @csrf
                        <input type="hidden" value="" name="inquiry_for">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Inquiry For Product</label>
                        <input type="text" class="form-control mb-3" value="{{ $product->product_name ?? '' }}"
                            disabled>
                        <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" placeholder="Enter Your Email Address"
                                value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_no" placeholder="Enter your Whatsapp Phone Number"
                                value="{{ old('contact_no') }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                class="form-control @error('contact_no') is-invalid @enderror">

                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="4" placeholder="Enter Message"
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
<script src="{{ asset('public/js/front/cart.js') }} "></script>

<script>
var formSubmitted = false;
$(document).ready(function() {
    $("#productInquiryForm").validate({
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
                uniqueEmail: "product_inquiries"
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