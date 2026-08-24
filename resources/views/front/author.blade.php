@include('layouts.frontheader')

<style>
    .theme-green .header-scrolled {
        background: #EDEAE4;
    }

    .theme-green .language-select .dropdown-input-lan {
        color: #0e2233;
    }

    @media (max-width:767px) {
        .sticky-header {
           
        }
    }
</style>

<section class="author-dark-section">
    <div class="container">
        <div class="row align-items-center mt-5 pt-5">
            <div class="col-lg-7 col-md-12 author-text-col">
                <h2 class="author-name">Salomi Kotecha</h2>
                <div class="author-subtitle">
                    <span>Founder of HNOWW</span>
                    <span class="divider">|</span>
                    <span>Objects, Rituals and the Art of Giving</span>
                    <span class="divider">|</span>
                    <a href="https://www.linkedin.com/in/salomi-kotecha-93b9a6131/" target="_blank" class="linkedin-link">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                        </svg>
                        LinkedIn
                    </a>
                </div>
                <p class="author-desc-text">
                    Salomi Kotecha is the founder of HNOWW, a Dubai-based design house creating objects designed to stay. After more than a decade working across fashion, design and material culture, she founded HNOWW to explore how objects shape the way we give, gather and remember. She writes about considered gifting, modern rituals, craftsmanship, hospitality and the stories that give objects permanence.
                </p>
            </div>
            <div class="col-lg-5 col-md-12 author-img-col">
                <div class="author-img-wrapper">
                    <img src="{{ asset('public/images/front/salomi-kotecha.webp') }}" class="img-fluid w-100" alt="Salomi Kotecha, founder of HNOWW">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mt_80">
    <div class="container">
        <div class="row gy-4 gy-lg-5">
            @if (isset($blogs) && is_countable($blogs) && count($blogs) > 0)
                @foreach ($blogs as $blog)
                    <div class="col-md-4">
                        <div class="collection_box">
                            <a href="{{ route('front.blog.detail', ['url' => $blog->url]) }}">
                                <img class="img-fluid mb-md-4 mb-2" src="{{ asset('/' . $blog->front_image) }}"
                                    alt="{{ $blog->front_image_alt ?? '' }}" loading="lazy">
                                <h3 class="sub_head">{{ $blog->title ?? '' }}</h3>
                            </a>
                            <p class="line-clamp">{!! $blog->short_description ?? '' !!}</p>
                            <a href="{{ route('front.blog.detail', ['url' => $blog->url]) }}" class="com_btn">Read
                                More</a>
                        </div>
                    </div>
                @endforeach
            @endif
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
                                fill="url(#paint0_linear_32_115)"></path>
                            <defs>
                                <linearGradient id="paint0_linear_32_115" x1="145.333" y1="5.83325" x2="5.33325"
                                    y2="5.83325" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#F8F7F3" stop-opacity="0"></stop>
                                    <stop offset="1" stop-color="#F8F7F3"></stop>
                                </linearGradient>
                            </defs>
                        </svg>

                    </span>
                    <span>
                        Objects chosen with care, designed to be lived with.
                    </span>
                    <span>
                        <svg width="146" height="11" viewBox="0 0 146 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M134.667 5.33325C134.667 8.27877 137.054 10.6666 140 10.6666C142.946 10.6666 145.333 8.27877 145.333 5.33325C145.333 2.38773 142.946 -8.13802e-05 140 -8.13802e-05C137.054 -8.13802e-05 134.667 2.38773 134.667 5.33325ZM0 5.33325L0 6.33325L140 6.33325V5.33325V4.33325L0 4.33325L0 5.33325Z"
                                fill="url(#paint0_linear_32_114)"></path>
                            <defs>
                                <linearGradient id="paint0_linear_32_114" x1="0" y1="5.83325" x2="140"
                                    y2="5.83325" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#F8F7F3" stop-opacity="0"></stop>
                                    <stop offset="1" stop-color="#F8F7F3"></stop>
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                </p>
            </div>
            <!-- <div>
                <a href="#" class="com_btn border-white text-white">Shop Gifts For Him</a>
            </div> -->
        </div>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Person",
  "name": "Salomi Kotecha",
  "url": "https://hnoww.com/author/salomi-kotecha",
  "image": "https://hnoww.com/public/images/front/salomi-kotecha.webp",
  "sameAs": "https://www.linkedin.com/in/salomi-kotecha-93b9a6131/",
  "jobTitle": "Founder",
  "worksFor": {
    "@type": "Organization",
    "name": "HNOWW"
  }  
}    
</script>

@include('layouts.frontfooter')
