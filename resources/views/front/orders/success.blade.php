@include('layouts.frontheader')

 <section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/thank-you.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">Your Order is Confirmed</h2>
        <p class="text-white py-4">Your request for a bespoke corporate proposal has been successfully received. The ritual of artful
                    giving begins here. <br>
                    Our team is reviewing your requirements and will reach out to you shortly at the email address
                    provided.</p>
        <a href="{{ route('front.home') }}" class="com_btn border-white text-white"><span><- Back to Home</span></a>
    </div>
</section> 

@include('layouts.frontfooter')