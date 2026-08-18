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
        <div class="section_header mb-4">
            <div class="gesture_filter">
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">Category</h3>
                    <select id="collection_category_filter" class="dropdown">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">Price</h3>
                    <select id="collection_price_filter" class="dropdown">
                        <option value="">Select Price</option>
                        @if(!empty($priceRanges))
                            @foreach($priceRanges as $range)
                                <option value="{{ $range['value'] }}" {{ request('price_range') == $range['value'] ? 'selected' : '' }}>
                                    {{ $range['label'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div id="collection-list-wrapper">
            @include('front.partials.collection-list', ['collections' => $collections])
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

        // Filter dropdown change event (resets to page 1)
        $('#collection_category_filter, #collection_price_filter').on('change', function () {
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

            fetchCollections(window.location.href, false);
        });
    });
</script>
@endpush

@include('layouts.frontfooter')
