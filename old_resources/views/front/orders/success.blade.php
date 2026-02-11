@include('layouts.frontheader')
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/atelier-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Your Order is Confirmed</h2>
        <a href="{{ route('front.home') }}" class="com_btn">Back to Home</a>
    </div>
</section>

@include('layouts.frontfooter')