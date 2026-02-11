@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/about-banner.png')}}" alt="about us banner">

    <div class="hero_content_inner">
        <h2 class="main_head">The Luxury of Intent</h2>
    </div>
</section>

<section class="mt_120">
    <div class="container">
        <div class="row gy-4 gy-lg-0 gx-lg-0">
            <div class="col-lg-6">
                <div class="abiout_left">
                    <div class="abiout_left_tp">
                        <img src="{{ asset('public/front/images/home_magic_left.svg') }}" alt="" class="img-fluid">
                        <p class="sub_head mb-0">In a world defined by speed and frictionless exchange, we have forgotten the
                            power of the
                            object.</p>
                    </div>

                    <p class="mb-0">Dubai operates at the velocity of the future. Transactions are instant. Communication is
                        constant. Everything is optimized for efficiency. Yet in this pursuit of speed, something
                        essential has been lost: the anchor — the physical objects that ground environments, signal
                        values, and formalize relationships.</p>
                    <p class="sub_head my-3" style="color: var(--secondary-color);"><i>I founded HNOWW because I believe
                            objects are not neutral.</i></p>
                    <p class="mb-0">The desk you work at is not just furniture; it is a site of decision-making. The table you host
                        at is not just a surface; it is a stage for trust. And when we gift, we are not just giving a
                        product — we are shaping memory, perception, and continuity.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="abiout_right">
                    <div class="abiout_left_tp">
                        <img src="{{ asset('public/images/front/about-fabe.png') }}" alt="" class="img-fluid">
                        <p class="sub_head mb-0">At HNOWW, we have moved beyond conventional gifting.
                            We curate Symbolic Luxury.</p>
                    </div>

                    <p>We reject the disposable, the generic, and the performative.
                        We curate for permanence.</p>
                    <p class="mb-0">Every object in the HNOWW universe is chosen for its ability to command presence
                        without excess — whether it is the weight of a stone desk object or the architectural
                        restraint of a hosting vessel. These pieces are not designed to impress briefly, but to
                        remain.</p>
                    <p class="sub_head mt-3 mb-0" style="color: var(--secondary-color);"><i>Symbolic Luxury is not about
                            cost. <br />
                            It is about intent made visible.</i></p>

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
                <span>Our</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Framework</h2>
            <p>HNOWW is built on three principles that guide every decision we make.</p>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/framework1.png')}}" alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">Environment</h3>
                            <p class="mb-0">Physical surroundings shape behavior. We curate objects that bring gravity
                                to the office, clarity to the desk, and warmth to the home.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/framework2.png')}}" alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">Ritual</h3>
                            <p class="mb-0">We honor the Gulf tradition of Karam — generosity expressed with discretion,
                                respect, and foresight. Our objects translate this cultural intelligence into a modern,
                                minimalist language.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/framework3.png')}}" alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">Result</h3>
                            <p class="mb-0">We do not measure success by the unboxing moment. We measure it by what
                                remains. The objects that stay on the desk. The pieces that continue to be used, seen,
                                and trusted over time.</p>
                        </div>
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
                <span>VISION</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Why HNOWW Exists</h2>
        </div>

        <div class="exists_content">
            <div class="col-lg-10 m-auto">
                <p class="sub_head_inter">HNOWW exists to help individuals, families, and organizations navigate the art
                    of the intentional gesture. Not louder gestures. Smarter ones. Not more objects. The right ones.
                    Welcome to HNOWW. Curated in Dubai for those who understand that legacy is built quietly.</p>
                <p class="sub_head">Environment. Ritual. Result.</p>
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
                <span>THE PRACTICE</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">What HNOWW Does</h2>
        </div>
        <div class="row align-items-center gy-4 gy-md-0">
            <div class="col-md-6">
                <img class="img-fluid" src="{{asset('public/images/front/practIce-about.png')}}" alt="images">
            </div>

            <div class="col-md-6 practice_content ps-lg-5">
                <p class="sub_head_inter">HNOWW curates sculptural objects for three environments:</p>
                <h4 class="title_40">The Desk. The Home. The Intentional Gift.</h4>
                <p class="small_heasd">We work with stone, metal, and heritage materials to create pieces that remain —
                    in use, in presence, and in memory.</p>
            </div>

        </div>
    </div>
</section>

<section class="mt_120 mb_120">
    <div class="container">
        <div class="founder_main">

            <div class="founder_text_1">
                <h2 data-aos="fade-left" data-aos-delay="0" data-aos-duration="800" data-aos-once="true">
                    Founder
                </h2>
                <p class="mb-0">viral kotecha</p>
            </div>

            <div data-aos="zoom-in" data-aos-delay="400" data-aos-duration="800" data-aos-once="true">
                <img src="{{ asset('public/images/front/hnoww-women.png') }}" alt="" class="img-fluid">
            </div>

            <div class="founder_text_2">
                <h2 data-aos="fade-left" data-aos-delay="1000" data-aos-duration="800" data-aos-once="true">
                    HNOWW
                </h2>
            </div>

        </div>
    </div>
</section>


@include('layouts.frontfooter')