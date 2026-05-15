<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/images/front/favicon.png') }}">
    <title>HNOWW — Launching Soon</title>
    <meta name="description" content="Luxury gifting where design, ritual, and story take shape. Launching soon.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:     #B58A46;
            --gold-lt:  #D4A96A;
            --gold-dk:  #8d6a2e;
            --bg:       #0d0c0a;
            --bg2:      #141210;
            --cream:    #F5F0E8;
            --muted:    rgba(245,240,232,0.55);
            --faint:    rgba(245,240,232,0.25);
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--cream);
            overflow-x: hidden;
        }

        /* ─── BACKGROUND ─────────────────────────────────────── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 90% 55% at 50% -5%,  rgba(181,138,70,.22) 0%, transparent 60%),
                radial-gradient(ellipse 55% 40% at 95% 100%, rgba(181,138,70,.10) 0%, transparent 55%),
                radial-gradient(ellipse 40% 35% at 5%  80%,  rgba(181,138,70,.07) 0%, transparent 55%);
            pointer-events: none;
            z-index: 0;
        }

        /* ─── LAYOUT ──────────────────────────────────────────── */
        .cs-page {
            min-height: 100vh;
            display: grid;
            grid-template-rows: auto 1fr auto;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        /* ─── TOPBAR ──────────────────────────────────────────── */
        .cs-topbar {
            padding: 36px 40px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cs-logo {
            height: 38px;
            width: auto;
            /* invert black SVG to white */
            filter: brightness(0) invert(1);
        }

        /* ─── MAIN CONTENT ────────────────────────────────────── */
        .cs-main {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px 40px;
        }

        .cs-card {
            width: 100%;
            max-width: 620px;
            text-align: center;
        }

        /* ─── ORNAMENT ────────────────────────────────────────── */
        .cs-ornament {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .cs-ornament-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: .28em;
            text-transform: uppercase;
            color: var(--gold);
            white-space: nowrap;
        }

        .cs-ornament-bar {
            flex: 1;
            max-width: 72px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold));
        }

        .cs-ornament-bar.rev {
            background: linear-gradient(90deg, var(--gold), transparent);
        }

        .cs-ornament-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--gold);
            flex-shrink: 0;
        }

        /* ─── HEADINGS ────────────────────────────────────────── */
        .cs-eyebrow {
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: .28em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 22px;
        }

        .cs-headline {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.4rem, 5.5vw, 3.75rem);
            font-weight: 500;
            line-height: 1.18;
            color: #fff;
            margin-bottom: 26px;
        }

        .cs-headline em {
            font-style: italic;
            color: var(--gold-lt);
        }

        .cs-body {
            font-size: clamp(.875rem, 2vw, 1rem);
            font-weight: 300;
            line-height: 1.8;
            color: var(--muted);
            max-width: 460px;
            margin: 0 auto 44px;
        }

        /* ─── RULE ────────────────────────────────────────────── */
        .cs-rule {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 40px;
        }

        .cs-rule-line {
            flex: 1;
            height: 1px;
            background: rgba(181,138,70,.25);
        }

        .cs-rule-diamond {
            width: 6px;
            height: 6px;
            border: 1px solid var(--gold);
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        /* ─── FORM SECTION ────────────────────────────────────── */
        .cs-form-label {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: .26em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 18px;
        }

        .cs-form {
            width: 100%;
        }

        /* input + button in one row */
        .cs-input-row {
            display: flex;
            border: 1px solid rgba(181,138,70,.35);
            background: rgba(255,255,255,.03);
            transition: border-color .25s, background .25s;
            margin-bottom: 12px;
        }

        .cs-input-row:focus-within {
            border-color: var(--gold);
            background: rgba(255,255,255,.055);
        }

        .cs-input-row input[type="email"] {
            flex: 1;
            min-width: 0;
            background: transparent;
            border: none;
            outline: none;
            padding: 17px 22px;
            font-family: 'Inter', sans-serif;
            font-size: .875rem;
            color: #fff;
        }

        .cs-input-row input[type="email"]::placeholder {
            color: rgba(245,240,232,.35);
        }

        .cs-input-row button {
            flex-shrink: 0;
            background: var(--gold);
            color: var(--bg);
            border: none;
            padding: 17px 30px;
            font-family: 'Inter', sans-serif;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .16em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background .25s, letter-spacing .2s;
            white-space: nowrap;
        }

        .cs-input-row button:hover {
            background: var(--gold-lt);
            letter-spacing: .19em;
        }

        .cs-input-row button:disabled {
            opacity: .55;
            cursor: not-allowed;
            letter-spacing: .16em;
        }

        /* feedback */
        .cs-feedback {
            min-height: 20px;
            font-size: .8rem;
            font-weight: 400;
            text-align: left;
        }

        .cs-feedback.err { color: #e08080; }
        .cs-feedback.ok  { color: var(--gold-lt); }

        /* privacy line */
        .cs-privacy {
            margin-top: 16px;
            font-size: .72rem;
            color: var(--faint);
            letter-spacing: .03em;
        }

        /* ─── SUCCESS STATE ───────────────────────────────────── */
        .cs-success {
            display: none;
        }

        .cs-success.visible {
            display: block;
            animation: fadeUp .4s ease both;
        }

        .cs-success-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border: 1px solid var(--gold);
            border-radius: 50%;
            margin: 0 auto 18px;
        }

        .cs-success-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 500;
            color: #fff;
            margin-bottom: 10px;
        }

        .cs-success-sub {
            font-size: .875rem;
            font-weight: 300;
            color: var(--muted);
            line-height: 1.75;
        }

        /* hide form region when success */
        .cs-form-region.hidden { display: none; }

        /* ─── FOOTER ──────────────────────────────────────────── */
        .cs-footer {
            padding: 32px 20px 36px;
            text-align: center;
            font-size: .68rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--faint);
            z-index: 1;
            position: relative;
        }

        .cs-footer a {
            color: var(--faint);
            text-decoration: none;
            transition: color .2s;
        }

        .cs-footer a:hover { color: var(--gold); }

        .cs-footer-sep {
            display: inline-block;
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--gold-dk);
            vertical-align: middle;
            margin: 0 10px 1px;
        }

        /* ─── ANIMATION ───────────────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .cs-card > * {
            animation: fadeUp .5s ease both;
        }

        .cs-card > *:nth-child(1) { animation-delay: .05s; }
        .cs-card > *:nth-child(2) { animation-delay: .12s; }
        .cs-card > *:nth-child(3) { animation-delay: .18s; }
        .cs-card > *:nth-child(4) { animation-delay: .24s; }
        .cs-card > *:nth-child(5) { animation-delay: .30s; }
        .cs-card > *:nth-child(6) { animation-delay: .36s; }

        /* ─── RESPONSIVE ──────────────────────────────────────── */
        @media (max-width: 600px) {
            .cs-topbar { padding: 28px 24px 0; }
            .cs-logo   { height: 30px; }
            .cs-main   { padding: 44px 16px 32px; }

            /* stack input and button vertically */
            .cs-input-row {
                flex-direction: column;
                border: none;
                background: transparent;
                gap: 10px;
            }

            .cs-input-row input[type="email"] {
                border: 1px solid rgba(181,138,70,.35);
                background: rgba(255,255,255,.03);
                padding: 15px 18px;
                width: 100%;
            }

            .cs-input-row button {
                width: 100%;
                padding: 15px 20px;
            }
        }

        @media (min-width: 601px) and (max-width: 768px) {
            .cs-headline { font-size: 2.8rem; }
        }
    </style>
</head>
<body>

<div class="cs-page">

    {{-- ── TOPBAR ── --}}
    <header class="cs-topbar">
        <a href="/">
            <img src="{{ asset('public/images/front/header-logo.svg') }}" alt="HNOWW" class="cs-logo">
        </a>
    </header>

    {{-- ── MAIN ── --}}
    <main class="cs-main">
        <div class="cs-card">

            {{-- Ornament --}}
            <div class="cs-ornament">
                <span class="cs-ornament-bar"></span>
                <span class="cs-ornament-dot"></span>
                Launching Soon
                <span class="cs-ornament-dot"></span>
                <span class="cs-ornament-bar rev"></span>
            </div>

            {{-- Headline --}}
            {{-- <p class="cs-eyebrow">Launching Soon</p> --}}

            <h1 class="cs-headline">
                Something <em>beautiful</em><br>is on its way.
            </h1>

            {{-- <p class="cs-body">
                We're crafting an experience worth the wait — curated objects shaped by intention,
                designed to turn the everyday into ceremony.
                Be the first to know when we open our doors.
            </p> --}}

            {{-- Rule --}}
            <div class="cs-rule">
                <span class="cs-rule-line"></span>
                <span class="cs-rule-diamond"></span>
                <span class="cs-rule-line"></span>
            </div>

            {{-- ── FORM REGION ── --}}
            <div class="cs-form-region" id="csFormRegion">
                <p class="cs-form-label">Join the Waitlist</p>

                <!--<form class="cs-form" id="csWaitlistForm" novalidate>-->
                <!--    @csrf-->
                <!--    <div class="cs-input-row" id="csInputRow">-->
                <!--        <input-->
                <!--            type="email"-->
                <!--            id="cs_email"-->
                <!--            name="newsletter_email"-->
                <!--            placeholder="Enter your email address"-->
                <!--            autocomplete="email"-->
                <!--            required-->
                <!--        >-->
                <!--        <button type="submit" id="csSubmitBtn">-->
                <!--            <span class="btn-text">Get Early Access</span>-->
                <!--            <span class="btn-loading" style="display:none;">Please wait…</span>-->
                <!--        </button>-->
                <!--    </div>-->
                <!--    <div class="cs-feedback" id="csFeedback"></div>-->
                <!--</form>-->
                <form id="newsletterForm" class="cs-form" action="{{ route('newsletter.temp.store') }}"
                    method="POST">
                    @csrf
                    <div class="cs-input-row">
                        <input class="cs_email" type="email" name="newsletter_email" id="newsletter_email"
                            placeholder="Enter your email address">
                        <button type="submit" id="csSubmitBtn">
                            <span class="btn-text">Submit</span>
                            <span class="btn-loader" style="display:none;">Submitting...</span>
                        </button>
                    </div>
                    <div id="newsletter_error"></div>
                </form>
            </div>

            {{-- ── SUCCESS STATE ── --}}
            <div class="cs-success" id="csSuccess">
                <div class="cs-success-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 11L9.5 15.5L17 7" stroke="#B58A46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="cs-success-title">You're on the list.</p>
                <p class="cs-success-sub">
                    Thank you for your interest. We'll send you a quiet note<br>the moment we're ready to welcome you in.
                </p>
            </div>

        </div>
    </main>

    {{-- ── FOOTER ── --}}
    <footer class="cs-footer">
        <span>&copy; {{ date('Y') }} HNOWW</span>
        <span class="cs-footer-sep"></span>
        <span>All rights reserved</span>
    </footer>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
    integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/additional-methods.min.js"
    integrity="sha512-owaCKNpctt4R4oShUTTraMPFKQWG9UdWTtG6GRzBjFV4VypcFi6+M3yc4Jk85s3ioQmkYWJbUl1b2b2r41RTjA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('public/js/front/custom_validations.js') }}"></script>
<script src="{{ asset('public/js/front/common.js') }}" defer></script>

<script>

var sitePath = "{{ url('/') }}";
$(document).ready(function() {
    setTimeout(function() {
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
        errorPlacement: function(error, element) {
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
                    if (response.success) {
                        $btn.prop('disabled', false).text(originalBtnText);
                        $('#newsletterMessage').text(response.message);
                        // Open WhatsApp link in new tab AFTER slight delay to ensure UI updates
                        if (response.whatsappUrl) {
                            setTimeout(function() {
                                window.open(response.whatsappUrl, '_blank');
                            }, 200);
                        }
                        $form[0].reset();
                    } else {
                        // Display first server-side validation error
                        if (response.errors) {
                            var firstError = Object.values(response.errors)[0][0];
                            $('#newsletterMessage').text(firstError);
                        } else {
                            $('#newsletterMessage').text(response.message);
                        }
                    }
                },
                error: function(xhr) {
                    $('#newsletterMessage').text(
                        'Something went wrong. Please try again.');
                },
                complete: function() {
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

</body>
</html>