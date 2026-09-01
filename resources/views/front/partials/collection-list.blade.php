<div class="him_wrapper">
    @if(isset($collections) && $collections->isNotEmpty())
        @foreach($collections as $key => $val)
            <div class="him_prod" data-category-id="{{ $val->category_id ?? '' }}" data-product-price="{{ $val->product_price ?? '' }}">
                <div class="him_prod_top">
                    @php
                        $imagePath = public_path('images/admin/product_list/' . $val->list_page_img);
                    @endphp
                    @if(isset($val->list_page_img) && $val->list_page_img != '' && file_exists($imagePath))
                        @if(!$val->category->is_inquiry)
                        <a href="{{ route('front.product.details', $val->product_url) }}">
                        @endif
                            <img class="img-fluid img_1" src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}" alt="{{ $val->product_name ?? 'Product Image' }}">
                        @if(!$val->category->is_inquiry)
                        </a>
                        @endif
                    @else
                        @if(!$val->category->is_inquiry)
                        <a href="{{ route('front.product.details', $val->product_url) }}">
                        @endif
                            <img class="w-100 mb-2 mb-md-4" src="{{ asset('public/noimg.jpg') }}" alt='No Image Found'>
                        @if(!$val->category->is_inquiry)    
                        </a>
                        @endif
                    @endif
                </div>
                 <h3 class="sub_head mt-2">
                    @if(!$val->category->is_inquiry)
                    <a href="{{ route('front.product.details', $val->product_url) }}">
                    @endif
                        {{ $val->product_name ?? '' }}
                    @if(!$val->category->is_inquiry)
                    </a>
                    @endif
                </h3>
                <div class="d-lg-flex justify-content-between align-items-center">
                 <div>
                   
                    <p class="fw-semibold text-dark mb-2">AED {{ number_format((float) preg_replace('/[^0-9.]/', '', $val->product_price), 0) }}</p>
                    <p class>{!! $val->short_description ?? '' !!}</p>
                </div>
                <div>
                    @if($val->category && $val->category->is_inquiry)
                        <button type="button"
                            class="com_btn bg-transparent product-inquiry-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#productInquiryModal"
                            data-product-name="{{ $val->product_name ?? '' }}">
                            Chat On WhatsApp
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