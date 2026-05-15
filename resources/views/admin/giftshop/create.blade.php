@extends('admin.layouts.app')

@section('title', 'Add Gift')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Add Gift</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.giftshops.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.giftshops.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Gift For</label><span class="text-danger">*</span>                      
                <select name="gift_for" id="gift_for" class="form-control input-default">
                    <option value=""> -- Select Gift For -- </option>
                    @foreach(config('global_values.gift_for') as $key => $value)
                        <option value="{{ $key }}" {{ old('gift_for') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                @error('gift_for') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">To Celebrate</label><span class="text-danger">*</span>                      
                <select name="to_celebrate" id="to_celebrate" class="form-control input-default">
                    <option value=""> -- Select To Celebrate -- </option>
                    @foreach(config('global_values.to_celebrate') as $key => $value)
                        <option value="{{ $key }}" {{ old('to_celebrate') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                @error('to_celebrate') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Product Price</label><span class="text-danger">*</span>
                <input type="text" name="product_price" class="form-control" value="{{ old('product_price') }}">
                @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Product Name</label><span class="text-danger">*</span>
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
                @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Product URL</label><span class="text-danger">*</span>
                <input type="text" name="product_url" id="product_url" class="form-control" value="{{ old('product_url') }}">
                @error('product_url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-8">
                <label class="form-label">List Page Image</label><span class="text-danger">*</span>
                <input type="file" name="list_img" id="list_img" class="form-control" value="{{ old('list_img') }}">
                @error('list_img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-8">
                <label class="form-label">Detail Page Images</label><span class="text-danger">*</span>
                <input type="file" name="detail_imgs[]" multiple id="detail_imgs" class="form-control" value="{{ old('detail_imgs') }}">
                @error('detail_imgs') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Product Short Description</label><span class="text-danger">*</span>
                <textarea name="short_description" id="short_description" class="form-control" rows="4">{{ old('short_description') }}</textarea>
                @error('short_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Product Large Description</label>
                <textarea name="large_description" id="large_description" class="form-control" rows="4">{{ old('large_description') }}</textarea>
                @error('large_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Product dimensions</label>
                <textarea name="dimensions" id="dimensions" class="form-control" rows="4">{{ old('dimensions') }}</textarea>
                @error('dimensions') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Meta Title</label><span class="text-danger">*</span>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Meta Description</label><span class="text-danger">*</span>
                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save Gift</button>
            </div>
        </div>
    </form>
</div>

<!-- Cropper Modal -->
<div class="modal fade" id="cropperModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="img-container">
                    <img id="cropperImage" style="max-width: 100%;">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropImageBtn">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_scripts')
<script src="{{ asset('public/js/admin/gift.js') }} " defer></script>
<script> 

$(document).ready(function() {
    $('#short_description').summernote({
        placeholder: 'Enter Product Short Description here...',
        height: 200,
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

    $('#large_description').summernote({
        placeholder: 'Enter Product Description here...',
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

    $('#dimensions').summernote({
        placeholder: 'Enter Product Description here...',
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

@endpush