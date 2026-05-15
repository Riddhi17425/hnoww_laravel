@extends('admin.layouts.app')
@section('content')
<div class="body d-flex py-lg-3 py-md-2">
   <div class="container-xxl">
      {{-- Page Header --}}
      <div class="row align-items-center">
         <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
            <span id="success-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
               <h3 class="fw-bold mb-0">Add Blogs</h3>
               <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary btn-set-task">Back</a>
            </div>
         </div>
      </div>
      {{-- Form Section --}}
      <div class="row clearfix g-3">
         <div class="col-sm-12">
            <div class="card mb-3">
               <div class="card-body">
                  <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     {{-- Blogs Info --}}
                     <div class="card mb-4 border">
                        <div class="card-header bg-light"><strong>Blogs Information</strong></div>
                        <div class="card-body row">
                           {{-- Title --}}
                           <div class="col-md-6 mb-3">
                              <label class="form-label">Title <span class="text-danger">*</span></label>
                              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Enter Title">
                              @error('title')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label">Url <span class="text-danger">*</span></label>
                              <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                                 value="{{ old('url') }}" placeholder="Enter url">
                              @error('url')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           {{-- Front Image --}}
                           <div class="col-md-6 mb-3">
                              <label class="form-label">Front Image <span class="text-danger">*</span></label>
                              <input type="file" name="front_image" class="form-control @error('front_image') is-invalid @enderror" id="blogs_front_image"  onchange="validateAndPreviewFrontImage()">
                              @error('front_image')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                              <img id="preview_front_image" src="#" alt="Preview" class="mt-2" style="max-width: 100px; height: 100px; display: none;" />
                           </div>
                           {{-- Detail Image --}}
                           <div class="col-md-6 mb-3">
                              <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                              <input type="file" name="detail_image" id="blogs_detail_image" class="form-control @error('detail_image') is-invalid @enderror" onchange="validateAndPreviewBannerImage()">
                              @error('detail_image')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                              <img id="preview_blogs_image" src="#" alt="Preview" class="mt-2" style="max-width: 100px; height: 100px; display: none;" />
                           </div>
                           {{-- Cta Image --}}
                           <div class="col-md-6 mb-3">
                              <label class="form-label">Cta Image </label>
                              <input type="file" name="cta_image" id="cta_image" class="form-control @error('cta_image') is-invalid @enderror" onchange="validateAndPreviewCTAImage()">
                              @error('cta_image')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                              <img id="preview_cta_image" src="#" alt="Preview" class="mt-2" style="max-width: 100px; height: 100px; display: none;" />
                           </div>
                           <div class="col-md-3 mb-3">
                              <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                              <input type="date" id="date" name="date"class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                              @error('date')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="col-md-3 mb-3">
                              <label class="form-label">Status <span class="text-danger">*</span></label>
                              <select name="status" class="form-control @error('status') is-invalid @enderror">
                                 <option value="Active" {{ old('status') == 0 ? 'selected' : '' }}>Active</option>
                                 <option value="In-Active" {{ old('status') == 1 ? 'selected' : '' }}>Inactive</option>
                              </select>
                              @error('status')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="col-md-12 mb-3">
                              <label class="form-label">CTA Content </label>
                              <textarea name="cta_content" id="cta_content"
                                 class="form-control @error('cta_content') is-invalid @enderror"
                                 value="{{ old('cta_content') }}" placeholder="Enter CTA content">{{ old('cta_content') }}</textarea>
                              @error('cta_content')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           {{-- Short Description --}}
                           <div class="col-md-12 mb-3">
                              <label class="form-label">Short Description <span class="text-danger">*</span></label>
                              <textarea name="short_description" id="short_description"
                                 class="form-control @error('short_description') is-invalid @enderror"
                                 value="{{ old('short_description') }}" placeholder="Enter short description">{{ old('short_description') }}</textarea>
                              @error('short_description')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           {{-- Detail Description --}}
                           <div class="col-md-12 mb-3">
                              <label class="form-label">Detail Description <span class="text-danger">*</span></label>
                              <textarea name="detail_description" class="form-control @error('detail_description') is-invalid @enderror"
                                 rows="4" id="detail_description">{{ old('detail_description') }}</textarea>
                              @error('detail_description')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           {{-- conclusion --}}
                           <div class="col-md-12 mb-3">
                              <label class="form-label">Conclusion <span class="text-danger">*</span></label>
                              <textarea name="conclusion" class="form-control @error('conclusion') is-invalid @enderror"
                                 rows="4" id="conclusion">{{ old('conclusion') }}</textarea>
                              @error('conclusion')
                              <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                           </div>
                           <div class="col-md-6 mb-3">
                              <label class="form-label">Meta Title</label>
                              <input type="text" id="meta_title" name="meta_title" class="form-control">
                           </div>
                           <div class="col-md-12">
                              <label for="meta_description" class="form-label">Meta Description</label>
                              <textarea id="meta_description" name="meta_description" class="form-control"></textarea>
                           </div>
                           <div class="card mb-4 border">
                              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                 <strong>FAQ Title & Description</strong>
                                 <button type="button" id="addFaqBlock" class="btn btn-sm btn-success">+ Add More</button>
                              </div>
                              <div class="card-body" id="faqRepeater">
                                 {{-- One FAQ block --}}
                                 <div class="faqGroup border rounded p-3 mb-3">
                                    <div class="mb-3">
                                       <label class="form-label">Title</label>
                                       <input type="text" name="faq_title[]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                       <label class="form-label">Description </label>
                                       <textarea name="faq_description[]" class="form-control summernote" rows="4" ></textarea>
                                    </div>
                                    <div class="text-end">
                                       <button type="button" class="btn btn-danger removeFaq">Remove</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     {{-- Submit --}}
                     <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Blogs</button>
                     </div>
                  </form>
               </div>
               {{-- End Card Body --}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('custom_scripts')
{{-- JS Section --}}
<script src="{{ asset('public/js/admin/blog.js') }}" defer></script>
<script>
   $(document).ready(function () {
       $('#detail_description').summernote({
           placeholder: 'Enter Description here...',
           height: 300,
           toolbar: [
               ['style', ['style']],
               ['font', ['bold', 'italic', 'underline', 'clear']],
               ['fontname', ['fontname']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['height', ['height']],
               ['insert', ['link', 'picture', 'hr']],
               ['view', ['fullscreen', 'codeview']],
               ['help', ['help']]
           ]
       });
       $('#short_description').summernote({
           placeholder: 'Enter Description here...',
           height: 300,
           toolbar: [
               ['style', ['style']],
               ['font', ['bold', 'italic', 'underline', 'clear']],
               ['fontname', ['fontname']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['height', ['height']],
               ['insert', ['link', 'picture', 'hr']],
               ['view', ['fullscreen', 'codeview']],
               ['help', ['help']]
           ]
       });
       $('#conclusion').summernote({
           placeholder: 'Enter Conclusion here...',
           height: 300,
           toolbar: [
               ['style', ['style']],
               ['font', ['bold', 'italic', 'underline', 'clear']],
               ['fontname', ['fontname']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['height', ['height']],
               ['insert', ['link', 'picture', 'hr']],
               ['view', ['fullscreen', 'codeview']],
               ['help', ['help']]
           ]
       });
       $('#meta_description').summernote({
           placeholder: 'Enter Meta Description here...',
           height: 300,
           toolbar: [
               ['style', ['style']],
               ['font', ['bold', 'italic', 'underline', 'clear']],
               ['fontname', ['fontname']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['height', ['height']],
               ['insert', ['link', 'picture', 'hr']],
               ['view', ['fullscreen', 'codeview']],
               ['help', ['help']]
           ]
       });
   });
</script>
<script>
   $(document).ready(function () {
       // Initialize Summernote
       $('.summernote').summernote({
           height: 200,
           placeholder: 'Enter Description here...'
       });
   
       // Add More
       $('#addFaqBlock').click(function () {
           let block = `
                   <div class="faqGroup border rounded p-3 mb-3">
                   <div class="mb-3">
                   <label class="form-label">Title </label>
                   <input type="text" name="faq_title[]" class="form-control" >
                   </div>
                   <div class="mb-3">
                   <label class="form-label">Description </label>
                   <textarea name="faq_description[]" class="form-control summernote" rows="4" ></textarea>
                   </div>
                   <div class="text-end">
                   <button type="button" class="btn btn-danger removeFaq">Remove</button>
                   </div>
                   </div>
           `;
           $('#faqRepeater').append(block);
           // Re-init summernote for new textareas
           $('.summernote').summernote({
               height: 200,
               placeholder: 'Enter Description here...'
           });
       });
   
       // Remove block
       $(document).on('click', '.removeFaq', function () {
           $(this).closest('.faqGroup').remove();
       });
   });
</script>
@endpush