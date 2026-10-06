@extends('admin.layouts.app')

@section('title', 'Generate Payment Link')

@push('custom_styles')
<style>
    .payment-link-card { border-top: 4px solid var(--primary-color, #c9a96a) !important; }
    .payment-link-icon { color: var(--primary-color, #c9a96a); background: color-mix(in srgb, var(--primary-color, #c9a96a) 12%, white); }
    .payment-amount-group:focus-within { box-shadow: 0 0 0 .2rem color-mix(in srgb, var(--primary-color, #c9a96a) 18%, transparent); }
    .payment-amount-group .input-group-text { color: #fff !important; background-color: var(--primary-color, #c9a96a) !important; border-color: var(--primary-color, #c9a96a) !important; font-weight: 600; }
    .payment-link-submit { background-color: var(--primary-color, #c9a96a); border-color: var(--primary-color, #c9a96a); }
    .payment-link-submit:hover, .payment-link-submit:focus { filter: brightness(.92); background-color: var(--primary-color, #c9a96a); border-color: var(--primary-color, #c9a96a); }
    .payment-amount-error { min-height: 1rem; }
    .payment-link-description { max-width: 680px; }
</style>
@endpush

@section('content')
<div class="container-xxl py-2">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-8">
            <div class="card payment-link-card border-0 shadow-sm overflow-hidden">
                <div class="card-body p-3 p-lg-4">
                    <div class="mb-3">
                        <span class="payment-link-icon rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width:40px;height:40px;">
                            <i class="icofont-link"></i>
                        </span>
                        <div><span class="badge rounded-pill bg-light text-primary mb-2">Payments</span></div>
                        <h4 class="mb-1">Create a payment link</h4>
                        <p class="payment-link-description text-muted small mb-0">Enter an amount to collect, then copy and share the secure payment link.</p>
                    </div>

                    <form id="paymentLinkForm" method="POST" action="{{ route('admin.users.generate.payment.link') }}" class="mb-0" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="link_amount" class="form-label fw-semibold">Payment amount</label>
                            <div class="input-group payment-amount-group">
                                <span class="input-group-text">AED</span>
                                <input type="number" id="link_amount" name="link_amount"
                                       class="form-control @error('link_amount') is-invalid @enderror"
                                       value="{{ old('link_amount') }}" min="2.00" step="0.01" inputmode="decimal"
                                       placeholder="0.00" required>
                            </div>
                            <div id="link_amount_error" class="payment-amount-error small text-danger" aria-live="polite">@error('link_amount'){{ $message }}@enderror</div>
                            <div class="form-text">The customer will be charged this amount in AED.</div>
                        </div>
                        <button type="submit" class="btn btn-primary payment-link-submit px-3">
                            <i class="icofont-link me-1"></i> Generate payment link
                        </button>
                    </form>

                    @if(!empty($paymentLinkUrl))
                        <div class="alert alert-success mt-3 mb-0 py-3" role="status">
                            <div class="d-flex align-items-start gap-2">
                                <i class="icofont-check-circled fs-5"></i>
                                <div class="flex-grow-1 min-w-0">
                                    <h5 class="alert-heading mb-1">Your AED checkout link is ready</h5>
                                    <p class="small mb-2">Payment amount: <strong>AED {{ $generatedAmount }}</strong></p>
                                    <div class="input-group">
                                        <input type="text" id="generatedPaymentLink" class="form-control bg-white"
                                               value="{{ $paymentLinkUrl }}" readonly aria-label="Generated payment link">
                                        <button type="button" class="btn btn-outline-success" id="copyPaymentLink">
                                            <i class="icofont-copy me-1"></i><span>Copy link</span>
                                        </button>
                                    </div>
                                    <small class="d-block mt-2">This link can be shared and used for new AED checkout sessions.</small>
                                    <small class="d-block mt-2" id="copyFeedback" aria-live="polite"></small>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_scripts')
<script>
$(function () {
    $.validator.addMethod('aedAmount', function (value, element) {
        return this.optional(element) || /^\d+(\.\d{1,2})?$/.test(value);
    }, 'Enter an amount with up to two decimal places.');

    $('#paymentLinkForm').validate({
        onkeyup: function (element) { $(element).valid(); },
        onfocusout: function (element) { $(element).valid(); },
        rules: {
            link_amount: { required: true, number: true, min: 2, aedAmount: true }
        },
        messages: {
            link_amount: {
                required: 'Please enter a payment amount.',
                number: 'Enter a valid amount.',
                min: 'Amount must be at least AED 2.00.'
            }
        },
        errorElement: 'span',
        errorClass: 'text-danger',
        errorPlacement: function (error, element) {
            $('#link_amount_error').empty().append(error);
        },
        highlight: function (element) { $(element).addClass('is-invalid').removeClass('is-valid'); },
        unhighlight: function (element) { $(element).removeClass('is-invalid').addClass('is-valid'); },
        success: function () { $('#link_amount_error').empty(); }
    });
});
</script>
@endpush

@if(!empty($paymentLinkUrl))
@push('custom_scripts')
<script>
document.getElementById('copyPaymentLink').addEventListener('click', async function () {
    const input = document.getElementById('generatedPaymentLink');
    const feedback = document.getElementById('copyFeedback');
    try {
        await navigator.clipboard.writeText(input.value);
    } catch (error) {
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand('copy');
    }
    this.querySelector('span').textContent = 'Copied';
    feedback.textContent = 'Payment link copied to clipboard.';
});
</script>
@endpush
@endif
