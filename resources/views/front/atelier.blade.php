@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/atelier-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">The Atelier</h2>
        <p class="para">Where philosophy, craft, and quiet ceremony meet.</p>
    </div>
</section>

<!-- about -->
<!--<section class="about">-->
<!--    <div class="container">-->
<!--        <div class="magic_wrapper">-->
<!--            <h2 class="magic_head_phone">-->
<!--                Beauty is not decoration It is devotion.-->
<!--            </h2>-->
<!--            <div class="text-end magic_wrapper_logo">-->
<!--                <img src="{{asset('public/images/front/home_magic_left.svg')}}" alt="">-->
<!--            </div>-->
<!--            <div>-->
<!--                <img src="{{asset('public/images/front/home_magic.png')}}" alt="" class="img-fluid">-->
<!--            </div>-->
<!--            <div>-->
<!--                <h3 class="magic_wrapper_h3">Designed in Dubai. Rooted in ritual. Made to endure.</h3>-->
<!--                <p>At HNOWW, every object is a gesture. A pause.-->
<!--                    A moment of intention.-->
<!--                    We craft sculptural pieces that turn daily actions into quiet ceremonies where form becomes meaning,-->
<!--                    and the everyday becomes sacred.-->
<!--                </p>-->
<!--            </div>-->
<!--            <h2 class="magic_head_1">Beauty is not decoration</h2>-->
<!--            <h2 class="magic_head_2">It is devotion.</h2>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!-- about -->

<section class="about">
    <div class="container">
        <div class="magic_wrapper">
            <h2 class="magic_head_phone" data-aos="fade-left" data-aos-delay="0" data-aos-duration="800"
                data-aos-once="true">
                Beauty is not decoration It is devotion.
            </h2>
            <!-- 3️⃣ Left image (from left) -->
            <div class="text-end magic_wrapper_logo" data-aos="fade-right" data-aos-delay="600" data-aos-duration="800"
                data-aos-once="true">
                <img src="{{ asset('public/front/images/home_magic_left.svg') }}" alt="" class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div data-aos="zoom-in" data-aos-delay="400" data-aos-duration="800" data-aos-once="true">
                <img src="{{ asset('public/front/images/home_magic.png') }}" alt="" class="img-fluid">
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div data-aos="fade-left" data-aos-delay="800" data-aos-duration="800" data-aos-once="true">
                <h3 class="magic_wrapper_h3">Designed in Dubai. Rooted in ritual. Made to endure.</h3>
                <p>
                    At HNOWW, every object is a gesture. A pause.
                    A moment of intention.
                    We craft sculptural pieces that turn daily actions into quiet ceremonies  where form becomes meaning,
 and the everyday becomes sacred.
                </p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1" data-aos="fade-left" data-aos-delay="0" data-aos-duration="800"
                data-aos-once="true">
                Beauty is not decoration
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="800"
                data-aos-once="true">
                It is devotion.
            </h2>

        </div>
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
            <h2 class="title_60">Origin</h2>
        </div>
        <div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="origin_left">
                        <img class="img-fluid" src="{{asset('public/images/front/bespoke1.png')}}" alt="images">
                        <div class="origin_left_content">
                            <p class="title_40">HNOWW was born from a simple belief:</p>
                            <p class="sub_head">that life becomes richer when lived with intention.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="atelier_origin_content">
                        <p class="sub_head_inter" style="color:unset;"> Inspired by the rituals of our culture hosting,
                            gifting, gathering, lighting a flame, offering sweets, preserving moments we reimagine these
                            gestures through culptural design.</p>
                        <p class="font_34 mt-4">Every curve, weight, and material is chosen with purpose:</p>
                        <p class="sub_head_inter" style="color:unset;">Stone for grounding, silver for memory, malachite
                            for depth, Brass for stillness. </p>
                        <p class="magic_wrapper_h3 mt-4">HNOWW is not an object brand. It is a movement back to meaning.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- origin -->

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
            <h2 class="title_60">Blessing Library</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/blessing-library1.png')}}"
                        alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">For Home</h3>
                            <p class="mb-0">A blessing for warmth, abundance, and shared tables.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/blessing-library2.png')}}"
                        alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">For Union</h3>
                            <p class="mb-0">A blessing for new beginnings, sacred partnership, and rooted love.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/blessing-library3.png')}}"
                        alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">For Self</h3>
                            <p class="mb-0">A blessing for clarity, stillness, and intention.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt_35 text-center">
            <a href="{{ route('front.blessings.library') }}" target="_blank" class="com_btn"> Explore All Blessings </a>
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
            <h2 class="title_60"> Journal</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/Journal1.png')}}"
                        alt="images">
                    <h3 class="sub_head mb-0">Why We Chose Travertine: A Study in Stone</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/Journal2.png')}}"
                        alt="images">
                    <h3 class="sub_head mb-0">The Ritual of Hosting: The Table as Ceremony</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/Journal3.png')}}"
                        alt="images">
                    <h3 class="sub_head mb-0">Objects of Memory: Creating a Personal Shrine at Home</h3>
                </div>
            </div>
        </div>

        <div class="mt_35 text-center">
            <a href="{{ route('front.journal') }}" target="_blank" class="com_btn">Read the Journal </a>
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
            <h2 class="title_60 mb-4">Bespoke Rituals</h2>

            <div class="row align-items-center px-3">
                <div class="col-md-12 text-center mb-3 mb-md-0">
                    <p class="mb-0">Commission custom ceremonial objects, heirlooms, and sacred gifts.
                        Our atelier collaborates with families, designers, and couples to create one-of-a-kind pieces
                        for
                    </p>
                </div>
                {{-- <div class="text-md-end col-md-6">
                <a href="javascript:void(0);" class="com_btn">View Bespoke Portfolio  </a>
            </div> --}}
            </div>
        </div>



        <div class="corporate_slider">

            <div class="desire_box">
                <img class="w-100 mb-4" src="{{asset('public/images/front/Bespoke-Rituals1.png')}}" alt="images">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="sub_head">Weddings & Pheras</h3>

                    </div>
                </div>
            </div>
            <div class="desire_box">
                <img class="w-100 mb-4" src="{{asset('public/images/front/Bespoke-Rituals2.png')}}" alt="images">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="sub_head">Milestone Celebrations</h3>

                    </div>
                </div>
            </div>
            <div class="desire_box">
                <img class="w-100 mb-4" src="{{asset('public/images/front/Bespoke-Rituals3.png')}}" alt="images">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="sub_head">New Homes</h3>

                    </div>
                </div>
            </div>
            <div class="desire_box">
                <img class="w-100 mb-4" src="{{asset('public/images/front/Bespoke-Rituals1.png')}}" alt="images">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="sub_head">New Homes</h3>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="mt_120">
    <div class="container">
        <div class="material_wrapper">
            <div class="section_header">
                <p class="sub_head mb-0">
                    <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span>Crafted</span>
                    <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                </p>
                <h2 class="title_60">With Intention</h2>
                <p>Our objects are made in small batches using natural materials:</p>
            </div>
            <div class="material_flex">
                <div class="mobile_slider">

                    <div class="material_slide text-center">
                        <div class="material_img">
                            <img src="{{asset('public/images/front/natural-stone.png')}}" alt="natural-stone"
                                class="img-fluid" loading="lazy">
                        </div>
                        <h6 class="sub_head">Natural stone</h6>
                    </div>


                    <div class="material_slide text-center">
                        <div class="material_img">
                            <img src="{{asset('public/images/front/natural-stone2.png')}}" alt="natural-stone"
                                class="img-fluid" loading="lazy">
                        </div>
                        <h6 class="sub_head">Brass</h6>
                    </div>

                    <div class="material_slide text-center">
                        <div class="material_img">
                            <img src="{{asset('public/images/front/natural-stone3.png')}}" alt="natural-stone"
                                class="img-fluid" loading="lazy">
                        </div>
                        <h6 class="sub_head">Malachite</h6>
                    </div>

                    <div class="material_slide text-center">
                        <div class="material_img">
                            <img src="{{asset('public/images/front/natural-stone4.png')}}" alt="natural-stone"
                                class="img-fluid" loading="lazy">
                        </div>
                        <h6 class="sub_head">Rose Quartz</h6>
                    </div>

                    <div class="material_slide text-center">
                        <div class="material_img">
                            <img src="{{asset('public/images/front/natural-stone5.png')}}" alt="natural-stone"
                                class="img-fluid" loading="lazy">
                        </div>
                        <h6 class="sub_head">Silver Metal</h6>
                    </div>

                    <div class="material_slide text-center">
                        <div class="material_img">
                            <img src="{{asset('public/images/front/natural-stone6.png')}}" alt="natural-stone"
                                class="img-fluid" loading="lazy">
                        </div>
                        <h6 class="sub_head">Leather</h6>
                    </div>

                </div>
            </div>
            <p class="text-center mb-0">We work with artisans whose hands understand the language of weight, stone, and
                texture — bringing each
                object to life with purpose and care.</p>
        </div>
    </div>
</section>


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
                <span>the</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Crafted With Intention</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/values1.png')}}" alt="images">
                    <h3 class="sub_head">Ritual First</h3>
                    <p class="mb-0">Objects designed for meaning, not decoration.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/values2.png')}}" alt="images">
                    <h3 class="sub_head">Sculptural Purity</h3>
                    <p class="mb-0">Form, weight, and shadow shape our vocabulary.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <img class="img-fluid mb-2 mb-md-4" src="{{asset('public/images/front/values3.png')}}" alt="images">
                    <h3 class="sub_head">Small Batch Craft</h3>
                    <p class="mb-0">Limited editions. Slow production. Enduring quality.</p>
                </div>
            </div>
        </div>

    </div>
</section>

<!--The Collections -->
<section class="mt_80">
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
            <h2 class="title_60">Bespoke & Private Services</h2>
        </div>
        <div class="row gy-4 gy-md-0 gx-2">
            <div class="col-md-6">
                <div class="bespoke_box">
                    <div class="bespoke_box_top">
                        <img class="img-fluid" src="{{asset('public/images/front/bespoke1.png')}}" alt="images">
                        <p class="title_40">Weddings & Celebrations</p>
                    </div>
                    <div class="bespoke_box_bot">
                        <p class="para">Sculptural ceremonial pieces for modern unions.</p>
                        <span><a href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#requestWeddingCatalogue" class="com_btn">Request Wedding
                                Catalogue</a></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="bespoke_box">

                    <div class="bespoke_box_top_2">
                        <img class="img-fluid" src="{{asset('public/images/front/bespoke2.png')}}" alt="images">
                        <p class="title_40">Corporate Rituals</p>
                    </div>
                    <div class="bespoke_box_bot">
                        <p class="para">Objects that create lasting partnerships. Custom engraving available.</p>
                        <span><a href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#requestCorporateProposal" class="com_btn">Download Corporate Lookbook</a></span>
                    </div>
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
                <p class="cta_ft_center">Our Concierge will curate three <br /> perfect options for you.</p>
            </div>
            <div>
                {{-- <a href="javascript:void(0)" class="btn_2">Begin Your Journey </a> --}}
            </div>
        </div>
    </div>
</section>

@push('script')
<script>

</script>
@endpush

@include('front.corporate_request_modal')
@include('front.wedding_request_modal')
@include('layouts.frontfooter')