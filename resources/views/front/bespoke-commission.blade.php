@include('layouts.frontheader')
<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/bespoke-banner.webp')}}" alt="images">

    <div class="hero_content_inner">
        <h2 class="main_head">Bespoke Commissions</h2>
        <p class="para">From imagination to heirloom. The art of bespoke creation.</p>
    </div>
</section>



<!-- about -->
<section class="about">
    <div class="container">
        <div class="magic_wrapper">
            <h2 class="magic_head_phone">
                True luxury
            </h2>
            <!-- 3️⃣ Left image (from left) -->
            <div class="text-end magic_wrapper_logo">
                <img src="{{ asset('public/images/front/home_magic_left.svg') }}" alt="" class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div class="magic_wrapper_center">
                <img src="{{ asset('public/images/front/home_magic.webp') }}" loading="lazy" alt="" class="img-fluid">
                <p class="magic_wrapper_p"> Ritual is the first luxury.</p>
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div>
                <p>
                    We accept a limited number of private commissions each year to craft objects of profound
                    significance. Whether it is a vessel for a sacred union, a deal toy for a landmark acquisition, or a
                    legacy piece for a newborn, we translate your narrative into permanent form. We do not just design
                    objects; we engineer memories
                </p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1">
                Beauty is not decoration
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2">
                is personal.
            </h2>

        </div>
    </div>
</section>
<!-- about -->


<!--Objects Of Desire -->
{{-- <section class="mt_80">
    <div class="section_header">
        <p class="sub_head mb-0">
            <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                        fill="#B58A46" />
                </svg>
            </span>
            <span>Objects</span>
            <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                        fill="#B58A46" />
                </svg>
            </span>
        </p>
        <h2 class="title_60">Of Desire</h2>
    </div>
    <div class="desire_slider">
        @if(isset($allProd) && is_countable($allProd) && count($allProd) > 0)
            @foreach($allProd as $key => $val)
                <div class="desire_box">
                    <div class="desire_box_top mb-4">
                        <img class="img-fluid img_1" src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}"
alt="{{ $val->product_name ?? 'Product Image' }}">
<span class="icon_hert">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="28" viewBox="0 0 30 28" fill="none">
    </svg>
</span>
<div class="desire_box_top_child">
    <!--style="background: linear-gradient(180deg, rgba(4, 51, 25, 0) 32%, #8c8a72 95%), url('{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : asset('public/images/front/desire2.png') }}') center/cover no-repeat;"-->
    <a href="jsvascript:void(0);" class="desire_box_top_child_inner">
        <svg width="19" height="19" viewBox="0 0 19 19" fill="none">
            <path
                d="M0.5 4.5H18.5M0.5 4.5V16.5C0.5 17.6046 1.39543 18.5 2.5 18.5H16.5C17.6046 18.5 18.5 17.6046 18.5 16.5V4.5M0.5 4.5L2.46327 1.00974C2.64039 0.69486 2.97357 0.5 3.33485 0.5H15.6652C16.0264 0.5 16.3596 0.69486 16.5367 1.00974L18.5 4.5M12.5 8.5C12.5 10.1569 11.1569 11.5 9.5 11.5C7.8431 11.5 6.5 10.1569 6.5 8.5"
                stroke="white" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span data-bs-toggle="modal" data-bs-target="#productInquiry" data-product-name="{{ $val->product_name }}"
            data-product-id="{{ $val->id }}">Enquire Now</span>
    </a>
</div>
</div>
<div class="desire_box_bot_child">
    <div>
        <h3 class="sub_head">{{$val->product_name ?? ''}}</h3>
        <p>{!! $val->short_description ?? '' !!}</p>
    </div>
    <a href="{{ route('front.product.details', $val->product_url) }}">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
            <path d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334" stroke="#8c8a72"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
</div>
</div>
@endforeach
@endif

</div>
</div>
</section> --}}


<!--The Editions -->
<section class="mt_120 mb_120">
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
            <h2 class="title_60">Scope of Work</h2>
        </div>
        <div class="row mobile_slider">
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/scope-of-worka1.webp') }}"
                        alt="images">
                    <h3 class="sub_head">Wedding Rituals</h3>
                    <p>Custom trousseau trunks, ring ceremony trays, and bridal party gifting suites that honor the
                        sanctity of the union.</p>

                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/scope-of-worka2.webp') }}"
                        alt="images">
                    <h3 class="sub_head">Family Heirloom</h3>
                    <p>Legacy objects for newborns, ancestry boxes, and milestone anniversary gifts designed to be
                        passed down.</p>

                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/scope-of-worka3.webp') }}"
                        alt="images">
                    <h3 class="sub_head">Corporate Legacy</h3>
                    <p>Sculptural deal toys, founder’s gifts, and architectural desk artifacts for partners of
                        consequence.</p>

                </div>
            </div>
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
                    <span>Let intention take form</span>
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
                <p class="cta_ft_center">Commission slots for Q1 2026 are <br /> currently open.</p>
            </div>
            <div>
                <a href="javascript:void(0)" class="btn_2">Begin Your Journey</a>
            </div>
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
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" placeholder="Enter Name" value="{{ old('name') }}"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Inquiry For Product</label>
                        <input type="text" class="form-control mb-3" id="product_name" value="" disabled>
                        <input type="hidden" name="product_id" id="product_id" value="">
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
                            <textarea name="message" placeholder="Enter Message" rows="4"
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
$(document).ready(function() {
    $('#productInquiry').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget);
        let productName = button.data('product-name');
        let productId = button.data('product-id');

        $('#product_name').val(productName);
        $('#product_id').val(productId);
    });
});
</script>
@endpush

@include('layouts.frontfooter')