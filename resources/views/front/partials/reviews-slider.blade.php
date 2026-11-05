{{-- Auto-scrolling reviews strip (pauses on hover). Expects: $reviews (collection), $title (section heading) --}}
@if(isset($reviews) && $reviews->count() > 0)
@php
    // Repeat the set so the strip is always wide enough, then render it twice for a seamless loop
    $repeat   = (int) ceil(6 / $reviews->count());
    $cards    = collect(range(1, $repeat))->flatMap(fn () => $reviews);
    $duration = max(30, $cards->count() * 7); // seconds for one full loop
@endphp
<style>
    .hn_reviews .review_marquee { overflow: hidden; padding: 12px 0 24px; -webkit-mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent); mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent); }
    .hn_reviews .review_track { display: flex; width: max-content; animation: reviewScroll var(--review-duration) linear infinite; }
    .hn_reviews .review_marquee:hover .review_track { animation-play-state: paused; }
    .hn_reviews .review_group { display: flex; gap: 24px; padding-right: 24px; }
    @keyframes reviewScroll { to { transform: translateX(-50%); } }

    .hn_reviews .review_card { position: relative; flex: 0 0 360px; width: 360px; padding: 34px 28px 26px; background: linear-gradient(135deg, #fffdf9 0%, #f5efe7 100%); border: 1px solid #e7d7b6; border-top: 3px solid #b58a46; text-align: left; box-shadow: 0 8px 22px rgba(9, 25, 35, .06); transition: transform .25s ease, box-shadow .25s ease; }
    .hn_reviews .review_card:hover { transform: translateY(-6px); box-shadow: 0 16px 32px rgba(181, 138, 70, .22); }
    .hn_reviews .review_card::before { content: "\201C"; position: absolute; top: 4px; right: 20px; font-family: Georgia, serif; font-size: 80px; line-height: 1; color: rgba(181, 138, 70, .22); }
    .hn_reviews .review_stars { color: #b58a46; font-size: 18px; letter-spacing: 2px; margin-bottom: 12px; }
    .hn_reviews .review_stars .off { color: #d9ccb2; }
    .hn_reviews .review_text { margin: 0 0 22px; font-size: 15px; line-height: 1.7; color: #3d3a33; display: -webkit-box; -webkit-line-clamp: 5; -webkit-box-orient: vertical; overflow: hidden; }
    .hn_reviews .review_author { display: flex; align-items: center; gap: 12px; padding-top: 16px; border-top: 1px solid rgba(181, 138, 70, .25); }
    .hn_reviews .review_avatar { flex: 0 0 46px; width: 46px; height: 46px; border-radius: 50%; object-fit: cover; background: #b58a46; color: #fff; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; border: 2px solid #fff; box-shadow: 0 0 0 1px #e7d7b6; }
    .hn_reviews .review_name { display: block; font-weight: 600; color: #0e2233; }
    .hn_reviews .review_city { display: block; font-size: 13px; color: #8a7a5c; }

    /* No shadows in the reviews section */
    .hn_reviews, .hn_reviews * { box-shadow: none !important; }
    @media (max-width: 575px) {
        .hn_reviews .review_card { flex-basis: 280px; width: 280px; padding: 30px 20px 22px; }
    }
    /* Accessibility: no motion -> make the strip manually scrollable instead */
    @media (prefers-reduced-motion: reduce) {
        .hn_reviews .review_marquee { overflow-x: auto; }
        .hn_reviews .review_track { animation: none; }
    }
</style>
<section class="mt_120 mb_120 hn_reviews">
    <div class="container">
        <div class="section_header">
            <h2 class="title_60">{{ $title ?? 'What Our Clients Say' }}</h2>
        </div>
    </div>
    <div class="review_marquee">
        <div class="review_track" style="--review-duration: {{ $duration }}s;">
            @foreach([1, 2] as $copy)
                <div class="review_group" @if($copy === 2) aria-hidden="true" @endif>
                    @foreach($cards as $review)
                        <div class="review_card">
                            <div class="review_stars" aria-label="{{ $review->rating }} out of 5 stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $review->rating ? '' : 'off' }}">&#9733;</span>
                                @endfor
                            </div>
                            <p class="review_text">{{ $review->description }}</p>
                            <div class="review_author">
                                @if($review->photo)
                                    <img class="review_avatar" src="{{ asset('public/images/admin/reviews/' . $review->photo) }}" alt="{{ $review->name }}" loading="lazy">
                                @else
                                    <span class="review_avatar">{{ strtoupper(mb_substr($review->name, 0, 1)) }}</span>
                                @endif
                                <span>
                                    <span class="review_name">{{ $review->name }}</span>
                                    <span class="review_city">{{ $review->city }}</span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
