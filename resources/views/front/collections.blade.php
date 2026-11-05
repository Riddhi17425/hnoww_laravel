@include('layouts.frontheader', [
    'meta_title' => $meta_title ?? '',
    'meta_description' => $meta_description ?? ''
])

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/for-him-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Collections</h2>
       
    </div>
</section>

<section class="mt_60">
    <div class="container">
        <style>
            .col_filter { width: 100%; text-align: left; }
            .col_filter_toggle { display: inline-flex; align-items: center; gap: 10px; padding: 8px 20px; color: #fff; background: #8c8a72; border: 1px solid #8c8a72; border-radius: 0; font-weight: 600; letter-spacing: .04em; transition: .25s; }
            .col_filter_toggle:hover, .col_filter_toggle[aria-expanded="true"] { background: #7a785f; border-color: #7a785f; }
            .col_filter_toggle svg { width: 18px; height: 18px; color: #fff; transition: transform .25s; }
            .col_filter_toggle[aria-expanded="true"] .chev { transform: rotate(180deg); }
            .col_filter_panel { position: relative; margin-top: 10px; padding: 12px 20px; background: linear-gradient(135deg, #fffdf9 0%, #f5efe7 100%); border: 1px solid #d9d7c8; border-top: 3px solid #8c8a72; border-radius: 0; }
            .col_filter_group { display: flex; align-items: center; gap: 20px; }
            .col_filter_group + .col_filter_group { margin-top: 8px; padding-top: 8px; border-top: 1px dashed rgba(140, 138, 114, .4); }
            .col_filter_title { flex: 0 0 110px; margin: 0; font-size: 12px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; color: #8c8a72; }
            .col_filter_chips { display: flex; flex-wrap: wrap; gap: 8px; }
            .col_chip { padding: 4px 14px; font-size: 13px; font-weight: 500; color: #574d3d; background: #fff; border: 1px solid #d9d7c8; border-radius: 0; cursor: pointer; transition: .2s; }
            .col_chip:hover { color: #8c8a72; border-color: #8c8a72; transform: translateY(-2px); }
            .col_chip.active { color: #fff; background: #8c8a72; border-color: #8c8a72; }
            /* No shadows anywhere in the filter (also overrides Bootstrap / theme focus & hover shadows) */
            .col_filter, .col_filter * { box-shadow: none !important; }
            @media (max-width: 575px) {
                .col_filter_panel { padding: 12px; }
                .col_filter_group { flex-direction: column; align-items: flex-start; gap: 6px; }
                .col_filter_title { flex-basis: auto; }
            }
        </style>
        <div class="section_header mb-4">
            <div class="col_filter">
                @php $filterActive = request('category_id') || request('price_range'); @endphp
                <button type="button" class="col_filter_toggle" data-bs-toggle="collapse" data-bs-target="#collectionFilterPanel"
                    aria-expanded="{{ $filterActive ? 'true' : 'false' }}" aria-controls="collectionFilterPanel">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5h18M6 12h12M10 19h4"></path></svg>
                    Filters
                    <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>
                </button>

                <div class="collapse {{ $filterActive ? 'show' : '' }}" id="collectionFilterPanel">
                    <div class="col_filter_panel">
                        {{-- Hidden inputs keep the ids used by the ajax script below --}}
                        <input type="hidden" id="collection_category_filter" value="{{ request('category_id') }}" autocomplete="off">
                        <input type="hidden" id="collection_price_filter" value="{{ request('price_range') }}" autocomplete="off">

                        <div class="col_filter_group">
                            <h3 class="col_filter_title">Recipient</h3>
                            <div class="col_filter_chips" data-target="#collection_category_filter">
                                <button type="button" class="col_chip" data-value="">All</button>
                                @foreach($categories->where('is_festive', 0) as $category)
                                    <button type="button" class="col_chip" data-value="{{ $category->id }}">{{ $category->category_name }}</button>
                                @endforeach
                            </div>
                        </div>

                        @if($categories->where('is_festive', 1)->isNotEmpty())
                            {{-- Festive categories: separate row, same category filter (both "All" pills clear it) --}}
                            <div class="col_filter_group">
                                <h3 class="col_filter_title">Festive</h3>
                                <div class="col_filter_chips" data-target="#collection_category_filter">
                                    <button type="button" class="col_chip" data-value="">All</button>
                                    @foreach($categories->where('is_festive', 1) as $category)
                                        <button type="button" class="col_chip" data-value="{{ $category->id }}">{{ $category->category_name }}</button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="col_filter_group">
                            <h3 class="col_filter_title">Price (AED)</h3>
                            <div class="col_filter_chips" data-target="#collection_price_filter">
                                <button type="button" class="col_chip" data-value="">All</button>
                                @if(!empty($priceRanges))
                                    @foreach($priceRanges as $range)
                                        <button type="button" class="col_chip" data-value="{{ $range['value'] }}">{{ $range['label'] }}</button>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="collection-list-wrapper">
            @include('front.partials.collection-list', ['collections' => $collections])
        </div>
    </div>
</section>
@include('front.partials.product-inquiry-modal')
@include('front.partials.festival-inquiry-modal')

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
        </div>
    </div>
</section>

@push('script')
<script>
    $(document).ready(function () {
        const collectionsBaseUrl = '{{ route('front.collections') }}';

        function fetchCollections(url, pushState = true) {
            const targetUrl = url || collectionsBaseUrl;
            const categoryId = $('#collection_category_filter').val() || '';
            const priceRange = $('#collection_price_filter').val() || '';

            const urlObj = new URL(targetUrl, window.location.origin);
            if (categoryId) {
                urlObj.searchParams.set('category_id', categoryId);
            } else if (!url) {
                urlObj.searchParams.delete('category_id');
            }

            if (priceRange) {
                urlObj.searchParams.set('price_range', priceRange);
            } else if (!url) {
                urlObj.searchParams.delete('price_range');
            }

            $.ajax({
                url: urlObj.toString(),
                type: 'GET',
                beforeSend: function () {
                    $('#collection-list-wrapper').css({
                        'opacity': '0.4',
                        'transition': 'opacity 0.2s ease',
                        'pointer-events': 'none'
                    });
                },
                success: function (response) {
                    $('#collection-list-wrapper').html(response);
                    $('#collection-list-wrapper').css({
                        'opacity': '1',
                        'pointer-events': 'auto'
                    });

                    if (pushState) {
                        history.pushState(null, '', urlObj.toString());
                    }
                },
                error: function (xhr) {
                    $('#collection-list-wrapper').css({
                        'opacity': '1',
                        'pointer-events': 'auto'
                    });
                    console.error('Failed to load collections:', xhr);
                }
            });
        }

        // Highlight the chip matching each hidden input's current value
        function syncChips() {
            $('.col_filter_chips').each(function () {
                const value = String($($(this).data('target')).val() || '');
                const chips = $(this).find('.col_chip');
                // If the value belongs to another row sharing this input, this row shows "All"
                const hasMatch = chips.filter(function () { return String($(this).data('value')) === value && value !== ''; }).length > 0;
                chips.each(function () {
                    const chipValue = String($(this).data('value'));
                    $(this).toggleClass('active', hasMatch ? chipValue === value : chipValue === '');
                });
            });
        }
        syncChips();

        // Chip click: set the hidden input, then reload (resets to page 1)
        $('.col_chip').on('click', function () {
            $($(this).parent().data('target')).val($(this).data('value'));
            syncChips();
            fetchCollections(collectionsBaseUrl, true);
        });

        // AJAX pagination click event
        $(document).on('click', '#collection-list-wrapper .pagination a', function (e) {
            e.preventDefault();
            const pageUrl = $(this).attr('href');
            if (pageUrl && pageUrl !== '#' && pageUrl !== 'javascript:void(0)') {
                fetchCollections(pageUrl, true);

                $('html, body').animate({
                    scrollTop: $('#collection-list-wrapper').offset().top - 120
                }, 400);
            }
        });

        // Handle browser Back / Forward buttons
        window.addEventListener('popstate', function () {
            const currentParams = new URLSearchParams(window.location.search);
            const catId = currentParams.get('category_id') || '';
            const pRange = currentParams.get('price_range') || '';

            $('#collection_category_filter').val(catId);
            $('#collection_price_filter').val(pRange);
            syncChips();

            fetchCollections(window.location.href, false);
        });
    });

    $(document).on('click', '.product-inquiry-btn', function () {
        let productName = $(this).data('product-name');

        $('#productInquiryProductName').val(productName);
    });
</script>
@endpush

<!-- START - COLLECTIONS PAGE SCHEMA -->
@php

$schemaHomeUrl = url('/');
$schemaPageUrl = url()->current();

// PAGE META DATA
$schemaPageTitle = !empty($meta_title)
    ? $meta_title
    : 'HNOWW Collections | Curated Luxury Gifts & Home Decor';

$schemaDescription = !empty($meta_description)
    ? $meta_description
    : "Explore HNOWW's curated collections of luxury gifts and home decor.";

// COLLECTION PAGE IMAGE
$schemaImage = asset(
    'public/images/front/for-him-banner.webp'
);

// PRODUCT ITEM LIST
$schemaItems = [];
if (isset($collections) && $collections->count() > 0)
{
    foreach ($collections as $index => $collection)
    {
        $schemaItems[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $collection->product_name ?? '',
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
        [
            '@type' => 'ItemList',
            '@id' => $schemaPageUrl . '#itemlist',
            'name' => 'HNOWW Collections',
            'description' => $schemaDescription,
            'url' => $schemaPageUrl,
            'numberOfItems' => count($schemaItems),
            'itemListElement' => $schemaItems,
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

@include('layouts.frontfooter')
