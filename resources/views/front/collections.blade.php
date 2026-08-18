@include('layouts.frontheader', [
    'meta_title' => '',
    'meta_description' => ''
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
                    <input type="hidden" id="collection_category_filter" value="{{ request('category_id') }}">
                    <div class="dropdown custom-filter-dropdown">
                        @php
                            $selectedCatName = 'Select Category';
                            foreach($categories as $category) {
                                if (request('category_id') == $category->id) {
                                    $selectedCatName = $category->category_name;
                                    break;
                                }
                            }
                        @endphp
                        <button class="btn dropdown-toggle" type="button" id="categoryDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $selectedCatName }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoryDropdownBtn">
                            <li><a class="dropdown-item {{ request('category_id') == '' ? 'active' : '' }}" href="javascript:void(0)" onclick="document.getElementById('collection_category_filter').value=''; window.location='{{ route('front.collections') }}?'+buildCollectionsQuery('', document.getElementById('collection_price_filter').value)">Select Category</a></li>
                            @foreach($categories as $category)
                                <li><a class="dropdown-item {{ request('category_id') == $category->id ? 'active' : '' }}" href="javascript:void(0)" onclick="document.getElementById('collection_category_filter').value='{{ $category->id }}'; window.location='{{ route('front.collections') }}?'+buildCollectionsQuery('{{ $category->id }}', document.getElementById('collection_price_filter').value)">{{ $category->category_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">Price</h3>
                    <input type="hidden" id="collection_price_filter" value="{{ request('price_range') }}">
                    <div class="dropdown custom-filter-dropdown">
                        @php
                            $selectedPriceName = 'Select Price';
                            if(!empty($priceRanges)){
                                foreach($priceRanges as $range) {
                                    if (request('price_range') == $range['value']) {
                                        $selectedPriceName = $range['label'];
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <button class="btn dropdown-toggle" type="button" id="priceDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $selectedPriceName }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="priceDropdownBtn">
                            <li><a class="dropdown-item {{ request('price_range') == '' ? 'active' : '' }}" href="javascript:void(0)" onclick="document.getElementById('collection_price_filter').value=''; window.location='{{ route('front.collections') }}?'+buildCollectionsQuery(document.getElementById('collection_category_filter').value, '')">Select Price</a></li>
                            @if(!empty($priceRanges))
                                @foreach($priceRanges as $range)
                                    <li><a class="dropdown-item {{ request('price_range') == $range['value'] ? 'active' : '' }}" href="javascript:void(0)" onclick="document.getElementById('collection_price_filter').value='{{ $range['value'] }}'; window.location='{{ route('front.collections') }}?'+buildCollectionsQuery(document.getElementById('collection_category_filter').value, '{{ $range['value'] }}')">{{ $range['label'] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="him_wrapper">
            @if(isset($collections) && $collections->isNotEmpty())
                @foreach($collections as $key => $val)
                    <div class="him_prod">
                        <div class="him_prod_top">
                            @php
                                $imagePath = public_path('images/admin/product_list/' . $val->list_page_img);
                            @endphp
                            @if(isset($val->list_page_img) && $val->list_page_img != '' && file_exists($imagePath))
                                <a href="{{ route('front.product.details', $val->product_url) }}"><img class="img-fluid img_1" src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}" alt="{{ $val->product_name ?? 'Product Image' }}"></a>
                            @else
                                <a href="{{ route('front.product.details', $val->product_url) }}"><img class="w-100 mb-2 mb-md-4" src="{{ asset('public/noimg.jpg') }}" alt='No Image Found'></a>
                            @endif
                        </div>
                         <h3 class="sub_head mt-2"><a href="{{ route('front.product.details', $val->product_url) }}">{{ $val->product_name ?? '' }}</a></h3>
                       <div class="d-lg-flex justify-content-between align-items-center">
                         <div>
                           
                            <p class="fw-semibold text-dark mb-2">AED {{ number_format((float) preg_replace('/[^0-9.]/', '', $val->product_price), 0) }}</p>
                            <p class>{!! $val->short_description ?? '' !!}</p>
                        </div>
                        <div>
                            <a href="{{ route('front.product.details', $val->product_url) }}" class="com_btn">VIEW OBJECT </a>
                        </div>
                       </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <img src="{{ asset('public/images/product-not-found.png') }}" alt="Collection products not found">
                </div>
            @endif
        </div>

        @if($collections->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $collections->links() }}
            </div>
        @endif
    </div>
</section>

<script>
    function buildCollectionsQuery(categoryId, priceRange) {
        const params = new URLSearchParams();

        if (categoryId) {
            params.set('category_id', categoryId);
        }

        if (priceRange) {
            params.set('price_range', priceRange);
        }

        return params.toString();
    }
</script>

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
@include('layouts.frontfooter')
