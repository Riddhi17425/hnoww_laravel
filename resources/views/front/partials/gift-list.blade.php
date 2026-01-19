<div class="row gy-4 gy-md-0">
@if($allGifts->isNotEmpty())
    @foreach ($allGifts as $val)
        <div class="col-md-4">
            <div class="gesture_box">
                <img class="img-fluid mb-2 mb-md-4"
                     src="{{ asset('public/images/admin/gifts/product_list/'.$val->list_page_img) }}">
                <div class="desire_box_bot_child">
                    <div>
                        <h3 class="sub_head">{{ $val->product_name }}</h3>
                        <p class="mb-0">{!! $val->short_description !!}</p>
                    </div>
                    <a href="{{ route('front.gift.details', $val->product_url) }}">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path d="M30.8334 9.16675L9.16669 30.8334M30.8334 9.16675H14.1667M30.8334 9.16675V25.8334"
                                    stroke="#8c8a72" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center">
        <img src="{{ asset('public/images/product-not-found.png') }}" alt="Gifts not found">
    </div>
@endif
</div>
