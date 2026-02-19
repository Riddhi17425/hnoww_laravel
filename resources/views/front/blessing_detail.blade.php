@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/blessing-library-banner.webp')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head mb-3">The Blessing Detail</h2>
        <p class="para sec_in_mb">Audio-poetic rituals to anchor the soul.</p>
    </div>
</section>

<section class="mt_80 mb_120">
    <div class="container">
        <div class="audio-card">

            <!-- IMAGE -->
            <div class="audio-image">
                <img src="{{ asset('public/images/admin/blessing/images/'.$blessing->image) }}"
                     alt="{{ $blessing->title }}"
                     class="img-fluid">
            </div>

            <div class="audio-content">

                <!-- TITLE -->
                <div class="d-flex align-items-center justify-content-between my-3">
                    <div>
                        <h3 class="song_title">{{ $blessing->title }}</h3>
                        <h6 class="song_phrase">{{ $blessing->sub_title }}</h6>
                    </div>
                    <img src="{{ asset('public/images/front/volume.svg') }}" width="33" height="30">
                </div>

                <!-- DESCRIPTION -->
                <p>
                    {!! nl2br(e($blessing->description)) !!}
                </p>

                <!-- AUDIO -->
                <audio id="audio">
                    <source src="{{ asset('public/images/admin/blessing/audios/'.$blessing->audio_file) }}"
                            type="audio/mpeg">
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

                <!-- CTA -->
                {{-- <a href="#"
                   class="com_btn">
                    GIFT THIS BLESSING
                </a> --}}
            </div>
        </div>
    </div>
</section>

@push('script')
<script>
const audio = document.getElementById("audio");
const playBtn = document.getElementById("playBtn");
const progressBar = document.getElementById("progressBar");
const progress = document.getElementById("progress");
const currentTimeEl = document.getElementById("currentTime");
const remainingTimeEl = document.getElementById("remainingTime");

let wasPlaying = false; // track state

// Play / Pause
// playBtn.addEventListener("click", () => {
//     if (audio.paused) {
//         audio.play();
//         playBtn.textContent = "⏸";
//     } else {
//         audio.pause();
//         playBtn.textContent = "▶";
//     }
// });
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

// Update progress
audio.addEventListener("timeupdate", () => {
    const percent = (audio.currentTime / audio.duration) * 100;
    progress.style.width = percent + "%";

    currentTimeEl.textContent = formatTime(audio.currentTime);
    remainingTimeEl.textContent =
        "-" + formatTime(audio.duration - audio.currentTime);
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

// 👉 MODAL CLOSE → PAUSE AUDIO
// modal.addEventListener("hidden.bs.modal", () => {
//     wasPlaying = !audio.paused; // store state
//     audio.pause();
//     playBtn.textContent = "▶";
// });
modal.addEventListener("hidden.bs.modal", () => {
    audio.pause();
    audio.currentTime = 0;
    playBtn.textContent = "▶";
});


// 👉 MODAL OPEN → RESUME IF IT WAS PLAYING
// modal.addEventListener("shown.bs.modal", () => {
//     if (wasPlaying) {
//         audio.play();
//         playBtn.textContent = "⏸";
//     }
//     wasPlaying = false; // reset state
// });
modal.addEventListener("shown.bs.modal", () => {
    wasPlaying = false; // reset state
});

function formatTime(time) {
    if (isNaN(time)) return "0:00";
    const minutes = Math.floor(time / 60);
    const seconds = Math.floor(time % 60)
        .toString()
        .padStart(2, "0");
    return `${minutes}:${seconds}`;
}


</script>
@endpush

@include('layouts.frontfooter')
