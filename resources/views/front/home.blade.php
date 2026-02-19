@include('layouts.frontheader')
<!-- hero section -->
<section class="hero-section">
    <img class="img-fluid" src="{{ asset('public/images/front/hero-banner.webp') }}" alt="images" loading="lazy">
    <!-- <video autoplay muted loop class="hero_video">
        <source src="{{ asset('public/images/front/hero-video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video> -->

    <div class="hero_content">
        <p class="mb-0 d-md-none" style="color: #F2D8D9;">Designed in Dubai. Made to endure.</p>
        <!--<h1 class="main_head">Where meaning takes shape.</h1>-->
        <h1 class="main_head">Where craft holds expressions </h1>
        <p>Personalised gifts designed to turn the everyday into a feeling. Thoughtfully designed, customized gifts
            shaped by intention and form.</p>
        <!--<p>Objects crafted to turn the everyday into ceremony.</p>-->
        <a href="{{ route('front.atelier') }}" class="com_btn border-0 bg-white">Explore The Works</a>
    </div>

    <div class="hero_left_right">
        <span><svg xmlns="http://www.w3.org/2000/svg" width="63" height="6" viewBox="0 0 63 6" fill="none">
                <path
                    d="M5.33332 2.66669C5.33332 1.19393 4.13942 2.03451e-05 2.66666 2.03451e-05C1.1939 2.03451e-05 -1.01725e-05 1.19393 -1.01725e-05 2.66669C-1.01725e-05 4.13945 1.1939 5.33335 2.66666 5.33335C4.13942 5.33335 5.33332 4.13945 5.33332 2.66669ZM62.6667 2.66669V2.16669L2.66666 2.16669V2.66669V3.16669L62.6667 3.16669V2.66669Z"
                    fill="white" />
            </svg></span>
        <p class="sub_head mb-0">Designed in Dubai. Made to endure.</p><span><svg xmlns="http://www.w3.org/2000/svg"
                width="63" height="6" viewBox="0 0 63 6" fill="none">
                <path
                    d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.03451e-05 60 2.03451e-05C58.5272 2.03451e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669L0 3.16669L60 3.16669V2.66669V2.16669L0 2.16669L0 2.66669Z"
                    fill="white" />
            </svg></span>
    </div>
</section>

<!--Find Gesture -->
<section class="mt_120 d-none">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Find</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">The Gesture</h2>
        </div>

        <div class="section_header">
            <div class="gesture_filter">
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">I’M CHOOSING A GIFT FOR</h3>
                    <select id="gift_for_filter" class="dropdown">
                        <option value="" {{ request('gift_for') == '' ? 'selected' : '' }}> Select Gift For </option>
                        @foreach(config('global_values.gift_for') as $key => $value)
                        <option value="{{ $key }}" {{ request('gift_for') == $key ? 'selected' : '' }}>{{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">to celebrate</h3>
                    <select id="to_celebrate_filter" class="dropdown">
                        <option value=""> Select To Celebrate </option>
                        @foreach(config('global_values.to_celebrate') as $key => $value)
                        <option value="{{ $key }}" {{ request('to_celebrate') == $key ? 'selected' : '' }}>{{ $value }}
                        </option>
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
    <div class="text-center mt_35">
        <a href="{{ route('front.giftshop') }}" target="_blank" class="com_btn">View all Gifts</a>
    </div>
    </div>
</section>

<!--The Collections -->
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
            <h2 class="title_60">Curated Expressions</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="collection_box">
                    <div class="">
                        <img class="img-fluid mb-2 mb-md-4" src="{{ asset('public/images/front/collections1.webp') }}"
                            alt="images" loading="lazy">
                    </div>
                    <h3 class="sub_head">For Her — {{$herProduct[0]->product_name ?? ''}}</h3>
                    <p>@if(isset($herProduct[0]->short_description)){!! $herProduct[0]->short_description !!}@endif</p>
                    <a href="{{ route('front.list', 'for-her') }}" target="_blank" class="com_btn">Explore Her World</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <div class="">
                        <img class="img-fluid mb-2 mb-md-4" src="{{ asset('public/images/front/collections2.webp') }}"
                            alt="images" loading="lazy">
                    </div>
                    <h3 class="sub_head">For Him — {{$himProduct[0]->product_name ?? ''}}</h3>
                    <p>@if(isset($himProduct[0]->short_description)){!! $himProduct[0]->short_description !!}@endif</p>
                    <a href="{{ route('front.list', 'for-him') }}" target="_blank" class="com_btn">Explore Him World</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <div class="">
                        <img class="img-fluid mb-2 mb-md-4" src="{{ asset('public/images/front/collections3.webp') }}"
                            alt="images" loading="lazy">
                    </div>
                    <h3 class="sub_head">For Home — {{$homeProduct[0]->product_name ?? ''}}</h3>
                    <p>@if(isset($homeProduct[0]->short_description)){!! $homeProduct[0]->short_description !!}@endif
                    </p>
                    <a href="{{ route('front.list', 'for-home') }}" target="_blank" class="com_btn">Explore Home
                        World</a>
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
            <h2 class="title_60">Valet Tray</h2>
        </div>
        <div class="gift_box">
            <div class="gift_box_lt">
                <img class="img-fluid" src="{{asset('public/images/front/valet_tray_home.webp')}}" alt="images">
            </div>

            <div class="gift_box_rt">
                <h3 class="gift_head">Carved in natural marble for <br /> leadership desks</h3>
                <h6 class="mt-3" style="color:var(--gold-color);">LIMITED EDITION — 50</h6>
                <p class="sub_head_inter">A sculptural object for the architect of industry. Minimal, grounded, and
                    rare.</p>
                <a href="{{ route('front.blessings.library') }}" target="_blank" class="com_btn"> Explore The
                    Architect’s Study </a>
            </div>
        </div>
    </div>
</section>

<!-- about -->
<section class="about mt_120">
    <div class="container">
        <div class="magic_wrapper">
            <h2 class="magic_head_phone">
                Intention drives beauty. Designs, guided by intent
            </h2>
            <!-- 3️⃣ Left image (from left) -->
            <div class="text-end magic_wrapper_logo">
                <img src="{{ asset('public/images/front/home_magic_left.svg') }}" loading="lazy" alt=""
                    class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div class="magic_wrapper_center">
                <img src="{{ asset('public/images/front/home_magic.webp') }}" loading="lazy" alt="" class="img-fluid">
                <p class="magic_wrapper_p"> Ritual is the first luxury.</p>
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div>
                <h3 class="magic_wrapper_h3">Rituals are not excess, they define us.</h3>
                <p>
                    Each piece is crafted as an emotion.
                    Form, material, and shadow are considered with care, designed to slow the moment, focus the mind,
                    and return us to what matters
                </p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1">
                Intention drives beauty.
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2">
                Designs, guided by intent
            </h2>

        </div>
    </div>
</section>
<!-- about -->

<!--Objects Of Desire -->
<section class="mt_80">
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
                <img class="img-fluid img_1"
                    src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}"
                    alt="{{ $val->product_name ?? 'Product Image' }}" loading="lazy">
                <span class="icon_hert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="28" viewBox="0 0 30 28" fill="none">
                        {{-- <path class="heart-path"
                                    d="M22.1426 1C23.0312 1.00003 23.9132 1.19019 24.7393 1.56152C25.5655 1.93295 26.3221 2.4794 26.9629 3.1748V3.17578C27.6039 3.87135 28.1169 4.70101 28.4678 5.62012C28.8187 6.53946 29 7.52807 29 8.52734C28.9999 9.52647 28.8187 10.5144 28.4678 11.4336C28.1607 12.2379 27.7296 12.9738 27.1973 13.6113L26.9629 13.8789L15 26.8594L3.03711 13.8789C1.74115 12.4726 1.0001 10.5486 1 8.52734C1 6.50595 1.74106 4.58125 3.03711 3.1748C4.33058 1.77138 6.0665 1.00001 7.85742 1C9.64834 1 11.3843 1.7714 12.6777 3.1748L14.2646 4.89648L15 5.69434L15.7354 4.89648L17.3213 3.1748C17.9622 2.47924 18.7195 1.933 19.5459 1.56152C20.3719 1.19024 21.254 1 22.1426 1Z"
                                    stroke="#B58A46" stroke-width="2" /> --}}
                    </svg>
                </span>
                <div class="desire_box_top_child">
                    <!--style="background: linear-gradient(180deg, rgba(4, 51, 25, 0) 32%, #8c8a72 95%), url('{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : asset('public/images/front/desire2.png') }}') center/cover no-repeat;"-->
                    <a href="jsvascript:void(0);" class="desire_box_top_child_inner" data-bs-toggle="modal"
                        data-bs-target="#productInquiry" data-product-name="{{ $val->product_name }}"
                        data-product-id="{{ $val->id }}">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none">
                            <path
                                d="M0.5 4.5H18.5M0.5 4.5V16.5C0.5 17.6046 1.39543 18.5 2.5 18.5H16.5C17.6046 18.5 18.5 17.6046 18.5 16.5V4.5M0.5 4.5L2.46327 1.00974C2.64039 0.69486 2.97357 0.5 3.33485 0.5H15.6652C16.0264 0.5 16.3596 0.69486 16.5367 1.00974L18.5 4.5M12.5 8.5C12.5 10.1569 11.1569 11.5 9.5 11.5C7.8431 11.5 6.5 10.1569 6.5 8.5"
                                stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Enquire Now</span>
                    </a>
                </div>

            </div>

            <div class="desire_box_bot_child">
                <div>
                    <h3 class="sub_head">{{$val->product_name ?? ''}}</h3>
                    <p>{!! $val->short_description ?? '' !!}</p>
                    <!--<p class="price"><a href="#">AED 1,980</a></p>-->
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
        @endif
    </div>
    </div>
</section>

<!--The Curated Rituals -->
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
            <h2 class="title_60">Curated Rituals</h2>
        </div>
        <div class="row g-lg-5 mobile_slider">
            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <div>
                        <img class="w-100 mb-4" src="{{ asset('public/images/front/rurated-rituals1.webp') }}"
                            alt="images" loading="lazy">
                    </div>
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Ritual Table</h3>
                            <p class="mb-0">Serveware shaped with the intention to gather.</p>
                        </div>
                        <span><a href="#" class="com_btn">Explore The Table </a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-4" src="{{ asset('public/images/front/rurated-rituals2.webp') }}" alt="images"
                        loading="lazy">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">Modern Majlis</h3>
                            <p class="mb-0">A contemporary space for gathering with quiet presence.</p>
                        </div>
                        <span><a href="#" class="com_btn">Explore Modern Majlis </a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-4" src="{{ asset('public/images/front/rurated-rituals3.webp') }}" alt="images"
                        loading="lazy">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Gift Shop</h3>
                            <p class="mb-0">Modern gestures, felt by design (under 500 AED)</p>
                        </div>
                        <span><a href="#" class="com_btn">The Art Of Gifting</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-4" src="{{ asset('public/images/front/rurated-rituals4.webp') }}" alt="images"
                        loading="lazy">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">Desert Rose</h3>
                            <p class="mb-0">Soft forms shaped by warmth and intention.</p>
                        </div>
                        <span class="mt-2"><a href="#" class="com_btn">Explore </a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--The Bespoke & Private Services -->
<section class="mt_120">
    <div class="container-fluid">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Our</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <!--<h2 class="title_60">Bespoke & Private Services</h2>-->
            <h2 class="title_60">Bespoke Services</h2>
        </div>
        <div class="row gx-2 mobile_slider">
            <div class="col-md-6">
                <div class="bespoke_box">
                    <div class="bespoke_box_top">
                        <img class="img-fluid" src="{{ asset('public/images/front/bespoke1.webp') }}" alt="images"
                            loading="lazy">
                        <p class="title_40">Weddings & Celebrations</p>
                    </div>
                    <div class="bespoke_box_bot">
                        <p class="para">Ceremonial designs crafted to mark modern unions.</p>
                        <span><a href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#requestWeddingCatalogue" class="com_btn">Request Wedding
                                Catalogue</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bespoke_box">

                    <div class="bespoke_box_top_2">
                        <img class="img-fluid" src="{{ asset('public/images/front/bespoke2.webp') }}" alt="images"
                            loading="lazy">
                        <p class="title_40">Corporate Rituals</p>
                    </div>
                    <div class="bespoke_box_bot">

                        <p class="para">Articles designed to mark intentional partnerships.</p>
                        <span><a href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#requestCorporateProposal" class="com_btn"> The Corporate
                                Edit</a></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

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
            <!--<h2 class="title_60">Editions</h2>-->
            <h2 class="title_60">House Journal</h2>
        </div>
        <div class="row mobile_slider">
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/editions1.webp') }}" alt="images"
                        loading="lazy">
                    <h3 class="sub_head">The Blessing Library</h3>
                    <p>Written blessings and words of intention for home, union, and self.</p>
                    <a href="{{ route('front.blessings.library') }}" target="_blank" class="com_btn">Explore </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/editions2.webp') }}" alt="images"
                        loading="lazy">
                    <h3 class="sub_head">The Journal</h3>
                    <p>Reflections on design, ritual, and contemporary living.</p>
                    <a href="{{ route('front.journal') }}" target="_blank" class="com_btn">Explore</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/editions3.webp') }}" alt="images"
                        loading="lazy">
                    <h3 class="sub_head">Bespoke Commissions</h3>
                    <p>Collaborative creations shaped around personal rituals and intent.</p>
                    <a href="{{ route('front.bespoke.commission') }}" target="_blank" class="com_btn">Explore</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade audio_modal" id="productInquiry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="productInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0 border-0">
                        <h5 class="title_40" id="productInquiryLabel">Product Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="ct_form">
                        <form method="POST" id="productInquiryForm" action="{{ route('front.store.product.inquiry') }}">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ct_input">
                                        <label class="sub_head">Name</label>
                                        <input type="text" name="name" placeholder="Enter Name"
                                            value="{{ old('name') }}"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                            class=" @error('name') is-invalid @enderror">

                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="ct_input">
                                        <label class="sub_head">Contact Number</label>
                                        <input type="text" name="contact_no"
                                            placeholder="Enter your Whatsapp Phone Number"
                                            value="{{ old('contact_no') }}"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                            class=" @error('contact_no') is-invalid @enderror">

                                        @error('contact_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="ct_input">
                                        <label class="sub_head">Email</label>
                                        <input type="email" name="email" placeholder="Enter Your Email Address"
                                            value="{{ old('email') }}" class=" @error('email') is-invalid @enderror">

                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="ct_input">
                                        <label class="sub_head">Inquiry For Product</label>
                                        <input style="background-color: #8c8a721c !important;color: var(--gold-color);"
                                            type="text" class=" fw-medium" id="product_name" value="" disabled>
                                        <input type="hidden" name="product_id" id="product_id" value="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="ct_input">
                                        <label class="sub_head">Message</label>
                                        <textarea name="message" placeholder="Enter Message" rows="1"
                                            class=" @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                        @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <button type="button" class="com_btn bg-transparent"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="com_btn bg-transparent ms-2">Submit</button>
                                </div>


                            </div>
                        </form>
                    </div>
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