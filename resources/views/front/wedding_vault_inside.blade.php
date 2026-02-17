@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/wedding_vault.png')}}" alt="him banner">

    <div class="hero_content_inner w-100">
        <div class="container">
            <h2 class="main_head mb-3"> HNoww Wedding Concierge</h2>
            <p class="sub_heads sec_in_mb"> Ceremonial wedding and anniversary gifts, sculptural heirlooms, and bespoke gifting for the modern union.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3 gap-md-4">
                <a href="#" class="com_btn border-white bg-white" data-bs-toggle="modal" data-bs-target="#requestWeddingCatalogue">Book a Wedding Gifting Consultation</a>
                {{-- <a href="#" class="com_btn border-white bg-white">Book a Wedding Gifting Consultation</a>
                <a href="#" class="com_btn border-white bg-transparent text-white"> Download Wedding Vault Lookbook
                    (PDF)</a> --}}
            </div>
        </div>
    </div>
</section>

<section class="mt_60 request_catalogue_para">
    <div class="container">
        <p class="sub_head text-center" style="color:#666666;">At HNoww, weddings are treated as living archives of a family’s story.
        The Wedding Vault is a private collection of ceremonial objects, malachite signatures, and bespoke luxury hampers in Dubai curated for brides, grooms, and planners who want every ritual, every favour, and every wedding or anniversay gift to feel intentional and unforgettable.
We work with limited quantities and high-touch customization. 
Everything you see here is curated to be photographed, kept, and passed on.
        </p>
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
                <span>Inside</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">The Wedding Vault</h2>
            <P> Explore the luxury gift hampers in Dubai or scroll to view everything to pick the best anniversary gift</P>
        </div>
        <div class="row gy-4 g-md-5">
            @if(isset($weddingProduct) && is_countable($weddingProduct) && count($weddingProduct) > 0)
                @foreach($weddingProduct as $key => $val)
                    <div class="col-md-4">
                        <div class="curated_rituals_box">
                            <div>
                                <img class="w-100 mb-2 mb-md-4" src="{{ asset('public/images/admin/product_list/'.$val->list_page_img) }}" alt="{{ $val->product_name ?? 'Product Image' }}">
                            </div>
                            <div class="desire_box_bot_child">
                                <div>
                                    <h3 class="sub_head">{{ $val->product_name ?? '' }} </h3>
                                    <p>{!! $val->short_description ?? '' !!}</p>
                                </div>
                                <a href="{{ route('front.product.details', $val->product_url) }}">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                        <path d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                            stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                            {{-- <div> --}}
                                {{-- <a href="{{ route('front.product.details', $val->product_url) }}" class="com_btn">VIEW Details </a> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- <div class="col-md-4">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/wedding-vault2.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Desk Ceremony Set </h3>
                            <p class="mb-0">Frames & heirlooms for moments that matter.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/wedding-vault3.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Modern Majlis Set </h3>
                            <p class="mb-0">Modern gestures under AED 500.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/wedding-vault4.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Everyday Sacred</h3>
                            <p class="mb-0">Light. Scent. Stillness.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/wedding-vault5.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Everyday Sacred</h3>
                            <p class="mb-0">Light. Scent. Stillness.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/wedding-vault6.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Everyday Sacred</h3>
                            <p class="mb-0">Light. Scent. Stillness.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="curated_rituals_box">
                    <img class="w-100 mb-2 mb-md-4" src="{{asset('public/images/front/wedding-vault7.png')}}" alt="images">
                    <div class="box_bot">
                        <div>
                            <h3 class="sub_head">The Everyday Sacred</h3>
                            <p class="mb-0">Light. Scent. Stillness.</p>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                <span>See</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">How the Wedding Vault Works</h2>
        </div>

        <div class="wedding_box_main">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="wedding_box">
                        <h3 class="wedding_box_head">01</h3>
                        <h5 class="sub_head mb-3">Discovery Call</h5>
                        <p class="mb-0">Share your wedding dates, venues,
                            guest profiles, and budget bands. We
                            recommend a mix of wedding anniversaries and gifts, premium gift hampers,
                            and favours for the ocassion.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="wedding_box">
                        <h3 class="wedding_box_head">02</h3>
                        <h5 class="sub_head mb-3">Curated Proposal</h5>
                        <p class="mb-0">You receive a PDF proposal with wedding and anniversary gifts, colour palettes, and
                                preliminary costings, including premium gift hampers
                                for different segments (family, friends,
                                VIPs).</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="wedding_box">
                        <h3 class="wedding_box_head">03</h3>
                        <h5 class="sub_head mb-3">Final Selection & Customization</h5>
                        <p class="mb-0">Together, we refine quantities,
                            personalization, packaging details, and
                            blessing scroll copy. Once approved,
                            production of the luxury wedding gifts begins.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="wedding_box">
                        <h3 class="wedding_box_head">04</h3>
                        <h5 class="sub_head mb-3">Production & Delivery</h5>
                        <p class="mb-0">We execute all orders, coordinate
                            timelines, and deliver ready-to-present wedding & anniversary gifts and
                            luxury gift hampers in Dubai. For Dubai
                            weddings, on-ground coordination can
                            be discussed.</p>
                    </div>
                </div>
            </div>

            <img class="wedding_box_line" src="{{asset('public/images/front/line_bg_wedding.svg')}}" alt="line">

        </div>
    </div>
</section>


<section class="wedding_gifting mt_80">
    <div class="container">
        <div class="section_header mb-0">
            <p class="sub_head mb-0  text-white">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="63" height="6" viewBox="0 0 63 6" fill="none">
                        <path
                            d="M-0.000651042 2.66675C-0.000651042 4.13951 1.19326 5.33341 2.66602 5.33341C4.13877 5.33341 5.33268 4.13951 5.33268 2.66675C5.33268 1.19399 4.13877 8.13802e-05 2.66602 8.13802e-05C1.19326 8.13802e-05 -0.000651042 1.19399 -0.000651042 2.66675ZM2.66602 2.66675V3.16675H62.666V2.66675V2.16675H2.66602V2.66675Z"
                            fill="#F8F7F3" />
                    </svg>
                </span>
                <span>Ready to</span>
                <span><svg xmlns="http://www.w3.org/2000/svg" width="63" height="6" viewBox="0 0 63 6" fill="none">
                        <path
                            d="M57.3333 2.66675C57.3333 4.13951 58.5272 5.33341 60 5.33341C61.4728 5.33341 62.6667 4.13951 62.6667 2.66675C62.6667 1.19399 61.4728 8.13802e-05 60 8.13802e-05C58.5272 8.13802e-05 57.3333 1.19399 57.3333 2.66675ZM0 2.66675V3.16675H60V2.66675V2.16675H0V2.66675Z"
                            fill="#F8F7F3" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60 text-white mb-4">Curate Your Wedding Gifting?</h2>
            <p class="sec_in_mb text-white">Whether you are a bride, groom, or planner, the HNoww Wedding Concierge is your partner in creating the best wedding gift,<br> that feels as close as the ceremony itself.</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 gap-md-4 mb-3 mb-md-4">
                {{-- <a href="#" class="com_btn border-white bg-white">Book a Wedding Gifting Consultation</a>
                <a href="#" class="com_btn border-white bg-transparent text-white"> Email the H Noww Wedding
                    Concierge</a> --}}
                <a href="#" class="com_btn border-white bg-transparent text-white" data-bs-toggle="modal" data-bs-target="#requestWeddingCatalogue"> Book a Wedding Gifting Consultation</a>
            </div>

            <p class="text-white mb-0"><i>HNoww Wedding Concierge — Ceremonial objects, sculptural heirlooms, and bespoke gifting for the modern union.</i></p>
        </div>
    </div>

    <svg class="wedding_svg1" xmlns="http://www.w3.org/2000/svg" width="305" height="386" viewBox="0 0 305 386"
        fill="none">
        <g style="mix-blend-mode:soft-light" opacity="0.2">
            <path
                d="M304.087 270.209C304.087 195.982 245.346 135.461 171.919 132.168C168.715 58.7412 108.016 0 33.8774 0C-40.2611 0 -100.96 58.7412 -104.164 132.168C-177.502 135.372 -236.332 195.893 -236.332 270.209C-236.332 344.526 -177.502 404.958 -104.164 408.251C-100.871 481.678 -40.2611 540.419 33.8774 540.419C108.016 540.419 168.626 481.589 171.919 408.251C245.346 405.047 304.087 344.348 304.087 270.209ZM282.014 259.529H172.186V153.706C230.037 156.821 276.852 202.212 282.014 259.529ZM150.737 387.158H44.5576V359.478C48.1177 346.395 55.7719 327.616 72.4152 310.616C89.8595 292.816 109.262 284.806 122.879 281.068H150.559V387.069H150.648L150.737 387.158ZM-83.1599 280.89H-55.3024C-42.3082 284.094 -23.6177 291.392 -6.70739 307.679C12.517 326.192 20.0821 347.463 23.0192 359.211V386.98H-83.0709V280.801H-83.1599V280.89ZM-83.1599 153.261H22.9302V181.297C20.3492 194.024 14.208 212.358 -1.27827 229.18C-20.2357 249.739 -42.8421 256.948 -55.2133 259.44H-83.3379V153.172H-83.249L-83.1599 153.261ZM34.0554 327.349C28.3593 315.956 20.0821 303.674 8.24485 292.193C-1.63435 282.67 -11.9585 275.728 -21.7487 270.743C-9.82247 264.958 2.99384 256.414 14.7421 243.687C23.8203 233.808 30.3173 223.483 34.8564 213.604C41.0866 225.264 49.9867 237.813 62.536 249.294C71.2582 257.393 81.2263 264.335 91.8175 269.853C80.5143 275.639 68.3212 283.738 57.0179 295.397C46.8717 305.988 39.3956 317.024 34.0554 327.349ZM123.146 259.529C110.953 255.969 93.4196 248.582 77.2212 233.719C57.9078 215.918 48.9186 195.448 44.6465 181.03V153.439H150.826V259.618H123.146V259.529ZM150.381 131.901H44.5576V22.0724C101.786 27.2345 147.266 74.0495 150.381 131.901ZM23.1081 22.0724V131.901H-82.715C-79.5999 74.0495 -34.209 27.2345 23.1081 22.0724ZM-104.52 153.617V259.44H-214.349C-209.186 202.212 -162.372 156.821 -104.52 153.617ZM-214.349 280.89H-104.52V386.713C-162.372 383.598 -209.186 338.207 -214.349 280.89ZM-82.8039 408.518H23.0192V518.346C-34.12 513.184 -79.5109 466.369 -82.8039 408.518ZM44.5576 518.346V408.518H150.381C147.266 466.369 101.875 513.095 44.5576 518.346ZM172.186 386.713V280.89H282.014C276.852 338.207 230.037 383.598 172.186 386.713Z"
                fill="white" />
        </g>
    </svg>

    <svg class="wedding_svg2" xmlns="http://www.w3.org/2000/svg" width="407" height="196" viewBox="0 0 407 196"
        fill="none">
        <g style="mix-blend-mode:soft-light" opacity="0.2">
            <path
                d="M540.419 -74.8487C540.419 -149.076 481.678 -209.597 408.251 -212.89C405.047 -286.317 344.348 -345.058 270.209 -345.058C196.071 -345.058 135.372 -286.317 132.168 -212.89C58.8302 -209.686 0 -149.165 0 -74.8487C0 -0.532171 58.8302 59.9 132.168 63.1931C135.461 136.62 196.071 195.361 270.209 195.361C344.348 195.361 404.958 136.531 408.251 63.1931C481.678 59.989 540.419 -0.710179 540.419 -74.8487ZM518.346 -85.5289H408.518V-191.352C466.369 -188.237 513.184 -142.846 518.346 -85.5289ZM387.069 42.0997H280.89V14.4201C284.45 1.33685 292.104 -17.4425 308.747 -34.4418C326.192 -52.2422 345.594 -60.2524 359.211 -63.9905H386.891V42.0107H386.98L387.069 42.0997ZM153.172 -64.1685H181.03C194.024 -60.9644 212.714 -53.6663 229.625 -37.3789C248.849 -18.8666 256.414 2.40488 259.351 14.1531V41.9217H153.261V-64.2575H153.172V-64.1685ZM153.172 -191.797H259.262V-163.761C256.681 -151.034 250.54 -132.7 235.054 -115.878C216.096 -95.3191 193.49 -88.1099 181.119 -85.6179H152.994V-191.886H153.083L153.172 -191.797ZM270.387 -17.7095C264.691 -29.1018 256.414 -41.384 244.577 -52.8652C234.698 -62.3884 224.374 -69.3306 214.583 -74.3147C226.51 -80.0998 239.326 -88.644 251.074 -101.371C260.152 -111.25 266.649 -121.575 271.188 -131.454C277.419 -119.795 286.319 -107.245 298.868 -95.7641C307.59 -87.6649 317.558 -80.7228 328.15 -75.2047C316.846 -69.4196 304.653 -61.3204 293.35 -49.6612C283.204 -39.07 275.728 -28.0337 270.387 -17.7095ZM359.478 -85.5289C347.285 -89.089 329.752 -96.4761 313.553 -111.339C294.24 -129.14 285.251 -149.61 280.979 -164.028V-191.619H387.158V-85.4399H359.478V-85.5289ZM386.713 -213.157H280.89V-322.986C338.118 -317.824 383.598 -271.009 386.713 -213.157ZM259.44 -322.986V-213.157H153.617C156.732 -271.009 202.123 -317.824 259.44 -322.986ZM131.812 -191.441V-85.6179H21.9835C27.1456 -142.846 73.9605 -188.237 131.812 -191.441ZM21.9835 -64.1685H131.812V41.6547C73.9605 38.5396 27.1456 -6.85131 21.9835 -64.1685ZM153.528 63.4601H259.351V173.288C202.212 168.126 156.821 121.311 153.528 63.4601ZM280.89 173.288V63.4601H386.713C383.598 121.311 338.207 168.037 280.89 173.288ZM408.518 41.6547V-64.1685H518.346C513.184 -6.85131 466.369 38.5396 408.518 41.6547Z"
                fill="white" />
        </g>
    </svg>
</section>
@include('front.wedding_request_modal')
@include('layouts.frontfooter')