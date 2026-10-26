<style>
.delivery-info {
    margin-top: 0.75rem;
    padding: 16px 18px;
    background: linear-gradient(135deg, #fffdf9 0%, #f5efe7 100%);
    border: 1px solid #e7d7b6;
    border-radius: 14px;
    box-shadow: 0 8px 18px rgba(9, 25, 35, 0.04);
}

.delivery-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(181, 138, 70, 0.2);
}

.delivery-header svg {
    width: 20px;
    height: 20px;
    color: #b58a46;
    flex-shrink: 0;
}

.delivery-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: #0e2233;
    letter-spacing: 0.2px;
}

.delivery-list {
    display: grid;
    gap: 8px;
}

.delivery-row {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 6px;
    line-height: 1.6;
    color: #0e2233;
    padding: 2px 0;
}

.delivery-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 700;
    min-width: 140px;
    color: #0e2233;
}

.delivery-label svg {
    width: 15px;
    height: 15px;
    color: #b58a46;
    flex-shrink: 0;
}

.delivery-value {
    color: #574d3d;
}

@media (max-width: 767px) {
    .delivery-info {
        padding: 14px 12px;
    }

    .delivery-header {
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .delivery-row {
        display: block;
        line-height: 1.7;
    }

    .delivery-label {
        display: flex;
        min-width: auto;
        margin-bottom: 2px;
    }
}
</style>

@php
    $pinIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
@endphp

<div class="delivery-info">
    <div class="delivery-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 3h15v13H1z"></path>
            <path d="M16 8h4l3 3v5h-7z"></path>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <p class="delivery-title">Delivery Charges</p>
    </div>

    <div class="delivery-list">
        <div class="delivery-row">
            <span class="delivery-label">{!! $pinIcon !!}Dubai:</span>
            <span class="delivery-value">30 Dirham</span>
        </div>
        <div class="delivery-row">
            <span class="delivery-label">{!! $pinIcon !!}Other Emirates:</span>
            <span class="delivery-value">50 Dirham</span>
        </div>
    </div>
</div>

<div class="delivery-info">
    <div class="delivery-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
            <path d="M16 2v4M8 2v4M3 10h18"></path>
            <path d="m9 16 2 2 4-4"></path>
        </svg>
        <p class="delivery-title">Estimated Delivery</p>
    </div>

    <div class="delivery-list">
        <div class="delivery-row">
            <span class="delivery-label">{!! $pinIcon !!}Dubai:</span>
            <span class="delivery-value">Within 2-3 business days</span>
        </div>
        <div class="delivery-row">
            <span class="delivery-label">{!! $pinIcon !!}Other Emirates:</span>
            <span class="delivery-value">Within 6-7 business days</span>
        </div>
    </div>
</div>
