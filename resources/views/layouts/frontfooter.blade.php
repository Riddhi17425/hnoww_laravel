<footer class="hnow_footer" id="editions">
    <div class="container">
        <div class="ft_top">
            <div class="ft_head_wrapper">
                <div>
                    <a href="javascript:void(0)" target="_blank">
                        <img src="{{ asset('public/front/images/footer-logo.svg') }}" alt="hnow"
                            class="img-fluid footer_logo">
                    </a>
                </div>
                <div>
                    <div class="ft_top_right">
                        <div>
                            <h2>Join the Circle.</h2>
                            <h4> A monthly reflection on design, ritual, and slow living</h4>
                        </div>
                        <form id="newsletterForm" class="ft_newsletter" action="{{ route('front.newsletter.store') }}"
                            method="POST">
                            @csrf
                            <div class="ft_input">
                                <input class="w-100" type="email" name="newsletter_email" id="newsletter_email"
                                    placeholder="Enter your email address">
                                <button type="submit" id="newsletterSubmitBtn">
                                    <span class="btn-text">Submit</span>
                                    <span class="btn-loader" style="display:none;">Submitting...</span>
                                </button>
                            </div>
                            <div id="newsletter_error"></div>
                        </form>
                        <div id="newsletterMessage" class="auto-hide" style="color: green; margin-top: 7px;"></div>

                    </div>
                </div>
            </div>
        </div>
        <div class="ft_middle">
            <div class="ft_center_wrapper">
                <div class="ft_center_box">
                    <div>
                        <h4 class="ft_head">Collections</h4>
                        <ul class="ft_menu">
                            <li><a href="{{ route('front.list', 'for-her') }}">For Her</a></li>
                            <li><a href="{{ route('front.list', 'for-him') }}">For Him</a></li>
                            <li><a href="{{ route('front.list', 'for-home') }}">For Home</a></li>
                            <li><a href="{{ route('front.giftshop') }}">The Gift Shop</a></li>
                            <!--<li><a href="javascript:void(0)">Festive Collections</a></li>-->
                        </ul>
                    </div>
                </div>

                <div class="ft_center_box">
                    <div>
                        <h4 class="ft_head">The Worlds</h4>
                        <ul class="ft_menu">
                            <li><a href="{{ route('front.list', ['for-him', 'worlds']) }}">The Architect’s Study</a></li>
                            <li><a href="{{ route('front.list', ['for-her', 'worlds']) }}">The The Desert Rose</a></li>
                            <li><a href="{{ route('front.list', ['for-home', 'worlds']) }}">The Modern Majlis</a></li>
                            <li><a href="#">The Ritual Table</a></li>
                            <li><a href="#">The Table As Landscape</a></li>
                        </ul>
                    </div>
                </div>

                <div class="ft_center_box">
                    <div>
                        <h4 class="ft_head">Services</h4>
                        <ul class="ft_menu">
                            <li><a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#requestWeddingCatalogue">Weddings & Celebrations</a></li>
                            <li><a href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#requestCorporateProposal">Corporate Rituals</a></li>
                            <li><a href="{{route('front.bespoke.commission')}}">Bespoke Commissions</a></li>
                            <!--<li><a href="{{ route('front.ceremonials') }}">Ceremonial Objects</a></li>-->
                        </ul>
                    </div>
                </div>

                <div class="ft_center_box">
                    <div>
                        <h4 class="ft_head">Editions</h4>
                        <ul class="ft_menu">
                            <li><a href="{{route('front.about')}}">About</a></li>
                            <li><a href="{{ route('front.journal') }}">The Journal</a></li>
                            <li><a href="{{ route('front.blessings.library') }}">The Blessing Library</a></li>
                            <!--<li><a href="">Philosophy & Craft</a></li>-->
                            <li><a href="{{ route('front.atelier') }}">The Atelier</a></li>
                        </ul>
                    </div>
                </div>

                <div class="ft_center_box">
                    <div>
                        <h4 class="ft_head">Assistance</h4>
                        <ul class="ft_menu">
                            {{-- <li><a href="{{ route('front.request.catalogue') }}">Request Catalogue</a></li> --}}
                            <li><a href="{{ route('front.contactus') }}">Contact Us</a></li>
                            {{-- <li><a href="#">Shipping & Returns</a></li>
                             <li><a href="#">Your Wishlist</a></li> --}}
                            <li><a href="{{ route('front.faqs') }}">FAQ's</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="ft_bottom">
            <div class="ym_cpy">
                All rights reserved. ©HNOWW <?php echo date("Y"); ?>. Designed in Dubai.
            </div>

            <div class="ft_privacy">
                <a></a>
                <a href="{{ route('front.privacy') }}" target="_blank">Privacy Policy</a>
            </div>
            <div class="ft_social">
                <ul>
                    <li><a href="https://www.instagram.com/h.noww" target="_blank">Instagram</a></li>
                    {{-- <li><a href="">WhatsApp</a></li> --}}
                    <li><a href="https://www.facebook.com/profile.php?id=61579793212952" target="_blank">Facebook</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>
<div class="modal fade audio_modal" id="loginRequiredModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="productInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="m-3">Please login to continue and add items to your cart.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{ route('front.auth', 'login') }}" class="com_btn">
                    Login Now
                </a>
                <button type="button" class="com_btn" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>


@include('front.corporate_request_modal')
@include('front.wedding_request_modal')
<!-- jquery js start -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Jquery Validation --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
    integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"
    integrity="sha512-owaCKNpctt4R4oShUTTraMPFKQWG9UdWTtG6GRzBjFV4VypcFi6+M3yc4Jk85s3ioQmkYWJbUl1b2b2r41RTjA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- bootstrap js start -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>

<!-- slack slider  -->
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!--Aos animation-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- Load Google Translate script -->
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- Sweetalert popup -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    
AOS.init();
</script>
<!-- main js start -->
<script src="{{ asset('public/front/js/main.js') }}"></script>

<!-- Custom Validations -->
 <script src="{{ asset('public/js/front/custom_validations.js') }}"></script>
 <script src="{{ asset('public/js/front/common.js') }}" defer></script>

 {{-- STRIPE PAYMENT GATEWAY --}}
 <script src="https://js.stripe.com/v3/"></script>

 <script>
    var sitePath = "{{ url('/') }}";
    $(document).ready(function () {
        setTimeout(function () {
            $('.auto-hide').fadeOut('slow');
        }, 5000); //5 seconds

        $("#newsletterForm").validate({
            rules: {
                newsletter_email: {
                    required: true,
                    email: true,
                    noSpamEmail: true,
                    uniqueEmail: "newsletters" // dynamic table
                }
            },
            messages: {
                newsletter_email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                }
            },
            errorPlacement: function (error, element) {
                 $('#newsletter_error').html(error); // replace instead of append
            },
            submitHandler: function(form) {
                var $form = $(form);
                var $btn = $form.find('button[type="submit"]');
                var originalBtnText = 'Submit';
                // Disable button and show loader
                $btn.prop('disabled', true).text('Submitting...');
                $('#newsletterMessage').text(''); // clear previous messages

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    success: function(response) {
                        if(response.success){
                            $btn.prop('disabled', false).text(originalBtnText);
                            $('#newsletterMessage').text(response.message);
                            // Open WhatsApp link in new tab AFTER slight delay to ensure UI updates
                            if(response.whatsappUrl){
                                setTimeout(function(){
                                    window.open(response.whatsappUrl, '_blank');
                                }, 200);
                            }
                            $form[0].reset();
                        } else {
                            // Display first server-side validation error
                            if(response.errors){
                                var firstError = Object.values(response.errors)[0][0];
                                $('#newsletterMessage').text(firstError);
                            } else {
                                $('#newsletterMessage').text(response.message);
                            }
                        }
                    },
                    error: function(xhr){
                        $('#newsletterMessage').text('Something went wrong. Please try again.');
                    },
                    complete: function(){
                        // Re-enable button and restore original text
                        //$btn.prop('disabled', false).text(originalBtnText);
                    }
                });

                return false; // prevent default form submit
            }
        });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('alert-success')) {
            e.target.remove();
        }
    });
});

@if(session('whatsapp_url'))
window.open("{{ session('whatsapp_url') }}", "_blank");
@endif
</script>
@stack('script')

</body>

</html>