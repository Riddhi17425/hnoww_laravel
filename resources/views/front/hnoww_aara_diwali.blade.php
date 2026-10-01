@include('layouts.frontheader')

<link rel="stylesheet" href="{{ asset('public/front/css/hnoww-aara-diwali.css') }}">

<!-- hero section -->
@php
    $aara_marquee_items = ['Florals that bloom', 'Objects that stay', 'The Diwali Edition', 'Dubai & the UAE'];
    $aara_marquee_items = array_merge($aara_marquee_items, $aara_marquee_items, $aara_marquee_items, $aara_marquee_items);
@endphp
<section class="aara_hero" style="background-image: url('{{ asset('public/images/front/hero-banner.webp') }}');">
    <div class="aara_hero_vertical">
        <span class="aara_hero_vertical_line"></span>
        <span class="aara_hero_vertical_text">Diwali in Dubai. Set with intention.</span>
        <span class="aara_hero_vertical_line"></span>
    </div>

    <div class="aara_hero_content">
        <div class="aara_hero_logos">
            <span class="brand_hnoww">HNOWW</span>
            <span class="brand_x">×</span>
            <span class="brand_aara">aara</span>
        </div>

        <p class="aara_hero_label">The Diwali Edition &middot; 2026</p>

        <h1 class="aara_hero_title">The Festive <em>Table</em></h1>

        <p class="aara_hero_para">
            Florals made to bloom for an evening. Objects designed to stay for generations.
            Set together, for the celebrations that matter.
        </p>

        <div class="aara_hero_btns">
            <a href="{{ route('front.giftshop') }}" class="com_btn_light">Shop the Edit <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20HNOWW%20x%20Aara%20Diwali%20Edition" target="_blank" rel="noopener" class="com_btn_light">Order on WhatsApp</a>
        </div>
    </div>

    <div class="aara_hero_corner">
        Delivered across the UAE<br>
        Order by [Date]
    </div>

    <!-- auto-scrolling text strip -->
    <div class="aara_marquee">
        <div class="aara_marquee_track">
            @for ($i = 0; $i < 2; $i++)
                <div class="aara_marquee_group" @if($i > 0) aria-hidden="true" @endif>
                    @foreach ($aara_marquee_items as $item)
                        <span class="aara_marquee_item">{{ $item }}</span>
                        <span class="aara_marquee_dot">&bull;</span>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- The Collaboration -->
<section class="aara_collab mt_120 mb_120">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-6">
                <p class="sub_head mb-0 aara_section_label">
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                    <span>The Collaboration</span>
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                </p>
                <h2 class="aara_collab_title">
                    One is made to bloom for an evening. The other, <em>to stay for generations.</em>
                </h2>

                <p class="aara_collab_para">
                    This Diwali, HNOWW and Aara Floral Luxury come together to set the scene for celebration.
                    Fresh florals bring colour, softness and movement. Architectural objects bring weight, meaning
                    and permanence. Together they turn the table into the heart of the festival, in Dubai as it is
                    back home.
                </p>

                <div class="aara_collab_brands">
                    <div class="aara_collab_brand">
                        <h3 class="aara_collab_brand_name">HNOWW</h3>
                        <p class="aara_collab_brand_tag">Objects designed to stay</p>
                        <p class="aara_collab_brand_desc">Architectural objects and luxury gifting, designed in Dubai.</p>
                    </div>
                    <div class="aara_collab_brand aara_collab_brand_aara">
                        <h3 class="aara_collab_brand_name aara_collab_brand_name_aara">aara</h3>
                        <p class="aara_collab_brand_tag">Floral Luxury</p>
                        <p class="aara_collab_brand_desc">[One line on Aara from their team.]</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="aara_collab_images">
                    <img class="aara_collab_img_main" src="{{ asset('public/images/front/diwali/Lotus Lights.webp') }}" alt="Florals that bloom for an evening">
                    <img class="aara_collab_img_secondary" src="{{ asset('public/images/front/diwali/Sovereign Weight.webp') }}" alt="Objects designed to stay for generations">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- The Festive Table Set -->
<section class="aara_pairing">
    <div class="aara_pairing_media">
        <img src="{{ asset('public/images/front/diwali/Corporate Diwali Collection 2026 Banner.webp') }}" alt="The Festive Table Set — HNOWW x Aara Diwali gifting, Dubai" loading="lazy">
        <span class="aara_pairing_badge">The Pairing</span>
    </div>

    <div class="aara_pairing_content">
        <p class="sub_head mb-0 aara_section_label">
            <span>
                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                </svg>
            </span>
            <span>Limited for Diwali</span>
            <span>
                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                </svg>
            </span>
        </p>
        <h2 class="aara_pairing_title">The Festive <em>Table Set</em></h2>

        <p class="aara_pairing_para">
            An HNOWW object and a fresh Aara arrangement, composed together and delivered as one.
            A table ready for the evening, or a gift that arrives ready to be placed.
        </p>

        <div class="aara_pairing_steps">
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">01</span>
                <div>
                    <p class="aara_pairing_step_title">Choose your object</p>
                    <p class="aara_pairing_step_desc">Elephants, bowls, candle stands, serveware</p>
                </div>
            </div>
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">02</span>
                <div>
                    <p class="aara_pairing_step_title">Pair it with Aara florals</p>
                    <p class="aara_pairing_step_desc">Composed to match the piece and the palette</p>
                </div>
            </div>
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">03</span>
                <div>
                    <p class="aara_pairing_step_title">Delivered together</p>
                    <p class="aara_pairing_step_desc">Across Dubai &amp; the UAE, before Diwali</p>
                </div>
            </div>
        </div>

        <div class="aara_pairing_price_row">
            <span class="aara_pairing_price_label">From</span>
            <span class="aara_pairing_price">AED [Price]</span>
        </div>

        <div>
            <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20HNOWW%20x%20Aara%20Festive%20Table%20Set" target="_blank" rel="noopener" class="com_btn_light">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
        </div>

        <p class="aara_pairing_note">Order by [Date] for delivery before Diwali</p>
    </div>
</section>

<!-- The Festive Table Collection -->
<section class="aara_edit mt_120 mb_120">
    <div class="container">
        <div class="aara_edit_header">
            <div>
                <p class="sub_head mb-0 aara_section_label">
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                    <span>The Edit</span>
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                </p>
                <h2 class="aara_edit_title">The Festive Table<br><em>Collection</em></h2>
            </div>
            <p class="aara_edit_para">
                Pieces from the Festive Table, each made to hold the occasion with care.
                Order any piece on its own, or pair it with Aara florals.
            </p>
        </div>

        <div class="aara_edit_grid_top">
            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/diwali/Sovereign Weight.webp') }}" alt="Silver Elephant Pair — HNOWW Diwali table piece, Dubai" loading="lazy">
                    <span class="aara_edit_card_badge">HNOWW</span>
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[Silver Elephant Pair]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">A blessing for the table.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Silver%20Elephant%20Pair" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_grid_top_right">
                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/diwali/Signature.webp') }}" alt="Malachite Bowl — HNOWW Diwali gifting, Dubai" loading="lazy">
                        <span class="aara_edit_card_badge">HNOWW</span>
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">[Malachite Bowl]</h3>
                            <span class="aara_edit_card_price">AED [Price]</span>
                        </div>
                        <p class="aara_edit_card_desc">A vessel for the offering.</p>
                        <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Malachite%20Bowl" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>

                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/diwali/Aarambh.webp') }}" alt="Candle Stand — HNOWW Diwali table piece, Dubai" loading="lazy">
                        <span class="aara_edit_card_badge">HNOWW</span>
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">[Candle Stand]</h3>
                            <span class="aara_edit_card_price">AED [Price]</span>
                        </div>
                        <p class="aara_edit_card_desc">A light for the evening.</p>
                        <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Candle%20Stand" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>

                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/diwali/Virasat.webp') }}" alt="Engraved Vase — HNOWW Diwali gifting, Dubai" loading="lazy">
                        <span class="aara_edit_card_badge">HNOWW</span>
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">[Engraved Vase]</h3>
                            <span class="aara_edit_card_price">AED [Price]</span>
                        </div>
                        <p class="aara_edit_card_desc">Made to hold the season.</p>
                        <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Engraved%20Vase" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>

                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/diwali/Why HNOWW Exists.webp') }}" alt="Fluted Platter — HNOWW Diwali serveware, Dubai" loading="lazy">
                        <span class="aara_edit_card_badge">HNOWW</span>
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">[Fluted Platter]</h3>
                            <span class="aara_edit_card_price">AED [Price]</span>
                        </div>
                        <p class="aara_edit_card_desc">A surface for the sweets.</p>
                        <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Fluted%20Platter" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="aara_edit_grid_bottom">
            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/aara/festive-centrepiece.jpg') }}" alt="The Festive Centrepiece — Aara Floral Luxury arrangement, Dubai" loading="lazy">
                    <span class="aara_edit_card_badge">Aara</span>
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[The Festive Centrepiece]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">Marigold, dahlia and quiet colour.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Festive%20Centrepiece" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/aara/marigold-rose.jpg') }}" alt="Marigold & Rose — Aara Floral Luxury arrangement, Dubai" loading="lazy">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[Marigold &amp; Rose]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">For the welcome at the door.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20Marigold%20%26%20Rose" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/aara/rouge-roses.jpg') }}" alt="Rouge Roses — Aara Floral Luxury arrangement, Dubai" loading="lazy">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[Rouge Roses]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">Colour, softness, movement.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20Rouge%20Roses" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>
        </div>

        <div class="aara_edit_grid_extra">
            <p class="aara_edit_extra_label">More from the Edit</p>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/diwali/Personalisation.webp') }}" alt="Brass Diya Trio — HNOWW Diwali table piece, Dubai" loading="lazy">
                    <span class="aara_edit_card_badge">HNOWW</span>
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[Brass Diya Trio]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">Light, carried in threes.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Brass%20Diya%20Trio" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/diwali/Why HNOWW Exists.webp') }}" alt="Marble Coaster Set — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <span class="aara_edit_card_badge">HNOWW</span>
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[Marble Coaster Set]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">A quiet base for every glass.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20Marble%20Coaster%20Set" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/aara-sec1.webp') }}" alt="Orchid & Jasmine — Aara Floral Luxury arrangement, Dubai" loading="lazy">
                    <span class="aara_edit_card_badge">Aara</span>
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[Orchid &amp; Jasmine]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">Quiet white, for a calmer table.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20Orchid%20%26%20Jasmine" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/diwali/Corporate Diwali Collection 2026 Banner.webp') }}" alt="White Peony Posy — Aara Floral Luxury arrangement, Dubai" loading="lazy">
                    <span class="aara_edit_card_badge">Aara</span>
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">[White Peony Posy]</h3>
                        <span class="aara_edit_card_price">AED [Price]</span>
                    </div>
                    <p class="aara_edit_card_desc">Soft and full, for the entryway.</p>
                    <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20White%20Peony%20Posy" target="_blank" rel="noopener" class="aara_edit_card_link">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- The Films - Set the Scene -->
@php
    $aara_films = [
        [
            'poster' => asset('public/images/front/aara-sec1.webp'),
            'video'  => asset('public/images/front/aara-video-sec1.mp4'),
            'duration' => '0:45',
            'title' => 'Lighting the Table',
            'alt' => 'Lighting the Table — HNOWW x Aara Diwali film',
        ],
        [
            'poster' => asset('public/images/front/diwali/Aarambh.webp'),
            'video'  => asset('public/images/front/hero-video.mp4'),
            'duration' => '0:[00]',
            'title' => '[Reel 2 title]',
            'alt' => 'Behind the scenes — HNOWW x Aara Diwali film',
        ],
        [
            'poster' => asset('public/images/front/diwali/Lotus Lights.webp'),
            'video'  => asset('public/images/front/hero-video.mp4'),
            'duration' => '0:[00]',
            'title' => '[Reel 3 title]',
            'alt' => 'Styling the arrangement — HNOWW x Aara Diwali film',
        ],
    ];
@endphp
<section class="aara_film_section">
    <div class="container">
        <div class="aara_film_header">
            <div>
                <p class="sub_head mb-0 aara_section_label">
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                    <span>The Films</span>
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                </p>
                <h2 class="aara_film_title">Set the <em>Scene</em></h2>
            </div>
            <p class="aara_film_hint">Tap to play with sound</p>
        </div>

        <div class="aara_film_grid">
            @foreach ($aara_films as $i => $film)
                <div>
                    <div class="aara_film_media" data-video="{{ $film['video'] }}">
                        <img src="{{ $film['poster'] }}" alt="{{ $film['alt'] }}" loading="lazy">
                        <span class="aara_film_play" role="button" aria-label="Play video">
                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                        </span>
                        <span class="aara_film_duration">{{ $film['duration'] }}</span>
                    </div>
                    <div class="aara_film_caption">
                        <span class="aara_film_num">{{ sprintf('%02d', $i + 1) }}</span>
                        <span class="aara_film_caption_title">{{ $film['title'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.aara_film_media').forEach(function (media) {
            media.addEventListener('click', function () {
                if (media.classList.contains('is-playing')) {
                    return;
                }

                var videoUrl = media.getAttribute('data-video');
                var video = document.createElement('video');
                video.src = videoUrl;
                video.controls = true;
                video.autoplay = true;
                video.playsInline = true;

                var revertToPoster = function () {
                    if (media.contains(video)) {
                        media.removeChild(video);
                    }
                    media.classList.remove('is-playing');
                };

                video.addEventListener('pause', revertToPoster);
                video.addEventListener('ended', revertToPoster);

                media.classList.add('is-playing');
                media.appendChild(video);
                video.play();
            });
        });
    });
</script>

<!-- infinite image gallery strip -->
@php
    $aara_gallery_images = [
        ['src' => asset('public/images/front/diwali/Sovereign Weight.webp'), 'alt' => 'Silver Diwali table objects — HNOWW, Dubai'],
        ['src' => asset('public/images/front/diwali/Aarambh.webp'), 'alt' => 'Gold candle stand with florals — HNOWW x Aara Diwali Edition'],
        ['src' => asset('public/images/front/aara-sec1.webp'), 'alt' => 'Aara Floral Luxury arrangement being styled, Dubai'],
        ['src' => asset('public/images/front/diwali/Signature.webp'), 'alt' => 'HNOWW silver desk object, Diwali gifting Dubai'],
    ];
    $aara_gallery_images = array_merge($aara_gallery_images, $aara_gallery_images);
@endphp
<section class="aara_gallery_strip">
    <div class="aara_gallery_track">
        @for ($i = 0; $i < 2; $i++)
            <div class="aara_gallery_group" @if($i > 0) aria-hidden="true" @endif>
                @foreach ($aara_gallery_images as $img)
                    <img src="{{ $img['src'] }}" alt="{{ $img['alt'] }}" loading="lazy">
                @endforeach
            </div>
        @endfor
    </div>
</section>

<!-- Questions, answered -->
@php
    $aara_faqs = [
        [
            'q' => 'How do I order from the Festive Table edit?',
            'a' => "Tap any \"Order on WhatsApp\" button on this page. Tell us the pieces you'd like, any personalisation, and your delivery date. Our team will confirm availability, pricing and payment directly on WhatsApp, usually within a few hours.",
        ],
        [
            'q' => 'Do you deliver across the UAE before Diwali?',
            'a' => "Yes, we deliver across Dubai and the wider UAE, including Abu Dhabi and Sharjah. Delivery slots fill up closer to the festival, so we recommend ordering early to guarantee arrival before Diwali.",
        ],
        [
            'q' => 'Can I pair any HNOWW piece with Aara florals?',
            'a' => "Most pieces from the edit can be paired with a fresh Aara arrangement composed to match. Let us know which object you've chosen on WhatsApp and the Aara team will style the florals around it, in colours and scale that suit the piece.",
        ],
        [
            'q' => 'Can pieces be personalised or gift-wrapped?',
            'a' => "Yes, personalisation such as names, initials or a short message is available on select pieces, subject to the item and lead time. Gift-wrapping in our signature packaging is included on request at no extra cost.",
        ],
        [
            'q' => 'Do you take corporate Diwali orders?',
            'a' => "Yes, we cater to corporate Diwali gifting in flexible quantities, with options for branding and bulk personalisation. Message us on WhatsApp with your headcount and budget and we'll put together a proposal.",
        ],
    ];
@endphp
<section class="mt_120 mb_120">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-5">
                <p class="sub_head mb-0 aara_section_label">
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                    <span>Before You Order</span>
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                </p>
                <h2 class="aara_faq_title">Questions, <br> <em>answered.</em></h2>
                <p class="aara_faq_para">Still deciding? Message us on WhatsApp and we'll help you compose the table.</p>
                <a href="https://wa.me/971509509274?text=Hi%20I%20have%20a%20question%20about%20the%20HNOWW%20x%20Aara%20Diwali%20Edition" target="_blank" rel="noopener" class="aara_faq_btn">Chat on WhatsApp</a>
            </div>

            <div class="col-lg-7">
                <div class="aara_faq_list">
                    @foreach ($aara_faqs as $faq)
                        <div class="aara_faq_item {{ $loop->first ? 'is-open' : '' }}">
                            <button type="button" class="aara_faq_question">
                                <span>{{ $faq['q'] }}</span>
                                <span class="aara_faq_icon">{!! $loop->first ? '&minus;' : '+' !!}</span>
                            </button>
                            <div class="aara_faq_answer">
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => collect($aara_faqs)->map(function ($faq) {
        return [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    })->values(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var allFaqItems = document.querySelectorAll('.aara_faq_item');

        function closeFaqItem(item) {
            var answer = item.querySelector('.aara_faq_answer');
            item.classList.remove('is-open');
            item.querySelector('.aara_faq_icon').innerHTML = '+';
            answer.style.maxHeight = '0px';
        }

        function openFaqItem(item) {
            var answer = item.querySelector('.aara_faq_answer');
            item.classList.add('is-open');
            item.querySelector('.aara_faq_icon').innerHTML = '&minus;';
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }

        allFaqItems.forEach(function (item) {
            if (item.classList.contains('is-open')) {
                openFaqItem(item);
            }

            var btn = item.querySelector('.aara_faq_question');
            btn.addEventListener('click', function () {
                var willOpen = !item.classList.contains('is-open');

                allFaqItems.forEach(closeFaqItem);

                if (willOpen) {
                    openFaqItem(item);
                }
            });
        });

        window.addEventListener('resize', function () {
            document.querySelectorAll('.aara_faq_item.is-open .aara_faq_answer').forEach(function (answer) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            });
        });
    });
</script>

<!-- Closing CTA -->
<section class="aara_cta">
    <img src="{{ asset('public/images/front/diwali/Lotus Lights.webp') }}" alt="Set your table before Diwali — HNOWW x Aara Floral Luxury, Dubai" loading="lazy">

    <div class="aara_cta_content">
        <div class="aara_cta_logos aara_hero_logos">
            <span class="brand_hnoww">HNOWW</span>
            <span class="brand_x">×</span>
            <span class="brand_aara">aara</span>
        </div>

        <h2 class="aara_cta_title">Set your table<br><em>before Diwali.</em></h2>

        <p class="aara_cta_meta">Order by [Date] &middot; Delivered across Dubai &amp; the UAE</p>

        <div class="aara_cta_btns">
            <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20HNOWW%20x%20Aara%20Diwali%20Edition" target="_blank" rel="noopener" class="aara_cta_btn_solid">Order on WhatsApp <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            <a href="{{ route('front.giftshop') }}" class="com_btn_light">Shop the Edit</a>
        </div>
    </div>
</section>

<!-- Footer -->
@include('layouts.frontfooter')
