@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/for-him-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">{{$category ? $category->category_name : '' }}</h2>
        <p class="sub_heads sec_in_mb">{{$category ? $category->title : '' }}</p>
        <p class="para mb-0">{{$category ? $category->description : '' }}</p>
    </div>
</section>

@if(isset($from)&& $from != null && strtolower($from) == 'worlds')
<section class="about">
    <div class="container">
        <div class="magic_wrapper">
            <h2 class="magic_head_phone" data-aos="fade-left" data-aos-delay="0" data-aos-duration="800"
                data-aos-once="true">
                @if(isset($category->magic_heading_first)){{$category->magic_heading_first}}@else Intention drives beauty. @endif @if(isset($category->magic_heading_second)){{$category->magic_heading_second}}@else Designs, guided by intent @endif
            </h2>
            <!-- 3️⃣ Left image (from left) -->
            <div class="text-end magic_wrapper_logo" data-aos="fade-right" data-aos-delay="600" data-aos-duration="800"
                data-aos-once="true">
                <img src="{{ asset('public/front/images/home_magic_left.svg') }}" loading="lazy" alt="" class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div data-aos="zoom-in" data-aos-delay="400" data-aos-duration="800" data-aos-once="true">
                {{-- Need to make dynamic --}}
                <img src="{{ asset('public/front/images/home_magic.png') }}" loading="lazy" alt="" class="img-fluid">
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div data-aos="fade-left" data-aos-delay="800" data-aos-duration="800"  data-aos-once="true">
                <h3 class="magic_wrapper_h3">@if(isset($category->magic_title)){{$category->magic_title}}@endif</h3>
                <p>
                    @if(isset($category->magic_description)){{$category->magic_description}} @endif
                </p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1" data-aos="fade-left" data-aos-delay="0" data-aos-duration="800"
                data-aos-once="true">
                @if(isset($category->magic_heading_first)){{$category->magic_heading_first}}@endif
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2" data-aos="fade-left" data-aos-delay="1000" data-aos-duration="800"
                data-aos-once="true">@if(isset($category->magic_heading_second)){{$category->magic_heading_second}}@endif
            </h2>

        </div>
    </div>
</section>
@endif

<section class="mt_60">
    <div class="container">
        <div class="him_wrapper">
            @if(isset($catProducts) && is_countable($catProducts) && count($catProducts))
                @foreach($catProducts as $key => $val)
                    <div class="him_prod">
                        <div class="him_prod_top mb-2 mb-md-4">
                            {{-- <img class="img-fluid img_1" src="{{ asset('public/images/front/desire1.png')}}" alt="him_prod"> --}}
                            <img class="img-fluid img_1" src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}" alt="{{ $val->product_name ?? 'Product Image' }}">
                        </div>
                            <div>
                                <h3 class="sub_head">{{ $val->product_name ?? '' }}</h3>
                                <p class>{!! $val->short_description ?? '' !!}</p>
                            </div>
                        <div>
                            <a href="{{ route('front.product.details', $val->product_url) }}" class="com_btn">VIEW OBJECT </a>
                        </div>
                    </div>
                @endforeach
            @endif
            {{-- <div class="him_prod">
                <div class="him_prod_top  mb-2 mb-md-4">
                    <img class="img-fluid img_1" src="{{ asset('public/images/front/desire2.png')}}" alt="him_prod">
                </div>
              
                    <div>
                        <h3 class="sub_head">The Oculus (Solo)</h3>
                        <p>A compact ritual centerpiece for intimate hosting.</p>
                    </div>
               
                <div>
                    <a href="product-details.php" class="com_btn">VIEW OBJECT </a>
                </div>
            </div>
            <div class="him_prod">
                <div class="him_prod_top mb-2 mb-md-4">
                    <img class="img-fluid img_1" src="{{ asset('public/images/front/desire3.png')}}" alt="him_prod">
                </div>
                    <div>
                        <h3 class="sub_head">The Hybrid Totem</h3>
                        <p> A travertine + brass totem for sound and stillness.</p>
                    </div>
              
                <div>
                    <a href="product-details.php" class="com_btn">VIEW OBJECT </a>
                </div>
            </div>
            <div class="him_prod">
                <div class="him_prod_top mb-2 mb-md-4">
                    <img class="img-fluid img_1" src="{{ asset('public/images/front/desire4.png')}}" alt="him_prod">
                </div>
                    <div>
                        <h3 class="sub_head">The Wireless Courtyard</h3>
                        <p>A travertine charging stone — technology, grounded.</p>
                    </div>
               
                <div>
                    <a href="product-details.php" class="com_btn">VIEW OBJECT </a>
                </div>
            </div> --}}
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
                    <span>
                        @if(isset($catSlug) && $catSlug != null)
                            @if(strtolower($catSlug) == 'for-home')
                            Craft Your Majlis.
                            @endif
                            @if(strtolower($catSlug) == 'for-her')
                            Objects chosen with care, designed to be lived with.
                            @endif
                            @if(strtolower($catSlug) == 'for-him')
                            Build His Ritual.
                            @endif
                        @endif
                    </span>
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
                <a href="javascript:void(0);" class="btn_2">SHOP GIFTS {{$category ? $category->category_name : '' }}</a>   
            </div>
        </div>
    </div>
</section>
@include('layouts.frontfooter')