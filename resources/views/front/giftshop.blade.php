@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/giftshop-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head mb-3">The Gift Shop</h2>
        <p class="para sec_in_mb"> Curated gestures, sculptural objects, thoughtful rituals — for every moment worth
            honouring.</p>
        <a href="#" class="com_btn border-white bg-transparent text-white">ENTER THE WORLD </a>
    </div>
</section>

<section class="mt_80">
    <div class="container">

        <div class="section_header text-start">
            <div class="gesture_filter">
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">choosing a gift for</h3>
                    <select id="gift_for_filter" class="dropdown">
                        <option value="" {{ request('gift_for') == '' ? 'selected' : '' }}> Select Gift For </option>
                        @foreach(config('global_values.gift_for') as $key => $value)
                            <option value="{{ $key }}" {{ request('gift_for') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">to celebrate</h3>
                    <select class="dropdown" id="to_celebrate_filter">
                        <option value=""> Select To Celebrate </option>
                        @foreach(config('global_values.to_celebrate') as $key => $value)
                            <option value="{{ $key }}" {{ request('to_celebrate') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">Around</h3>
                    <select id="gift_price_filter" class="dropdown">
                        <option value=""> Select Price </option>
                        @foreach(config('global_values.gift_price_range') as $key => $value)
                            <option value="{{ $key }}" {{ request('gift_price_filter') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="gift-section">
            <div id="gift-list-wrapper">
                    @if($allGifts->isNotEmpty())
                        @include('front.partials.gift-list', ['allGifts' => $allGifts])
                    @endif
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
                <span>The</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Signature Pairings</h2>
        </div>
        <div class="row g-4 g-md-5">
            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <div>
                        <img class="w-100 mb-4" src="{{asset('public/images/front/rurated-rituals1.png')}}" alt="images">
                    </div>
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Ritual Duo </h3>
                            <p>Serveware designed for ceremony.</p>
                        </div>
                        <span><a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#giftInquiry">Enquire</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-4" src="{{asset('public/images/front/rurated-rituals2.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Desk Ceremony Set </h3>
                            <p>Frames & heirlooms for moments that matter.</p>
                        </div>
                        <span><a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#giftInquiry">Enquire</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-4" src="{{asset('public/images/front/rurated-rituals3.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Modern Majlis Set </h3>
                            <p>Modern gestures under AED 500.</p>
                        </div>
                        <span><a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#giftInquiry">Enquire</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-4" src="{{asset('public/images/front/rurated-rituals4.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Everyday Sacred</h3>
                            <p>Light. Scent. Stillness.</p>
                        </div>
                        <span><a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#giftInquiry">Enquire</a></span>
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
                <span>The</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Signature Pairings</h2>
        </div>
        <div class="gift_box">
            <div class="gift_box_lt">
                <img class="img-fluid" src="{{asset('public/images/front/signature-pairings.png')}}" alt="images">
            </div>

            <div class="gift_box_rt">
                <h3 class="gift_head">Gifting as Ritual. <br /> Every box, a blessing.</h3>
                <p class="sub_head_inter">Every HNOWW object arrives wrapped in hand-tied satin, ivory paper, and
                    a
                    sculptural black
                    box. <br> <b>Gifting becomes ceremony.</b> </p>
                <a href="{{ route('front.blessings.library') }}" target="_blank" class="com_btn"> Add a Blessing Card </a>
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
                    <span>Not sure what to choose?</span>
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
                <p class="cta_ft_center">Our Concierge will curate three <br /> perfect options for you.</p>
            </div>
            <div>
                {{-- <a href="javascript:void(0)" class="btn_2">WhatsApp the Concierge</a> --}}
            </div>
        </div>
    </div>
</section>

<div class="modal fade audio_modal" id="giftInquiry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="giftInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0">
                        <h5 class="modal-title" id="giftInquiryLabel">Product Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="productInquiryForm" action="{{ route('front.store.product.inquiry') }}">
                        @csrf
                        <input type="hidden" value="gift" name="inquiry_for">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" placeholder="Enter Name"
                                value="{{ old('name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Inquiry For Gift</label>
                            <select class="dropdown form-control" name="product_id" required>
                                <option value="">Select Product</option>
                                @if(isset($giftProducts) && is_countable($giftProducts) && count($giftProducts) > 0)
                                    @foreach ($giftProducts as $key => $val )
                                        <option value="{{ $val->id }}">{{$val->product_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email" placeholder="Enter Your Email Address"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text"
                                name="contact_no" placeholder="Enter your Whatsapp Phone Number"
                                value="{{ old('contact_no') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                class="form-control @error('contact_no') is-invalid @enderror">

                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" placeholder="Enter Message"
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

@include('layouts.frontfooter')