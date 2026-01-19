@include('layouts.frontheader')
@push('style')
<style>
.theme-green .header-scrolled {
    /*background: #EDEAE4;*/
}

.theme-green .language-select .dropdown-input-lan
{
    color: #0e2233;
}

@media (max-width:767px) {
.sticky-header
{
     /*background: #EDEAE4;*/
}
}
</style>
@endpush

<section class="mt_60 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="pro_details">
                    <div class="left nav flex-column" id="productTab" role="tablist">
                        @if(isset($productDetailImages) && $productDetailImages != '')
                            @foreach($productDetailImages as $key => $val)
                                <button class="nav-link @if($key == 0) active @endif" 
                                        data-bs-toggle="tab" 
                                        data-bs-target="#img1_{{ $key }}"> {{-- ✅ fix here --}}
                                    <img src="{{ asset('public/images/admin/gifts/product_detail/'.$val)}}" alt="Sample Product">
                                </button>
                            @endforeach
                        @endif
                    </div>

                    <div class="tab-content">
                        @if(isset($productDetailImages) && $productDetailImages != '')
                            @foreach($productDetailImages as $key => $val)
                                <div class="tab-pane fade show @if($key == 0) active @endif" 
                                    id="img1_{{ $key }}"> {{-- ✅ fix here --}}
                                    <div class="zoom-container">
                                        <img class="zoom-image img-fluid" src="{{ asset('public/images/admin/gifts/product_detail/'.$val)}}" alt="Product Detail Image">
                                        <div class="zoom-lens"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-lg-5">
                <div class="pro_details_right">
                    <h2 class="main_head">{{ $product->product_name ?? '' }}</h2>
                    <p class="sub_head_inter para">{!! $product->short_description ?? '' !!}</p>
                    <h4 class="sub_head_inter">AED {{ $product->product_price ?? '' }}</h4>

                    <div class="increment_decrement_area">
                        <div class="increment_decrement">
                        <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry">Enquire Now </a>
                    </div>
                </div>

                @if(isset($product->large_description) && $product->large_description != '')
                <h4 class="sub_head mb-4">The Story</h4>
                <div class="mb-4">
                    {!! $product->large_description ?? '' !!}
                </div>
                @endif
                @if(isset($product->dimensions) && $product->dimensions != '')
                <h4 class="sub_head mb-4">Material</h4>
                <div class="pro_details_info_list">
                    {!! $product->dimensions ?? '' !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if(isset($productTab) && is_countable($productTab) && count($productTab) > 0) 
<section class="mt_60 mb-5">
    <div class="container">
        <div class="modern-tabs">
            <ul class="nav nav-tabs" id="filledTabs" role="tablist">
                @foreach($productTab as $key => $val)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($key == 0) active @endif"  {{-- ✅ first tab active --}}
                                id="tab-{{ $key }}"                                 {{-- ✅ unique ID --}}
                                data-bs-toggle="tab" 
                                data-bs-target="#tab-content-{{ $key }}"            {{-- ✅ unique target --}}
                                type="button" role="tab" 
                                aria-controls="tab-content-{{ $key }}" 
                                aria-selected="@if($key == 0) true @else false @endif">
                            {{ $val->title ?? '' }}
                        </button>
                    </li>
                @endforeach
                <!-- TAB 2 -->
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-content-3"
                        type="button" role="tab" aria-controls="tab-content-3" aria-selected="false">
                        Materials & Craft
                    </button>
                </li> --}}

            </ul>

            <div class="tab-content" id="filledTabsContent">
            @foreach($productTab as $key => $val)
                <div class="tab-pane fade @if($key == 0) show active @endif" {{-- ✅ only first tab active --}}
                    id="tab-content-{{ $key }}" 
                    role="tabpanel" 
                    aria-labelledby="tab-{{ $key }}">
                    {!! $val->details ?? '' !!}
                </div>
            @endforeach
            
            </div>
        </div>
    </div>
</section>
@endif

<section class="mt_80 mb_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Pairs</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Similar Products</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            @if(isset($similarProduct) && is_countable($similarProduct) && count($similarProduct) > 0)
                @foreach($similarProduct as $key => $val)
                    <div class="col-md-4">
                        <a class="him_prod" href="{{ route('front.gift.details', $val->product_url) }}">
                            <div class="him_prod_top mb-2 mb-md-4">
                                <img class="img-fluid img_1" src="{{ isset($val->list_page_img) ? asset('public/images/admin/gifts/product_list/'.$val->list_page_img) : '' }}" alt="{{ $val->product_name ?? 'Product Image' }}">
                            </div>
                            <div>
                                <div>
                                    <h3 class="sub_head">{{ $val->product_name ?? '' }}</h3>
                                    <p class="mb-0">{!! $val->short_description ?? '' !!}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
</section>

<div class="modal fade audio_modal" id="productInquiry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0">
                        <h5 class="modal-title" id="productInquiryLabel">Product Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="productInquiryForm" action="{{ route('front.store.product.inquiry') }}">
                        @csrf
                        <input type="hidden" value="gift" name="inquiry_for">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Inquiry For Product</label>
                        <input type="text" class="form-control mb-3" value="{{ $product->product_name ?? '' }}" disabled>
                        <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email"
                                placeholder="Enter Your Email Address"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text"
                                name="contact_no"
                                placeholder="Enter your Whatsapp Phone Number"
                                value="{{ old('contact_no') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                class="form-control @error('contact_no') is-invalid @enderror">

                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message"
                                    rows="4"
                                    placeholder="Enter Message"
                                    class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="com_btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="com_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>

</script>
@endpush

@include('layouts.frontfooter')