@include('layouts.frontheader')



<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/corporate-vault-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">The Corporate Vault</h2>
        <p class="para my-3">Objects designed to remain.</p>
        <a href="#" class="com_btn bg-white border-0" data-bs-toggle="modal"
            data-bs-target="#requestCorporateProposal">Request for CORPORATE CATALOGUE</a>
    </div>
</section>

<section class="mt_60 request_catalogue_para">
    <div class="container">
        <p class="text-center sub_head_inter" style="color:#666666">A considered collection of architectural desk
            objects, ritual instruments, and enduring artefacts curated for leadership environments.
            Each object in the Corporate Vault is selected for <b>material integrity, discretion,</b> and its ability to
            <b>remain
                appropriate over time.</b>
        </p>

        <p class="text-center sub_head_inter" style="color:#666666">This is not gifting for the moment. This is
            representation, chosen carefully.</p>
    </div>
</section>

{{-- DYNAMIC --}}
@if(isset($categories) && is_countable($categories) && count($categories) > 0)

@foreach($categories as $k => $v)
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
                <span>Collections</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">{{ $v->category_name ?? '' }}</h2>
<<<<<<< HEAD
            <p><b>{!! $v->description ?? '' !!}</b></p>
            {{-- data-bs-toggle="modal" data-bs-target="#productInquiry" --}}
            <a href="#" class="com_btn" data-category="{{ $v->id }}"> {{ $v->button_text ?? '' }}</a>
=======
            <p>{!! $v->description ?? '' !!}</p>
                {{-- data-bs-toggle="modal" data-bs-target="#productInquiry" --}}
            <a href="#" class="com_btn corporate-product" data-category="{{ $v->id }}"> {{ $v->button_text ?? '' }}</a>
>>>>>>> e4dd33e42001bf4790796634c16675901d083f07
        </div>

        <div class="row gy-4 gy-lg-0">
            @if(isset($v->products) && is_countable($v->products) && count($v->products) > 0)
            @foreach($v->products as $key => $val)
            @if(($k == 0 || $k == 1) && $key == 3)
            @break
            {{-- @elseif(($k == 2 || $k == 3) && $key == 3)
                    @break --}}
            @endif
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4"
                        src="{{ asset('public/images/admin/product_list/'.$val->list_page_img) }}" alt="images">
                    <div class="desire_box_bot_child">
                        <div>
                            <h3 class="sub_head">{{ $val->product_name ?? '' }}</h3>
                            <p class="mb-0">{!! $val->short_description ?? '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($k == 2 && $key == 1)
            <div class="col-md-4">
                <div class="desire_box">
                    <div class="hospitality_img">
                        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/hospitality3.webp')}}"
                            alt="images">
                        <div class="hospitality_img_overlay">
                            <h3 class="title_36">These objects are not decorative.
                                <p></p>
                                They are intended to <b>mark moments without diminishing them.</b>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($k == 3 && $key == 1)
            <div class="col-md-4">
                <div class="desire_box">
                    <div class="hospitality_img">
                        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/hospitality3.webp')}}"
                            alt="images">
                        <div class="hospitality_img_overlay">
                            <h3 class="title_36">These pieces respect Gulf traditions of <b>karam, </b> interpreted for
                                contemporary spaces.</h3>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif
            {{-- <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/desk2.webp')}}" alt="images">
            <div class="desire_box_bot_child">
                <div>
                    <h3 class="sub_head">Pen Holders & Organisers</h3>
                    <p class="mb-0">Weighted metal pieces that introduce order and restraint to the desk.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="desire_box">
            <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/desk3.webp')}}" alt="images">
            <div class="desire_box_bot_child">
                <div>
                    <h3 class="sub_head">Paperweights & Coasters</h3>
                    <p class="mb-0">Stone and metal forms that anchor the workspace physically and visually.</p>
                </div>
            </div>
        </div>
    </div> --}}
    </div>
    </div>
</section>
@endforeach

@else
{{-- STATIC --}}
{{-- <section class="mt_120 mb_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Collections</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">The Desk</h2>
            <p><b>For environments where decisions are made.</b> Objects designed to sit within executive workspaces —
                not to decorate them.</p>
            <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry" data-product="desck_objects"> ENQUIRE ABOUT DESK OBJECTS</a>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/desk1.webp')}}" alt="images">
<div class="desire_box_bot_child">
    <div>
        <h3 class="sub_head">Card Holders</h3>
        <p>Silver and stone forms designed to hold presence without excess.</p>
    </div>

    <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
</div>
</div>
</div>
<div class="col-md-4">
    <div class="desire_box">
        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/desk2.webp')}}" alt="images">
        <div class="desire_box_bot_child">
            <div>
                <h3 class="sub_head">Pen Holders & Organisers</h3>
                <p class="mb-0">Weighted metal pieces that introduce order and restraint to the desk.</p>
            </div>

            <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="desire_box">
        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/desk3.webp')}}" alt="images">
        <div class="desire_box_bot_child">
            <div>
                <h3 class="sub_head">Paperweights & Coasters</h3>
                <p class="mb-0">Stone and metal forms that anchor the workspace physically and visually.</p>
            </div>

            <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
        </div>
    </div>
</div>
</div>
</div>
</section> --}}

{{-- <section class="mt_120 mb_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Collections</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Writing & Thought Objects</h2>
            <p><b>For continuity, reflection, and intellectual presence.</b> Objects designed to accompany thinking —
                and remain with the recipient over time.</p>
            <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry" data-product="writing_objects"> ENQUIRE ABOUT WRITING SETS</a>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/images-here.webp')}}"
alt="images">
<div class="desire_box_bot_child">
    <div>
        <h3 class="sub_head">Silver-Plated Bookmarks</h3>
        <p>Given as markers of trust and continuity.</p>
    </div>

    <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
</div>
</div>
</div>
<div class="col-md-4">
    <div class="desire_box">
        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/images-here.webp')}}" alt="images">
        <div class="desire_box_bot_child">
            <div>
                <h3 class="sub_head">Writing Sets & Ledgers</h3>
                <p class="mb-0">Journals paired with metal accents, selected for longevity rather than
                    trend.</p>
            </div>

            <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="desire_box">
        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/images-here.webp')}}" alt="images">
        <div class="desire_box_bot_child">
            <div>
                <h3 class="sub_head">Voyager Sets</h3>
                <p class="mb-0">Curated ensembles designed for leaders who move across roles, regions, and
                    responsibilities.</p>
            </div>
            <!-- 
                        <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
        </div>
    </div>
</div>
</div>
</div>
</section>

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
                <span>Collections</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Frames & Memory Objects</h2>
            <p> <b>For moments that deserve to be kept visible.</b> Architectural frames designed to hold photographs,
                certificates, or milestones — without sentimentality.</p>
            <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry"
                data-product="frames_objects"> ENQUIRE ABOUT FRAMES</a>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/memory1.webp')}}" alt="images">
                    <div class="desire_box_bot_child">
                        <div>
                            <h3 class="sub_head">Silver Grid Frames</h3>
                            <p>Clean architectural lines in polished silver.</p>
                        </div>

                        <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/memory2.webp')}}" alt="images">
                    <div class="desire_box_bot_child">
                        <div>
                            <h3 class="sub_head">Malachite & Stone Frames</h3>
                            <p class="mb-0">Sculptural compositions for leadership offices and private spaces.</p>
                        </div>

                        <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <div class="hospitality_img">
                        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/hospitality3.webp')}}"
                            alt="images">
                        <div class="hospitality_img_overlay">
                            <h3 class="title_36">These objects are not decorative.
                                <p></p>
                                They are intended to <b>mark moments without diminishing them.</b>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt_120 mb_35">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Collections</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Ritual & Hospitality Objects</h2>
            <p><b>For welcome, respect, and shared presence.</b> Objects designed for hosting — interpreted with modern
                restraint.</p>
            <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry"
                data-product="ritual_objects"> ENQUIRE ABOUT RITUAL OBJECTS</a>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/images-here.webp')}}"
                        alt="images">
                    <div class="desire_box_bot_child">
                        <div>
                            <h3 class="sub_head">Glassware & Carafes</h3>
                            <p>Sculptural hydration vessels with architectural clarity.</p>
                        </div>

                        <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/hospitality2.webp')}}"
                        alt="images">
                    <div class="desire_box_bot_child">
                        <div>
                            <h3 class="sub_head">Coasters & Table Objects</h3>
                            <p class="mb-0">Weighted metal and stone pieces designed to remain on hosting tables.</p>
                        </div>

                        <!-- <a href="#">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path
                                    d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <div class="hospitality_img">
                        <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/hospitality3.webp')}}"
                            alt="images">
                        <div class="hospitality_img_overlay">
                            <h3 class="title_36">These pieces respect Gulf traditions of <b>karam, </b> interpreted for
                                contemporary spaces.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endif

<section class="about">
    <div class="container">
        <div class="magic_wrapper">
            <h2 class="magic_head_phone">
                Containment & Presentation
            </h2>
            <!-- 3️⃣ Left image (from left) -->
            <div class="text-end magic_wrapper_logo">
                <img src="{{ asset('public/images/front/home_magic_left.svg') }}" loading="lazy" alt=""
                    class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div class="magic_wrapper_center">
                <img src="{{ asset('public/images/front/home_magic.webp') }}" loading="lazy" alt="" class="img-fluid">
                <p class="magic_wrapper_p"> For how an object arrives.</p>
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div>
                <p>
                    Every piece in the Corporate Vault is presented in <b>signature velvet boxes,</b> designed for
                    permanence , not transit.
                </p>
                <p>No flimsy cartons. <br> No disposable packaging.</p>
                <p>The container signals the same care as the object.</p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1">
                Containment &
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2">
                Presentation
            </h2>

        </div>
    </div>
</section>
@if(isset($corporateKits) && count($corporateKits) && count($corporateKits) > 0)

<section class="mt_35">
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
            @foreach($corporateKits as $key => $val)
            <div class="cor_kts">
                <picture>
                    <source media="(min-width: 768px)" srcset="{{ asset('public/images/front/corpotat-kits.webp') }}">
                    <img class="img-fluid" src="{{ asset('public/images/front/corporate-kits-phone.webp') }}"
                        alt="Description" style="width:auto;">
                </picture>
                <div class="cor_kits_cont">
                    <div>
                        <h3 class="title_40">{{ $val->title ?? '' }}</h3>
                        <p>{!! $val->short_description !!}</p>
                    </div>
                    <div class="sub_head my-4">
                        <p>{!! $val->large_description !!}</p>
                        {{-- <p class="mb-1">Contains:</p>
                            <p class="mb-1"> – Card Holder</p>
                            <p class="mb-1">– Pen Holder</p>
                            <p>– Organiser</p> --}}
                    </div>

                    {{-- <a href="#" class="com_btn border-white" data-bs-toggle="modal"
                            data-bs-target="#requestCorporateProposal">Request for CORPORATE CATALOGUE</a> --}}
                    <a href="#" class="com_btn border-white" data-bs-toggle="modal"
                        data-bs-target="#requestCorporateKitProposal">Request for CORPORATE CATALOGUE</a>
                </div>
            </div>
            @endforeach
            {{-- <div class="cor_kts">
                <picture>
                    <source media="(min-width: 768px)" srcset="{{ asset('public/images/front/corpotat-kits.webp') }}">
            <img class="img-fluid" src="{{ asset('public/images/front/corporate-kits-phone.webp') }}" alt="Description"
                style="width:auto;">
            </picture>
            <div class="cor_kits_cont">
                <div>
                    <h3 class="title_40">The Executive Desk Suite</h3>
                    <p>A weighted triad for leadership workspaces.
                    </p>
                </div>
                <div class="sub_head my-4">
                    <p class="mb-1">Contains:</p>
                    <p class="mb-1"> – Card Holder</p>
                    <p class="mb-1">– Pen Holder</p>
                    <p>– Organiser</p>
                </div>

                <a href="#" class="com_btn border-white" data-bs-toggle="modal"
                    data-bs-target="#requestCorporateProposal">Request for CORPORATE CATALOGUE</a>
            </div>
        </div> --}}

    </div>
    </div>
</section>
@endif

<section class="mt_120">
    <div class="container">
        <div class="section_header">
            <h2 class="title_60">Customization & Recognition</h2>
        </div>
        <div class="text-center">
            <p>All Corporate Vault objects support understated customisation designed to remain appropriate.</p>
            <h4 class="sub_head" style="color:var(--secondary-color); font-style: italic;">This includes:</h4>
            <p>Company-led recognition cards | Internal branding only (never front-facing)</p>
            <p>Customisation is treated as <b>representation,</b> not promotion.</p>
        </div>
    </div>
</section>

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
            <h2 class="title_60">Trust Builders</h2>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/builder1.webp') }}" alt="images"
                        loading="lazy">
                    <h3 class="sub_head">The Recognition Standard</h3>
                    <p><b>Representation begins with recognition.</b> Each gift carries a company-led message.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/builder2.webp') }}" alt="images"
                        loading="lazy">
                    <h3 class="sub_head">The Packaging Standard</h3>
                    <p>Every object arrives contained in our signature velvet boxes, designed for permanence.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-4" src="{{ asset('public/images/front/builder3.webp') }}" alt="images"
                        loading="lazy">
                    <h3 class="sub_head">The Lead Time</h3>
                    <p>"Production: <b>30-45 Days.</b> " Rush orders available upon request.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Corporate Product Request -->
<div class="modal fade corporate_vault_modal" id="requestCorporateProduct" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestCorporateProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            
                <div class="modal-body">
                    <div class="container">
                <div class="text-center my-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <form method="POST" action="{{ route('front.store.corporate.kit.request') }}" id="requestCorporateProductForm" class="ct_form">
                        @csrf
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="ck_full_name" id="ck_full_name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                        placeholder="Enter your Full Name" value="{{ old('ck_full_name') }}">
                                    @error('ck_full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Company Organization <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="ck_company_name"
                                        placeholder="Enter your Company Organization Name" id="ck_company_name"
                                        value="{{ old('ck_company_name') }}">
                                    @error('ck_company_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="ck_phone" id="ck_phone"
                                        placeholder="Enter your WhatsApp Phone Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                        value="{{ old('phone') }}">
                                    @error('ck_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="ck_email" placeholder="Enter your Email Address"
                                        id="ck_email" value="{{ old('ck_email') }}">
                                    @error('ck_email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Product of Interest (MULTISELECT) -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Product of Interest <span
                                            class="text-danger">*</span></label>
                                    <select id="ck_product_of_interest" name="ck_product_of_interest[]" multiple>
                                        @if(isset($corporateKits) && is_countable($corporateKits) &&
                                        count($corporateKits) > 0)
                                        @foreach($corporateKits as $value)
                                        <option value="{{ $value->id }}"
                                            {{ collect(old('ck_product_of_interest'))->contains($value->id) ? 'selected' : '' }}>
                                            {{ $value->title }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div id="product_kit_error"></div>
                                    @error('ck_product_of_interest') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Quantity Range -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Quantity Range <span class="text-danger">*</span></label>
                                    <select name="ck_quantity_range" id="ck_quantity_range">
                                        <option value="">Select</option>
                                        @foreach(config('global_values.quality_range') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('ck_quantity_range') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ck_quantity_range') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Approximate Budget</label>
                                    <input type="text" placeholder="Enter Approximate Budget" name="ck_budget"
                                        id="ck_budget" value="{{ old('ck_budget') }}">
                                    @error('ck_budget') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Branding -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Branding Requirements</label>
                                    <input type="text" placeholder="e.g. Logo etching, Custom box colour"
                                        name="ck_branding_requirements" id="ck_branding_requirements"
                                        value="{{ old('ck_branding_requirements') }}">
                                </div>
                            </div>

                            <!-- Delivery Date -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Delivery Timeline <span class="text-danger">*</span></label>
                                    <input type="date" name="ck_delivery_date" id="ck_delivery_date"
                                        value="{{ old('ck_delivery_date') }}">
                                    @error('ck_delivery_date') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="ct_input">
                                    <label class="sub_head">Message / Notes</label>
                                    <textarea name="ck_message" placeholder="Enter Message"
                                        id="ck_message">{{ old('ck_message') }}</textarea>
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

<!-- Corporate Kit Request -->
<div class="modal fade corporate_vault_modal" id="requestCorporateKitProposal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestCorporateKitProposalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container">
                    <div class="text-center my-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('front.store.corporate.kit.request') }}"
                        id="requestCorporateKitProposalForm" class="ct_form">
                        @csrf
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="ck_full_name" id="ck_full_name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                        placeholder="Enter your Full Name" value="{{ old('ck_full_name') }}">
                                    @error('ck_full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Company Organization <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="ck_company_name"
                                        placeholder="Enter your Company Organization Name" id="ck_company_name"
                                        value="{{ old('ck_company_name') }}">
                                    @error('ck_company_name') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="ck_phone" id="ck_phone"
                                        placeholder="Enter your WhatsApp Phone Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                        value="{{ old('phone') }}">
                                    @error('ck_phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="ck_email" placeholder="Enter your Email Address"
                                        id="ck_email" value="{{ old('ck_email') }}">
                                    @error('ck_email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Product of Interest (MULTISELECT) -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Product of Interest <span
                                            class="text-danger">*</span></label>
                                    <select id="ck_product_of_interest" name="ck_product_of_interest[]" multiple>
                                        @if(isset($corporateKits) && is_countable($corporateKits) &&
                                        count($corporateKits) > 0)
                                        @foreach($corporateKits as $value)
                                        <option value="{{ $value->id }}"
                                            {{ collect(old('ck_product_of_interest'))->contains($value->id) ? 'selected' : '' }}>
                                            {{ $value->title }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div id="product_kit_error"></div>
                                    @error('ck_product_of_interest') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Quantity Range -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Quantity Range <span class="text-danger">*</span></label>
                                    <select name="ck_quantity_range" id="ck_quantity_range">
                                        <option value="">Select</option>
                                        @foreach(config('global_values.quality_range') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('ck_quantity_range') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('ck_quantity_range') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Approximate Budget</label>
                                    <input type="text" placeholder="Enter Approximate Budget" name="ck_budget"
                                        id="ck_budget" value="{{ old('ck_budget') }}">
                                    @error('ck_budget') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Branding -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Branding Requirements</label>
                                    <input type="text" placeholder="e.g. Logo etching, Custom box colour"
                                        name="ck_branding_requirements" id="ck_branding_requirements"
                                        value="{{ old('ck_branding_requirements') }}">
                                </div>
                            </div>

                            <!-- Delivery Date -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Delivery Timeline <span class="text-danger">*</span></label>
                                    <input type="date" name="ck_delivery_date" id="ck_delivery_date"
                                        value="{{ old('ck_delivery_date') }}">
                                    @error('ck_delivery_date') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="ct_input">
                                    <label class="sub_head">Message / Notes</label>
                                    <textarea name="ck_message" placeholder="Enter Message" id="ck_message"
                                        rows="1">{{ old('ck_message') }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="com_btn bg-transparent">REQUEST CORPORATE QUOTE</button>
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
$(document).ready(function() {
    var element = $('#ck_product_of_interest')[0]; // get raw DOM element from jQuery object
    var choices = new Choices(element, {
        removeItemButton: true, // shows an "x" to deselect each selected option
        placeholder: true,
        placeholderValue: 'Select products',
        searchEnabled: true,
    });

    $("#requestCorporateKitProposalForm").validate({
        ignore: [],
        rules: {
            ck_full_name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                lettersonly: true
            },
            ck_company_name: {
                required: true
            },
            ck_phone: {
                required: true,
                number: true,
                validPhone: true
            },
            ck_email: {
                required: true,
                email: true,
                noSpamEmail: true,
                uniqueEmail: "corporate_kit_requests"
            },
            'ck_product_of_interest[]': {
                required: true
            },
            ck_quantity_range: {
                required: true
            },
            ck_delivery_date: {
                required: true,
                date: true,
                minDate: true
            },
            ck_message: {
                maxlength: 500,
            }
        },
        messages: {
            ck_full_name: {
                required: "Please enter your full name",
                minlength: "Full name must be at least 2 characters",
                maxlength: "Full name cannot exceed 50 characters",
                lettersonly: "Full name can only contain letters and spaces"
            },
            ck_company_name: {
                required: "Please enter your company or organization name"
            },
            ck_phone: {
                required: "Please enter your phone number",
                number: "Phone number must contain only digits",
                validPhone: "Enter a valid phone number"
            },
            ck_email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
                uniqueEmail: "This email is already used"
            },
            'ck_product_of_interest[]': {
                required: "Please select at least one product of interest"
            },
            ck_quantity_range: {
                required: "Please select a quantity range"
            },
            ck_delivery_date: {
                required: "Please select a delivery date",
                date: "Enter a valid date",
                minDate: "Delivery date must be after today"
            },
            ck_message: {
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