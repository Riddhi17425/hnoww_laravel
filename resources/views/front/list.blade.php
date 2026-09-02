@include('layouts.frontheader', [
    'meta_title' => $category->meta_title ?? $category->name,
    'meta_description' => $category->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($category->description), 160)
])

<!-- HERO SECTION -->
<section class="hero-section_inner">

    @if(!empty($category->banner_image) && file_exists(public_path('images/admin/category_banner/'.$category->banner_image)))
        <img class="img-fluid test"
             src="{{ asset('public/images/admin/category_banner/'.$category->banner_image) }}"
             alt="{{ $category->category_name ?? 'Category Banner' }}">
    @else
        <img class="img-fluid test"
             src="{{ asset('public/images/front/for-him-banner.webp') }}"
             alt="{{ $category->category_name ?? 'Category Banner' }}">
    @endif

    <div class="hero_content_inner">
        <h2 class="main_head">
            {{ $category->category_name ?? '' }}
        </h2>

        @if(!empty($category->title))
            <p class="sub_heads sec_in_mb">
                {{ $category->title }}
            </p>
        @endif

        @if(!empty($category->description))
            <p class="para mb-0">
                {!! $category->description !!}
            </p>
        @endif
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
            <div class="text-end magic_wrapper_logo">
                <img src="{{ asset('public/images/front/footer-logo.svg') }}" loading="lazy" alt="" class="img-fluid">
            </div>

            <!-- 2️⃣ Center image (scale 0 → 1) -->
            <div class="magic_wrapper_center">
                {{-- Need to make dynamic --}}
                <img src="{{ asset('public/images/front/home_magic.webp') }}" loading="lazy" alt="image" class="img-fluid">
                <p class="magic_wrapper_p mb-0"> Ritual is the first luxury.</p>
            </div>

            <!-- 4️⃣ Text block (from right) -->
            <div>
                <h3 class="magic_wrapper_h3">@if(isset($category->magic_title)){{$category->magic_title}}@endif</h3>
                <p>
                    @if(isset($category->magic_description)){{$category->magic_description}} @endif
                </p>
            </div>

            <!-- 1️⃣ First heading (from right) -->
            <h2 class="magic_head_1">
                @if(isset($category->magic_heading_first)){{$category->magic_heading_first}}@endif
            </h2>

            <!-- 5️⃣ Last heading (from right) -->
            <h2 class="magic_head_2">@if(isset($category->magic_heading_second)){{$category->magic_heading_second}}@endif
            </h2>

        </div>
    </div>
</section>
@endif

<!-- START - CELEBRATION SECTION -->
@if(
    !empty($category->celebration_label) ||
    !empty($category->celebration_title) ||
    !empty($category->celebration_description) ||
    !empty($category->celebration_image)
)

<section class="mt_120">
    <div class="container">

        <div class="section_header">
            @if(!empty($category->celebration_label))
                <p class="sub_head mb-0">

                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                                fill="#B58A46">
                            </path>
                        </svg>
                    </span>

                    <span>{{ $category->celebration_label }}</span>

                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46">
                            </path>
                        </svg>
                    </span>

                </p>
            @endif

            @if(!empty($category->celebration_title))
                <h2 class="title_60">
                    {{ $category->celebration_title }}
                </h2>
            @endif

        </div>

        @if(!empty($category->celebration_description))
            <div class="exists_content">
                <div class="col-lg-10 m-auto text-center">

                    <p class="sub_head_inter">
                        {!! $category->celebration_description ?? '' !!}
                    </p>

                </div>
            </div>
        @endif


        @if(!empty($category->celebration_image))
            <div class="mt-5">

                <img
                    class="img-fluid w-100"
                    src="{{ asset('public/images/admin/category_celebration/' . $category->celebration_image) }}"
                    alt="{{ $category->celebration_title ?? 'Celebration' }}">

            </div>
        @endif

    </div>
</section>
@endif
<!-- END - CELEBRATION SECTION -->

<!-- START - COLLECTION SECTION -->
@if(
    !empty($category->collection_label) ||
    !empty($category->collection_title) ||
    !empty($category->collection_description)
)

<section class="mt_120 mb_120">
    <div class="container">

        <!-- Section Header -->
        <div class="section_header text-center mb-5">

            @if(!empty($category->collection_label))
                <p class="sub_head mb-0">

                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                                fill="#B58A46">
                            </path>
                        </svg>
                    </span>

                    <span>
                        {{ $category->collection_label }}
                    </span>

                    <span>
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46">
                            </path>
                        </svg>
                    </span>

                </p>
            @endif


            @if(!empty($category->collection_title))
                <h2 class="title_60 mb-4">
                    {{ $category->collection_title }}
                </h2>
            @endif


            @if(!empty($category->collection_description))
                <p class="mb-4">
                    {!! $category->collection_description !!}
                </p>
            @endif

        </div>
    </div>
</section>
@endif
<!-- END - COLLECTION SECTION -->

<!-- START - PRODUCT DISPLAY SECTION -->
<section class="mt_60">
    <div class="container">
        <div class="him_wrapper">
            @if(isset($catProducts) && is_countable($catProducts) && count($catProducts))
                @foreach($catProducts as $key => $val)
                    <div class="him_prod">
                        <div class="him_prod_top">
                            @php
                                $imagePath = public_path('images/admin/product_list/' . $val->list_page_img);
                            @endphp
                            @if(isset($val->list_page_img) && $val->list_page_img != '' && file_exists($imagePath))
                                @if(!$category->is_inquiry)
                                    <a href="{{ route('front.product.details', $val->product_url) }}">
                                @endif
                                    <img class="img-fluid img_1" src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}" alt="{{ $val->product_name ?? 'Product Image' }}">
                                @if(!$category->is_inquiry)
                                    </a>
                                @endif
                            @else
                                @if(!$category->is_inquiry)
                                <a href="{{ route('front.product.details', $val->product_url) }}">
                                @endif
                                    <img class="w-100 mb-2 mb-md-4" src="{{ asset('public/noimg.jpg') }}" alt='No Image Found'>
                                @if(!$category->is_inquiry)
                                </a>
                                @endif
                            @endif
                        </div>
                        <h3 class="sub_head mt-2">
                            @if(!$category->is_inquiry)
                            <a href="{{ route('front.product.details', $val->product_url) }}">
                            @endif
                                {{ $val->product_name ?? '' }}
                            @if(!$category->is_inquiry)
                            </a>
                            @endif
                        </h3>
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-semibold text-dark mb-2">AED {{ number_format((float) preg_replace('/[^0-9.]/', '', $val->product_price), 0) }}</p>
                                <p class>{!! $val->short_description ?? '' !!}</p>
                            </div>

                            <div>
                                @if($category->is_inquiry)
                                    <button type="button"
                                        class="com_btn bg-transparent product-inquiry-btn text-nowrap"
                                        data-bs-toggle="modal"
                                        data-bs-target="#productInquiryModal"
                                        data-product-name="{{ $val->product_name ?? '' }}">
                                        Chat on WhatsApp
                                    </button>
                                @else
                                    <a href="{{ route('front.product.details', $val->product_url) }}" class="com_btn text-nowrap">
                                        EXPLORE MORE
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif
           
        </div>
    </div>
</section>
<!-- END - PRODUCT DISPLAY SECTION -->

<!-- START - PERSONALISATION SECTION -->
@if($category->category_url == 'corporate-diwali-gifts-dubai')
<section class="personalisation_section mt_120 mb_120">
    <div class="container">
        <div class="section_header text-center mb-5">
            <p class="sub_head mb-0">
                <span>
                    <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46"></path>
                    </svg>
                </span>
                <span>THE</span>
                <span>
                    <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"></path>
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Personalisation</h2>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 mb-4 mb-md-0 text-center">
                <img class="img-fluid" src="{{ asset('public/images/front/diwali/Personalisation.webp') }}" alt="Personalisation Gift Box">
            </div>
            <div class="col-lg-6 col-md-6 ps-lg-5">
                <h3 class="title_40 mb-3">
                    Every gift includes an individual story card
                </h3>
                <p class="mb-4">
                    Depending on the selected piece, personalisation may include the recipient's name, a company message, a commemorative note, or a photograph or project visual placed inside the frame.
                </p>
                <p class="mb-4">
                    Corporate orders are available in flexible quantities, subject to the selected product and level of personalisation.
                </p>
                <div>
                    <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#requestCorporateProposal">
                        REQUEST A CORPORATE PROPOSAL
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END - PERSONALISATION SECTION -->
@endif
<!-- START - PERSONALISATION FORM -->
@include('front.partials.product-inquiry-modal')
@include('front.partials.festival-inquiry-modal')
<!-- END - PERSONALISATION FORM -->

<!-- START - FAQ SECTION -->
@if(!empty($category->faqs) && is_array($category->faqs) && count($category->faqs) > 0)
<section class="mt_120 mb_120">
    <div class="container">
        <h2 class="title_60 mb-5">FAQs</h2>
        <div class="faq_cont">
            <div class="accordion" id="accordion-category-faq">
                @foreach($category->faqs as $key => $faq)
                    @if(!empty($faq['question']) || !empty($faq['answer']))
                        <div class="faq_cont_acco">
                            <h2 class="according_head sub_head collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-faq-{{ $key }}"
                                aria-expanded="false"
                                aria-controls="collapse-faq-{{ $key }}">
                                {{ $faq['question'] ?? '' }}
                            </h2>

                            <div id="collapse-faq-{{ $key }}"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordion-category-faq">
                                <div class="accordion-body">
                                    <p class="mb-0 text-muted">
                                        {!! nl2br(e($faq['answer'] ?? '')) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- END - FAQ SECTION -->

<!-- START - ABOVE FOOTER SECTION -->
@if(!isset($catSlug) || strtolower($catSlug) != 'luxury-rakshabandhan')
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
                                @if(strtolower($catSlug) == 'luxury-home-decor')
                                Craft Your Majlis.
                                @endif
                                @if(strtolower($catSlug) == 'luxury-gifts-for-her')
                                Objects chosen with care, designed to be lived with.
                                @endif
                                @if(strtolower($catSlug) == 'luxury-gifts-for-him')
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
                    {{-- <a href="javascript:void(0);" class="btn_2">SHOP GIFTS {{$category ? $category->category_name : '' }}</a>    --}}
                </div>
            </div>
        </div>
    </section>
@endif
<!-- END - ABOVE FOOTER SECTION -->

<!-- START - COLLECTIONS PAGE SCHEMA -->
@php

// CURRENT PAGE DATA
$schemaPageUrl = url()->current();
$schemaHomeUrl = url('/');
$schemaCategoryName = $category->category_name ?? '';

// PAGE TITLE
$schemaPageTitle = !empty($category->meta_title)
    ? $category->meta_title
    : $schemaCategoryName . ' | HNOWW';


// PAGE DESCRIPTION
$schemaDescription = !empty($category->meta_description)
    ? $category->meta_description
    : strip_tags($category->description ?? '');

// CATEGORY IMAGE
$schemaImage = null;

if ( !empty($category->celebration_image) && file_exists
        ( public_path('images/admin/category_celebration/' . $category->celebration_image ) ) ) 
{
    $schemaImage = asset('public/images/admin/category_celebration/' . $category->celebration_image );
}
elseif ( !empty($category->banner_image) &&
    file_exists( public_path('images/admin/category_banner/' . $category->banner_image ) ) ) 
{
    $schemaImage = asset( 'public/images/admin/category_banner/' . $category->banner_image );
}

// PRODUCT ITEM LIST
$schemaProducts = [];
if (isset($catProducts) && $catProducts->count() > 0)
{
    foreach ($catProducts as $index => $product)
    {
        $schemaProducts[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $product->product_name ?? '',
        ];
    }
}

// COMPLETE JSON-LD SCHEMA
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [

        // COLLECTION PAGE
        [
            '@type' => 'CollectionPage',
            '@id' => $schemaPageUrl . '#collectionpage',
            'url' => $schemaPageUrl,
            'name' => $schemaPageTitle,
            'description' => $schemaDescription,
            'image' => $schemaImage,
            'isPartOf' => [
                '@type' => 'WebSite',
                '@id' => $schemaHomeUrl . '#website',
                'url' => $schemaHomeUrl,
                'name' => 'HNOWW',
            ],

            'breadcrumb' => [
                '@id' => $schemaPageUrl . '#breadcrumb',
            ],

            'mainEntity' => [
                '@id' => $schemaPageUrl . '#itemlist',
            ],
        ],

        // PRODUCT ITEM LIST
        [
            '@type' => 'ItemList',
            '@id' => $schemaPageUrl . '#itemlist',
            'name' => $schemaCategoryName,
            'description' => $schemaDescription,
            'url' => $schemaPageUrl,
            'numberOfItems' => count($schemaProducts),
            'itemListOrder' =>
                'https://schema.org/ItemListOrderDescending',
            'itemListElement' => $schemaProducts,
        ],

        // BREADCRUMB
        [
            '@type' => 'BreadcrumbList',
            '@id' => $schemaPageUrl . '#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => $schemaHomeUrl,
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Collections',
                    'item' => $schemaHomeUrl . '/collections',
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $schemaCategoryName,
                    'item' => $schemaPageUrl,
                ],
            ],
        ],
    ],
];
@endphp

<script type="application/ld+json">
{!! json_encode(
    $schemaData,
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE |
    JSON_PRETTY_PRINT
) !!}
</script>
<!-- END - COLLECTIONS PAGE SCHEMA -->

<!-- START - FAQ SCHEMA -->
@if(!empty($category->faqs) && is_array($category->faqs) && count($category->faqs) > 0)
    @php
        $schemaFaqs = [];
        foreach ($category->faqs as $faq)
        {
            $question = trim($faq['question'] ?? '');
            $answer = trim($faq['answer'] ?? '');

            if (!empty($question) && !empty($answer))
            {
                $schemaFaqs[] = [
                    '@type' => 'Question',
                    'name' => strip_tags($question),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => trim(
                            preg_replace(
                                '/\s+/',
                                ' ',
                                strip_tags($answer)
                            )
                        ),
                    ],
                ];
            }
        }

        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $schemaFaqs,
        ];
    @endphp

    @if(count($schemaFaqs) > 0)
        <script type="application/ld+json">
            {!! json_encode(
                $faqSchema,
                JSON_UNESCAPED_SLASHES |
                JSON_UNESCAPED_UNICODE |
                JSON_PRETTY_PRINT
            ) !!}
        </script>
    @endif
@endif
<!-- END - FAQ SCHEMA  -->

@include('layouts.frontfooter')

<script>
    $(document).ready(function () {
        var productElement = $('#product_of_interest')[0];

        if (productElement) {
            new Choices(productElement, {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Select products',
                searchEnabled: true,
            });
        }
    });

    $(document).on('click', '.product-inquiry-btn', function () {
        let productName = $(this).data('product-name');

        $('#productInquiryProductName').val(productName);
    });
</script>