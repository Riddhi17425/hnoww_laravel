@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/thank-you.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Thank You.</h2>
        <h4 class="sub_head text-white">{{ 'Your payment has been processed successfully.' }}</h4>
    </div>
</section>

@include('layouts.frontfooter')