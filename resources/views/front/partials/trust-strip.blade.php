<style>
.trust-strip {
    background: var(--dark-900, #0e2233);
    border-radius: 8px;
    padding: 32px 24px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    text-align: center;
}

.trust-strip .trust-item svg {
    width: 26px;
    height: 26px;
    color: #fff;
    margin-bottom: 14px;
}

.trust-strip .trust-title {
    margin: 0 0 8px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #fff;
}

.trust-strip .trust-text {
    margin: 0;
    font-size: 13px;
    line-height: 1.5;
    color: rgba(255, 255, 255, 0.85);
    white-space: nowrap;
}

@media (max-width: 1199px) {
    .trust-strip .trust-text {
        white-space: normal;
    }
}

@media (max-width: 767px) {
    .trust-strip {
        grid-template-columns: repeat(2, 1fr);
        gap: 28px 12px;
        padding: 24px 14px;
    }

    .trust-strip .trust-text {
        font-size: 12px;
    }
}
</style>

<section class="trust-section mt_120 mb_120">
    <div class="container">
        <div class="trust-strip">
            <div class="trust-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <p class="trust-title">UAE Delivery</p>
                <p class="trust-text">Delivery across Dubai and all Emirates.</p>
            </div>
            <div class="trust-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="13" r="8"></circle><path d="M12 9v4l2 2"></path><path d="M10 2h4M12 2v3"></path></svg>
                <p class="trust-title">Fast Shipping</p>
                <p class="trust-text">Express Dubai delivery in 2-3 days.</p>
            </div>
            <div class="trust-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1v-7h3zM3 19a2 2 0 0 0 2 2h1v-7H3z"></path></svg>
                <p class="trust-title">Customer Service</p>
                <p class="trust-text">Here to help you, every day.</p>
            </div>
            <div class="trust-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2"></rect><path d="M8 11V7a4 4 0 0 1 8 0v4"></path><circle cx="12" cy="16" r="1"></circle></svg>
                <p class="trust-title">Secure Payment</p>
                <p class="trust-text">Your payment is processed securely.</p>
            </div>
        </div>
    </div>
</section>
