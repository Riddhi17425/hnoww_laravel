@include('layouts.frontheader')

<style>
    .sticky-header
    {
       position: absolute;
      top: 0;
      left: 0;
      width: 100%;
    }
    
    .sticky-header
    {
        background:transparent;
    }
    
</style>

<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/privacy_banner.webp')}}" alt="privacy policy">

    <div class="hero_content_inner">
        <h2 class="main_head">PRIVACY POLICY</h2>
        <!--<p class="para">Protecting your information, respecting your trust.</p>-->
    </div>
</section>


<section class="mt_80">
    <div class="container">
        
        <div class="privacy_nav_jump">

 <nav class="sidebar">

  <a href="#sec1">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">1. Privacy Policy</span>
  </a>

  <a href="#sec2">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">2. Information We Collect</span>
  </a>

  <a href="#sec3">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">3. How We Use Your Information</span>
  </a>

  <a href="#sec4">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">4. Customization, Corporate & Ceremonial Data</span>
  </a>

  <a href="#sec5">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">5. Payment Security</span>
  </a>

  <a href="#sec6">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">6. Sharing of Information</span>
  </a>

  <a href="#sec7">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">7. Data Retention</span>
  </a>

  <a href="#sec8">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">8. Confidentiality & Discretion</span>
  </a>

  <a href="#sec9">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">9. Cookies & Website Analytics</span>
  </a>

  <a href="#sec10">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">10. Your Rights</span>
  </a>
  
  <a href="#sec11">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">11. Third-Party Links</span>
  </a>
  
  <a href="#sec12">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">12. Policy Updates</span>
  </a>
  
  <a href="#sec13">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">13. Contact Us</span>
  </a>

</nav>


  <!-- RIGHT SIDE - Content Paragraphs -->
  <main class="content">

        <div class="privacy_main" id="sec1">
            <h3 class="title_40 mb_35">1. PRIVACY POLICY</h3>
           
           <div>
                <!--<h5 class="sub_head">Information We Collect</h5>-->
                <p>How we collect, use, and protect your information with care and discretion.</p>
                <p>At HNoww, we value your trust and are committed to protecting your privacy. This Privacy Policy explains how we collect, use, store, and safeguard your personal information when you interact with our website, place an order, or engage with our services.
</p>
                <p>By using our website or services, you consent to the practices described in this Privacy Policy.</p>
           </div>
           
        </div>
        
           <div class="privacy_main" id="sec2">
            <h3 class="title_40 mb_35 mt_35">2. INFORMATION WE COLLECT</h3>
           
           <div>
                <p>We may collect the following types of information when you interact with HNoww:</p>
                <ul>
                    <li>Personal details such as name, email address, phone number, and delivery address</li>
                    <li>Order-related information, including product selections and customisation details</li>
                    <li>Payment-related information processed securely through third-party payment providers</li>
                    <li>Corporate or event-related details shared during concierge-led consultations</li>
                    <li>Communications shared via email, WhatsApp, enquiry forms, or direct correspondence</li>
                </ul>
                <p>We only collect information that is necessary to provide our products and services effectively.</p>
           </div>
            
        </div>
        
           <div class="privacy_main" id="sec3">
            <h3 class="title_40 mb_35 mt_60">3. HOW WE USE YOUR INFORMATION</h3>
           
           <div>
                
                <p>Your information is used solely for legitimate business purposes, including:</p>
                <ul>
                    <li>Processing and fulfilling orders</li>
                    <li>Managing customized, corporate, or wedding requests</li>
                    <li>Coordinating deliveries and logistics</li>
                    <li>Communicating order updates, confirmations, or enquiries</li>
                    <li>Providing customer and concierge support</li>
                    <li>Improving our website, services, and user experience</li>
                    <li>Meeting legal or regulatory obligations</li>
                </ul>
                <p>HNoww does not sell, rent, or trade your personal information to third parties.</p>
           </div>
           
            
        </div>
        
           <div class="privacy_main" id="sec4">
            <h3 class="title_40 mb_35 mt_35">4. CUSTOMIZATION, CORPORATE & CEREMONIAL DATA</h3>
            
             <div>
                <p>Information shared for customized gifts, corporate gifting, or wedding and ceremonial orders is treated with heightened discretion. Logos, names, messages, and event details are used strictly for order fulfillment and are not reused, shared, or displayed without prior consent.
</p>
           </div>
           
           </div>
           
           <div class="privacy_main" id="sec5">
             <h3 class="title_40 mb_35 mt_60">5. PAYMENT SECURITY</h3>
             
             <div>
                 <p>All payment transactions are processed through secure, encrypted third-party payment gateways. HNoww does not store or have direct access to your full payment card details.
</p>
                 
             </div>
           </div>
           
            <div class="privacy_main" id="sec6">
              <h3 class="title_40 mb_35 mt_60">6. SHARING OF INFORMATION</h3>
              
                  <div>
               <p>We may share limited information with trusted third parties only when necessary to deliver our services, such as:
</p>
                <ul>
                    <li>Courier and logistics partners</li>
                    <li>Payment service providers</li>
                    <li>Technology and website service providers</li>
                </ul>
                <p>All third parties are required to handle your data responsibly and in accordance with applicable privacy laws.
</p>
           </div>
            </div>
            
            <div class="privacy_main" id="sec7">
              <h3 class="title_40 mb_35 mt_60">7. DATA RETENTION</h3>
              
                  <div>
                      <p>We retain personal information only for as long as necessary to fulfil the purposes outlined in this policy, comply with legal obligations, or resolve disputes. Once data is no longer required, it is securely deleted or hidden.
</p>
                </div>
            </div>
            
            <div class="privacy_main" id="sec8">
              <h3 class="title_40 mb_35 mt_60">8. CONFIDENTIALITY & DISCRETION</h3>
              
                  <div>
                      <p>All client relationships, corporate engagements, employee gifting programs, and wedding projects are treated as confidential. Information is never shared externally without explicit consent, except where required by law.
</p>
                
           </div>
            </div>
            
            <div class="privacy_main" id="sec9">
              <h3 class="title_40 mb_35 mt_60">9. COOKIES & WEBSITE ANALYTICS</h3>
              
                  <div>
                    <p>Our website may use cookies and similar technologies to enhance functionality, analyze traffic, and improve user experience. Cookies do not collect personally identifiable information unless voluntarily provided by the user.
</p>
                <p>You may choose to disable cookies through your browser settings; however, this may affect website performance.
</p>
           </div>
            </div>
            
            <div class="privacy_main" id="sec10">
              <h3 class="title_40 mb_35 mt_60">10. YOUR RIGHTS</h3>
              
                  <div>
                      <p>You have the right to:</p>
                      <ul>
                        <li>Request access to your personal data</li>
                        <li>Request correction of inaccurate information</li>
                        <li>Request deletion of your data, subject to legal and operational requirements</li>
                        <li>Withdraw consent for certain communications</li>
                    </ul>
                      <p>Requests can be made by contacting us through the details provided on our website.</p>
               
                </div>
            </div>
            
            <div class="privacy_main" id="sec11">
              <h3 class="title_40 mb_35 mt_60">11. THIRD-PARTY LINKS</h3>
              
                  <div>
                      <p>Our website may contain links to third-party websites. HNoww is not responsible for the privacy practices or content of external sites. We encourage users to review the privacy policies of any third-party websites they visit.
</p>
               
                </div>
            </div>
            
            <div class="privacy_main" id="sec12">
              <h3 class="title_40 mb_35 mt_60">12. POLICY UPDATES</h3>
              
                  <div>
                      <p>HNoww reserves the right to update or modify this Privacy Policy at any time. Any changes will be reflected on this page, and continued use of the website constitutes acceptance of the updated policy.
</p>
                      
                </div>
            </div>
            
            <div class="privacy_main" id="sec13">
              <h3 class="title_40 mb_35 mt_60">13. CONTACT US</h3>
              
                  <div>
                      <p>If you have questions about this Privacy Policy, data handling practices, or your personal information, please contact our team via the details available on the website. Our Concierge will assist you with care and discretion.
</p>
                      
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
        <div class="cta_ftwrapper">
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
                {{-- <a href="javascript:void(0)" class="btn_2">Begin Your Journey </a> --}}
            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')
