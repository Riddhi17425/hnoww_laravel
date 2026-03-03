@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/editions-banner.webp')}}" alt="images">

    <div class="hero_content_inner">
        <h2 class="main_head">Editions</h2>
        <p class="para">Time-bound expressions of form, ritual, and collaboration.</p>
    </div>
</section>

<section class="mt_60">
    <div class="container">
        <p class="text-center sub_head_inter" style="color:#666666">Each HNOWW Edition is a chapter shaped by
            dialogue, discipline, and restraint. <br> They are created slowly, released briefly, and never repeated in
            the same form.</p>
        <p class="text-center sub_head_inter" style="color:#666666">This is not seasonal design. It is considered
            expression.</p>
    </div>
</section>

<section class="mt_80 ">
    <div class=" container-fluid origin_wrapper">
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
            <h2 class="title_60">HNOWW × Aara</h2>
        </div>
        <div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="origin_left">
                        <!-- <img class="img-fluid" src="{{asset('public/images/front/aara-sec1.webp')}}" alt="images"> -->
                        <video autoplay muted loop>
                            <source src="{{ asset('public/images/front/aara-video-sec1.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="atelier_origin_content">
                        <h3 class="title_40 mb-3">Season I — The Table as Landscape</h3>
                        <p class="sub_head_inter" style="color:unset;">This Edition explores how objects can shape
                            space.</p>

                        <p class="sub_head_inter" style="color:unset;">Through restraint, weight, and placement, HNOWW
                            objects move beyond the shelf becoming structural elements within an environment.</p>
                        <p class="magic_wrapper_h3 mt-4">Created in collaboration with Aara, this chapter examines how
                            florals respond when objects lead.
                        </p>
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
            <h2 class="title_60">Archive</h2>
        </div>
        <div class="row gy-4 gy-lg-0">
            <div class="col-md-4">
                <div class="archive_box">
                    <img class="w-100 mb-3" src="{{ asset('public/images/front/archive1.webp') }}" alt="images">
                    <h3 class="sub_head">The Architecture of Gathering</h3>
                    <hr>
                    <div class="archive_box_inner">
                        <h3 class="sub_head_inter">HNOWW × Aara</h3>
                        {{-- <p class="mb-0">2025 — Spatial Composition</p> --}}
                    </div>
                    <p class="mb-0">2025 Spatial Composition </br> A study of the table as structure. Objects arranged to shape space and movement.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="archive_box">
                    <img class="w-100 mb-3" src="{{ asset('public/images/front/archive2.webp') }}" alt="images">
                    <h3 class="sub_head">The Geometry of Flame</h3>
                    <hr>

                    <div class="archive_box_inner">
                        {{-- <p class="mb-0">2024 — Light as Object</p> --}}
                    </div>

                    <p class="mb-0">2024 Light as Object </br> A study of candle form and proportion. Developed in glass and metal with restrained
                        detailing.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="archive_box">
                    <img class="w-100 mb-3" src="{{ asset('public/images/front/archive3.webp') }}" alt="images">
                    <h3 class="sub_head">Ritual in Print</h3>
                    <hr>

                    <div class="archive_box_inner">
                        <h3 class="sub_head_inter">HNOWW * Shivaranjini</h3>
                        {{-- <p class="mb-0">2024 — Devotional Forms </p> --}}
                    </div>

                    <p class="mb-0">2024 Devotional Forms <br/> A collaboration with an Indian artist. Traditional motifs presented in a
                        contemporary way.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- about -->
<section class="about">
    <div class="container">
        <div class="magic_wrapper">
            <h2 class="magic_head_phone">
                Why Editions Exist
            </h2>
            <!-- 3️⃣ Left image (from left) -->
            <div class="text-end magic_wrapper_logo">
                <img src="{{ asset('public/images/front/home_magic_left.svg') }}" alt="" class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div class="magic_wrapper_center">
                <img src="{{ asset('public/images/front/home_magic.webp') }}" loading="lazy" alt="" class="img-fluid">
                <p class="magic_wrapper_p">HNOWW Editions exist <br /> to protect intention.</p>
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div>
                <p>They allow collaboration without dilution.<br />
                    They allow experimentation without excess. <br />
                    They allow expression without permanence.
                </p>
                <h3 class="magic_wrapper_h3">An Edition is not defined by quantity, but by clarity.</h3>
                <p>
                    When an Edition ends, it remains as a record, not a product line.
                </p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1">
                Why Editions Exist
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2">
                How ideas are respected
            </h2>

        </div>
    </div>
</section>
<!-- about -->

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
                    <span>Propose an Edition</span>
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
                <p class="cta_ft_center">Each proposal is <br /> reviewed with care.</p>
            </div>
            <div>
                <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20your%20services"
                target="_blank" class="btn_2"> Start a Conversation </a>
                {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bespokeCommission"
                    class="btn_2">Start a Conversation</a> --}}
            </div>
        </div>
    </div>
</section>


@include('layouts.frontfooter')