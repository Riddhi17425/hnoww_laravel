<div class="modal fade wedding_catalogue_modal" id="requestWeddingCatalogue" data-bs-backdrop="static" data-bs-keyboard="false"
   tabindex="-1" aria-labelledby="requestWeddingCatalogueLabel" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen modal-dialog-centered">
      <div class="modal-content">
         <div class="text-center my-4">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="container">
               <form method="POST" action="{{ route('front.store.wedding.catelogue.request') }}" id="requestWeddingCatalogueForm" class="ct_form">
                  @csrf
                  <div class="row">
                     <!-- Full Name -->
                     <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Full Name <span class="text-danger">*</span></label>
                           <input type="text" name="w_full_name" placeholder="Enter your Full Name" id="w_full_name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" value="{{ old('w_full_name') }}">
                           @error('w_full_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                     </div>
                     <!-- Company -->
                     <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Company Organization <span class="text-danger">*</span></label>
                           <input type="text" name="w_company_name" placeholder="Enter your Company Organization Name" id="w_company_name" value="{{ old('w_company_name') }}">
                           @error('w_company_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                     </div>
                     <!-- Phone -->
                     <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Phone Number <span class="text-danger">*</span></label>
                           <input type="text" name="w_phone" placeholder="Enter your WhatsApp Phone Number" id="w_phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);" value="{{ old('w_phone') }}">
                           @error('w_phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                     </div>
                     <!-- Email -->
                     <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Email <span class="text-danger">*</span></label>
                           <input type="email" placeholder="Enter your Email Address" name="w_email" id="w_email" value="{{ old('w_email') }}">
                           @error('w_email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                     </div>
                     <!-- Product of Interest (MULTISELECT) -->
                     <div class="col-lg-4">
                        <div class="ct_input">
                           <label class="sub_head">Product of Interest <span class="text-danger">*</span></label>
                           <select id="w_product_of_interest" name="w_product_of_interest[]" multiple>
                           @if(isset($weddingProduct) && is_countable($weddingProduct) && count($weddingProduct) > 0)
                              @foreach($weddingProduct as $value)
                              <option value="{{ $value->id }}" {{ collect(old('product_of_interest'))->contains($value->id) ? 'selected' : '' }}>
                              {{ $value->product_name }}
                              </option>
                              @endforeach
                           @endif
                           </select>
                           <div id="w_product_error"></div>
                           @error('w_product_of_interest') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                     </div>
                     <!-- Quantity Range -->
                     <div class="col-lg-4">
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
                     </div>
                     <!-- Budget -->
                     <div class="col-lg-4">
                        <div class="ct_input">
                           <label class="sub_head">Approximate Budget</label>
                           <input type="text" name="w_budget" placeholder="Enter Approximate Budget" id="w_budget" value="{{ old('w_budget') }}">
                           @error('w_budget') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                     </div>
                     <!-- Branding -->
                     <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Branding Requirements</label>
                           <input type="text" name="w_branding_requirements" placeholder="e.g. Logo etching, Custom box colour" id="w_branding_requirements" value="{{ old('w_branding_requirements') }}">
                        </div>
                     </div>
                     <!-- Delivery Date -->
                     <div class="col-lg-6">
                        <div class="ct_input">
                           <label class="sub_head">Delivery Timeline <span class="text-danger">*</span></label>
                           <input type="date" name="w_delivery_date" id="w_delivery_date" value="{{ old('w_delivery_date') }}">
                           @error('w_delivery_date') <small class="text-danger">{{ $message }}</small> @enderror
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
                        <button type="submit" class="com_btn">REQUEST WEDDING CATALOGUE</button>
                     </div>
                  </div>
                </form>
            </div>
         </div>
      </div>
   </div>
</div>