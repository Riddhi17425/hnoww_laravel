@extends('admin.layouts.app')

@section('title', 'Add Journal')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Add Journal</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.journals.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Month Name</label><span class="text-danger">*</span>
                <select name="month_name" class="form-control">
                    <option value="">-- Select Month --</option>
                    @foreach(config('global_values.months') as $month)
                        <option value="{{ $month }}"
                            {{ old('month_name') == $month ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endforeach
                </select>
                @error('month_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Title</label><span class="text-danger">*</span>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Feature Title</label><span class="text-danger">*</span>
                <input type="text" name="feature_title" class="form-control" value="{{ old('feature_title') }}">
                @error('feature_title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Feature Description</label><span class="text-danger">*</span>
                <input type="text" name="feature_description" class="form-control" value="{{ old('feature_description') }}">
                @error('feature_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Description</label><span class="text-danger">*</span>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Thumbnail Image</label><span class="text-danger">*</span>
                <input type="file" name="thumbnail_img" class="form-control">
                @error('thumbnail_img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Detail Image</label><span class="text-danger">*</span>
                <input type="file" name="detail_img" class="form-control">
                @error('detail_img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save Journal</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('custom_scripts')
<script src="{{ asset('public/js/admin/journal.js') }} " defer></script>
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