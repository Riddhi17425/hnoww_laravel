@extends('admin.layouts.app')

@section('title', 'Add Ceremonial')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Add Ceremonial</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.ceremonials.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.ceremonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Title</label><span class="text-danger">*</span>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Description</label><span class="text-danger">*</span>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Image</label><span class="text-danger">*</span>
                <input type="file" name="image" class="form-control">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save Ceremonial</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('custom_scripts')
<script src="{{ asset('public/js/admin/ceremonial.js') }} " defer></script>
<script> 

$(document).ready(function() {
    $('#description').summernote({
        placeholder: 'Enter Description here...',
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
});
</script>

@endpush