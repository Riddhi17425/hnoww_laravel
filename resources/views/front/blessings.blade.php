@include('layouts.frontheader')
@php // print_r(request()->segment(2)); die;
@endphp


<style>
.bles_modal_close {
    top: 22px;
    right: 22px;
}

@media (max-width: 767px) {
    .bles_modal_close {
        filter: invert(1);
    }
}

</style>

<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/blessing-library-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head mb-3">The Blessing Library</h2>
        <p class="para sec_in_mb">Audio-poetic rituals to anchor the soul.</p>
    </div>
</section>

<section class="mt_80 mb_120">
    <div class="container">

        <div class="section_header text-start">
            <div class="gesture_filter">
                <div class="gesture_filter_child">
                    <h3 class="gesture_title">SEEKING A BLESSING OF</h3>
                    <select class="dropdown" id="blessing_of">
                        <option value="">All</option>
                        @foreach(config('global_values.blessing_of') as $key => $label)
                        <option value="{{ $key }}" {{ request()->segment(2) == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            @if(isset($blessings) && is_countable($blessings) && count($blessings) > 0)
            @foreach($blessings as $key => $val)
            <div class="col-md-4 mb-4">
                <div class="gesture_box open-blessing" data-bs-toggle="modal" data-bs-target="#blessingPopup"
                    data-id="{{ $val->id }}" data-title="{{ $val->title }}" data-subtitle="{{ $val->sub_title }}"
                    data-description="{{ strip_tags($val->description) }}"
                    data-image="{{ asset('public/images/admin/blessing/images/'.$val->image) }}"
                    data-audio="{{ route('front.blessings.audio', $val->id) }}">
                    <img class="img-fluid mb-2 mb-md-4"
                        src="{{ asset('public/images/admin/blessing/images/'.$val->image) }}" alt="images">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="sub_head">{{ $val->title ?? '' }}</h3>
                            <p class="mb-0">{{ $val->sub_title ?? '' }}</p>
                        </div>
                        <div>
                            <img style="cursor: pointer;" src="{{asset('public/images/front/volume.svg')}}" alt=""
                                width="33" height="30">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="text-center">
                <img class="mb-2 mb-md-4" height="250px" width="250px"
                    src="{{asset('public/images/product-not-found.webp')}}" alt="images">
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Blessing Detail Modal -->
<div class="modal fade audio_modal" id="blessingPopup" tabindex="-1" aria-labelledby="blessingPopupLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card position-relative">

                    <div class="audio-image">
                        <img id="modalImage" src="" alt="blessing image" loading="lazy" class="img-fluid">
                    </div>

                    <div class="audio-content">
                        <div class="d-flex align-items-center justify-content-between my-3">
                            <div class="text-start">
                                <h3 id="modalTitle" class="song_title"></h3>
                                <h6 id="modalSubTitle" class="song_phrase"></h6>
                            </div>
                            <div>
                                <img src="{{asset('public/images/front/volume.svg')}}" alt="volume" width="33"
                                    height="30">
                            </div>
                        </div>

                        <p id="modalDescription"></p>

                        <!-- AUDIO -->
                        <audio id="audio">
                            <source id="audioSource" src="" type="audio/mpeg">
                            Your browser does not support audio.
                        </audio>

                        <!-- TIME -->
                        <div class="audio-meta">
                            <span id="currentTime">0:00</span>
                            <span id="remainingTime">-0:00</span>
                        </div>

                        <!-- PROGRESS -->
                        <div class="progress-bar" id="progressBar">
                            <span id="progress"></span>
                        </div>

                        <!-- CONTROLS -->
                        <div class="controls">
                            <button class="icon">⏮</button>
                            <button class="play" id="playBtn">▶</button>
                            <button class="icon">⏭</button>
                        </div>

                        <a href="javascript:void(0);" class="com_btn" id="giftBtn">GIFT THIS BLESSING</a>
                        <div class="audio-links mt-4">
                            <a href="javascript:void(0);" id="shareBlessingBtn">Share this <svg width="20" height="22"
                                    viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.75 5.25L6.75 8.75M6.75 12.75L12.75 16.25M15.75 6.75C14.0931 6.75 12.75 5.40685 12.75 3.75C12.75 2.09315 14.0931 0.75 15.75 0.75C17.4069 0.75 18.75 2.09315 18.75 3.75C18.75 5.40685 17.4069 6.75 15.75 6.75ZM15.75 20.75C14.0931 20.75 12.75 19.4069 12.75 17.75C12.75 16.0931 14.0931 14.75 15.75 14.75C17.4069 14.75 18.75 16.0931 18.75 17.75C18.75 19.4069 17.4069 20.75 15.75 20.75ZM3.75 13.75C2.09315 13.75 0.75 12.4069 0.75 10.75C0.75 9.0931 2.09315 7.75 3.75 7.75C5.40685 7.75 6.75 9.0931 6.75 10.75C6.75 12.4069 5.40685 13.75 3.75 13.75Z"
                                        stroke="#c7b58c" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <button type="button" class="btn-close position-absolute bles_modal_close " data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gift Blessing Modal -->
<div class="modal fade audio_modal" id="giftBlessingModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <form method="POST" id="giftBlessingForm" action="{{ route('front.store.gift.blessing') }}"
                        class="ct_form">
                        @csrf
                        <div class="modal-header border-0 px-0 pt-0">
                            <h5 class="title_40">Gift This Blessing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <input type="hidden" name="blessing_id" id="giftBlessingId">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <h6 class="sub_head">Your Details</h6>
                                </div>
                                <div class="ct_input">
                                    <label class="sub_head">Name</label>
                                    <input type="text" name="from_name" placeholder="Enter your Name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                                </div>
                                <div class="ct_input">
                                    <label class="sub_head">Email</label>
                                    <input type="email" name="from_email" placeholder="Enter your Email">
                                </div>
                                <div class="ct_input">
                                    <label class="sub_head">Phone</label>
                                    <input type="text" name="from_phone" placeholder="Enter your Phone Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="ct_input">
                                    <h6 class="sub_head">Recipient's Details</h6>
                                </div>

                                <div class="ct_input">
                                    <label class="sub_head">Name</label>
                                    <input type="text" name="to_name" placeholder="Enter the Name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                                </div>
                                <div class="ct_input">
                                    <label class="sub_head">Email</label>
                                    <input type="email" name="to_email" placeholder="Email">
                                </div>
                                <div class="ct_input">
                                    <label class="sub_head">Phone</label>
                                    <input type="text" name="to_phone" placeholder="Enter Phone Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Recipient's Address Line1</label>
                                    <input type="text" name="address_line1" placeholder="Enter Address Line 1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Recipient's Address Line2</label>
                                    <input type="text" name="address_line2" placeholder="Enter Address Line 2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Recipient's Emirate</label>
                                    <input type="text" name="emirate" placeholder="Enter Emirate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Recipient's Landmark</label>
                                    <input type="text" name="landmark" placeholder="Enter Landmark">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Message/Notes</label>
                                    <textarea name="message_note" placeholder="Notes" id="#" rows="1"
                                        aria-invalid="false"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="ct_input">
                                    <div class=" remember-me mb-3">
                                        <span><input type="checkbox" value="1" id="addFlowersCheckbox"
                                                name="add_flowers"></span>
                                        <label class="sub_head"> Would you like to add beautiful Flowers?</label>
                                    </div>

                                    <div id="giftFlowerOptions" class="gift_flower_options is-visible">

                                        <label class="flower_option">
                                            <input type="radio" name="flower_budget_range" value="150 to 250">
                                            <span class="custom_radio"></span>
                                            <span class="option_text">₹150 - ₹250</span>
                                        </label>

                                        <label class="flower_option">
                                            <input type="radio" name="flower_budget_range" value="250 to 500">
                                            <span class="custom_radio"></span>
                                            <span class="option_text">₹250 - ₹500</span>
                                        </label>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class=" d-flex justify-content-center gap-2">
                            <a class="com_btn" data-bs-toggle="modal" data-bs-target="#blessingPopup"
                                style="cursor: pointer;"><span>
                                    <- </span> Back</a>
                            <button type="submit" class="com_btn bg-transparent">Send Gift</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Share Details Modal -->
<div class="modal fade audio_modal" id="shareDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <form method="POST" id="shareDetailsForm" action="{{ route('front.store.shared.detail') }}"
                        class="ct_form">
                        @csrf
                        <div class="modal-header border-0 px-0 pt-0">
                            <h5 class="title_40">Share This Blessing</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <input type="hidden" name="blessing_id" id="shareBlessingId">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Name</label>
                                    <input type="text" name="name" placeholder="Enter your Name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Email</label>
                                    <input type="email" name="email" placeholder="Enter your Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="ct_input">
                                    <label class="sub_head">Contact</label>
                                    <input type="text" name="contact_no" placeholder="Enter your Contact Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-center gap-2">
                            <button type="submit" class="com_btn bg-transparent">Continue to Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Share Options Modal -->
<div class="modal fade audio_modal" id="shareOptionsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid gap-0">
                    <div class="modal-header border-0 px-0 pt-0">
                        <h5 class="title_40">Social Sharing Options</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div>
                        Awesome! Where would you like to share your poem?
                    </div>

                    <div class="share-wrapper">
                        <a href="javascript:void(0);" id="shareWhatsappBtn" class="share-box whatsapp"
                            title="Share on WhatsApp">
                            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_146_89)">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M75 0C116.423 0 150 33.5771 150 75C150 116.423 116.423 150 75 150C33.5771 150 0 116.423 0 75C0 33.5771 33.5771 0 75 0Z"
                                        fill="url(#paint0_linear_146_89)" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M75.0002 109.518C68.8918 109.518 62.8801 107.892 57.6213 104.818C56.7746 104.323 55.7551 104.191 54.8088 104.449L43.3742 107.587L47.3586 98.8125C47.9006 97.6201 47.76 96.2285 46.9953 95.165C42.7326 89.2617 40.4826 82.2861 40.4826 75C40.4826 55.9658 55.966 40.4824 75.0002 40.4824C94.0344 40.4824 109.518 55.9658 109.518 75C109.518 94.0342 94.0344 109.518 75.0002 109.518ZM75.0002 33.1758C51.9377 33.1758 33.1789 51.9375 33.1789 75C33.1789 83.1123 35.4787 90.9023 39.8586 97.6641L33.5041 111.659C32.9182 112.951 33.132 114.463 34.049 115.541C34.7551 116.364 35.7775 116.824 36.8293 116.824C39.1848 116.824 52.0314 112.787 55.301 111.888C61.3449 115.122 68.1213 116.824 75.0002 116.824C98.0598 116.824 116.824 98.0596 116.824 75C116.824 51.9375 98.0598 33.1787 75.0002 33.1758Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M84.9844 79.8895C83.4024 80.537 82.3916 83.0155 81.3662 84.2811C80.8389 84.9286 80.2119 85.0311 79.4033 84.7059C73.4619 82.3388 68.9063 78.372 65.6279 72.9052C65.0713 72.0585 65.1709 71.3876 65.8418 70.5995C66.832 69.4335 68.0772 68.1093 68.3438 66.536C68.9385 63.0614 64.3945 52.2772 58.3916 57.164C41.1211 71.2382 87.2022 108.565 95.5195 88.3768C97.8721 82.6522 87.6094 78.8143 84.9844 79.8895Z"
                                        fill="white" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_146_89" x1="19.8721" y1="24.1465" x2="138.923"
                                        y2="114.252" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#39AE41" />
                                        <stop offset="1" stop-color="#80C269" />
                                    </linearGradient>
                                    <clipPath id="clip0_146_89">
                                        <rect width="150" height="150" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>WhatsApp</span>
                        </a>

                        <a href="javascript:void(0);" id="shareEmailBtn" class="share-box gmail" title="Share via Email">
                            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M75 2C115.317 2 148 34.6832 148 75C148 115.317 115.317 148 75 148C34.6832 148 2 115.317 2 75C2 34.6832 34.6832 2 75 2Z"
                                    stroke="#8C8A72" stroke-width="4" />
                                <g clip-path="url(#clip0_146_125)">
                                    <path
                                        d="M36.0352 108.984H50.3906V73.9701L29.8828 58.5227V102.805C29.8828 106.224 32.6411 108.984 36.0352 108.984Z"
                                        fill="#4285F4" />
                                    <path
                                        d="M99.6094 108.984H113.965C117.369 108.984 120.117 106.214 120.117 102.805V58.5227L99.6094 73.9701"
                                        fill="#34A853" />
                                    <path
                                        d="M99.6094 47.1946V73.9701L120.117 58.5227V50.284C120.117 42.6427 111.432 38.2865 105.352 42.8693"
                                        fill="#FBBC04" />
                                    <path d="M50.3906 73.9701V47.1946L75 65.7315L99.6094 47.1946V73.9701L75 92.5071"
                                        fill="#EA4335" />
                                    <path
                                        d="M29.8828 50.284V58.5227L50.3906 73.9701V47.1946L44.6484 42.8693C38.5576 38.2865 29.8828 42.6427 29.8828 50.284Z"
                                        fill="#C5221F" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_146_125">
                                        <rect width="90.2344" height="67.9688" fill="white"
                                            transform="translate(29.8828 41.0156)" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Email</span>
                        </a>

                        <a href="javascript:void(0);" id="shareInstagramBtn" class="share-box instagram"
                            title="Share on Instagram">
                            <svg viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_146_96)">
                                    <mask id="mask0_146_96" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="150" height="150">
                                        <path
                                            d="M75 150C116.421 150 150 116.421 150 75C150 33.5786 116.421 0 75 0C33.5786 0 0 33.5786 0 75C0 116.421 33.5786 150 75 150Z"
                                            fill="white" />
                                    </mask>
                                    <g mask="url(#mask0_146_96)">
                                        <path
                                            d="M32.2266 303.516C121.218 303.516 193.359 231.374 193.359 142.383C193.359 53.3916 121.218 -18.75 32.2266 -18.75C-56.7646 -18.75 -128.906 53.3916 -128.906 142.383C-128.906 231.374 -56.7646 303.516 32.2266 303.516Z"
                                            fill="url(#paint0_radial_146_96)" />
                                    </g>
                                    <path
                                        d="M96.0938 59.7656C99.3298 59.7656 101.953 57.1423 101.953 53.9062C101.953 50.6702 99.3298 48.0469 96.0938 48.0469C92.8577 48.0469 90.2344 50.6702 90.2344 53.9062C90.2344 57.1423 92.8577 59.7656 96.0938 59.7656Z"
                                        fill="white" />
                                    <path
                                        d="M75 56.25C71.2916 56.25 67.6665 57.3497 64.5831 59.4099C61.4996 61.4702 59.0964 64.3986 57.6773 67.8247C56.2581 71.2508 55.8868 75.0208 56.6103 78.6579C57.3338 82.2951 59.1195 85.636 61.7418 88.2582C64.364 90.8805 67.7049 92.6663 71.3421 93.3897C74.9792 94.1132 78.7492 93.7419 82.1753 92.3227C85.6014 90.9036 88.5298 88.5004 90.5901 85.4169C92.6503 82.3335 93.75 78.7084 93.75 75C93.75 70.0272 91.7746 65.2581 88.2583 61.7417C84.742 58.2254 79.9728 56.25 75 56.25ZM75 84.375C73.1458 84.375 71.3333 83.8252 69.7915 82.795C68.2498 81.7649 67.0482 80.3007 66.3386 78.5877C65.6291 76.8746 65.4434 74.9896 65.8051 73.171C66.1669 71.3525 67.0598 69.682 68.3709 68.3709C69.682 67.0598 71.3525 66.1669 73.171 65.8051C74.9896 65.4434 76.8746 65.6291 78.5877 66.3386C80.3007 67.0482 81.7649 68.2498 82.795 69.7915C83.8252 71.3332 84.375 73.1458 84.375 75C84.375 77.4864 83.3873 79.871 81.6291 81.6291C79.871 83.3873 77.4864 84.375 75 84.375Z"
                                        fill="white" />
                                    <path
                                        d="M98.4375 37.5H51.5625C43.796 37.5 37.5 43.796 37.5 51.5625V98.4375C37.5 106.204 43.796 112.5 51.5625 112.5H98.4375C106.204 112.5 112.5 106.204 112.5 98.4375V51.5625C112.5 43.796 106.204 37.5 98.4375 37.5Z"
                                        stroke="white" stroke-width="10.0495" stroke-miterlimit="10" />
                                </g>
                                <defs>
                                    <radialGradient id="paint0_radial_146_96" cx="0" cy="0" r="1"
                                        gradientUnits="userSpaceOnUse"
                                        gradientTransform="translate(32.2266 142.383) scale(161.133)">
                                        <stop stop-color="#FFD676" />
                                        <stop offset="0.25" stop-color="#F2A454" />
                                        <stop offset="0.38" stop-color="#F05C3C" />
                                        <stop offset="0.7" stop-color="#C22F86" />
                                        <stop offset="0.96" stop-color="#6666AD" />
                                        <stop offset="0.99" stop-color="#5C6CB2" />
                                    </radialGradient>
                                    <clipPath id="clip0_146_96">
                                        <rect width="150" height="150" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Instagram</span>
                        </a>
                    </div>

                       <div class="text-center">
                       <a class="com_btn" data-bs-toggle="modal" data-bs-target="#blessingPopup" style="cursor: pointer;"><span>
                                    &lt;- </span> Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
let currentBlessingId = null;
let activeShareLink = '';
let activeWhatsappUrl = '';
let activeEmailUrl = '';
let activeInstagramUrl = 'https://www.instagram.com/';
const modal = document.getElementById("blessingPopup");
const audio = document.getElementById("audio");
const playBtn = document.getElementById("playBtn");
const progressBar = document.getElementById("progressBar");
const progress = document.getElementById("progress");
const currentTimeEl = document.getElementById("currentTime");
const remainingTimeEl = document.getElementById("remainingTime");

let wasPlaying = false;

// Play / Pause
playBtn.addEventListener("click", async () => {
    try {
        if (audio.paused) {
            await audio.play();
            playBtn.textContent = "⏸";
        } else {
            audio.pause();
            playBtn.textContent = "▶";
        }
    } catch (err) {
        console.warn("Audio play interrupted:", err);
    }
});

function buildBlessingShareLink(blessingId) {
    return sitePath + '/blessings-detail/' + blessingId;
}

function copyShareLink(callback) {
    if (!activeShareLink) {
        alert('Share link not available');
        return;
    }

    navigator.clipboard.writeText(activeShareLink).then(function() {
        if (typeof callback === 'function') {
            callback();
        }
    }).catch(function() {
        if (typeof callback === 'function') {
            callback();
        }
    });
}

// Update progress
audio.addEventListener("timeupdate", () => {
    const percent = (audio.currentTime / audio.duration) * 100;
    progress.style.width = percent + "%";

    currentTimeEl.textContent = formatTime(audio.currentTime);
    remainingTimeEl.textContent = "-" + formatTime(audio.duration - audio.currentTime);
});

// Seek
progressBar.addEventListener("click", (e) => {
    const width = progressBar.clientWidth;
    const clickX = e.offsetX;
    audio.currentTime = (clickX / width) * audio.duration;
});

// On audio end
audio.addEventListener("ended", () => {
    playBtn.textContent = "▶";
    progress.style.width = "0%";
});

// Modal close → pause & reset audio
modal.addEventListener("hidden.bs.modal", () => {
    audio.pause();
    audio.currentTime = 0;
    playBtn.textContent = "▶";
    wasPlaying = false;
});

modal.addEventListener("shown.bs.modal", () => {
    wasPlaying = false;
});

function formatTime(time) {
    if (isNaN(time)) return "0:00";
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60).toString().padStart(2, "0");
    return `${minutes}:${seconds}`;
}

// Open blessing modal & load data
document.addEventListener('click', function(e) {
    const card = e.target.closest('.open-blessing');
    if (!card) return;

    const blessingId = card.dataset.id;
    const title = card.dataset.title;
    const subtitle = card.dataset.subtitle;
    const description = card.dataset.description;
    const image = card.dataset.image;
    const audioSrc = card.dataset.audio;

    currentBlessingId = blessingId;

    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalSubTitle').textContent = subtitle;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalImage').src = image;

    const audioEl = document.getElementById('audio');
    const audioSource = document.getElementById('audioSource');

    audioEl.pause();
    audioEl.currentTime = 0;
    audioSource.src = audioSrc;
    audioEl.load();

    document.getElementById('playBtn').textContent = '▶';
});

// Filter dropdown change
$(document).ready(function() {
    $('#blessing_of').on('change', function() {
        var slug = $(this).val();
        if (slug) {
            window.location.href = "{{ route('front.blessings.library', ':slug') }}".replace(':slug',
                slug);
        } else {
            window.location.href = "{{ route('front.blessings.library') }}";
        }
    });
});

// ========== UPDATED GIFT BUTTON LOGIC ==========
$('#giftBtn').on('click', function() {
    if (!currentBlessingId) {
        alert('Please select a blessing');
        return;
    }

    // Set the blessing ID in gift form
    $('#giftBlessingId').val(currentBlessingId);

    // Close the first modal (blessing detail)
    $('#blessingPopup').modal('hide');

    // Open the gift modal after the first one has fully hidden (with small delay for smooth transition)
    setTimeout(function() {
        $('#giftBlessingModal').modal('show');
    }, 350);
});
// ==============================================

$('#shareBlessingBtn').on('click', function() {
    if (!currentBlessingId) {
        alert('Please select a blessing');
        return;
    }

    $('#shareBlessingId').val(currentBlessingId);
    $('#blessingPopup').modal('hide');

    setTimeout(function() {
        $('#shareDetailsModal').modal('show');
    }, 350);
});

var formSubmitted = false;
var shareFormSubmitted = false;
const addFlowersCheckbox = document.getElementById('addFlowersCheckbox');
const giftFlowerOptions = document.getElementById('giftFlowerOptions');

function toggleGiftFlowerOptions() {
    if (!addFlowersCheckbox || !giftFlowerOptions) {
        return;
    }

    if (addFlowersCheckbox.checked) {
        giftFlowerOptions.classList.add('is-visible');
        return;
    }

    giftFlowerOptions.classList.remove('is-visible');
    giftFlowerOptions.querySelectorAll('input[name="flower_budget_range"]').forEach(function(radio) {
        radio.checked = false;
    });
}

if (addFlowersCheckbox) {
    addFlowersCheckbox.addEventListener('change', toggleGiftFlowerOptions);
    toggleGiftFlowerOptions();
}

$('#giftBlessingForm').validate({
    rules: {
        from_name: {
            required: true,
            minlength: 2,
            maxlength: 50,
            lettersonly: true
        },
        from_email: {
            required: true,
            email: true,
            noSpamEmail: true,
        },
        from_phone: {
            required: true,
            validPhone: true
        },
        to_name: {
            required: true,
            minlength: 2,
            maxlength: 50,
            lettersonly: true
        },
        to_email: {
            required: true,
            email: true,
            noSpamEmail: true,
        },
        to_phone: {
            required: true,
            validPhone: true
        },
        address_line1: {
            required: true,
            minlength: 3,
            maxlength: 150
        },
        address_line2: {
            required: true,
            minlength: 3,
            maxlength: 150
        },
        emirate: {
            required: true,
            minlength: 3,
            maxlength: 50,
            lettersonly: true
        },
        landmark: {
            minlength: {
                param: 3,
                depends: function(element) {
                    return $(element).val().length > 0;
                }
            },
            maxlength: 150
        },
        flower_budget_range: {
            required: {
                depends: function() {
                    return $('#addFlowersCheckbox').is(':checked');
                }
            }
        },
    },
    messages: {
        from_name: {
            required: "Please enter your Full name",
            minlength: "Name must be at least 2 characters",
            maxlength: "Name cannot be longer than 50 characters",
            lettersonly: "Only letters and spaces are allowed"
        },
        from_email: {
            required: "Please enter your email",
            email: "Please enter a valid email address",
            noSpamEmail: "This email address is not allowed",
        },
        from_phone: {
            required: "Please enter your Contact number"
        },
        to_name: {
            required: "Please enter recipient's Full name",
            minlength: "Name must be at least 2 characters",
            maxlength: "Name cannot be longer than 50 characters",
            lettersonly: "Only letters and spaces are allowed"
        },
        to_email: {
            required: "Please enter recipient's email",
            email: "Please enter a valid email address",
            noSpamEmail: "This email address is not allowed",
        },
        to_phone: {
            required: "Please enter recipient's Contact number"
        },
        address_line1: {
            required: "Please enter recipient's Address Line 1",
            minlength: "Address Line 1 must be at least 3 characters",
            maxlength: "Address Line 1 cannot exceed 150 characters"
        },
        address_line2: {
            required: "Please enter recipient's Address Line 2",
            minlength: "Address Line 2 must be at least 3 characters",
            maxlength: "Address Line 2 cannot exceed 150 characters"
        },
        emirate: {
            required: "Please enter recipient's Emirate",
            minlength: "Emirate must be at least 3 characters",
            maxlength: "Emirate cannot exceed 50 characters",
            lettersonly: "Only letters and spaces are allowed"
        },
        landmark: {
            minlength: "Landmark must be at least 3 characters",
            maxlength: "Landmark cannot exceed 150 characters"
        },
        flower_budget_range: {
            required: "Please select a flower budget range"
        },
    },
    submitHandler: function(form) {
        if (!formSubmitted) {
            formSubmitted = true;
            const btn = $(form).find('button[type="submit"]');
            if (btn.length) {
                btn.prop('disabled', true).text('Submitting...');
            }
            $.ajax({
                url: "{{ route('front.store.gift.blessing') }}",
                method: "POST",
                data: $(form).serialize(),
                success: function(res) {
                    alert(res.message);
                    $('#giftBlessingModal').modal('hide');
                    form.reset();
                    toggleGiftFlowerOptions();
                    if (res.whatsapp_url) {
                        window.open(res.whatsapp_url, '_blank');
                    }
                },
                error: function() {
                    alert('Something went wrong');
                    formSubmitted = false;
                    btn.prop('disabled', false).text('Send Gift');
                },
                complete: function() {
                    formSubmitted = false;
                    btn.prop('disabled', false).text('Send Gift');
                }
            });
        }
    }
});

$('#shareDetailsForm').validate({
    rules: {
        name: {
            required: true,
            minlength: 2,
            maxlength: 100,
            lettersonly: true
        },
        email: {
            required: true,
            email: true,
            noSpamEmail: true,
        },
        contact_no: {
            required: true,
            validPhone: true
        }
    },
    messages: {
        name: {
            required: 'Please enter your name',
            minlength: 'Name must be at least 2 characters',
            maxlength: 'Name cannot be longer than 100 characters',
            lettersonly: 'Only letters and spaces are allowed'
        },
        email: {
            required: 'Please enter your email',
            email: 'Please enter a valid email address',
            noSpamEmail: 'This email address is not allowed',
        },
        contact_no: {
            required: 'Please enter your contact number'
        }
    },
    submitHandler: function(form) {
        if (!shareFormSubmitted) {
            shareFormSubmitted = true;
            const btn = $(form).find('button[type="submit"]');

            if (btn.length) {
                btn.prop('disabled', true).text('Submitting...');
            }

            $.ajax({
                url: "{{ route('front.store.shared.detail') }}",
                method: 'POST',
                data: $(form).serialize(),
                success: function(res) {
                    activeShareLink = res.share_link || buildBlessingShareLink($(
                        '#shareBlessingId').val());
                    activeWhatsappUrl = res.whatsapp_url || ('https://wa.me/?text=' +
                        encodeURIComponent(activeShareLink));
                    activeEmailUrl = res.email_url || ('mailto:?subject=' + encodeURIComponent(
                        'Blessing share') + '&body=' + encodeURIComponent(
                        activeShareLink));
                    activeInstagramUrl = res.instagram_url || 'https://www.instagram.com/';

                    $('#shareDetailsModal').modal('hide');
                    form.reset();

                    setTimeout(function() {
                        $('#shareOptionsModal').modal('show');
                    }, 350);
                },
                error: function(xhr) {
                    let message = 'Something went wrong';

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const firstError = Object.values(xhr.responseJSON.errors)[0];
                        if (firstError && firstError[0]) {
                            message = firstError[0];
                        }
                    }

                    alert(message);
                },
                complete: function() {
                    shareFormSubmitted = false;
                    if (btn.length) {
                        btn.prop('disabled', false).text('Continue to Share');
                    }
                }
            });
        }
    }
});

$('#shareWhatsappBtn').on('click', function() {
    if (!activeWhatsappUrl) {
        alert('Share link not available');
        return;
    }

    window.open(activeWhatsappUrl, '_blank');
});

$('#shareEmailBtn').on('click', function() {
    if (!activeEmailUrl) {
        alert('Share link not available');
        return;
    }

    window.location.href = activeEmailUrl;
});

$('#shareInstagramBtn').on('click', function() {
    copyShareLink(function() {
        alert('Share link copied. Paste it in Instagram.');
        window.open(activeInstagramUrl, '_blank');
    });
});

$('#giftBlessingModal').on('hidden.bs.modal', function() {
    const form = document.getElementById('giftBlessingForm');
    if (form) {
        form.reset();
    }
    toggleGiftFlowerOptions();
});

$('#shareDetailsModal').on('hidden.bs.modal', function() {
    const form = document.getElementById('shareDetailsForm');
    if (form) {
        form.reset();
    }
});
</script>
@endpush

@include('layouts.frontfooter')