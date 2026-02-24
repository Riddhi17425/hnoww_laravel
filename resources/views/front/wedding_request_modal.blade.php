<style>
/* Container check */
.form_check_main_modal {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: 20px;
}

/* Hidden Input */
.custom_check_input {
    display: none !important;
}

/* Base Label Style */
.custom_check_label {
    display: inline-block;
    padding: 10px 20px;
    border: 1px solid var(--gold-color) !important;
    border-radius: 50px;
    background-color: transparent;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* THE WORKING STATE */
/* Input check hone par Label ka style badlo */
.custom_check_input:checked+.custom_check_label {
    background-color: var(--gold-color) !important;
    color: white !important;
}
</style>

<div class="modal fade wedding_catalogue_modal" id="requestWeddingCatalogue" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestWeddingCatalogueLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center my-4">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">

                    <div class="text-center mb-5">
                        <h4 class="title_60 mb-3">Wedding Gifting Consultation</h4>
                        <p class="sub_head " style="font-family: var(--heading-font); font-style: italic;">
                            HNOWW weddings are treated as living archives of a family's story. <br> This form helps us
                            understand how to curate your rituals with care.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('front.store.wedding.catelogue.request') }}"
                        id="requestWeddingCatalogueForm" class="ct_form">
                        @csrf
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="w_full_name" placeholder="Enter your Full Name"
                                        id="w_full_name"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                        value="{{ old('w_full_name') }}">
                                    @error('w_full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <!-- Phone -->
                            {{-- <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Phone Number </label>
                           <input type="text" name="w_phone" placeholder="Enter your WhatsApp Phone Number" id="w_phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" value="{{ old('w_phone') }}">
                            @error('w_phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                </div> --}}
                <!-- Email -->
                <div class="col-lg-6">
                    <div class="ct_input">
                        <label class="sub_head">Email <span class="text-danger">*</span></label>
                        <input type="email" placeholder="Enter your Email Address" name="w_email" id="w_email"
                            value="{{ old('w_email') }}">
                        @error('w_email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ct_input">
                        <label class="sub_head">Role <span class="text-danger">*</span></label>
                        <select name="w_role" id="w_role">
                            <option value="">Select</option>
                            @foreach(config('global_values.wedding_role') as $key => $value)
                            <option value="{{ $key }}" {{ old('w_role') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                            @endforeach
                        </select>
                        @error('w_role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ct_input">
                        <label class="sub_head">Wedding Location</label>
                        <input type="text" name="w_location" placeholder="Enter Approximate Budget" id="w_location"
                            value="{{ old('w_location') }}">
                        @error('w_location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ct_input">
                        <label class="sub_head">Wedding Date </label>
                        <input type="date" name="w_wedding_date" id="w_wedding_date"
                            value="{{ old('w_wedding_date') }}">
                        @error('w_wedding_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <!-- <div class="col-lg-12">
                    <div class="ct_input">
                        <label class="sub_head">
                            What are you looking for? <span class="text-danger">*</span>
                        </label>

                        <div class="form-check">
                            <input type="checkbox" id="ceremonial" name="w_looking_for[]"
                                value="Ceremonial / ritual objects">
                            <label class="form-check-label" for="ceremonial">
                                Ceremonial / ritual objects
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="favours" name="w_looking_for[]"
                                value="Wedding favours / guest gifts">
                            <label class="form-check-label" for="favours">
                                Wedding favours / guest gifts
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="legacy" name="w_looking_for[]" value="Family / legacy pieces">
                            <label class="form-check-label" for="legacy">
                                Family / legacy pieces
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="hampers" name="w_looking_for[]" value="Bespoke hampers">
                            <label class="form-check-label" for="hampers">
                                Bespoke hampers
                            </label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" id="unsure" name="w_looking_for[]" value="Unsure — need guidance">
                            <label class="form-check-label" for="unsure">
                                Unsure — need guidance
                            </label>
                        </div>

                        <div id="w_looking_for_error"></div>
                    </div>
                </div> -->



                <div class="col-lg-12">
                    <div class="ct_input">
                        <label class="sub_head">
                            What are you looking for? <span class="text-danger">*</span>
                        </label>

                        <div class="form_check_main_modal">

                            <div class="form_check_item">
                                <input type="checkbox" id="check_ceremonial" name="w_looking_for[]"
                                    value="Ceremonial / ritual objects" class="custom_check_input">
                                <label class="custom_check_label" for="check_ceremonial"> Ceremonial / ritual
                                    objects</label>
                            </div>

                            <div class="form_check_item">
                                <input type="checkbox" id="check_favours" name="w_looking_for[]"
                                    value="Wedding favours / guest gifts" class="custom_check_input">
                                <label class="custom_check_label" for="check_favours">Wedding favours / guest
                                    gifts</label>
                            </div>

                            <div class="form_check_item">
                                <input type="checkbox" id="check_legacy" name="w_looking_for[]"
                                    value="Family / legacy pieces" class="custom_check_input">
                                <label class="custom_check_label" for="check_legacy"> Family / legacy pieces</label>
                            </div>

                            <div class="form_check_item">
                                <input type="checkbox" id="check_hampers" name="w_looking_for[]" value="Bespoke hampers"
                                    class="custom_check_input">
                                <label class="custom_check_label" for="check_hampers"> Bespoke hampers</label>
                            </div>

                            <div class="form_check_item">
                                <input type="checkbox" id="check_unsure" name="w_looking_for[]"
                                    value="Unsure — need guidance" class="custom_check_input">
                                <label class="custom_check_label" for="check_unsure"> Unsure — need guidance</label>
                            </div>
                        </div>

                    </div>
                    <div id="w_looking_for_error"></div>
                </div>
           

            <div class="col-lg-6">
                <div class="ct_input">
                    <label class="sub_head">
                        Approximate Guest Count
                    </label>
                    <select name="w_guest_count">
                        <option value="">Select Guest Count</option>
                        @foreach(config('global_values.wedding_guest_count') as $key => $value)
                        <option value="{{ $key }}" {{ old('w_quantity_range') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ct_input">
                    <label class="sub_head">
                        Budget Band (overall)
                    </label>
                    <select name="w_budget_band">
                        <option value="">Select Budget</option>
                        @foreach(config('global_values.wedding_budget') as $key => $value)
                        <option value="{{ $key }}" {{ old('w_quantity_range') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Product of Interest (MULTISELECT) -->
            {{-- <div class="col-lg-4">
                        <div class="ct_input">
                           <label class="sub_head">Product of Interest <span class="text-danger">*</span></label>
                           <select id="w_product_of_interest" name="w_product_of_interest[]" multiple>
                              @if(isset($weddingProduct) && is_countable($weddingProduct) && count($weddingProduct) > 0)
                                 @foreach($weddingProduct as $value)
                                 <option value="{{ $value->id }}"
            {{ collect(old('product_of_interest'))->contains($value->id) ? 'selected' : '' }}>
            {{ $value->product_name }}
            </option>
            @endforeach
            @endif
            </select>
            <div id="w_product_error"></div>
            @error('w_product_of_interest') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div> --}}
    <!-- Quantity Range -->
    {{-- <div class="col-lg-4">
                        <div class="ct_input">
                           <label class="sub_head">Quantity Range <span class="text-danger">*</span></label>
                           <select name="w_quantity_range" id="w_quantity_range">
                              <option value="">Select</option>
                              @foreach(config('global_values.quality_range') as $key => $value)
                              <option value="{{ $key }}" {{ old('w_quantity_range') == $key ? 'selected' : '' }}>
    {{ $value }}
    </option>
    @endforeach
    </select>
    @error('w_quantity_range') <small class="text-danger">{{ $message }}</small> @enderror
</div>
</div> --}}
<!-- Budget -->
{{-- <div class="col-lg-4">
                        <div class="ct_input">
                           <label class="sub_head">Approximate Budget</label>
                           <input type="text" name="w_budget" placeholder="Enter Approximate Budget" id="w_budget" value="{{ old('w_budget') }}">
@error('w_budget') <small class="text-danger">{{ $message }}</small> @enderror
</div>
</div> --}}
<!-- Branding -->
{{-- <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Branding Requirements</label>
                           <input type="text" name="w_branding_requirements" placeholder="e.g. Logo etching, Custom box colour" id="w_branding_requirements" value="{{ old('w_branding_requirements') }}">
</div>
</div> --}}
<!-- Delivery Date -->
{{-- <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Delivery Timeline <span class="text-danger">*</span></label>
                           <input type="date" name="w_delivery_date" id="w_delivery_date" value="{{ old('w_delivery_date') }}">
@error('w_delivery_date') <small class="text-danger">{{ $message }}</small> @enderror
</div>
</div> --}}
<!-- Message -->
<div class="col-12">
    <div class="ct_input">
        <label class="sub_head">Message / Notes</label>
        <textarea name="w_message" placeholder="Enter Message" id="w_message" rows="1">{{ old('message') }}</textarea>
    </div>
</div>
<div class="col-12 text-center">
    <button type="submit" class="com_btn bg-transparent">Request Wedding Consultation</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>