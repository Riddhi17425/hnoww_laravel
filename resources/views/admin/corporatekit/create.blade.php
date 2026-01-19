@extends('admin.layouts.app')

@section('title', 'Add Corporate Kit')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Add Corporate Kit</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.corporate-kits.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.corporate-kits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Title</label><span class="text-danger">*</span>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">Price Range</label><span class="text-danger">*</span>
                <input type="text" name="price_range" class="form-control" value="{{ old('price_range') }}">
                @error('price_range') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-3">
                <label class="form-label">MOQ (In Units)</label><span class="text-danger">*</span>
                <input type="number" name="moq" class="form-control" value="{{ old('moq') }}">
                @error('moq') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-8">
                <label class="form-label">Image</label><span class="text-danger">*</span>
                <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
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
                <button type="submit" class="btn btn-primary">Save Corporate Kit</button>
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
<script src="{{ asset('public/js/admin/corporatekit.js') }} " defer></script>
<script> 

$(document).ready(function() {
    $('#short_description').summernote({
        placeholder: 'Enter Short Description here...',
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
        placeholder: 'Enter Large Description here...',
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