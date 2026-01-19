<!-- Corporate Request -->
<div class="modal fade corporate_vault_modal" id="requestCorporateProposal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="requestCorporateProposalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="container">
                <div class="text-center my-4">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('front.store.corporate.proposal.request') }}" id="requestCorporateProposalForm" class="ct_form">
                    @csrf
                        <div class="row">

                            <!-- Full Name -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="full_name" id="full_name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" placeholder="Enter your Full Name" value="{{ old('full_name') }}">
                                    @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Company Organization <span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" placeholder="Enter your Company Organization Name" id="company_name" value="{{ old('company_name') }}">
                                    @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter your WhatsApp Phone Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" value="{{ old('phone') }}">
                                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="Enter your Email Address" id="email" value="{{ old('email') }}">
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Product of Interest (MULTISELECT) -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Product of Interest <span class="text-danger">*</span></label>
                                    <select id="product_of_interest" name="product_of_interest[]" multiple>
                                        @if(isset($corporateProduct) && is_countable($corporateProduct) && count($corporateProduct) > 0)
                                            @foreach($corporateProduct as $value)
                                                <option value="{{ $value->id }}" {{ collect(old('product_of_interest'))->contains($value->id) ? 'selected' : '' }}>
                                                    {{ $value->product_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div id="product_error"></div>
                                    @error('product_of_interest') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Quantity Range -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Quantity Range <span class="text-danger">*</span></label>
                                    <select name="quantity_range" id="quantity_range">
                                        <option value="">Select</option>
                                        @foreach(config('global_values.quality_range') as $key => $value)
                                            <option value="{{ $key }}" {{ old('quantity_range') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('quantity_range') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="col-lg-4">
                                <div class="ct_input">
                                    <label class="sub_head">Approximate Budget</label>
                                    <input type="text" placeholder="Enter Approximate Budget" name="budget" id="budget" value="{{ old('budget') }}">
                                    @error('budget') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Branding -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Branding Requirements</label>
                                    <input type="text" placeholder="e.g. Logo etching, Custom box colour" name="branding_requirements" id="branding_requirements" value="{{ old('branding_requirements') }}">
                                </div>
                            </div>

                            <!-- Delivery Date -->
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Delivery Timeline <span class="text-danger">*</span></label>
                                    <input type="date" name="delivery_date" id="delivery_date" value="{{ old('delivery_date') }}">
                                    @error('delivery_date') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="ct_input">
                                    <label class="sub_head">Message / Notes</label>
                                    <textarea name="message" placeholder="Enter Message" id="message">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="com_btn">REQUEST CORPORATE QUOTE</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

