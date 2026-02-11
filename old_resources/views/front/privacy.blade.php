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
    <img class="img-fluid" src="{{asset('public/images/front/privacy_banner.png')}}" alt="privacy policy">

    <div class="hero_content_inner">
        <h2 class="main_head">PRIVACY, DELIVERY & TERMS OF USE</h2>
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
    <span class="sb_text">1. Privacy & Data Protection</span>
  </a>

  <a href="#sec2">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">2. Order Types & Fulfilment Paths</span>
  </a>

  <a href="#sec3">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">3. Delivery Policy</span>
  </a>

  <a href="#sec4">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">4. Returns, Exchanges & Defective Items</span>
  </a>

  <a href="#sec5">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">5. Cancellations</span>
  </a>

  <a href="#sec6">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">6. Pricing & Availability</span>
  </a>

  <a href="#sec7">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">7. Intellectual Property</span>
  </a>

  <a href="#sec8">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">8. Limitation of Liability</span>
  </a>

  <a href="#sec9">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">9. Governing Law</span>
  </a>

  <a href="#sec10">
    <span class="sb_icon">
      <svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46"/>
      </svg>
    </span>
    <span class="sb_text">10. Contact & Complaints</span>
  </a>

</nav>


  <!-- RIGHT SIDE - Content Paragraphs -->
  <main class="content">

        <div class="privacy_main" id="sec1">
            <h3 class="title_40 mb_35">1. PRIVACY & DATA PROTECTION</h3>
           
           <div>
                <h5 class="sub_head">Information We Collect</h5>
                <p>We collect only information necessary to respond to enquiries and fulfil orders, including:</p>
                <ul>
                    <li>Name</li>
                    <li>Company or organisation name</li>
                    <li>Email address</li>
                    <li>Phone number (WhatsApp preferred)</li>
                    <li>Delivery details</li>
                    <li>Product or curation preferences</li>
                    <li>Customisation or branding requirements</li>
                </ul>
                <p>We do not collect unnecessary personal data.</p>
           </div>
           
            <div>
                <h5 class="sub_head">Use of Information</h5>
                <p>Information shared with HNOWW is used solely to:</p>
                <ul>
                    <li>Respond to enquiries</li>
                    <li>Prepare proposals and quotations</li>
                    <li>Coordinate production and delivery</li>
                    <li>Communicate order updates</li>
                    <li>Provide post-delivery support</li>
                </ul>
                <p>We do not use your information for unsolicited marketing.</p>
           </div>
           
            <div>
                <h5 class="sub_head">Confidentiality</h5>
                <p>All enquiries and orders are treated as confidential.</p>
                <p>Client identities, employee gifting details, and wedding-related information are never disclosed publicly without consent.</p>
           </div>
           
            <div>
                <h5 class="sub_head">Data Sharing</h5>
                <p>We do not sell or trade personal data.</p>
                <p>Information may be shared only when necessary with:</p>
                <ul>
                    <li>Production partners (for approved customisation)</li>
                    <li>Logistics partners (for delivery)</li>
                    <li>Payment or invoicing providers</li>
                </ul>
                <p>All partners are selected for reliability and confidentiality.</p>
           </div>
           
            <div>
                <h5 class="sub_head">Data Security</h5>
                <p>We take reasonable technical and organisational measures to protect stored information. Access is limited to authorised personnel only.</p>
           </div>
           
            <div>
                <h5 class="sub_head">Your Rights</h5>
                <p>You may request to:</p>
                <ul>
                    <li>review your information</li>
                    <li>correct inaccuracies</li>
                    <li>request deletion after order completion (subject to legal obligations)</li>
                </ul>
                <p>Requests may be sent to <b><a href="mailto:mail@hnoww.com">mail@hnoww.com.</a></b></p>
           </div>
            
        </div>
        
           <div class="privacy_main" id="sec2">
            <h3 class="title_40 mb_35 mt_35">2. ORDER TYPES & FULFILMENT PATHS</h3>
           
           <div>
                <p>HNOWW operates across three distinct order categories:</p>
                <ol>
                    <li><b>Retail (Ready-to-Ship)</b></li>
                    <li><b>Curated / Corporate Orders</b></li>
                    <li><b>Wedding & Celebration Orders</b></li>
                </ol>
                <p>We do not collect unnecessary personal data.</p>
           </div>
            
        </div>
        
           <div class="privacy_main" id="sec3">
            <h3 class="title_40 mb_35 mt_60">3. DELIVERY POLICY</h3>
           
           <div>
                <h5 class="sub_head">A. Retail Orders (Ready-to-Ship)</h5>
                <p>Applies to items clearly marked “<b>Ready to Ship</b>” on the website.</p>
                <ul>
                    <li><b>Dubai:</b> Next-day or 1–2 working days</li>
                    <li><b>UAE (outside Dubai):</b> 2–4 working days</li>
                    
                </ul>
                <p>Retail orders are delivered in HNOWW signature packaging with protective outer transit material.</p>
           </div>
           
            <div>
                <h5 class="sub_head">B. Curated / Corporate Orders</h5>
                <p>Applies to:</p>
                <ul>
                    <li>corporate gifting</li>
                    <li>leadership orders</li>
                    <li>bulk or proposal-based orders</li>
                    <li><b>Standard production & delivery:</b> 30–45 days</li>
                    <li>Timelines confirmed prior to production</li>
                    <li>White-glove delivery coordination available for leadership or sensitive deliveries</li>
                </ul>
                <p>Retail orders are delivered in HNOWW signature packaging with protective outer transit material.</p>
           </div>
           
            <div>
                <h5 class="sub_head">C. Wedding & Celebration Orders</h5>
                <p>Wedding and celebration orders are treated as <b>curated orders</b> .</p>
                <ul>
                    <li>Standard production & delivery: 30–45 days</li>
                    <li>Timelines confirmed during consultation</li>
                    <li>White-glove coordination may be arranged for ceremonial deliveries</li>
                </ul>
           </div>
           
            <div>
                <h5 class="sub_head">Delivery Confirmation</h5>
                <p>All deliveries require confirmation of receipt. Corporate and wedding deliveries are not left unattended.</p>
           </div>
            
        </div>
        
           <div class="privacy_main" id="sec4">
            <h3 class="title_40 mb_35 mt_35">4. RETURNS, EXCHANGES & DEFECTIVE ITEMS</h3>
            
             <div>
                <h5 class="sub_head">A. Retail Returns & Exchanges (UAE-Compliant)</h5>
                <p>For non-customised retail purchases:</p>
                <ul>
                    <li>Requests must be submitted within <b>7 calendar days</b> of delivery</li>
                    <li>Items must be unused, unaltered, and in original packaging</li>
                   
                </ul>
                <p>Returns are reviewed upon receipt.</p>
           </div>
           
            <div>
                <h5 class="sub_head">B. Non-Returnable Items</h5>
                <p>The following are <b>not eligible</b> for return or exchange:</p>
                <ul>
                    <li>customised or engraved items</li>
                    <li>personalised recognition cards or inserts</li>
                    <li>curated corporate orders once approved</li>
                    <li>wedding or celebration items</li>
                    <li>bulk orders</li>
                    <li>items used, altered, or handled after delivery</li>
                </ul>
               
           </div>
           
            <div>
                <h5 class="sub_head">C. Damaged or Incorrect Items</h5>
                <p>If an item arrives damaged or materially incorrect:</p>
                <ul>
                    <li>notify HNOWW within <b>48 hours</b> of delivery</li>
                    <li>provide clear photographic evidence</li>
                </ul>
                <p>We will review and arrange repair, replacement, or resolution where appropriate.</p>
           </div>
           
            <div>
                <h5 class="sub_head">D. Compensation Rights</h5>
                <p>Customers retain rights under UAE consumer law to seek compensation for damages resulting from product defects, where applicable.</p>
           </div>
            
           </div>
           
           <div class="privacy_main" id="sec5">
             <h3 class="title_40 mb_35 mt_60">5. CANCELLATIONS</h3>
             
             <div>
                 <p>Orders may be cancelled before production begins, subject to confirmation.</p>
                 <p>Once production or customisation has commenced, cancellations may not be possible.</p>
                 <p>This applies to:</p>
                <ul>
                    <li>curated corporate orders</li>
                    <li>wedding and celebration orders</li>
                </ul>
             </div>
           </div>
           
            <div class="privacy_main" id="sec6">
              <h3 class="title_40 mb_35 mt_60">6. PRICING & AVAILABILITY</h3>
              
                  <div>
               
                <ul>
                    <li>Retail pricing is displayed online</li>
                    <li>Corporate and wedding pricing is shared via proposal or catalogue</li>
                    <li>Prices and availability are confirmed prior to order approval</li>
                </ul>
                <p>HNOWW reserves the right to update pricing prior to confirmation.</p>
           </div>
            </div>
            
            <div class="privacy_main" id="sec7">
              <h3 class="title_40 mb_35 mt_60">7. INTELLECTUAL PROPERTY</h3>
              
                  <div>
                      <p>All content on the HNOWW website, including text, imagery, product names, and design elements, is the property of HNOWW unless otherwise stated.</p>
                      <p>Unauthorised use or reproduction is prohibited.</p>
                </div>
            </div>
            
            <div class="privacy_main" id="sec8">
              <h3 class="title_40 mb_35 mt_60">8. LIMITATION OF LIABILITY</h3>
              
                  <div>
                      <p>HNOWW is not responsible for:</p>
                <ul>
                    <li>delays caused by events beyond reasonable control</li>
                    <li>incorrect delivery details provided by the client</li>
                    <li>normal wear resulting from use</li>
                </ul>
                <p>Liability is limited to the value of the item supplied, in accordance with UAE law.</p>
           </div>
            </div>
            
            <div class="privacy_main" id="sec9">
              <h3 class="title_40 mb_35 mt_60">9. GOVERNING LAW</h3>
              
                  <div>
                      <p>These terms are governed by and construed in accordance with the laws of the <b> United Arab Emirates.</b></p>
                      <p>Any disputes shall be subject to the jurisdiction of UAE courts.</p>
               
                
           </div>
            </div>
            
            <div class="privacy_main" id="sec10">
              <h3 class="title_40 mb_35 mt_60">10. CONTACT & COMPLAINTS</h3>
              
                  <div>
                      <p>For enquiries, delivery coordination, returns, or concerns:</p>
                      <p><b>Email:</b> <a href="mailto:>mail@hnoww.com">mail@hnoww.com</a></p>
                      <p><b>WhatsApp:</b> Corporate Concierge</p>
                      <p>We aim to respond within <b>48 hours.</b></p>
               
                
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
