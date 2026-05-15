@include('layouts.frontheader')
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/atelier-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Your Order is Failed</h2>
        <a class="com_btn" href="{{ route('front.home') }}" class="com_btn">Back to Home</a>
    </div>
</section>

@include('layouts.frontfooter')