<!-- FESTIVAL / BASIC CATEGORY INQUIRY MODAL -->
<div class="modal fade corporate_vault_modal"
    id="requestCorporateProposal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="requestCorporateProposalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="text-center my-4">
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>

                    <form method="POST"
                        action="{{ route('front.store.festival.inquiry') }}"
                        id="festivalInquiryForm"
                        class="ct_form">

                        @csrf

                        <!-- CURRENT CATEGORY ID -->
                        <input type="hidden"
                            name="category_id"
                            value="{{ $category->id }}">

                        <div class="row">
                            <!-- FULL NAME -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Full Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        name="name"
                                        placeholder="Enter your Full Name"
                                        value="{{ old('name') }}"
                                        required>

                                    @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- COMPANY -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Company Organization
                                    </label>
                                    <input type="text"
                                        name="company_name"
                                        placeholder="Enter your Company Organization Name"
                                        value="{{ old('company_name') }}" >

                                    @error('company_name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- PHONE -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                        name="contact_no"
                                        placeholder="Enter your Phone Number"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                        value="{{ old('contact_no') }}"
                                        required>

                                    @error('contact_no')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- EMAIL -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="email"
                                        name="email"
                                        placeholder="Enter your Email Address"
                                        value="{{ old('email') }}"
                                        required>

                                    @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- PRODUCT OF INTEREST -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Product of Interest
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select
                                        id="product_of_interest"
                                        name="product_of_interest[]"
                                        multiple>

                                        @if(isset($catProducts) && count($catProducts))
                                            @foreach($catProducts as $product)
                                                <option
                                                    value="{{ $product->id }}"
                                                    {{ collect(old('product_of_interest'))->contains($product->id) ? 'selected' : '' }}>

                                                    {{ $product->product_name }}

                                                </option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <div id="product_interest_error"></div>

                                    @error('product_of_interest')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- QUANTITY RANGE -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Quantity Range
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="quantity_range" required>
                                        <option value="">
                                            Select
                                        </option>
                                        @foreach(config('global_values.quality_range') as $key => $value)
                                            <option
                                                value="{{ $key }}"
                                                {{ old('quantity_range') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('quantity_range')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- BUDGET -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Approximate Budget
                                    </label>
                                    <input type="text"
                                        name="budget"
                                        placeholder="Enter Approximate Budget"
                                        value="{{ old('budget') }}">
                                </div>
                            </div>

                            <!-- BRANDING REQUIREMENTS -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Branding Requirements
                                    </label>
                                    <input type="text"
                                        name="branding_requirements"
                                        placeholder="e.g. Logo etching, Custom box colour"
                                        value="{{ old('branding_requirements') }}">
                                </div>
                            </div>

                            <!-- DELIVERY DATE -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Delivery Timeline
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                        name="delivery_date"
                                        value="{{ old('delivery_date') }}"
                                        required>

                                    @error('delivery_date')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <!-- MESSAGE -->
                            <div class="col-12">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Message / Notes
                                    </label>
                                    <textarea
                                        name="message"
                                        placeholder="Enter Message"
                                        rows="1">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <!-- SUBMIT -->
                            <div class="col-12 text-center">
                                <button type="submit" class="com_btn bg-transparent">
                                    REQUEST CORPORATE QUOTE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
$(document).ready(function () {

    var festivalFormSubmitted = false;

    $("#festivalInquiryForm").validate({

        ignore: [],

        rules: {

            name: {
                required: true,
                minlength: 2,
                maxlength: 255
            },

            contact_no: {
                required: true,
                number: true,
                validPhone: true
            },

            email: {
                required: true,
                email: true
            },

            'product_of_interest[]': {
                required: true
            },

            quantity_range: {
                required: true
            },

            delivery_date: {
                required: true,
                date: true
            },

            budget: {
                maxlength: 255
            },

            branding_requirements: {
                maxlength: 255
            },

            message: {
                maxlength: 500
            }
        },

        messages: {

            name: {
                required: "Please enter your full name",
                minlength: "Full name must be at least 2 characters",
                maxlength: "Full name cannot exceed 255 characters"
            },

            contact_no: {
                required: "Please enter your phone number",
                number: "Phone number must contain only digits"
            },

            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },

            'product_of_interest[]': {
                required: "Please select at least one product of interest"
            },

            quantity_range: {
                required: "Please select a quantity range"
            },

            delivery_date: {
                required: "Please select a delivery date",
                date: "Please enter a valid date"
            },

            budget: {
                maxlength: "Budget cannot exceed 255 characters"
            },

            branding_requirements: {
                maxlength: "Branding requirements cannot exceed 255 characters"
            },

            message: {
                maxlength: "Message cannot exceed 500 characters"
            }
        },

        errorElement: 'div',

        errorPlacement: function(error, element) {

            if (element.attr('name') === 'product_of_interest[]') {

                $('#product_interest_error').html('');
                $('#product_interest_error').html(error);

            } else {

                error.insertAfter(element);

            }
        },

        highlight: function(element) {

            $(element)
                .addClass('is-invalid')
                .removeClass('is-valid');

        },

        unhighlight: function(element) {

            $(element)
                .addClass('is-valid')
                .removeClass('is-invalid');

        },

        submitHandler: function(form) {

            if (!festivalFormSubmitted) {

                festivalFormSubmitted = true;

                const btn = $(form).find('button[type="submit"]');

                if (btn.length) {

                    btn.prop('disabled', true)
                       .text('Submitting...');

                }

                form.submit();
            }
        }
    });

});
</script>
@endpush