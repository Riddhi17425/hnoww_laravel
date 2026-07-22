@php
    //echo "<pre>"; print_r($blog->blog_faq); die;
@endphp

@include('layouts.frontheader', [
    'og_image' => asset($blog->og_image),
    'blog_schema' => $blog->blog_schema ?? '',
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
    @if (!empty($faqSchemaEntities))
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
    <img class="img-fluid" src="{{ asset('public/images/front/articles-banner.webp') }}" alt="about us banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Articles</h2>
        <p class="para mb-0">Reflections on design, ritual, and the art of intentional living.</p>
    </div>
</section>

<section class="mt_120 mb_120">
    <div class="container">
        <div class="section_header">
            <h1 class="title_60">{{ $blog->title ?? '' }}</h1>
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
                    <p class="title_24 sidebar-title mb-4">CONTENTS</p>
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
                        <a href="{{ $blog->cta_link ?? '#' }}" target="_blank"><img
                                src="{{ asset('/' . $blog->cta_image) }}" alt="{{ $blog->cta_image_alt ?? '' }}"
                                class="img-fluid" alt="{{ $blog->cta_image_alt ?? '' }} "></a>
                        <div class="articles_cta_content">
                            {{-- <h3 class="text-white">{!! $blog->cta_content ?? '' !!}</h3>
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
                    <div class="col-md-3 mb-md-0 mb-3 text-center">
                        <a href="{{ route('front.author') }}">
                            <img src="{{ asset('public/images/front/hnoww-women.webp') }}" alt="Salomi Kotecha"
                                class="img-fluid rounded-circle author-img">
                        </a>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex align-items-center mb-2">
                            <a href="{{ route('front.author') }}" class="text-decoration-none">
                                <h4 class="author-name mb-0">Salomi Kotecha</h4>
                            </a>
                            <a href="https://www.linkedin.com/in/salomi-kotecha-93b9a6131/" class="text-decoration-none ms-3" title="LinkedIn" target="_blank">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="#0077b5">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                        </div>
                        <p class="author-subtitle mb-3">
                            Founder, HNOWW <span class="text-muted mx-2">|</span>Objects, Rituals and the Art of
                            Giving
                        </p>
                    </div>
                </div>
                <p class="author-desc mb-0">
                    Salomi Kotecha is the founder of HNOWW, a Dubai-based design house creating objects designed to
                    stay. After more than a decade working across fashion, design and material culture, she founded
                    HNOWW to explore how objects shape the way we give, gather and remember. She writes about
                    considered gifting, modern rituals, craftsmanship, hospitality and the stories that give objects
                    permanence.
                </p>
            </div>

                @if (isset($blog->blog_faq) && is_countable($blog->blog_faq) && count($blog->blog_faq) > 0)
                    <div>
                        <h2 class="title_60 mb-4 text-center" style="color: #c7b58c;">FAQs</h2>

                        <div class="faq_cont">
                            <div class="accordion" id="staticFaqAccordion">

                                @foreach ($blog->blog_faq as $index => $faq)
                                    <div class="faq_cont_acco border-bottom">

                                        <h3 class="according_head sub_head" data-bs-toggle="collapse"
                                            data-bs-target="#faq-{{ $index }}"
                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                            {{ $faq['faq_title'] ?? '' }}
                                        </h3>

                                        <div id="faq-{{ $index }}"
                                            class="accordion-collapse {{ $index === 0 ? 'show' : '' }} collapse"
                                            data-bs-parent="#staticFaqAccordion">
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
                        @if (isset($blessings) && $blessings->count() > 0)
                            <div id="blessingsPromoCarousel" class="carousel slide carousel-fade"
                                data-bs-ride="carousel" data-bs-interval="8000">
                                <div class="carousel-inner">
                                    @foreach ($blessings as $index => $blessing)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                                            data-id="{{ $blessing->id }}"
                                            data-audio="{{ route('front.blessings.audio', $blessing->id) }}">

                                            <img src="{{ asset('public/images/admin/blessing/images/' . $blessing->image) }}"
                                                alt="{{ $blessing->title }}" class="img-fluid promo-img mb-3"
                                                style="border-radius: 8px;">

                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h4 class="sidebar-title promo-title mb-0">{{ $blessing->title }}</h4>
                                                <img src="{{ asset('public/images/front/volume.svg') }}" alt="Audio"
                                                    width="20">
                                            </div>
                                            <p class="mb-2" style="font-size: 13px; color: #666; font-weight: 500;">
                                                {{ $blessing->sub_title }}</p>
                                            <p class="promo-desc mb-3">
                                                {{ Str::limit(strip_tags($blessing->description), 90) }}</p>

                                            <div class="d-flex align-items-center mb-3">
                                                <span class="promo-current-time"
                                                    style="font-size: 11px; color: #666;">0:00</span>
                                                <div class="flex-grow-1 promo-progress-bar mx-2"
                                                    style="height: 3px; background: #e0dcd3; position: relative; border-radius: 2px; cursor: pointer;">
                                                    <div class="promo-progress"
                                                        style="width: 0%; height: 100%; background: #c7b58c; border-radius: 2px;">
                                                    </div>
                                                </div>
                                                <span class="promo-remaining-time"
                                                    style="font-size: 11px; color: #666;">-0:00</span>
                                            </div>

                                            <div class="d-flex justify-content-center align-items-center mb-4 gap-4">
                                                <span style="cursor: pointer; color: #333;"
                                                    data-bs-target="#blessingsPromoCarousel" data-bs-slide="prev">
                                                    <svg width="14" height="14" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M11 18V6l-8.5 6 8.5 6zm.5-6l8.5 6V6l-8.5 6z" />
                                                    </svg>
                                                </span>
                                                <span class="promo-play-btn"
                                                    style="cursor: pointer; background: #c7b58c; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: #fff;">
                                                    <svg width="18" height="18" viewBox="0 0 24 24"
                                                        fill="currentColor" style="margin-left: 2px;">
                                                        <path d="M8 5v14l11-7z" />
                                                    </svg>
                                                </span>
                                                <span style="cursor: pointer; color: #333;"
                                                    data-bs-target="#blessingsPromoCarousel" data-bs-slide="next">
                                                    <svg width="14" height="14" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path d="M4 18l8.5-6L4 6v12zm9-12v12l8.5-6L13 6z" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <a href="javascript:void(0);"
                                                class="com_btn w-100 promo-gift-btn text-center"
                                                data-id="{{ $blessing->id }}">
                                                GIFT THIS BLESSING
                                                <svg width="14" height="14" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="ms-1">
                                                    <circle cx="18" cy="5" r="3"></circle>
                                                    <circle cx="6" cy="12" r="3"></circle>
                                                    <circle cx="18" cy="19" r="3"></circle>
                                                    <line x1="8.59" y1="13.51" x2="15.42"
                                                        y2="17.49"></line>
                                                    <line x1="15.41" y1="6.51" x2="8.59"
                                                        y2="10.49"></line>
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <audio id="promoAudio" preload="none"></audio>
                        @endif
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
         @foreach ($blogs as $otherBlog)
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
    document.addEventListener("DOMContentLoaded", function() {
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
                    flexContainer.className =
                        "d-flex align-items-center justify-content-between heading-wrapper";
                    flexContainer.appendChild(a);
                    li.appendChild(flexContainer);

                    if (index === 0) {
                        a.classList.add("active");
                    }

                    sidebarList.appendChild(li);
                    currentH2Li = li;
                    currentH3Ul = null;

                    sections.push(heading);
                } else if ((heading.tagName.toLowerCase() === 'h3' || heading.tagName.toLowerCase() ===
                        'h4') && currentH2Li) {
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
                        toggleBtn.innerHTML =
                            '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 4.5L6 7.5L9 4.5" stroke="#666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';

                        allDropdowns.push({
                            ul: ul,
                            btn: toggleBtn
                        });

                        if (currentH2Li === sidebarList.firstElementChild) {
                            ul.style.maxHeight = "1000px";
                            toggleBtn.style.transform = "rotate(180deg)";
                        }

                        toggleBtn.onclick = function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            const isCollapsed = ul.style.maxHeight === "0px" || ul.style
                                .maxHeight === "";

                            allDropdowns.forEach(item => {
                                if (item.ul !== ul) {
                                    item.ul.style.maxHeight = "0px";
                                    item.btn.style.transform = "rotate(0deg)";
                                }
                            });

                            if (isCollapsed) {
                                ul.style.maxHeight = ul.scrollHeight + "px";
                                toggleBtn.style.transform = "rotate(180deg)";
                                setTimeout(() => {
                                    if (ul.style.maxHeight !== "0px") ul.style.maxHeight =
                                        "1000px";
                                }, 300);
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
            link.addEventListener("click", function(e) {
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
                    const relativeTop = linkRect.top - containerRect.top + sidebarContainer
                        .scrollTop;
                    const centerOffset = relativeTop - (sidebarContainer.clientHeight / 2) + (
                        linkRect.height / 2);

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

        window.addEventListener("scroll", function() {
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

                        if (targetUl && (targetUl.style.maxHeight === '0px' || targetUl.style
                                .maxHeight === '')) {
                            targetUl.style.maxHeight = targetUl.scrollHeight + "px";
                            setTimeout(() => {
                                if (targetUl.style.maxHeight !== "0px") targetUl.style
                                    .maxHeight = "1000px";
                            }, 300);
                            const toggleBtn = targetUl.parentElement.querySelector(
                                '.dropdown-toggle-btn');
                            if (toggleBtn) toggleBtn.style.transform = 'rotate(180deg)';
                        }
                    }
                });

                if (!isClickScrolling) {
                    const sidebarContainer = document.querySelector(".sidebar-container");
                    if (sidebarContainer && currentLink) {
                        const containerRect = sidebarContainer.getBoundingClientRect();
                        const linkRect = currentLink.getBoundingClientRect();

                        if (linkRect.top < containerRect.top || linkRect.bottom > containerRect
                            .bottom) {
                            const relativeTop = linkRect.top - containerRect.top + sidebarContainer
                                .scrollTop;
                            const centerOffset = relativeTop - (sidebarContainer.clientHeight / 2) + (
                                linkRect.height / 2);

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
                    } else if (item.ul.style.maxHeight === '0px' || item.ul.style.maxHeight ===
                        '') {
                        item.ul.style.maxHeight = "1000px";
                        item.btn.style.transform = "rotate(180deg)";
                    }
                });
            }
        });
    });
</script>

<!-- Gift Blessing popup for blog sidebar (reuses the 3-field share form) -->
<div class="modal fade audio_modal" id="blogGiftModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <form method="POST" id="blogGiftForm" action="{{ route('front.store.shared.detail') }}"
                        class="ct_form">
                        @csrf
                        <div class="modal-header border-0 px-0 pt-0">
                            <h5 class="title_40">Gift This Blessing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <input type="hidden" name="blessing_id" id="blogGiftBlessingId">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Name</label>
                                    <input type="text" name="name" placeholder="Enter your Name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Email</label>
                                    <input type="email" name="email" placeholder="Enter your Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Contact</label>
                                    <input type="text" name="contact_no" placeholder="Enter your Contact Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-3 gap-2">
                            <button type="submit" class="com_btn bg-transparent">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Share Options Modal (blog sidebar) -->
<div class="modal fade audio_modal" id="blogShareOptionsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid gap-0">
                    <div class="modal-header border-0 px-0 pt-0">
                        <h5 class="title_40">Social Sharing Options</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div>
                        Awesome! Where would you like to share your poem?
                    </div>

                    <div class="share-wrapper">
                        <a href="javascript:void(0);" id="blogShareWhatsappBtn" class="share-box whatsapp"
                            title="Share on WhatsApp">
                            <!-- same WhatsApp svg as blessings page -->
                            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_146_89b)">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M75 0C116.423 0 150 33.5771 150 75C150 116.423 116.423 150 75 150C33.5771 150 0 116.423 0 75C0 33.5771 33.5771 0 75 0Z"
                                        fill="url(#paint0_linear_146_89b)" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M75.0002 109.518C68.8918 109.518 62.8801 107.892 57.6213 104.818C56.7746 104.323 55.7551 104.191 54.8088 104.449L43.3742 107.587L47.3586 98.8125C47.9006 97.6201 47.76 96.2285 46.9953 95.165C42.7326 89.2617 40.4826 82.2861 40.4826 75C40.4826 55.9658 55.966 40.4824 75.0002 40.4824C94.0344 40.4824 109.518 55.9658 109.518 75C109.518 94.0342 94.0344 109.518 75.0002 109.518ZM75.0002 33.1758C51.9377 33.1758 33.1789 51.9375 33.1789 75C33.1789 83.1123 35.4787 90.9023 39.8586 97.6641L33.5041 111.659C32.9182 112.951 33.132 114.463 34.049 115.541C34.7551 116.364 35.7775 116.824 36.8293 116.824C39.1848 116.824 52.0314 112.787 55.301 111.888C61.3449 115.122 68.1213 116.824 75.0002 116.824C98.0598 116.824 116.824 98.0596 116.824 75C116.824 51.9375 98.0598 33.1787 75.0002 33.1758Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M84.9844 79.8895C83.4024 80.537 82.3916 83.0155 81.3662 84.2811C80.8389 84.9286 80.2119 85.0311 79.4033 84.7059C73.4619 82.3388 68.9063 78.372 65.6279 72.9052C65.0713 72.0585 65.1709 71.3876 65.8418 70.5995C66.832 69.4335 68.0772 68.1093 68.3438 66.536C68.9385 63.0614 64.3945 52.2772 58.3916 57.164C41.1211 71.2382 87.2022 108.565 95.5195 88.3768C97.8721 82.6522 87.6094 78.8143 84.9844 79.8895Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_146_89b" x1="19.8721" y1="24.1465"
                                        x2="138.923" y2="114.252" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#39AE41" />
                                        <stop offset="1" stop-color="#80C269" />
                                    </linearGradient>
                                    <clipPath id="clip0_146_89b">
                                        <rect width="150" height="150" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>WhatsApp</span>
                        </a>

                        <a href="javascript:void(0);" id="blogShareEmailBtn" class="share-box gmail"
                            title="Share via Email">
                            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M75 2C115.317 2 148 34.6832 148 75C148 115.317 115.317 148 75 148C34.6832 148 2 115.317 2 75C2 34.6832 34.6832 2 75 2Z"
                                    stroke="#8C8A72" stroke-width="4" />
                                <g clip-path="url(#clip0_146_125b)">
                                    <path
                                        d="M36.0352 108.984H50.3906V73.9701L29.8828 58.5227V102.805C29.8828 106.224 32.6411 108.984 36.0352 108.984Z"
                                        fill="#4285F4" />
                                    <path
                                        d="M99.6094 108.984H113.965C117.369 108.984 120.117 106.214 120.117 102.805V58.5227L99.6094 73.9701"
                                        fill="#34A853" />
                                    <path
                                        d="M99.6094 47.1946V73.9701L120.117 58.5227V50.284C120.117 42.6427 111.432 38.2865 105.352 42.8693"
                                        fill="#FBBC04" />
                                    <path d="M50.3906 73.9701V47.1946L75 65.7315L99.6094 47.1946V73.9701L75 92.5071"
                                        fill="#EA4335" />
                                    <path
                                        d="M29.8828 50.284V58.5227L50.3906 73.9701V47.1946L44.6484 42.8693C38.5576 38.2865 29.8828 42.6427 29.8828 50.284Z"
                                        fill="#C5221F" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_146_125b">
                                        <rect width="90.2344" height="67.9688" fill="white"
                                            transform="translate(29.8828 41.0156)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Email</span>
                        </a>

                        <a href="javascript:void(0);" id="blogShareInstagramBtn" class="share-box instagram"
                            title="Share on Instagram">
                            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_146_96b)">
                                    <mask id="mask0_146_96b" style="mask-type:luminance" maskUnits="userSpaceOnUse"
                                        x="0" y="0" width="150" height="150">
                                        <path
                                            d="M75 150C116.421 150 150 116.421 150 75C150 33.5786 116.421 0 75 0C33.5786 0 0 33.5786 0 75C0 116.421 33.5786 150 75 150Z"
                                            fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_146_96b)">
                                        <path
                                            d="M32.2266 303.516C121.218 303.516 193.359 231.374 193.359 142.383C193.359 53.3916 121.218 -18.75 32.2266 -18.75C-56.7646 -18.75 -128.906 53.3916 -128.906 142.383C-128.906 231.374 -56.7646 303.516 32.2266 303.516Z"
                                            fill="url(#paint0_radial_146_96b)" />
                                    </g>
                                    <path
                                        d="M96.0938 59.7656C99.3298 59.7656 101.953 57.1423 101.953 53.9062C101.953 50.6702 99.3298 48.0469 96.0938 48.0469C92.8577 48.0469 90.2344 50.6702 90.2344 53.9062C90.2344 57.1423 92.8577 59.7656 96.0938 59.7656Z"
                                        fill="white" />
                                    <path
                                        d="M75 56.25C71.2916 56.25 67.6665 57.3497 64.5831 59.4099C61.4996 61.4702 59.0964 64.3986 57.6773 67.8247C56.2581 71.2508 55.8868 75.0208 56.6103 78.6579C57.3338 82.2951 59.1195 85.636 61.7418 88.2582C64.364 90.8805 67.7049 92.6663 71.3421 93.3897C74.9792 94.1132 78.7492 93.7419 82.1753 92.3227C85.6014 90.9036 88.5298 88.5004 90.5901 85.4169C92.6503 82.3335 93.75 78.7084 93.75 75C93.75 70.0272 91.7746 65.2581 88.2583 61.7417C84.742 58.2254 79.9728 56.25 75 56.25ZM75 84.375C73.1458 84.375 71.3333 83.8252 69.7915 82.795C68.2498 81.7649 67.0482 80.3007 66.3386 78.5877C65.6291 76.8746 65.4434 74.9896 65.8051 73.171C66.1669 71.3525 67.0598 69.682 68.3709 68.3709C69.682 67.0598 71.3525 66.1669 73.171 65.8051C74.9896 65.4434 76.8746 65.6291 78.5877 66.3386C80.3007 67.0482 81.7649 68.2498 82.795 69.7915C83.8252 71.3332 84.375 73.1458 84.375 75C84.375 77.4864 83.3873 79.871 81.6291 81.6291C79.871 83.3873 77.4864 84.375 75 84.375Z"
                                        fill="white" />
                                    <path
                                        d="M98.4375 37.5H51.5625C43.796 37.5 37.5 43.796 37.5 51.5625V98.4375C37.5 106.204 43.796 112.5 51.5625 112.5H98.4375C106.204 112.5 112.5 106.204 112.5 98.4375V51.5625C112.5 43.796 106.204 37.5 98.4375 37.5Z"
                                        stroke="white" stroke-width="10.0495" stroke-miterlimit="10" />
                                </g>
                                <defs>
                                    <radialGradient id="paint0_radial_146_96b" cx="0" cy="0" r="1"
                                        gradientUnits="userSpaceOnUse"
                                        gradientTransform="translate(32.2266 142.383) scale(161.133)">
                                        <stop stop-color="#FFD676" />
                                        <stop offset="0.25" stop-color="#F2A454" />
                                        <stop offset="0.38" stop-color="#F05C3C" />
                                        <stop offset="0.7" stop-color="#C22F86" />
                                        <stop offset="0.96" stop-color="#6666AD" />
                                        <stop offset="0.99" stop-color="#5C6CB2" />
                                    </radialGradient>
                                    <clipPath id="clip0_146_96b">
                                        <rect width="150" height="150" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Instagram</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carouselEl = document.getElementById('blessingsPromoCarousel');
            if (!carouselEl) return;

            const promoAudio = document.getElementById('promoAudio');

            const playIcon = () =>
                '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" style="margin-left:2px;"><path d="M8 5v14l11-7z"/></svg>';
            const pauseIcon = () =>
                '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6 5h4v14H6zM14 5h4v14h-4z"/></svg>';

            function formatTime(t) {
                if (isNaN(t)) return '0:00';
                const m = Math.floor(t / 60);
                const s = Math.floor(t % 60).toString().padStart(2, '0');
                return `${m}:${s}`;
            }

            function getActiveSlide() {
                return carouselEl.querySelector('.carousel-item.active');
            }

            function setPlayIconState(slide, playing) {
                const btn = slide.querySelector('.promo-play-btn');
                if (btn) btn.innerHTML = playing ? pauseIcon() : playIcon();
            }

            function resetSlideUI(slide) {
                const progress = slide.querySelector('.promo-progress');
                const cur = slide.querySelector('.promo-current-time');
                const rem = slide.querySelector('.promo-remaining-time');
                if (progress) progress.style.width = '0%';
                if (cur) cur.textContent = '0:00';
                if (rem) rem.textContent = '-0:00';
                setPlayIconState(slide, false);
            }

            // Play / pause toggle
            carouselEl.addEventListener('click', function(e) {
                const btn = e.target.closest('.promo-play-btn');
                if (!btn) return;
                const slide = getActiveSlide();
                if (!slide) return;

                const audioSrc = slide.dataset.audio;
                if (promoAudio.getAttribute('src') !== audioSrc) {
                    promoAudio.src = audioSrc;
                }

                if (promoAudio.paused) {
                    promoAudio.play().then(() => setPlayIconState(slide, true)).catch(() => {});
                } else {
                    promoAudio.pause();
                    setPlayIconState(slide, false);
                }
            });

            // Seek
            carouselEl.addEventListener('click', function(e) {
                const bar = e.target.closest('.promo-progress-bar');
                if (!bar || !promoAudio.duration) return;
                const rect = bar.getBoundingClientRect();
                promoAudio.currentTime = ((e.clientX - rect.left) / rect.width) * promoAudio.duration;
            });

            // Progress updates
            promoAudio.addEventListener('timeupdate', function() {
                const slide = getActiveSlide();
                if (!slide) return;
                const progress = slide.querySelector('.promo-progress');
                const cur = slide.querySelector('.promo-current-time');
                const rem = slide.querySelector('.promo-remaining-time');
                const pct = (promoAudio.currentTime / promoAudio.duration) * 100 || 0;
                if (progress) progress.style.width = pct + '%';
                if (cur) cur.textContent = formatTime(promoAudio.currentTime);
                if (rem) rem.textContent = '-' + formatTime(promoAudio.duration - promoAudio.currentTime);
            });

            promoAudio.addEventListener('ended', function() {
                const slide = getActiveSlide();
                if (slide) resetSlideUI(slide);
            });

            // Stop audio whenever the carousel changes slide
            carouselEl.addEventListener('slide.bs.carousel', function() {
                promoAudio.pause();
                promoAudio.currentTime = 0;
                const slide = getActiveSlide();
                if (slide) resetSlideUI(slide);
            });

            // GIFT THIS BLESSING -> open the 3-field popup
            carouselEl.addEventListener('click', function(e) {
                const giftBtn = e.target.closest('.promo-gift-btn');
                if (!giftBtn) return;
                document.getElementById('blogGiftBlessingId').value = giftBtn.dataset.id;
                $('#blogGiftModal').modal('show');
            });

            // Submit handler for the popup (mirrors shareDetailsForm on the blessings page)
            let blogActiveShareLink = '';
            let blogActiveWhatsappUrl = '';
            let blogActiveEmailUrl = '';
            let blogActiveInstagramUrl = 'https://www.instagram.com/';

            function buildBlogShareLink(blessingId) {
                return sitePath + '/blessings-detail/' + blessingId;
            }

            $('#blogGiftForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 100,
                        lettersonly: true
                    },
                    email: {
                        required: true,
                        email: true,
                        noSpamEmail: true
                    },
                    contact_no: {
                        required: true,
                        validPhone: true
                    }
                },
                messages: {
                    name: {
                        required: 'Please enter your name',
                        minlength: 'Name must be at least 2 characters',
                        maxlength: 'Name cannot be longer than 100 characters',
                        lettersonly: 'Only letters and spaces are allowed'
                    },
                    email: {
                        required: 'Please enter your email',
                        email: 'Please enter a valid email address',
                        noSpamEmail: 'This email address is not allowed'
                    },
                    contact_no: {
                        required: 'Please enter your contact number'
                    }
                },
                submitHandler: function(form) {
                    const btn = $(form).find('button[type="submit"]');
                    btn.prop('disabled', true).text('Submitting...');

                    $.ajax({
                        url: "{{ route('front.store.shared.detail') }}",
                        method: 'POST',
                        data: $(form).serialize(),
                        success: function(res) {
                            blogActiveShareLink = res.share_link || buildBlogShareLink($(
                                '#blogGiftBlessingId').val());
                            blogActiveWhatsappUrl = res.whatsapp_url || (
                                'https://wa.me/?text=' + encodeURIComponent(
                                    blogActiveShareLink));
                            blogActiveEmailUrl = res.email_url || ('mailto:?subject=' +
                                encodeURIComponent('Blessing share') + '&body=' +
                                encodeURIComponent(blogActiveShareLink));
                            blogActiveInstagramUrl = res.instagram_url ||
                                'https://www.instagram.com/';

                            $('#blogGiftModal').modal('hide');
                            form.reset();

                            setTimeout(function() {
                                $('#blogShareOptionsModal').modal('show');
                            }, 350);
                        },
                        error: function(xhr) {
                            let message = 'Something went wrong';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                const firstError = Object.values(xhr.responseJSON.errors)[
                                0];
                                if (firstError && firstError[0]) message = firstError[0];
                            }
                            alert(message);
                        },
                        complete: function() {
                            btn.prop('disabled', false).text('Continue');
                        }
                    });
                }
            });

            $('#blogShareWhatsappBtn').on('click', function() {
                if (!blogActiveWhatsappUrl) {
                    alert('Share link not available');
                    return;
                }
                window.open(blogActiveWhatsappUrl, '_blank');
            });

            $('#blogShareEmailBtn').on('click', function() {
                if (!blogActiveEmailUrl) {
                    alert('Share link not available');
                    return;
                }
                window.location.href = blogActiveEmailUrl;
            });

            $('#blogShareInstagramBtn').on('click', function() {
                if (!blogActiveShareLink) {
                    alert('Share link not available');
                    return;
                }
                navigator.clipboard.writeText(blogActiveShareLink).then(function() {
                    alert('Share link copied. Paste it in Instagram.');
                    window.open(blogActiveInstagramUrl, '_blank');
                }).catch(function() {
                    alert('Share link copied. Paste it in Instagram.');
                    window.open(blogActiveInstagramUrl, '_blank');
                });
            });
        });
    </script>
@endpush

@include('layouts.frontfooter')
