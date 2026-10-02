@include('layouts.frontheader')

<link rel="stylesheet" href="{{ asset('public/front/css/hnoww-aara-diwali.css') }}">

<!-- hero section -->
@php
    $aara_marquee_items = ['Florals that bloom', 'Objects that stay', 'The Diwali Edition', 'Dubai & the UAE'];
    $aara_marquee_items = array_merge($aara_marquee_items, $aara_marquee_items, $aara_marquee_items, $aara_marquee_items);
@endphp
<section class="aara_hero">
    <video class="aara_hero_video" src="{{ asset('public/images/front/Aara/HNoww_Website.mp4') }}" autoplay muted loop playsinline poster="{{ asset('public/images/front/Aara/imageHNoww_Website_poster.webp') }}"></video>

    <div class="aara_hero_vertical">
        <span class="aara_hero_vertical_line"></span>
        <span class="aara_hero_vertical_text">Diwali in Dubai. Set with intention.</span>
        <span class="aara_hero_vertical_line"></span>
    </div>

    <div class="aara_hero_content">
        <div class="aara_hero_logos">
            <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="brand_hnoww_logo">
            <span class="brand_x">×</span>
            <img src="{{ asset('public/images/front/Aara/aara-logo-white.svg') }}" alt="aara" class="brand_aara_logo">
        </div>

        <p class="aara_hero_label">A HNOWW &times; aara collaboration</p>

        <h1 class="aara_hero_title">The Festive Table</h1>

        <p class="aara_hero_para">
            Where what blooms for the evening meets what stays long after.
            For the festive season, HNOWW and aara bring together flowers, objects and the ritual of setting a table.
            A considered setting for Diwali, festive hosting, thoughtful gifting, and evenings that stay with you.
        </p>

        <div class="aara_hero_btns">
            <a href="#festive-table-collection" class="com_btn_light">Shop the Festive Table <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            <!-- <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20HNOWW%20x%20Aara%20Diwali%20Edition" target="_blank" rel="noopener" class="com_btn_light">Order on WhatsApp</a> -->
        </div>
    </div>

    <div class="aara_hero_corner">
        Delivered across the UAE<br>
        <!-- Order by [Date] -->
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
        <div class="row align-items-center gy-0 gy-lg-5">
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
                    Some things belong to the moment. Flowers open, colour a room, and become part of an
                    evening before the season moves on. Others are chosen with the intention to remain.
                    For The Festive Table, aara's seasonal florals meet HNOWW's enduring objects to create a
                    setting where the fleeting and the lasting sit naturally side by side.
                    Because a celebration is not only about what happens that evening. It is about what you
                    choose to bring into it, and what you keep long after.
                </p>

                <div class="aara_collab_brands">
                    <div class="aara_collab_brand">
                        <img src="{{ asset('public/images/front/Hnoww-logo.svg') }}" alt="HNOWW" class="aara_collab_brand_logo">
                        <p class="aara_collab_brand_tag">OBJECTS DESIGNED TO STAY</p>
                        <p class="aara_collab_brand_desc">Architectural objects and luxury gifting, designed in Dubai.</p>
                    </div>
                    <div class="aara_collab_brand aara_collab_brand_aara">
                        <img src="{{ asset('public/images/front/Aara/aara-logo-grey.svg') }}" alt="aara" class="aara_collab_brand_logo aara_collab_brand_logo_aara">
                        <p class="aara_collab_brand_tag">FLORAL LUXURY</p>
                        <p class="aara_collab_brand_desc">Seasonal floral design and bespoke arrangements, crafted in Dubai.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="aara_collab_images">
                    <img class="aara_collab_img_collage" src="{{ asset('public/images/front/Aara/Collage.webp') }}" alt="HNOWW x Aara — florals and objects styled together, Dubai">
                </div>
            </div>
        </div>
    </div>
</section>


<!-- The Festive Table Collection -->
<section class="aara_edit mt_120 mb_120" id="festive-table-collection">
    <div class="container">
        <div class="aara_edit_header">
            <div>
                <p class="sub_head mb-0 aara_section_label">
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                    <span>The Objects Behind the Setting</span>
                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                        </svg>
                    </span>
                </p>
                <h2 class="aara_edit_title">The Festive Table<br><em>Collection</em></h2>
            </div>
            <p class="aara_edit_para">
                Everything you saw in the Reel, brought together in one place.
                Objects selected for the table, but never limited to it.
                Pieces that catch the light, hold a moment, bring something unexpected to a setting, and
                continue to live beautifully long after the celebration is over.
                For Diwali. For festive gatherings. For the years in between.
            </p>
        </div>

        <div class="aara_edit_grid_top">
            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/The Twin Columns.webp') }}" alt="The Twin Columns — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">The Twin Columns</h3>
                        <span class="aara_edit_card_price">AED 750</span>
                    </div>
                    <p class="aara_edit_card_desc">For two candles at two heights.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_grid_top_right">
                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/Aara/4th_collection/Gaj Silver Elephants (set of two).webp') }}" alt="Lotus Bowl — HNOWW Diwali gifting, Dubai" loading="lazy">
                        <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">Gaj Silver Elephants</h3>
                            <span class="aara_edit_card_price">AED 325</span>
                        </div>
                        <p class="aara_edit_card_desc">For good luck, placed facing the door.</p>
                        <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>

                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/Aara/4th_collection/Sandooq Silver Dry Fruit Box.webp') }}" alt="Mehr Candleholder and Vase Duo — HNOWW Diwali gifting, Dubai" loading="lazy">
                        <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">Architectural Silver Jar</h3>
                            <span class="aara_edit_card_price">AED 295</span>
                        </div>
                        <p class="aara_edit_card_desc">For one thing, kept well.</p>
                        <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>

                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/Aara/4th_collection/Tara Silver Serving Tray.webp') }}" alt="Gaj Silver Urli (small) — HNOWW Diwali gifting, Dubai" loading="lazy">
                        <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">Tara Silver Serving Tray</h3>
                            <span class="aara_edit_card_price">AED 575</span>
                        </div>
                        <p class="aara_edit_card_desc">Made to hold the season.</p>
                        <a href="javascript:void(0);"  rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>

                <div class="aara_edit_card">
                    <div class="aara_edit_card_img">
                        <img src="{{ asset('public/images/front/Aara/4th_collection/The Gathering.webp') }}" alt="Tara Silver Serving Tray — HNOWW Diwali gifting, Dubai" loading="lazy">
                        <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                    </div>
                    <div class="aara_edit_card_body">
                        <div class="aara_edit_card_row">
                            <h3 class="aara_edit_card_title">The Gathering</h3>
                            <span class="aara_edit_card_price">AED 850</span>
                        </div>
                        <p class="aara_edit_card_desc">For a centrepiece that holds the fruit.</p>
                        <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="aara_edit_grid_bottom">
            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Gaj Silver Urli (small).webp') }}" alt="Gaj Silver Urli (small) — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Gaj Silver Urli</h3>
                        <span class="aara_edit_card_price">AED 425</span>
                    </div>
                    <p class="aara_edit_card_desc">For water, flame and flowers.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Silver Serving Tongs.webp') }}" alt="Silver Serving Tongs — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Silver Serving Tongs</h3>
                        <span class="aara_edit_card_price">AED 200</span>
                    </div>
                    <p class="aara_edit_card_desc">Service, with a little shine.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Mehr Candleholder and Vase Duo.webp') }}" alt="Mehr Candleholder and Vase Duo — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Mehr Candleholder and Vase Duo</h3>
                        <span class="aara_edit_card_price">AED 575</span>
                    </div>
                    <p class="aara_edit_card_desc">For flowers by day and flame by evening.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>
        </div>

        <div class="aara_edit_grid_extra">
            <p class="aara_edit_extra_label">More from the Edit</p>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Two Tier Dessert Stand.webp') }}" alt="Two Tier Dessert Stand — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Two Tier Dessert Stand</h3>
                        <span class="aara_edit_card_price">AED 300</span>
                    </div>
                    <p class="aara_edit_card_desc">For height where there is no room.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Lotus Bowl.webp') }}" alt="Sandooq Silver Dry Fruit Box — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Lotus Bowl</h3>
                        <span class="aara_edit_card_price">AED 345</span>
                    </div>
                    <p class="aara_edit_card_desc">For a candle, incense or a single flower.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Zoya Silver Serving Tray.webp') }}" alt="Silver Serving Tongs — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Zoya Silver Serving Tray</h3>
                        <span class="aara_edit_card_price">AED 550</span>
                    </div>
                    <p class="aara_edit_card_desc">For sweets, lifted on a low foot.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

            <div class="aara_edit_card">
                <div class="aara_edit_card_img">
                    <img src="{{ asset('public/images/front/Aara/4th_collection/Ganesh Mantra Tealight Holder.webp') }}" alt="The Gathering — HNOWW Diwali gifting, Dubai" loading="lazy">
                    <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="aara_edit_card_badge">
                </div>
                <div class="aara_edit_card_body">
                    <div class="aara_edit_card_row">
                        <h3 class="aara_edit_card_title">Ganesh Mantra Tealight Holder</h3>
                        <span class="aara_edit_card_price">AED 220</span>
                    </div>
                    <p class="aara_edit_card_desc">For a prayer lit from behind.</p>
                    <a href="javascript:void(0);" rel="noopener" class="aara_edit_card_link">Explore More <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
                </div>
            </div>

        </div>

        <div class="aara_edit_footer_cta">
            <a href="javascript:void(0);" class="com_btn">Shop All Pieces <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
        </div>
    </div>
</section>

<!-- The Festive Table Set -->
<section class="aara_pairing">
    <div class="aara_pairing_media">
        <img src="{{ asset('public/images/front/Aara/3rd_tableSet.webp') }}" alt="The Festive Table Set — HNOWW x Aara Diwali gifting, Dubai" loading="lazy">
        <span class="aara_pairing_badge">The Pairing</span>
    </div>

    <div class="aara_pairing_content">
        <p class="sub_head mb-0 aara_section_label">
            <span>
                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                </svg>
            </span>
            <span>The Table, Composed</span>
            <span>
                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                </svg>
            </span>
        </p>
        <h2 class="aara_pairing_title">The Festive <em>Table Set</em></h2>

        <p class="aara_pairing_para">
            A considered selection of HNOWW objects brought together as one complete setting.
            Chosen for the way they catch the light, create balance and make the table feel ready for the evening.
            Use them together for the festivities. Keep them separately for everything that follows.
        </p>

        <div class="aara_pairing_steps">
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">01</span>
                <div>
                    <p class="aara_pairing_step_title">Made for the table</p>
                    <p class="aara_pairing_step_desc">A composed selection designed to work beautifully together.</p>
                </div>
            </div>
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">02</span>
                <div>
                    <p class="aara_pairing_step_title">Chosen to remain</p>
                    <p class="aara_pairing_step_desc">Pieces that continue beyond the season and find their place in your home.</p>
                </div>
            </div>
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">03</span>
                <div>
                    <p class="aara_pairing_step_title">Finished with aara florals</p>
                    <p class="aara_pairing_step_desc">Seasonal blooms bring colour, movement and warmth to the setting.</p>
                </div>
            </div>
            <div class="aara_pairing_step">
                <span class="aara_pairing_step_num">04</span>
                <div>
                    <p class="aara_pairing_step_title">For gifting or gathering</p>
                    <p class="aara_pairing_step_desc">A complete gesture for someone special, or a setting made for your own table.</p>
                </div>
            </div>
        </div>

        <div class="aara_pairing_price_row">
            <span class="aara_pairing_price_label">From</span>
            <span class="aara_pairing_price">AED 650</span>
        </div>

        <div class="aara_pairing_btns">
            <a href="javascript:void(0);" class="com_btn_light">Shop the Set <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20complete%20HNOWW%20x%20Aara%20Festive%20Table%20Set" target="_blank" rel="noopener" class="aara_pairing_link">Enquire about the complete setting</a>
        </div>
    </div>
</section>


<!-- The Films - Set the Scene -->
@php
    $aara_films = [
        [
            'video' => asset('public/reel_videos/aara_flowers.webm'),
            'duration' => '0:45',
            'title' => 'Light the Table',
            'desc' => 'Begin with light. A single flame changes the way silver catches, the way glass reflects, and the way the evening begins to take shape.',
            'alt' => 'Light the Table — HNOWW x Aara Diwali film',
        ],
        [
            'video'  => asset('public/reel_videos/hnoww_aara_diwaliVO.webm'),
            'duration' => '0:[00]',
            'title' => 'Bring in the Florals',
            'desc' => "Then, bring in the flowers. Aara's seasonal arrangements add colour, movement and softness, giving the table its sense of occasion without overwhelming it.",
            'alt' => 'Bring in the Florals — HNOWW x Aara Diwali film',
        ],
        [
            'video'  => asset('public/reel_videos/hnoww_aara_products.webm'),
            'duration' => '0:[00]',
            'title' => 'Place the Objects',
            'desc' => 'Finally, make room for what remains. Layer HNOWW objects among the florals, allowing form, material and light to come together naturally.',
            'alt' => 'Place the Objects — HNOWW x Aara Diwali film',
        ],
        [
            'video'  => asset('public/reel_videos/hnoww_aara-interview.webm'),
            'duration' => '0:[00]',
            'title' => 'Place the Objects',
            'desc' => 'Finally, make room for what remains. Layer HNOWW objects among the florals, allowing form, material and light to come together naturally.',
            'alt' => 'Place the Objects — HNOWW x Aara Diwali film',
        ],
        [
            'video'  => asset('public/reel_videos/hnoww_nandi.webm'),
            'duration' => '0:[00]',
            'title' => 'Place the Objects',
            'desc' => 'Finally, make room for what remains. Layer HNOWW objects among the florals, allowing form, material and light to come together naturally.',
            'alt' => 'Place the Objects — HNOWW x Aara Diwali film',
        ],
        [
            'video'  => asset('public/reel_videos/hnoww_website.webm'),
            'duration' => '0:[00]',
            'title' => 'Place the Objects',
            'desc' => 'Finally, make room for what remains. Layer HNOWW objects among the florals, allowing form, material and light to come together naturally.',
            'alt' => 'Place the Objects — HNOWW x Aara Diwali film',
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
                    <span>The Ritual of Setting</span>
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

        <p class="aara_film_intro">
            The beauty of a table is rarely in how much is placed on it. It is in how everything finds its place.
            Three gestures bring The Festive Table to life.
        </p>

        <div class="aara_film_grid aara_film_slider">
            @foreach ($aara_films as $i => $film)
                <div class="aara_film_slide">
                    <div class="aara_film_media" role="button" tabindex="0" aria-label="Play {{ $film['title'] }} video">
                        <video src="{{ $film['video'] }}" muted loop playsinline preload="none" aria-label="{{ $film['alt'] }}"></video>
                        <span class="aara_film_play" aria-hidden="true">
                            <svg class="aara_icon_play" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                        </span>
                        <!-- <span class="aara_film_duration">{{ $film['duration'] }}</span> -->
                    </div>
                    <div class="aara_film_caption">
                        <span class="aara_film_num">{{ sprintf('%02d', $i + 1) }}</span>
                        <div>
                            <span class="aara_film_caption_title">{{ $film['title'] }}</span>
                            <p class="aara_film_caption_desc">{{ $film['desc'] }}</p>
                            <!-- <span class="aara_film_watch">Watch</span> -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var filmSlider = $('.aara_film_slider');
        if (filmSlider.length && !filmSlider.hasClass('slick-initialized')) {
            filmSlider.slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: false,
                dots: true,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 4000,
                prevArrow: '<button type="button" class="aara_film_arrow aara_film_arrow_prev" aria-label="Previous reels">&#8592;</button>',
                nextArrow: '<button type="button" class="aara_film_arrow aara_film_arrow_next" aria-label="Next reels">&#8594;</button>',
                responsive: [
                    { breakpoint: 992, settings: { slidesToShow: 2 } },
                    { breakpoint: 640, settings: { slidesToShow: 1 } }
                ]
            });
        }

        function positionFilmArrows() {
            var media = filmSlider[0] && filmSlider[0].querySelector('.aara_film_media');
            var prevArrow = filmSlider[0] && filmSlider[0].querySelector('.aara_film_arrow_prev');
            var nextArrow = filmSlider[0] && filmSlider[0].querySelector('.aara_film_arrow_next');
            if (!media || !prevArrow || !nextArrow) return;
            var top = media.offsetHeight / 2;
            prevArrow.style.top = top + 'px';
            nextArrow.style.top = top + 'px';
        }

        positionFilmArrows();
        window.addEventListener('resize', positionFilmArrows);
        window.addEventListener('load', positionFilmArrows);

        function playFilmPreview(video) {
            video.preload = 'metadata';
            video.play().catch(function () {});
        }

        var filmObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                var video = entry.target.querySelector('video');
                if (!video || entry.target.classList.contains('is-playing')) return;
                if (entry.isIntersecting) {
                    playFilmPreview(video);
                } else {
                    video.pause();
                }
            });
        }, { threshold: 0.25 });

        var playIconSvg = '<svg class="aara_icon_play" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>';
        var pauseIconSvg = '<svg viewBox="0 0 24 24"><path d="M6 5h4v14H6zM14 5h4v14h-4z"></path></svg>';

        var allFilmMedia = document.querySelectorAll('.aara_film_media');

        function stopOtherFilms(exceptMedia) {
            allFilmMedia.forEach(function (otherMedia) {
                if (otherMedia === exceptMedia || !otherMedia.classList.contains('is-playing')) return;
                var otherVideo = otherMedia.querySelector('video');
                otherMedia.classList.remove('is-playing');
                otherVideo.loop = true;
                otherVideo.muted = true;
                otherVideo.pause();
                if (otherMedia.getBoundingClientRect().width > 0) playFilmPreview(otherVideo);
                if (otherMedia._updateIcon) otherMedia._updateIcon();
            });
        }

        allFilmMedia.forEach(function (media) {
            var video = media.querySelector('video');
            var playIcon = media.querySelector('.aara_film_play');
            filmObserver.observe(media);

            function updateIcon() {
                var showPause = media.classList.contains('is-playing') && !video.paused;
                playIcon.innerHTML = showPause ? pauseIconSvg : playIconSvg;
            }
            media._updateIcon = updateIcon;

            var lastToggleAt = 0;

            function toggleFilm() {
                var now = Date.now();
                if (now - lastToggleAt < 300) return;
                lastToggleAt = now;

                if (!media.classList.contains('is-playing')) {
                    stopOtherFilms(media);
                    media.classList.add('is-playing');
                    video.loop = false;
                    video.muted = false;
                    video.currentTime = 0;
                    video.play().then(updateIcon).catch(function () {
                        media.classList.remove('is-playing');
                        video.loop = true;
                        video.muted = true;
                        updateIcon();
                    });
                    updateIcon();
                    return;
                }
                if (video.paused) {
                    video.play().then(updateIcon);
                } else {
                    video.pause();
                }
                updateIcon();
            }

            function returnToPreview() {
                media.classList.remove('is-playing');
                video.loop = true;
                video.muted = true;
                if (media.getBoundingClientRect().width > 0) playFilmPreview(video);
                updateIcon();
            }

            media.addEventListener('click', toggleFilm);
            media.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    toggleFilm();
                }
            });
            video.addEventListener('ended', returnToPreview);
            video.addEventListener('play', updateIcon);
            video.addEventListener('pause', updateIcon);
        });
    });
</script>

<!-- infinite image gallery strip -->
@php
    $aara_gallery_products = [
        'Tara Silver Serving Tray',
        'The Gathering',
        'Sandooq Silver Dry Fruit Box',
        'Gaj Silver Elephants (set of two)',
        'Silver Serving Tongs',
        'The Twin Columns',
        'Mehr Candleholder and Vase Duo',
        'Two Tier Dessert Stand',
        'Gaj Silver Urli (small)',
        'Lotus Bowl',
        'Zoya Silver Serving Tray',
        'Ganesh Mantra Tealight Holder',
    ];
    $aara_gallery_images = collect($aara_gallery_products)->map(function ($name) {
        return [
            'src' => asset('public/images/front/Aara/5th_Slider/' . $name . '.webp'),
            'alt' => $name . ' — HNOWW Diwali gifting, Dubai',
        ];
    })->all();
@endphp
<section class="aara_gallery_header mt_120">
    <div class="container">
        <p class="sub_head mb-0 aara_section_label">
            <span>
                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                </svg>
            </span>
            <span>The Art of Gathering</span>
            <span>
                <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                </svg>
            </span>
        </p>
        <h2 class="aara_gallery_title">A table is never just a table.</h2>
        <p class="aara_gallery_body">
            It is where the first light is lit. Where guests arrive and stay a little longer.
            Where something beautiful is passed from one hand to another. And, over time, where certain
            objects become part of the ritual itself.
        </p>
    </div>
</section>

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
            'q' => 'Can I purchase the pieces individually?',
            'a' => 'Yes. HNOWW pieces featured in the campaign are available individually, subject to availability.',
        ],
        [
            'q' => 'Can I purchase the complete Festive Table Set?',
            'a' => 'Yes. The Festive Table Set brings together the selected HNOWW pieces featured in the setting.',
        ],
        [
            'q' => 'Are the flowers available to purchase?',
            'a' => 'The florals shown in the campaign are by aara. For floral availability, bespoke arrangements or festive styling, please enquire with aara.',
        ],
        [
            'q' => 'Can I recreate the table exactly as shown?',
            'a' => 'For a complete setting featuring HNOWW objects and aara florals, please enquire with the team.',
        ],
        [
            'q' => 'Can I order for Diwali?',
            'a' => 'Yes. We recommend placing festive orders in advance to allow time for preparation and delivery.',
        ],
        [
            'q' => 'Do you deliver across Dubai and the UAE?',
            'a' => 'HNOWW offers delivery across Dubai and the wider UAE. Delivery timelines vary by product and order.',
        ],
        [
            'q' => 'Can I gift individual HNOWW pieces?',
            'a' => 'Yes. A piece can be chosen for the table, for the home, or simply because it feels right for the person receiving it.',
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
                <p class="aara_faq_para">A few things worth knowing before bringing The Festive Table home.</p>
               <div class="text-center text-lg-start"><a href="https://wa.me/971509509274?text=Hi%20I%20have%20a%20question%20about%20the%20HNOWW%20x%20Aara%20Diwali%20Edition" target="_blank" rel="noopener" class="aara_faq_btn">Chat on WhatsApp</a></div>
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
    <img src="{{ asset('public/images/front/Aara/CTA.webp') }}" alt="Set your table before Diwali — HNOWW x Aara Floral Luxury, Dubai" loading="lazy">

    <div class="aara_cta_content">
        <div class="aara_cta_logos aara_hero_logos">
            <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="brand_hnoww_logo">
            <span class="brand_x">×</span>
            <img src="{{ asset('public/images/front/Aara/aara-logo-white.svg') }}" alt="aara" class="brand_aara_logo">
        </div>

        <p class="aara_cta_eyebrow">The Festive Season</p>

        <h2 class="aara_cta_title">Set your table<br><em>before Diwali.</em></h2>

        <p class="aara_cta_meta">
            Beautiful things make an occasion. The right things make it yours.
            Discover HNOWW objects and aara florals, brought together for festive tables, thoughtful gifting
            and evenings worth remembering.
        </p>

        <div class="aara_cta_btns">
            <a href="#festive-table-collection" class="aara_cta_btn_solid">Shop the Festive Table <span class="btn_arrow"><svg viewBox="0 0 24 10" width="18" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.5 5H23M23 5L17 1M23 5L17 9" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            <a href="https://wa.me/971509509274?text=Hi%20I%20am%20interested%20in%20the%20complete%20HNOWW%20x%20Aara%20Festive%20Table%20Set" target="_blank" rel="noopener" class="com_btn_light">Enquire About the Complete Setting</a>
        </div>
    </div>
</section>

<!-- Footer -->
@include('layouts.frontfooter')
