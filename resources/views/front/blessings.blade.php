@include('layouts.frontheader')
@php // print_r(request()->segment(2)); die; 
@endphp

<style>
    .form-control:focus
    {
            border-color: #8c8a72;
            box-shadow:unset;
    }
</style>
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/blessing-library-banner.png')}}" alt="him banner">

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
                        <div class="gesture_box open-blessing"
                                data-bs-toggle="modal"
                                data-bs-target="#blessingPopup"
                                data-id="{{ $val->id }}"
                                data-title="{{ $val->title }}"
                                data-subtitle="{{ $val->sub_title }}"
                                data-description="{{ strip_tags($val->description) }}"
                                data-image="{{ asset('public/images/admin/blessing/images/'.$val->image) }}"
                                data-audio="{{ asset('public/images/admin/blessing/audios/'.$val->audio_file) }}"
                            >
                            <img class="img-fluid mb-2 mb-md-4" src="{{ asset('public/images/admin/blessing/images/'.$val->image) }}" alt="images">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="sub_head">{{ $val->title ?? '' }}</h3>
                                    <p class="mb-0">{{ $val->sub_title ?? '' }}</p>
                                </div>
                                <div>
                                    <img style="cursor: pointer;" src="{{asset('public/images/front/volume.svg')}}" alt="" width="33" height="30">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <img class="mb-2 mb-md-4" height="250px" width="250px" src="{{asset('public/images/not_found.avif')}}" alt="images">
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Blessing Detail Modal -->
<div class="modal fade audio_modal" id="blessingPopup" tabindex="-1" aria-labelledby="blessingPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card">
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
                                <img src="{{asset('public/images/front/volume.svg')}}" alt="volume" width="33" height="30">
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
                            <a href="#" onclick="openShare()">Share this <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.75 5.25L6.75 8.75M6.75 12.75L12.75 16.25M15.75 6.75C14.0931 6.75 12.75 5.40685 12.75 3.75C12.75 2.09315 14.0931 0.75 15.75 0.75C17.4069 0.75 18.75 2.09315 18.75 3.75C18.75 5.40685 17.4069 6.75 15.75 6.75ZM15.75 20.75C14.0931 20.75 12.75 19.4069 12.75 17.75C12.75 16.0931 14.0931 14.75 15.75 14.75C17.4069 14.75 18.75 16.0931 18.75 17.75C18.75 19.4069 17.4069 20.75 15.75 20.75ZM3.75 13.75C2.09315 13.75 0.75 12.4069 0.75 10.75C0.75 9.0931 2.09315 7.75 3.75 7.75C5.40685 7.75 6.75 9.0931 6.75 10.75C6.75 12.4069 5.40685 13.75 3.75 13.75Z"
                                        stroke="#c7b58c" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
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
                     <form method="POST" id="giftBlessingForm" action="{{ route('front.store.gift.blessing') }}">
                @csrf
                <div class="modal-header px-0 pt-0">
                    <h5 class="modal-title">Gift This Blessing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                    <input type="hidden" name="blessing_id" id="giftBlessingId">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h6>From</h6>
                            <div class="mb-3">
                                <input type="text" name="from_name" class="form-control mb-2" placeholder="Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="from_email" class="form-control mb-2" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="from_phone" class="form-control mb-3" placeholder="Phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                            </div>
                                
                        </div>
                        
                        <div class="col-md-6">
                            <h6>To</h6>
                            
                            <div class="mb-3">
                                 <input type="text" name="to_name" class="form-control mb-2" placeholder="Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                            </div>
                            <div class="mb-3">
                                 <input type="email" name="to_email" class="form-control mb-2" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="to_phone" class="form-control mb-2" placeholder="Phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                            </div>
                                 
                        </div>
                        
                        <div class="col-md-12">
                             <textarea id="#" rows="3" placeholder="Nots" class="form-control mb-2 valid" aria-invalid="false">                                 
                             </textarea>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-center gap-2">
                         <a class="com_btn"  data-bs-toggle="modal" data-bs-target="#blessingPopup" style="cursor: pointer;"><span><-</span> Back</a>
                        <button type="submit" class="com_btn bg-transparent">Send Gift</button>
                    </div>
                   
            </form>
                </div>
            </div>
           
        </div>
    </div>
</div>

@push('script')
<script>
let currentBlessingId = null;
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

function openShare() {
    const url = sitePath + '/blessings-detail/'+currentBlessingId;

    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: url
        });
    } else {
        navigator.clipboard.writeText(url).then(() => {
            alert("Link copied to clipboard");
        });
    }
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
document.addEventListener('click', function (e) {
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
        if(slug) {
            window.location.href = "{{ route('front.blessings.library', ':slug') }}".replace(':slug', slug);
        } else {
            window.location.href = "{{ route('front.blessings.library') }}";
        }
    });
});

// ========== UPDATED GIFT BUTTON LOGIC ==========
$('#giftBtn').on('click', function () {
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

var formSubmitted = false;
$('#giftBlessingForm').validate({
    rules: {
        from_name: { required: true, minlength: 2, maxlength: 50, lettersonly: true },
        from_email: { required: true, email: true, noSpamEmail: true, uniqueEmail: "contact_inquiries" },
        from_phone: { required: true, validPhone: true },
        to_name: { required: true, minlength: 2, maxlength: 50, lettersonly: true },
        to_email: { required: true, email: true, noSpamEmail: true, uniqueEmail: "contact_inquiries" },
        to_phone: { required: true, validPhone: true },
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
        from_phone: { required: "Please enter your Contact number" },
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
        to_phone: { required: "Please enter recipient's Contact number" },
    },
    submitHandler: function (form) {
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
                success: function (res) {
                    alert(res.message);
                    $('#giftBlessingModal').modal('hide');
                    form.reset();
                    if (res.whatsapp_url) {
                        window.open(res.whatsapp_url, '_blank');
                    }
                },
                error: function () {
                    alert('Something went wrong');
                    formSubmitted = false;
                    btn.prop('disabled', false).text('Send Gift');
                },
                complete: function () {
                    formSubmitted = false;
                    btn.prop('disabled', false).text('Send Gift');
                }
            });
        }
    }
});
</script>
@endpush

@include('layouts.frontfooter')