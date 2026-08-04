{{-- @include('layouts.frontheader')
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/atelier-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Than you </h2>
        <a href="{{ route('front.home') }}" class="com_btn"><span class="text-light">Back to Home</span></a>
    </div>
</section>
@include('layouts.frontfooter') --}}

@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/thank-you.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Thank You.</h2>
        <h4 class="sub_head text-white">Your Inquiry has been sent Successfully. We will get back to you soon.</h4>
        {{-- <p class="text-white py-4">Your Inquiry has been received. We will get back to you soon.</p> --}}
    </div>
</section>

@include('layouts.frontfooter')