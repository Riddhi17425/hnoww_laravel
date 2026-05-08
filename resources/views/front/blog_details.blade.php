@include('layouts.frontheader', [
    'og_image' => asset($blog->detail_image)
])
 @if (isset($blog->blog_faq) && is_countable($blog->blog_faq) && count($blog->blog_faq) > 0)
    @php
        $faqSchemaEntities = [];
        foreach ($blog->blog_faq as $faq) {
            $question = trim($faq['faq_title'] ?? '');
            $answer = trim(strip_tags($faq['faq_description'] ?? ''));
            if ($question && $answer) {
                $faqSchemaEntities[] = [
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $answer,
                    ],
                ];
            }
        }
    @endphp
    @if(!empty($faqSchemaEntities))
        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $faqSchemaEntities,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endif
@endif

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
            <h2 class="title_60">{{$blog->title ?? ''}}</h2>
        </div>

        <div class="mb_35">
            <img class="img-fluid" src="{{ asset('/' . $blog->detail_image) }}"
                alt="images">
        </div>

        <div class="articles_details">
           {!! $blog->detail_description !!}

            <div class="mb_35">
                <div class="articles_cta">
                    <img src="{{ asset('/' . $blog->cta_image) }}" alt="cat image"
                        class="img-fluid">
                    <div class="articles_cta_content">
                        <h3 class="title_40 text-white">{{ $blog->cta_content ?? '' }}</h3>
                        <a href="{{ route('front.contactus') }}" class="btn_2 mt_35">Get In Touch</a>
                    </div>
                </div>
            </div>

            <div class="mb_35">
                <h3 class="title_40 mb-3">Conclusion</h3>
                {!! $blog->conclusion !!}
            </div>

            {{-- <div>
                <h2 class="title_60 mb-4">FAQs</h2>
                <div class="faq_cont">
                    <div class="accordion" id="staticFaqAccordion">

                        <div class="faq_cont_acco border-bottom">
                            <h2 class="according_head sub_head" data-bs-toggle="collapse" data-bs-target="#faq-1"
                                aria-expanded="true">
                                How much do corporate gifts cost in Dubai?
                            </h2>
                            <div id="faq-1" class="accordion-collapse collapse show"
                                data-bs-parent="#staticFaqAccordion">
                                <div class="accordion-body">
                                    Prices vary widely. Promotional gifts may start under AED 50, while luxury corporate
                                    gifts can exceed AED 500 depending on materials and customization.
                                </div>
                            </div>
                        </div>

                        <div class="faq_cont_acco border-bottom">
                            <h2 class="according_head sub_head" data-bs-toggle="collapse" data-bs-target="#faq-2"
                                aria-expanded="false">
                                Can I order customized corporate gifts in bulk?
                            </h2>
                            <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#staticFaqAccordion">
                                <div class="accordion-body">
                                    Yes, many suppliers in Dubai offer bulk ordering with customization options. It’s
                                    best to discuss your specific needs and timelines with the supplier to ensure a
                                    smooth process.

                                </div>
                            </div>
                        </div>

                        <div class="faq_cont_acco border-bottom">
                            <h2 class="according_head sub_head" data-bs-toggle="collapse" data-bs-target="#faq-3"
                                aria-expanded="false">
                                What are popular Ramadan corporate gifts in UAE?
                            </h2>
                            <div id="faq-3" class="accordion-collapse collapse" data-bs-parent="#staticFaqAccordion">
                                <div class="accordion-body">
                                    Popular Ramadan corporate gifts include dates, premium tea sets, personalized prayer
                                    mats, and elegant lanterns. These gifts are chosen for their cultural significance
                                    and ability to convey respect and goodwill during the holy month.

                                </div>
                            </div>
                        </div>

                        <div class="faq_cont_acco border-bottom">
                            <h2 class="according_head sub_head" data-bs-toggle="collapse" data-bs-target="#faq-4"
                                aria-expanded="false">
                                How long does customization take in Dubai?
                            </h2>
                            <div id="faq-4" class="accordion-collapse collapse" data-bs-parent="#staticFaqAccordion">
                                <div class="accordion-body">
                                    Customization timelines can vary based on the complexity of the order and the
                                    supplier’s capabilities. Generally, it can take anywhere from 2 to 6 weeks for
                                    customized corporate gifts, especially if they involve intricate designs or
                                    materials. It’s advisable to plan ahead and communicate your deadlines clearly with
                                    the supplier.

                                </div>
                            </div>
                        </div>

                        <div class="faq_cont_acco border-bottom">
                            <h2 class="according_head sub_head" data-bs-toggle="collapse" data-bs-target="#faq-5"
                                aria-expanded="false">
                                What is the best corporate gift supplying company in Dubai?
                            </h2>
                            <div id="faq-5" class="accordion-collapse collapse" data-bs-parent="#staticFaqAccordion">
                                <div class="accordion-body">
                                    HNoww is a leading corporate gift supplier in Dubai, known for its design-led
                                    approach and high-quality craftsmanship. They specialize in premium and customized
                                    gifts that cater to the sophisticated tastes of Dubai’s business community. With a
                                    focus on intentional gifting and end-to-end solutions, HNoww is a preferred choice
                                    for businesses looking to make a lasting impression through their corporate gifts.

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

            @if (isset($blog->blog_faq) && is_countable($blog->blog_faq) && count($blog->blog_faq) > 0)
            <div>
                <h2 class="title_60 mb-4">FAQs</h2>
                <div class="faq_cont">
                    <div class="accordion" id="staticFaqAccordion">
                        @foreach ($blog->blog_faq as $index => $faq)
                            <div class="faq_cont_acco border-bottom">
                                <h2 class="according_head sub_head" data-bs-toggle="collapse" data-bs-target="#faq-1" aria-expanded="true">
                                    {{ $faq['faq_title'] }}
                                </h2>
                                <div id="faq-{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#staticFaqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq['faq_description'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach  
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

{{-- @if (isset($blogs) && is_countable($blogs) && count($blogs) > 0)
<section class="section-mt">
   <div class="container">
      <div class="row justify-content-center my-lg-5">
         <div class="col-lg-8 text-center">
            <h2 class="main_head head_wrapper">Blogs You may also like</h2>
            <p>Explore more articles</p>
         </div>
      </div>
      <div class="blog_list_slider owl-theme owl-carousel">
         @foreach($blogs as $otherBlog)
         <div class="blogs_card">
            <a href="{{ route('blogs.detail', $otherBlog->url) }}">
            <img src="{{ asset('/'.$otherBlog->front_image) }}" alt="otherBlog" class="img-fluid">
            </a>
            <div class="blogs_card_bt">
               <p>{{ \Carbon\Carbon::parse($otherBlog->date)->format('F j, Y') }}</p>
               <div class="blogs_content">
                  <a href="{{ route('blogs.detail', $otherBlog->url) }}">
                     <h3 class="blogs-title">{{ $otherBlog->title }}</h3>
                  </a>
                  <span>
                  <a class="arrow_circle" href="{{ route('blogs.detail', $otherBlog->url) }}">
                  <img src="{{ asset('public/front/img/arrow.png') }}" alt="arrow" class="img-fluid arrow_icon">
                  </a>
                  </span>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      <!-- Custom Navigation Buttons -->
      <div class="custom-nav">
         <div id="customPrev">                
            <a class="arrow_circle">
            <img src="{{asset('public/front/img/arrow.png')}}" alt="arrow" class="img-fluid arrow_icon" style="transform: scaleX(-1);">
            </a> 
            Previous
         </div>
         <div id="customNext">
            Next
            <a class="arrow_circle">
            <img src="{{asset('public/front/img/arrow.png')}}" alt="arrow" class="img-fluid arrow_icon">
            </a>               
         </div>
      </div>
   </div>
</section>
@endif --}}

@include('layouts.frontfooter')