@include('layouts.frontheader')

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/articles-banner.webp')}}" alt="about us banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Articles</h2>
        <p class="mb-0 para ">Reflections on design, ritual, and the art of intentional living.</p>
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
            <h2 class="title_60">House Journal</h2>
        </div>
        <div class="row gy-4 gy-lg-5">
            @if(isset($blogs) && is_countable($blogs) && count($blogs) > 0)
                @foreach($blogs as $blog)
                    <div class="col-md-4">
                        <div class="collection_box">
                            <a href="{{ route('front.blog.detail', ['url' => $blog->url]) }}"><img class="img-fluid mb-2 mb-md-4"
                                    src="{{ asset('/' . $blog->front_image) }}" alt="{{ $blog->front_image_alt ?? '' }}" loading="lazy"></a>
                            <h3 class="sub_head">{{ $blog->title ?? '' }}</h3>
                            <p class="line-clamp">{!! $blog->short_description ?? '' !!}</p>
                            <a href="{{ route('front.blog.detail', ['url' => $blog->url]) }}" class="com_btn">Explore</a>
                        </div>
                    </div>
                @endforeach
            @endif
            {{-- <div class="col-md-4">
                <div class="collection_box">
                    <a href="{{ route('front.blessings.library') }}"><img class="img-fluid mb-2 mb-md-4"
                            src="{{ asset('public/images/front/articles2.webp') }}" alt="images" loading="lazy"></a>
                    <h3 class="sub_head">The Weight of Malachite : </h3>
                    <p class="line-clamp">Exploring the heritage of this deep green stone, and why we utilize its
                        grounding presence for the modern executive study.</p>
                    <a href="{{ route('front.blessings.library') }}" class="com_btn">Explore</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <a href="{{ route('front.blessings.library') }}"><img class="img-fluid mb-2 mb-md-4"
                            src="{{ asset('public/images/front/articles3.webp') }}" alt="images" loading="lazy"></a>
                    <h3 class="sub_head">The Meaningful Trousseau</h3>
                    <p class="line-clamp">Moving beyond the ephemeral. How to curate a bridal gifting suite that honors
                        the sanctity of the union and becomes a lifelong family heirloom.</p>
                    <a href="{{ route('front.blessings.library') }}" class="com_btn">Explore</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <a href="{{ route('front.blessings.library') }}"><img class="img-fluid mb-2 mb-md-4"
                            src="{{ asset('public/images/front/articles4.webp') }}" alt="images" loading="lazy"></a>
                    <h3 class="sub_head">Smart Minimalism</h3>
                    <p class="line-clamp">The objects we interact with daily shape our thoughts. Discover how
                        introducing weighted, structural forms can ground your routine.</p>
                    <a href="{{ route('front.blessings.library') }}" class="com_btn">Explore</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <a href="{{ route('front.blessings.library') }}"><img class="img-fluid mb-2 mb-md-4"
                            src="{{ asset('public/images/front/articles5.webp') }}" alt="images" loading="lazy"></a>
                    <h3 class="sub_head">The Ritual of the Welcome</h3>
                    <p class="line-clamp">Elevating hospitality through sculptural design. A look at how gathering bowls
                        and offering trays transform a simple greeting into a memorable experience.</p>
                    <a href="{{ route('front.blessings.library') }}" class="com_btn">Explore</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection_box">
                    <a href="{{ route('front.blessings.library') }}"><img class="img-fluid mb-2 mb-md-4"
                            src="{{ asset('public/images/front/articles6.webp') }}" alt="images" loading="lazy"></a>
                    <h3 class="sub_head">Forging Permanence</h3>
                    <p class="line-clamp">A look inside the atelier. How hammered copper, brushed brass, and polished
                        silver are shaped to endure generations.</p>
                    <a href="{{ route('front.blessings.library') }}" class="com_btn">Explore</a>
                </div>
            </div> --}}
        </div>
    </div>
</section>


@include('layouts.frontfooter')