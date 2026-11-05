@include('layouts.frontheader')

<style>
    .sticky-header {

        background: transparent;

    }
</style>
<!-- hero section -->

<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/privacy_banner.webp')}}" alt="privacy policy">
    <div class="hero_content_inner">
        <h2 class="main_head"> RETURN AND REFUND POLICY</h2>
    </div>
</section>

<section class="mt_80">
    <div class="container">
        <div class="privacy_nav_jump">
            <nav class="sidebar">
                <a href="#sec2">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">1. Change-of-Mind Returns</span>
                </a>
                <a href="#sec3">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">2. Damaged, Defective or Incorrect Items</span>
                </a>
                <a href="#sec4">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">3. Items Excluded from Change-of-Mind Returns</span>
                </a>
                <a href="#sec5">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">4. Natural Materials</span>
                </a>
                <a href="#sec6">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 2.66669 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">5. Gifts</span>
                </a>
                <a href="#sec7">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 2.66669 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">6. Order Cancellations</span>
                </a>
                <a href="#sec8">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 2.66669 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">7. Refund Processing Timeline</span>
                </a>
                <a href="#sec9">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 2.66669 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">8. How to Request Assistance</span>
                </a>
                <a href="#sec10">
                    <span class="sb_icon">
                        <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 2.66669 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                                fill="#B58A46" />
                        </svg>
                    </span>
                    <span class="sb_text">9. UAE Consumer Rights</span>
                </a>
            </nav>
            <!-- RIGHT SIDE - Content Paragraphs -->
            <main class="content">
                <div class="privacy_main" id="sec2">
                    <h3 class="title_40 mb_35 mt_35">1. Change-of-Mind Returns</h3>
                    <div>
                        <p>HNO̱WW does not offer returns or refunds solely because a customer has changed their mind or no longer wants an item.</p>
                        <p>This does not affect any rights you may have under UAE consumer law, including rights relating to defective, damaged, incomplete, incorrect, or misrepresented products.</p>
                    </div>
                </div>
                <div class="privacy_main" id="sec3">
                    <h3 class="title_40 mb_35 mt_60">2. Damaged, Defective or Incorrect Items</h3>
                    <div>
                        <p>If your order arrives damaged, defective, incomplete, incorrect, or not as described, please contact us within 48 hours of delivery and provide photographs of the item and its packaging.</p>
                        <p>We will review the issue and arrange the next steps. Depending on the issue, you may choose a remedy such as repair, replacement, or a full refund.</p>
                        <p>For eligible claims, HNO̱WW will arrange collection of the affected item at no additional cost to you.</p>
                        <p>The 48-hour notification request helps us assess and resolve issues promptly. It does not limit any statutory consumer rights you may have.</p>
                    </div>
                </div>
                <div class="privacy_main" id="sec4">
                    <h3 class="title_40 mb_35 mt_35">3. Items Excluded from Change-of-Mind Returns</h3>
                    <div>
                        <p>The following items are not eligible for change-of-mind returns:</p>
                        <ul>
                            <li>Personalised, engraved, or bespoke pieces that cannot be returned to their original condition.</li>
                            <li>Corporate and bulk orders made to the customer's brief.</li>
                            <li>Food and consumables, including chocolates, dates, and dry fruits</li>
                            <li>Candles that have been lit, and any other items that have been used.</li>
                            <li>Sale and final-sale items.</li>

                        </ul>
                        <p>These exclusions do not affect your rights for items that are defective, damaged, incorrect, incomplete, or not as described.</p>
                    </div>
                </div>
                <div class="privacy_main" id="sec5">
                    <h3 class="title_40 mb_35 mt_60">4. Natural Materials</h3>
                    <div>
                        <p>Many HNO̱WW pieces are made from natural stone, metal, and hand-finished materials. Minor variations in colour, veining, texture, and finish are part of their individual character and are not necessarily defects.</p>
                        <p>If you believe an item has a defect or does not match its description, please contact us within 48 hours of delivery so we can assess the issue.</p>
                    </div>
                </div>

                <div class="privacy_main" id="sec6">

                    <h3 class="title_40 mb_35 mt_60">5. Gifts</h3>

                    <div>

                        <p>If you received an item as a gift, you can request an exchange by contacting us with the order number. To be eligible:</p>
                        <ul>
                            <li>Your request must reach us within 7 days of delivery.</li>
                            <li>The item must be unused, in its original condition and packaging.</li>
                            <li>The item must not fall under the exclusions in Section 3.</li>
                        </ul>

                        <p>Approved exchanges are issued as store credit [valid for X months]. Gift exchanges are not refunded in cash. We will confirm the credit amount and how it will be issued once your request is approved, and we will handle all gift-related enquiries discreetly.</p>

                    </div>

                </div>

                <div class="privacy_main" id="sec7">

                    <h3 class="title_40 mb_35 mt_60">6. Order Cancellations</h3>

                    <div>

                        <p>Orders may be cancelled before dispatch for a full refund.</p>

                        <p>Corporate, bulk, personalised, or bespoke orders may not be cancellable once sourcing, customisation, or production has started.</p>

                        <p>Please contact us as soon as possible if you wish to cancel an order.</p>

                    </div>

                </div>

                <div class="privacy_main" id="sec8">

                    <h3 class="title_40 mb_35 mt_60">7. Refund Processing Timeline</h3>

                    <div>

                        <p>Approved refunds are issued to the original payment method. For returns that require inspection, refunds are generally processed within 7–14 working days after we have received and inspected the item. The time taken for the funds to appear in your account may depend on your bank or payment provider.</p>

                        <p>For cash-on-delivery orders, approved refunds are issued by bank transfer. We will confirm the details we need to process the refund.</p>

                    </div>

                </div>

                <div class="privacy_main" id="sec9">

                    <h3 class="title_40 mb_35 mt_60">8. How to Request Assistance</h3>

                    <div>

                        <p>To report an issue with your order, request a cancellation, or request a gift exchange, please contact us with your order number and relevant details.</p>

                        <p><strong>WhatsApp:</strong> <a href="https://wa.me/971502243720" target="_blank">+971 50 224 3720</a></p>

                        <p><strong>Email:</strong> <a href="mailto:connect@hnoww.com">connect@hnoww.com</a></p>

                        <p>For damaged, defective, or incorrect items, please include photographs of the product and its packaging. Our team will review your request and guide you through the next steps.</p>

                    </div>

                </div>

                <div class="privacy_main" id="sec10">

                    <h3 class="title_40 mb_35 mt_60">9. UAE Consumer Rights</h3>

                    <div>

                        <p>This policy is intended to operate in accordance with applicable UAE consumer protection law and does not exclude or limit any rights that cannot lawfully be excluded. Where a mandatory right or timeline under UAE law differs from this policy, the law prevails.</p>

                        <p>For online purchases, UAE e-commerce legislation provides consumer protections in specified circumstances, including where goods violate applicable requirements, are defective, incomplete, damaged, or not as described, arrive too late to be useful, or do not conform to the digital contract or the seller's stated terms and conditions.</p>

                    </div>

                </div>

            </main>

        </div>

    </div>

</section>

<!--<section class="mt_80">-->

<!--</section>-->

<section class="cta_footer mt_120">

    <div class="container">

        {{-- <div class="cta_ftwrapper">

            <div>

                <p class="sub_head mb-0">

                    <span>

                        <svg width="146" height="11" viewBox="0 0 146 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M10.6666 5.33325C10.6666 8.27877 8.27877 10.6666 5.33325 10.6666C2.38773 10.6666 -8.13802e-05 8.27877 -8.13802e-05 5.33325C-8.13802e-05 2.38773 2.38773 -8.13802e-05 5.33325 -8.13802e-05C8.27877 -8.13802e-05 10.6666 2.38773 10.6666 5.33325ZM145.333 5.33325V6.33325L5.33325 6.33325V5.33325V4.33325L145.333 4.33325V5.33325Z"
                                fill="url(#paint0_linear_32_115)" />

                            <defs>

                                <linearGradient id="paint0_linear_32_115" x1="145.333" y1="5.83325" x2="5.33325"
                                    y2="5.83325" gradientUnits="userSpaceOnUse">

                                    <stop stop-color="#F8F7F3" stop-opacity="0" />

                                    <stop offset="1" stop-color="#F8F7F3" />

                                </linearGradient>

                            </defs>

                        </svg>

                    </span>

                    <span>Let intention take form</span>

                    <span>

                        <svg width="146" height="11" viewBox="0 0 146 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <path
                                d="M134.667 5.33325C134.667 8.27877 137.054 10.6666 140 10.6666C142.946 10.6666 145.333 8.27877 145.333 5.33325C145.333 2.38773 142.946 -8.13802e-05 140 -8.13802e-05C137.054 -8.13802e-05 134.667 2.38773 134.667 5.33325ZM0 5.33325L0 6.33325L140 6.33325V5.33325V4.33325L0 4.33325L0 5.33325Z"
                                fill="url(#paint0_linear_32_114)" />

                            <defs>

                                <linearGradient id="paint0_linear_32_114" x1="0" y1="5.83325" x2="140" y2="5.83325"
                                    gradientUnits="userSpaceOnUse">

                                    <stop stop-color="#F8F7F3" stop-opacity="0" />

                                    <stop offset="1" stop-color="#F8F7F3" />

                                </linearGradient>

                            </defs>

                        </svg>

                    </span>

                </p>

            </div>

            <div>

                <p class="cta_ft_center">Our Concierge will curate three <br /> perfect options for you.</p>

            </div>

            <div>

                <a href="javascript:void(0)" class="btn_2">Begin Your Journey </a>

            </div>

        </div> --}}

    </div>

</section>

@include('layouts.frontfooter')