@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/thank-you.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">The Ritual Begins.</h2>
        <h4 class="sub_head text-white">Thank you. Your order has been received.</h4>
        <p class="text-white py-4">Thank you for choosing to gift with purpose. Your object is now being carefully
            prepared by our Atelier. <br> We will notify you the moment it is secured and ready for transit.</p>
        <a href="{{ route('front.home') }}" class="com_btn border-white text-white"><span>
               <- Return to The Collection</span></a>
    </div>
</section>

@include('layouts.frontfooter')