@include('layouts.frontheader')

<style>
    .expired-order-page {
        padding: 90px 0;
        background: linear-gradient(180deg, #f5f2ec 0%, #efeae2 100%);
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .expired-order-box {
        max-width: 720px;
        width: 100%;
        background: rgba(255, 255, 255, 0.72);
        border: 1px solid rgba(14, 34, 51, 0.08);
        box-shadow: 0 18px 45px rgba(14, 34, 51, 0.08);
        padding: 52px 32px;
        text-align: center;
        backdrop-filter: blur(6px);
    }

    .expired-order-icon {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        background: #f8efe7;
        color: #b64b37;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        border: 1px solid rgba(182, 75, 55, 0.15);
    }

    .expired-order-box h2 {
        margin: 0 0 14px;
        font-size: clamp(2rem, 4vw, 3rem);
        color: var(--dark-900);
        letter-spacing: -0.03em;
    }

    .expired-order-box p {
        margin: 0;
        font-size: 1.05rem;
        color: rgba(14, 34, 51, 0.8);
    }

    @media (max-width: 575px) {
        .expired-order-box {
            padding: 38px 22px;
        }
    }
</style>

<section class="expired-order-page">
    <div class="container">
        <div class="expired-order-box">
            <div class="expired-order-icon">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="9"></circle>
                    <line x1="12" y1="7" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <h2>This order link has expired.</h2>
            <p>{{ $message ?? 'This order link has expired.' }}</p>
        </div>
    </div>
</section>

@include('layouts.frontfooter')
