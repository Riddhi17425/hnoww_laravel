@include('layouts.frontheader')
@php // print_r(request()->segment(2)); die;
@endphp

<style>
.gift_flower_options {
    display: none;
}

.gift_flower_options.is-visible {
    display: flex;
    gap: 15px;
}

/* OPTION CARD */
.flower_option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 18px;
    border: 2px solid #ddd;
    cursor: pointer;
    transition: 0.3s;
    font-weight: 500;
}

/* HIDE DEFAULT RADIO */
.flower_option input {
    display: none;
}

/* CUSTOM RADIO */
.custom_radio {
    width: 18px;
    height: 18px;
    border: 2px solid #999;
    border-radius: 50%;
    position: relative;
}

/* INNER DOT */
.custom_radio::after {
    content: "";
    width: 10px;
    height: 10px;
    background: #8c8a72;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: 0.2s;
}

/* TEXT */
.option_text {
    font-size: 14px;
}

/* ACTIVE STATE */
.flower_option input:checked+.custom_radio {
    border-color: #8c8a72;
}

.flower_option input:checked+.custom_radio::after {
    transform: translate(-50%, -50%) scale(1);
}


/* HOVER EFFECT */
.flower_option:hover {
    border-color: #8c8a72;
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
                                    <label class="sub_head">Receipients Address Line1</label>
                                    <input type="text" name="address_line1" placeholder="Enter Address Line 1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Receipients Address Line2</label>
                                    <input type="text" name="address_line2" placeholder="Enter Address Line 2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Receipients Emirate</label>
                                    <input type="text" name="emirate" placeholder="Enter Emirate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ct_input">
                                    <label class="sub_head">Receipients Landmark</label>
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
                                    <input type="checkbox" value="1" id="addFlowersCheckbox" name="add_flowers">
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

                        <div class="mt-3 d-flex justify-content-center gap-2">
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
                <div class="audio-card d-grid">
                    <div class="modal-header border-0 px-0 pt-0">
                        <h5 class="title_40">Share Options</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="share_option_buttons">
                        <a href="javascript:void(0);" class="com_btn bg-transparent" id="shareWhatsappBtn">Share on
                            WhatsApp</a>
                        <a href="javascript:void(0);" class="com_btn bg-transparent" id="shareEmailBtn">Share on
                            Email</a>
                        <a href="javascript:void(0);" class="com_btn bg-transparent" id="shareInstagramBtn">Share on
                            Instagram</a>
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