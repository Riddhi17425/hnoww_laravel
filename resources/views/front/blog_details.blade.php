@php
    //echo "<pre>"; print_r($blog->blog_faq); die;
@endphp

@include('layouts.frontheader', [
    'og_image' => asset($blog->og_image),
    'blog_schema' => $blog->blog_schema ?? ''
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
            <h1 class="title_60">{{$blog->title ?? ''}}</h1>
            <p>Published {{ $blog->date ? \Carbon\Carbon::parse($blog->date)->format('F d, Y') : '' }}</p>
        </div>

        <div class="mb_35">
            <img class="img-fluid" src="{{ asset('/' . $blog->detail_image) }}"
                alt="{{ $blog->detail_image_alt ?? '' }}">
        </div>

        <div class="row gx-lg-4">
            <!-- Left Sidebar -->
            <aside class="col-lg-3 d-none d-lg-block">
                <div class="sidebar-container">
                    <p class="title_24 mb-4 sidebar-title">CONTENTS</p>
                    <ul id="dynamic-sidebar" class="list-unstyled pe-2">
                        <!-- Links will be generated here dynamically via JS -->
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="col-12 col-lg-6 articles_details content">
           {!! $blog->detail_description !!}

            <div class="mb_35">
                <div class="articles_cta">
                    <a href="{{$blog->cta_link ?? '#'}}" target="_blank"><img src="{{ asset('/' . $blog->cta_image) }}" alt="{{$blog->cta_image_alt ?? ''}}"
                        class="img-fluid" alt="{{ $blog->cta_image_alt ?? '' }} "></a>
                    <div class="articles_cta_content">
                        {{--<h3 class="text-white">{!! $blog->cta_content ?? '' !!}</h3>
                         <a href="{{ route('front.contactus') }}" class="btn_2 mt_35">Get In Touch</a> --}}
                    </div>
                </div>
            </div>

            <div class="mb_35">
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

            <!-- Author Section (Blitz Style) -->
            <div class="author-section mb-5 mt-5">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center mb-3 mb-md-0">
                        <img src="{{ asset('public/images/front/hnoww-women.webp') }}" alt="Salomi Kotecha" class="img-fluid rounded-circle author-img">
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex align-items-center mb-2">
                            <h4 class="mb-0 author-name">Salomi Kotecha</h4>
                            <a href="#" class="ms-3 text-decoration-none" title="LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#0077b5"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </div>
                        <p class="mb-3 author-subtitle">
                            Founder of HNoww <span class="mx-2 text-muted">|</span> Crafting Meaningful Stories Through Objects
                        </p>
                    </div>
                </div>
                <p class="mb-0 author-desc">
                    Salomi Kotecha is the founder of HNOWW, a Dubai-based design house creating objects designed to stay. After more than a decade in fashion and design, she founded HNOWW to explore how craftsmanship, material and meaningful design shape the way we gift, gather and remember. She writes about design, gifting, hosting and the stories behind objects that become part of everyday life.
                </p>
            </div>

            @if (isset($blog->blog_faq) && is_countable($blog->blog_faq) && count($blog->blog_faq) > 0)
            <div>
                <h2 class="title_60 mb-4 text-center"  style="color: #c7b58c;">FAQs</h2>
            
                <div class="faq_cont">
                    <div class="accordion" id="staticFaqAccordion">
            
                        @foreach ($blog->blog_faq as $index => $faq)
            
                            <div class="faq_cont_acco border-bottom">
            
                                <h3
                                    class="according_head sub_head"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq-{{ $index }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                >
                                    {{ $faq['faq_title'] ?? '' }}
                                </h3>
            
                                <div
                                    id="faq-{{ $index }}"
                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                    data-bs-parent="#staticFaqAccordion"
                                >
                                    <div class="accordion-body">
                                        {!! $faq['faq_description'] ?? '' !!}
                                    </div>
                                </div>
            
                            </div>
            
                        @endforeach
            
                    </div>

                </div>
            </div>
        @endif
            </div> <!-- Close Main Content -->

            <!-- Right Sidebar -->
            <aside class="col-lg-3 d-none d-lg-block">
                <div class="sidebar-container">
                    <!-- Blessings Library Promotional Section -->
                    <div class="blessings-promo">
                        <!-- Auto-sliding Content Carousel -->
                        <div id="blessingsPromoCarousel" class="carousel slide carousel-fade pb-4" data-bs-ride="carousel" data-bs-interval="5000">
                            <div class="carousel-inner">
                                <!-- Slide 1 -->
                                <div class="carousel-item active">
                                    <img src="{{ asset('public/images/front/blessing-library2.webp') }}" alt="Sandhya" class="img-fluid mb-3 promo-img" style="border-radius: 8px;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h4 class="sidebar-title mb-0 promo-title">Sandhya</h4>
                                        <img src="{{ asset('public/images/front/volume.svg') }}" alt="Audio" width="20">
                                    </div>
                                    <p class="mb-2" style="font-size: 13px; color: #666; font-weight: 500;">Between Day and Night</p>
                                    <p class="mb-3 promo-desc">A blessing for the in-between. Where presence is enough, and stillness holds.</p>
                                    
                                    <!-- Audio Player Fake UI / Carousel Controls -->
                                    <div class="d-flex align-items-center mb-3">
                                        <span style="font-size: 11px; color: #666;">0:00</span>
                                        <div class="flex-grow-1 mx-2" style="height: 3px; background: #e0dcd3; position: relative; border-radius: 2px;">
                                            <div style="width: 30%; height: 100%; background: #c7b58c; border-radius: 2px;"></div>
                                        </div>
                                        <span style="font-size: 11px; color: #666;">-0:00</span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mb-4 gap-4">
                                        <span style="cursor: pointer; color: #333;" data-bs-target="#blessingsPromoCarousel" data-bs-slide="prev">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M11 18V6l-8.5 6 8.5 6zm.5-6l8.5 6V6l-8.5 6z"/></svg>
                                        </span>
                                        <span style="cursor: pointer; background: #c7b58c; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                                        </span>
                                        <span style="cursor: pointer; color: #333;" data-bs-target="#blessingsPromoCarousel" data-bs-slide="next">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M4 18l8.5-6L4 6v12zm9-12v12l8.5-6L13 6z"/></svg>
                                        </span>
                                    </div>

                                    <a href="{{ route('front.blessings.library') }}" class="com_btn w-100 text-center mb-3" >GIFT THIS BLESSING</a>
                                    <div class="text-center">
                                        <a href="#" style="font-size: 14px; color: #c7b58c; text-decoration: none;">Share this <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ms-1"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg></a>
                                    </div>
                                </div>

                                <!-- Slide 2 -->
                                <div class="carousel-item">
                                    <img src="{{ asset('public/images/front/blessing-library3.webp') }}" alt="Sandhya" class="img-fluid mb-3 promo-img" style="border-radius: 8px;">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h4 class="sidebar-title mb-0 promo-title">Sandhya2</h4>
                                        <img src="{{ asset('public/images/front/volume.svg') }}" alt="Audio" width="20">
                                    </div>
                                    <p class="mb-2" style="font-size: 13px; color: #666; font-weight: 500;">Between Day and Night</p>
                                    <p class="mb-3 promo-desc">A blessing for the in-between. Where presence is enough, and stillness holds.</p>
                                    
                                    <!-- Audio Player Fake UI / Carousel Controls -->
                                    <div class="d-flex align-items-center mb-3">
                                        <span style="font-size: 11px; color: #666;">0:00</span>
                                        <div class="flex-grow-1 mx-2" style="height: 3px; background: #e0dcd3; position: relative; border-radius: 2px;">
                                            <div style="width: 30%; height: 100%; background: #c7b58c; border-radius: 2px;"></div>
                                        </div>
                                        <span style="font-size: 11px; color: #666;">-0:00</span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mb-4 gap-4">
                                        <span style="cursor: pointer; color: #333;" data-bs-target="#blessingsPromoCarousel" data-bs-slide="prev">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M11 18V6l-8.5 6 8.5 6zm.5-6l8.5 6V6l-8.5 6z"/></svg>
                                        </span>
                                        <span style="cursor: pointer; background: #c7b58c; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #fff;">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                                        </span>
                                        <span style="cursor: pointer; color: #333;" data-bs-target="#blessingsPromoCarousel" data-bs-slide="next">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M4 18l8.5-6L4 6v12zm9-12v12l8.5-6L13 6z"/></svg>
                                        </span>
                                    </div>

                                    <a href="{{ route('front.blessings.library') }}" class="com_btn w-100 text-center mb-3" style="background: transparent; color: #666; border: 1px solid #ccc;">GIFT THIS BLESSING</a>
                                    <div class="text-center">
                                        <a href="#" style="font-size: 14px; color: #c7b58c; text-decoration: none;">Share this <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ms-1"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div> <!-- Close Row -->
    </div> <!-- Close Container -->
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarList = document.getElementById("dynamic-sidebar");
        const headings = document.querySelectorAll(".content h2, .content h3, .content h4");
        const sections = [];
        let currentH2Li = null;
        let currentH3Ul = null;
        const allDropdowns = [];

        if (headings.length > 0 && sidebarList) {
            headings.forEach((heading, index) => {
                let targetId = heading.id;
                if (!targetId) {
                    targetId = heading.tagName.toLowerCase() + "-heading-" + index;
                    heading.id = targetId;
                }

                const a = document.createElement("a");
                a.href = "#" + targetId;
                a.className = "nav-link";
                a.textContent = heading.textContent.trim();

                if (heading.tagName.toLowerCase() === 'h2') {
                    const li = document.createElement("li");
                    
                    const flexContainer = document.createElement("div");
                    flexContainer.className = "d-flex align-items-center justify-content-between heading-wrapper";
                    flexContainer.appendChild(a);
                    li.appendChild(flexContainer);

                    if (index === 0) {
                        a.classList.add("active");
                    }
                    
                    sidebarList.appendChild(li);
                    currentH2Li = li;
                    currentH3Ul = null;
                    
                    sections.push(heading);
                } else if ((heading.tagName.toLowerCase() === 'h3' || heading.tagName.toLowerCase() === 'h4') && currentH2Li) {
                    if (!currentH3Ul) {
                        const ul = document.createElement("ul");
                        currentH3Ul = ul;
                        
                        ul.className = "sub-menu ps-3 m-0";
                        ul.style.overflow = "hidden";
                        ul.style.transition = "max-height 0.3s ease-in-out";
                        ul.style.maxHeight = "0px";
                        ul.style.listStyleType = "none";
                        ul.id = "submenu-" + index;

                        const toggleBtn = document.createElement("button");
                        toggleBtn.className = "dropdown-toggle-btn border-0 bg-transparent ms-2 p-0";
                        toggleBtn.style.transition = "transform 0.3s ease-in-out";
                        toggleBtn.style.cursor = "pointer";
                        toggleBtn.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 4.5L6 7.5L9 4.5" stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                        
                        allDropdowns.push({ ul: ul, btn: toggleBtn });

                        if (currentH2Li === sidebarList.firstElementChild) {
                            ul.style.maxHeight = "1000px";
                            toggleBtn.style.transform = "rotate(180deg)";
                        }

                        toggleBtn.onclick = function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            const isCollapsed = ul.style.maxHeight === "0px" || ul.style.maxHeight === "";
                            
                            allDropdowns.forEach(item => {
                                if (item.ul !== ul) {
                                    item.ul.style.maxHeight = "0px";
                                    item.btn.style.transform = "rotate(0deg)";
                                }
                            });

                            if (isCollapsed) {
                                ul.style.maxHeight = ul.scrollHeight + "px";
                                toggleBtn.style.transform = "rotate(180deg)";
                                setTimeout(() => { if (ul.style.maxHeight !== "0px") ul.style.maxHeight = "1000px"; }, 300);
                            } else {
                                ul.style.maxHeight = "0px";
                                toggleBtn.style.transform = "rotate(0deg)";
                            }
                        };

                        const flexContainer = currentH2Li.querySelector(".heading-wrapper");
                        if (flexContainer) {
                            flexContainer.appendChild(toggleBtn);
                        }

                        currentH2Li.appendChild(ul);
                    }
                    
                    const subLi = document.createElement("li");
                    a.classList.add("sub-link");
                    subLi.appendChild(a);
                    currentH3Ul.appendChild(subLi);
                    
                    sections.push(heading);
                }
            });
        }

        const links = document.querySelectorAll("#dynamic-sidebar li a.nav-link");
        let isClickScrolling = false;

        links.forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                
                isClickScrolling = true;
                
                links.forEach(l => l.classList.remove("active"));
                this.classList.add("active");

                const targetId = this.getAttribute("href");
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    const headerOffset = 120;
                    const elementPosition = targetSection.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
                
                const sidebarContainer = document.querySelector(".sidebar-container");
                if (sidebarContainer) {
                    const containerRect = sidebarContainer.getBoundingClientRect();
                    const linkRect = this.getBoundingClientRect();
                    const relativeTop = linkRect.top - containerRect.top + sidebarContainer.scrollTop;
                    const centerOffset = relativeTop - (sidebarContainer.clientHeight / 2) + (linkRect.height / 2);
                    
                    sidebarContainer.scrollTo({
                        top: centerOffset > 0 ? centerOffset : 0,
                        behavior: 'smooth'
                    });
                }
                
                setTimeout(() => {
                    isClickScrolling = false;
                }, 800);
            });
        });

        window.addEventListener("scroll", function () {
            let current = "";
            let currentLink = null;
            
            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                const sectionTop = rect.top + window.scrollY;
                if (window.scrollY >= sectionTop - 180) {
                    current = section.getAttribute("id");
                }
            });

            if (current) {
                links.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                        currentLink = link;
                        
                        const parentUl = link.closest('.sub-menu');
                        const li = link.closest('li');
                        const ownUl = li ? li.querySelector('.sub-menu') : null;
                        const targetUl = parentUl || ownUl;

                        allDropdowns.forEach(item => {
                            if (item.ul !== targetUl) {
                                item.ul.style.maxHeight = "0px";
                                item.btn.style.transform = "rotate(0deg)";
                            }
                        });

                        if (targetUl && (targetUl.style.maxHeight === '0px' || targetUl.style.maxHeight === '')) {
                            targetUl.style.maxHeight = targetUl.scrollHeight + "px";
                            setTimeout(() => { if (targetUl.style.maxHeight !== "0px") targetUl.style.maxHeight = "1000px"; }, 300);
                            const toggleBtn = targetUl.parentElement.querySelector('.dropdown-toggle-btn');
                            if (toggleBtn) toggleBtn.style.transform = 'rotate(180deg)';
                        }
                    }
                });
                
                if (!isClickScrolling) {
                    const sidebarContainer = document.querySelector(".sidebar-container");
                    if(sidebarContainer && currentLink) {
                        const containerRect = sidebarContainer.getBoundingClientRect();
                        const linkRect = currentLink.getBoundingClientRect();
                        
                        if(linkRect.top < containerRect.top || linkRect.bottom > containerRect.bottom) {
                            const relativeTop = linkRect.top - containerRect.top + sidebarContainer.scrollTop;
                            const centerOffset = relativeTop - (sidebarContainer.clientHeight / 2) + (linkRect.height / 2);
                            
                            sidebarContainer.scrollTo({
                                top: centerOffset > 0 ? centerOffset : 0, 
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            } else if (window.scrollY < 200 && links.length > 0) {
                links.forEach(l => l.classList.remove("active"));
                links[0].classList.add("active");
                
                const firstUl = allDropdowns.length > 0 ? allDropdowns[0].ul : null;
                allDropdowns.forEach(item => {
                    if (item.ul !== firstUl) {
                        item.ul.style.maxHeight = "0px";
                        item.btn.style.transform = "rotate(0deg)";
                    } else if (item.ul.style.maxHeight === '0px' || item.ul.style.maxHeight === '') {
                        item.ul.style.maxHeight = "1000px";
                        item.btn.style.transform = "rotate(180deg)";
                    }
                });
            }
        });
    });
</script>

@include('layouts.frontfooter')