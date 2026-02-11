@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/about-banner.png')}}" alt="about us banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Gifting Shaped By Intent</h2>
    </div>
</section>

<section class="mt_120">
    <div class="container">
        <div class="row gy-4 gy-lg-0 gx-lg-0">
            <div class="col-lg-6">
                <div class="abiout_left">
                    <div class="abiout_left_tp">
                        <img src="{{ asset('public/front/images/home_magic_left.svg') }}" alt="" class="img-fluid">
                        <p class="sub_head mb-0">In a fast-moving world, we believe objects should still hold meaning.
</p>
                    </div>

                    <p class="mb-0">Dubai moves quickly. Transactions are instant. Communication is constant. Efficiency shapes how we live and work. Yet in this pace, something essential is often overlooked, the physical objects that ground our spaces, express values, and give form to relationships.
</p>
                    <p class="sub_head my-3" style="color: var(--secondary-color);"><i>I founded HNoww with a simple belief: objects are not neutral.</i></p>
                    <p>What we place on a desk, a table, or in someone’s hands carries meaning. Objects influence how we decide, how we gather, and how we remember.
</p>
                    <p class="mb-0">The desk you work at shapes focus. The table you host builds trust. And when we give, we are not simply offering an object. We are shaping memory, perception, and continuity through what is chosen and how it is held.
</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="abiout_right">
                    <div class="abiout_left_tp">
                        <img src="{{ asset('public/images/front/about-fabe.png') }}" alt="" class="img-fluid">
                        <p class="sub_head mb-0">At HNoww, we move beyond conventional gifting to objects chosen for meaning.
</p>
                    </div>

                    <p>We do not believe in disposable gifts, generic gestures, or objects chosen to perform for a moment. We curate with permanence in mind, objects meant to stay, to be lived with, and to hold relevance over time.
</p>
                    <p class="mb-0">Every piece in the HNoww collection is selected for its presence, not its excess. Whether it is the weight of a desk object, the balance of a hosting piece, or the restraint of a form, each object is designed to feel grounded and considered, not fleeting.
</p>
                    <p class="sub_head mt-3 mb-0" style="color: var(--secondary-color);"><i>Symbolic luxury is not defined by cost.
 <br />
                            It is defined by intent made visible.</i></p>

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
            <p>HNoww is guided by three principles that inform every object we curate and every decision we make.
</p>
        </div>
        <div class="row gy-4 gy-md-0">
            <div class="col-md-4">
                <div class="desire_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/framework1.png')}}" alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">Environment</h3>
                            <p class="mb-0">Physical surroundings shape behaviour. We curate objects that bring gravity to the office, clarity to the desk, and warmth to the home, grounding everyday spaces with intention and balance.
</p>
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
                            <p class="mb-0">We honour the Gulf tradition of Karam; generosity expressed with discretion, respect, and foresight. Our objects translate this cultural understanding into a modern, restrained language, where giving is thoughtful rather than performative.</p>
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
                            <p class="mb-0">We do not measure success by the unboxing moment. We measure it by what remains. Objects that stay on the desk. Pieces that continue to be used, trusted, and lived with over time.
</p>
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
                <span>Purpose</span>
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
                <p class="sub_head_inter">HNOWW exists to help individuals, families, and organisations choose with intention.
 Not louder gestures, but considered ones. Not more objects, but the right ones.
We curate objects that bring clarity to moments of giving, pieces chosen with care, restraint, and relevance. Designed to endure, not to impress.
Curated in Dubai, for those who understand that legacy is built quietly.
</p>
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
                <p class="small_heasd">We work with stone, metal, and heritage materials to create objects designed to remain in use, in presence, and in memory. Each piece is shaped to live with you over time, grounding everyday moments with clarity and purpose.
</p>
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