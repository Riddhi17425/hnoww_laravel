@include('layouts.frontheader')

<style>
    .sticky-header
    {
        background:transparent;
    }

    /* Shipping table (only addition) */
    .shipping_table_wrap { overflow-x: auto; margin: 15px 0; }
    .shipping_table { width: 100%; border-collapse: collapse; }
    .shipping_table th,
    .shipping_table td { border: 1px solid #B58A46; padding: 12px 16px; text-align: left; }
    .shipping_table th { background: rgba(181, 138, 70, 0.1); }
</style>

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/privacy_banner.webp')}}" alt="shipping policy">

    <div class="hero_content_inner">
        <h2 class="main_head">SHIPPING POLICY</h2>
    </div>
</section>


<section class="mt_80">
    <div class="container">

        <div class="privacy_nav_jump">

 <nav class="sidebar">

  @php
    $shipping_nav = [
        1  => 'Shipping Policy',
        2  => 'Delivery Locations',
        3  => 'Shipping Charges & Delivery Timelines',
        4  => 'Order Processing',
        5  => 'Delivery Process',
        6  => 'Delivery Attempts',
        7  => 'Delivery Delays',
        8  => 'Missing or Undelivered Orders',
        9  => 'Order Cancellation',
        10 => 'Special Orders',
        11 => 'Gift Deliveries',
        12 => 'Contact Us',
        13 => 'Changes to This Shipping Policy',
    ];
  @endphp

  @foreach($shipping_nav as $num => $label)
  <a href="#sec{{ $num }}">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">{{ $num }}. {{ $label }}</span>
  </a>
  @endforeach

</nav>


  <!-- RIGHT SIDE - Content Paragraphs -->
  <main class="content">

        <div class="privacy_main" id="sec1">
            <h3 class="title_40 mb_35">1. SHIPPING POLICY</h3>

           <div>
                <p>At HNoww, we understand that the timing of a delivery can be just as important as the gift itself. We take care in preparing every order and aim to ensure it reaches its intended destination safely and within the stated delivery timeframe.</p>
                <p>This Shipping Policy outlines the delivery terms applicable to orders placed through the HNoww website.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec2">
            <h3 class="title_40 mb_35 mt_35">2. DELIVERY LOCATIONS</h3>

           <div>
                <p>HNoww currently delivers across <strong>Dubai and other Emirates within the UAE</strong>.</p>
                <p>Delivery availability may be subject to the accessibility of the delivery address and the nature of the order.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec3">
            <h3 class="title_40 mb_35 mt_60">3. SHIPPING CHARGES & DELIVERY TIMELINES</h3>

           <div>
                <p>Orders are processed within 1 business day after being placed and confirmed. Once your order is dispatched, you will receive a tracking link via SMS/email to follow its progress.</p>

                <div class="shipping_table_wrap">
                    <table class="shipping_table">
                        <thead>
                            <tr>
                                <th>Delivery Location</th>
                                <th>Shipping Charge</th>
                                <th>Estimated Delivery</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Dubai</strong></td>
                                <td>AED 30</td>
                                <td>Within 2 days</td>
                            </tr>
                            <tr>
                                <td><strong>Other Emirates</strong></td>
                                <td>AED 50</td>
                                <td>Within 7 days</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p>Delivery timelines are in business days and begin once your order is dispatched. Orders placed before 12 PM are processed the same day. Orders placed after 12 PM or on Sundays/public holidays, are processed the next business day.</p>
                <p>The above delivery timelines are estimates and may vary in certain circumstances, including public holidays, unforeseen logistical disruptions, adverse weather conditions, traffic restrictions, recipient unavailability, or incorrect delivery information.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec4">
            <h3 class="title_40 mb_35 mt_60">4. ORDER PROCESSING</h3>

           <div>
                <p>Orders are processed after the order has been successfully placed and confirmed.</p>
                <p>Customers are responsible for providing complete and accurate delivery information at the time of placing an order. This includes the recipient's name, contact number, complete address, building or villa details, and any relevant delivery instructions.</p>
                <p>Incorrect or incomplete information may result in delays or an unsuccessful delivery.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec5">
            <h3 class="title_40 mb_35 mt_60">5. DELIVERY PROCESS</h3>

           <div>
                <p>Our delivery partner may contact the recipient using the contact details provided with the order to coordinate delivery.</p>
                <p>Customers should ensure that the recipient, or an authorised person, is available to receive the order at the specified delivery address.</p>
                <p>For gift orders being sent directly to another person, the customer is responsible for ensuring that the recipient's contact and delivery details are accurate.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec6">
            <h3 class="title_40 mb_35 mt_60">6. DELIVERY ATTEMPTS</h3>

           <div>
                <p>If the recipient is unavailable at the time of delivery, the delivery partner may contact the recipient to arrange delivery.</p>
                <p>Where delivery cannot be completed because the recipient is unavailable, the address is incorrect or inaccessible, or for any other reason affecting successful delivery, HNoww may contact the customer to arrange the next appropriate step.</p>
                <p>If delivery is unsuccessful after 2 attempts, the order will be returned to us. Redelivery will be charged at the standard shipping rate.</p>
                <p>If your order arrives damaged or is not received, please contact us within 48 hours. Any replacement or refund will be handled under our Refund &amp; Returns Policy.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec7">
            <h3 class="title_40 mb_35 mt_60">7. DELIVERY DELAYS</h3>

           <div>
                <p>While HNoww makes every reasonable effort to meet the stated delivery timelines, delays may occasionally occur due to circumstances beyond our reasonable control.</p>
                <p>These may include:</p>
                <ul>
                    <li>Public holidays</li>
                    <li>Adverse weather conditions</li>
                    <li>Unexpected traffic or road restrictions</li>
                    <li>Courier or logistics disruptions</li>
                    <li>Incorrect or incomplete delivery information</li>
                    <li>Recipient unavailability</li>
                    <li>Unforeseen operational or external circumstances</li>
                </ul>
                <p>Where a significant delay affects an order, HNoww will make reasonable efforts to assist the customer and provide relevant information regarding the delivery.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec8">
            <h3 class="title_40 mb_35 mt_60">8. MISSING OR UNDELIVERED ORDERS</h3>

           <div>
                <p>If an order has not been received within the applicable estimated delivery timeframe, please contact HNoww with your order number and delivery details.</p>
                <p>We will review the delivery status and, where necessary, coordinate with the relevant delivery partner to determine the status of the order.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec9">
            <h3 class="title_40 mb_35 mt_60">9. ORDER CANCELLATION</h3>

           <div>
                <p>If you wish to cancel an order, please contact HNoww as soon as possible.</p>
                <p>Cancellation may not be possible once an order has been prepared, dispatched, or handed over to the delivery partner.</p>
                <p>Any applicable cancellation or refund will be handled in accordance with HNoww's applicable terms and policies.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec10">
            <h3 class="title_40 mb_35 mt_60">10. SPECIAL ORDERS</h3>

           <div>
                <p>Certain orders may require additional handling or delivery arrangements due to their size, quantity, customisation, or other specific requirements.</p>
                <p>Where a different delivery timeframe or arrangement applies, this will be communicated to the customer before the order is confirmed.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec11">
            <h3 class="title_40 mb_35 mt_60">11. GIFT DELIVERIES</h3>

           <div>
                <p>Where an order is being delivered directly to another person as a gift, the customer authorises HNoww and its delivery partner to deliver the order to the recipient at the address provided.</p>
                <p>The recipient may be contacted to facilitate delivery.</p>
                <p>HNoww is not responsible for delays or unsuccessful deliveries resulting from incorrect or incomplete recipient information provided by the customer.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec12">
            <h3 class="title_40 mb_35 mt_60">12. CONTACT US</h3>

           <div>
                <p>For questions about your order or delivery, contact us at <a href="mailto:connect@hnoww.com">connect@hnoww.com</a> or WhatsApp <a href="https://wa.me/971502243720" target="_blank">971 50 224 3720</a>, Monday to Friday, 9:00 AM to 6:00 PM.</p>
                <p>Any applicable cancellation or refund will be handled under our Refund &amp; Returns Policy.</p>
           </div>

        </div>

        <div class="privacy_main" id="sec13">
            <h3 class="title_40 mb_35 mt_60">13. CHANGES TO THIS SHIPPING POLICY</h3>

           <div>
                <p>HNoww may update this Shipping Policy from time to time to reflect changes to our delivery arrangements, services, or operational requirements.</p>
                <p>Any revised version will be published on this page and will apply from the date of publication.</p>
           </div>

        </div>

  </main>

</div>

    </div>
</section>


<section class="cta_footer mt_120">
    <div class="container">
    </div>
</section>

@include('layouts.frontfooter')
