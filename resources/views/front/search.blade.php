@include('layouts.frontheader', [
    'meta_title' => $meta_title ?? 'Search Results',
    'meta_description' => $meta_description ?? 'Search results on HNOWW'
])

<style>
.search_hero_section {
    background: #f8f6f0;
    padding: 60px 0 40px;
    text-align: center;
    border-bottom: 1px solid #eae6df;
}
.search_page_title {
    font-size: 32px;
    font-weight: 300;
    color: #111111;
    margin-bottom: 10px;
    font-family: var(--font-primary, serif);
}
.search_page_subtitle {
    font-size: 14px;
    color: #666666;
    margin-bottom: 25px;
}
.search_refine_form {
    max-width: 600px;
    margin: 0 auto 20px;
    display: flex;
    gap: 8px;
    background: #ffffff;
    padding: 6px 6px 6px 16px;
    border-radius: 30px;
    border: 1px solid #dcd6cd;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
}
.search_refine_input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 15px;
    background: transparent;
    color: #111;
}
.search_refine_btn {
    background: #111111;
    color: #ffffff;
    border: none;
    padding: 10px 24px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.search_refine_btn:hover {
    background: #333333;
}
.search_tabs_container {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 25px;
}
.search_tab_btn {
    padding: 8px 18px;
    font-size: 13px;
    font-weight: 500;
    color: #555555;
    background: #ffffff;
    border: 1px solid #dcd6cd;
    border-radius: 20px;
    text-decoration: none;
    transition: all 0.2s;
}
.search_tab_btn:hover, .search_tab_btn.active {
    background: #111111;
    color: #ffffff;
    border-color: #111111;
    text-decoration: none;
}
.search_controls_bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #eeeeee;
    margin-bottom: 30px;
}
.search_results_count {
    font-size: 14px;
    color: #555555;
}
.search_sort_select {
    padding: 6px 14px;
    font-size: 13px;
    border: 1px solid #cccccc;
    border-radius: 4px;
    outline: none;
    background: #ffffff;
}
.search_category_card {
    background: #fdfcf9;
    border: 1px solid #eae5db;
    border-radius: 8px;
    padding: 20px;
    text-decoration: none;
    color: #111;
    display: block;
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
}
.search_category_card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    color: #111;
    text-decoration: none;
}
.search_blog_card {
    border: 1px solid #eee;
    border-radius: 8px;
    overflow: hidden;
    height: 100%;
    background: #fff;
    transition: transform 0.2s;
}
.search_blog_card:hover {
    transform: translateY(-3px);
}
.search_blog_img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
.search_blog_content {
    padding: 16px;
}
.search_empty_box {
    text-align: center;
    padding: 60px 20px;
    background: #fafafa;
    border-radius: 12px;
    margin: 40px 0;
}
.search_empty_icon {
    width: 64px;
    height: 64px;
    margin-bottom: 16px;
    opacity: 0.4;
}
</style>

<!-- Hero Section -->
<section class="search_hero_section">
    <div class="container">
        @if(!empty($query))
            <h1 class="search_page_title">Search Results for "{{ $query }}"</h1>
            <p class="search_page_subtitle">Found {{ $totalResults }} {{ Str::plural('result', $totalResults) }}</p>
        @else
            <h1 class="search_page_title">Search Our Collection</h1>
            <p class="search_page_subtitle">Type a product name, category, or gift idea below</p>
        @endif

        <form action="{{ route('front.search') }}" method="GET" class="search_refine_form">
            <input type="text" name="q" value="{{ $query }}" class="search_refine_input" placeholder="Search products, collections, blogs..." autocomplete="off">
            <button type="submit" class="search_refine_btn">Search</button>
        </form>

        <div class="search_tabs_container">
            <a href="{{ route('front.search', ['q' => $query, 'tab' => 'all', 'sort' => $sort]) }}" class="search_tab_btn {{ $tab == 'all' ? 'active' : '' }}">
                All Results ({{ $totalResults }})
            </a>
            <a href="{{ route('front.search', ['q' => $query, 'tab' => 'products', 'sort' => $sort]) }}" class="search_tab_btn {{ $tab == 'products' ? 'active' : '' }}">
                Products ({{ $products->total() }})
            </a>
            <a href="{{ route('front.search', ['q' => $query, 'tab' => 'categories', 'sort' => $sort]) }}" class="search_tab_btn {{ $tab == 'categories' ? 'active' : '' }}">
                Collections ({{ $categories->count() }})
            </a>
            <a href="{{ route('front.search', ['q' => $query, 'tab' => 'blogs', 'sort' => $sort]) }}" class="search_tab_btn {{ $tab == 'blogs' ? 'active' : '' }}">
                Articles ({{ $blogs->count() }})
            </a>
        </div>
    </div>
</section>

<!-- Results Main Content -->
<section class="mt_40 mb_80">
    <div class="container">
        @if($totalResults > 0)
            <div class="search_controls_bar">
                <div class="search_results_count">
                    Showing results for <strong>"{{ $query }}"</strong>
                </div>
                <div>
                    <label for="search_sort" class="me-2 text-muted small">Sort by:</label>
                    <select id="search_sort" class="search_sort_select" onchange="location = this.value;">
                        <option value="{{ route('front.search', ['q' => $query, 'tab' => $tab, 'sort' => 'newest']) }}" {{ $sort == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="{{ route('front.search', ['q' => $query, 'tab' => $tab, 'sort' => 'price_low']) }}" {{ $sort == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="{{ route('front.search', ['q' => $query, 'tab' => $tab, 'sort' => 'price_high']) }}" {{ $sort == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="{{ route('front.search', ['q' => $query, 'tab' => $tab, 'sort' => 'name_asc']) }}" {{ $sort == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                    </select>
                </div>
            </div>

            <!-- Products Section -->
            @if(($tab == 'all' || $tab == 'products') && $products->count() > 0)
                <div class="mb-5">
                    @if($tab == 'all')
                        <h3 class="gesture_title mb-3">Products ({{ $products->total() }})</h3>
                    @endif
                    
                    <div class="him_wrapper">
                        @foreach($products as $val)
                            <div class="him_prod">
                                <div class="him_prod_top">
                                    @php
                                        $imagePath = public_path('images/admin/product_list/' . $val->list_page_img);
                                    @endphp
                                    @if(isset($val->list_page_img) && $val->list_page_img != '' && file_exists($imagePath))
                                        <a href="{{ route('front.product.details', $val->product_url) }}">
                                            <img class="img-fluid img_1" src="{{ asset('public/images/admin/product_list/'.$val->list_page_img) }}" alt="{{ $val->product_name ?? 'Product Image' }}">
                                        </a>
                                    @else
                                        <a href="{{ route('front.product.details', $val->product_url) }}">
                                            <img class="w-100 mb-2 mb-md-4" src="{{ asset('public/noimg.jpg') }}" alt="No Image Found">
                                        </a>
                                    @endif
                                </div>
                                <h3 class="sub_head mt-2">
                                    <a href="{{ route('front.product.details', $val->product_url) }}">
                                        {{ $val->product_name ?? '' }}
                                    </a>
                                </h3>
                                <div class="d-lg-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="fw-semibold text-dark mb-2">AED {{ number_format((float) preg_replace('/[^0-9.]/', '', $val->product_price), 0) }}</p>
                                        <p>{!! Str::limit(strip_tags($val->short_description ?? ''), 60) !!}</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('front.product.details', $val->product_url) }}" class="com_btn text-nowrap">
                                            EXPLORE MORE
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif

            <!-- Collections Section -->
            @if(($tab == 'all' || $tab == 'categories') && $categories->count() > 0)
                <div class="mb-5">
                    @if($tab == 'all')
                        <h3 class="gesture_title mb-3">Collections & Categories ({{ $categories->count() }})</h3>
                    @endif

                    <div class="row g-3">
                        @foreach($categories as $cat)
                            <div class="col-md-4 col-sm-6">
                                <a href="{{ route('front.list', $cat->category_url) }}" class="search_category_card">
                                    <h4 class="fw-semibold mb-1" style="font-size: 16px;">{{ $cat->category_name }}</h4>
                                    <p class="text-muted small mb-0">{{ Str::limit(strip_tags($cat->description ?? ''), 80) }}</p>
                                    <span class="text-dark small fw-semibold mt-2 d-inline-block">Explore Collection &rarr;</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Articles / Blog Section -->
            @if(($tab == 'all' || $tab == 'blogs') && $blogs->count() > 0)
                <div class="mb-5">
                    @if($tab == 'all')
                        <h3 class="gesture_title mb-3">Articles & Journal ({{ $blogs->count() }})</h3>
                    @endif

                    <div class="row g-4">
                        @foreach($blogs as $blog)
                            <div class="col-md-4 col-sm-6">
                                <div class="search_blog_card">
                                    @if($blog->front_image && file_exists(public_path('images/admin/blogs/' . $blog->front_image)))
                                        <img src="{{ asset('public/images/admin/blogs/' . $blog->front_image) }}" alt="{{ $blog->title }}" class="search_blog_img">
                                    @endif
                                    <div class="search_blog_content">
                                        <h4 class="fw-semibold mb-2" style="font-size: 15px;">
                                            <a href="{{ route('front.blog.detail', $blog->url) }}" class="text-dark text-decoration-none">
                                                {{ $blog->title }}
                                            </a>
                                        </h4>
                                        <p class="text-muted small mb-3">{{ Str::limit(strip_tags($blog->short_description ?? ''), 90) }}</p>
                                        <a href="{{ route('front.blog.detail', $blog->url) }}" class="small fw-bold text-dark text-uppercase" style="letter-spacing: 0.5px;">Read Article &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="search_empty_box">
                <svg class="search_empty_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <h3 class="fw-light mb-2">No results found for "{{ $query }}"</h3>
                <p class="text-muted small mb-4">Please check for spelling errors or try searching for another term.</p>
                
                <a href="{{ route('front.collections') }}" class="com_btn d-inline-block">Browse Collections</a>
            </div>
        @endif
    </div>
</section>

@include('layouts.frontfooter')
