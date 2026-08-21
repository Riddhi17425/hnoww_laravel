@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6"><h3>Edit Banner</h3></div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" id="bannerForm" novalidate>
        @csrf
        @method('PUT')
        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Title</label><span class="text-danger">*</span>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}">
                <div class="invalid-feedback">The banners title field is required.</div>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Type</label><span class="text-danger">*</span>
                <select id="type" name="type" class="form-control">
                    <option value="">-- Select Type --</option>
                    <option value="image" {{ old('type', $banner->type ?? '') == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ old('type', $banner->type ?? '') == 'video' ? 'selected' : '' }}>Video</option>
                </select>
                <div class="invalid-feedback">The type field is required.</div>
                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- IMAGE FIELDS - hidden by default, JS decides visibility based on $banner->type --}}
            <div id="image_fields" class="row g-3 col-md-12" style="display:none;">
                <div class="col-md-6">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control"
                        {{ !empty($banner->image) ? 'data-has-existing="true"' : '' }}>
                    <div class="invalid-feedback">The banners image field is required.</div>
                    @if(!empty($banner->image))
                        <img src="{{ asset('public/images/admin/banner/images/'.$banner->image) }}" width="100" class="mt-2 d-block">
                    @endif
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile Image</label>
                    <input type="file" name="mobile_image" class="form-control">
                    @if(!empty($banner->mobile_image))
                        <img src="{{ asset('public/images/admin/banner/images/'.$banner->mobile_image) }}" width="100" class="mt-2 d-block">
                    @endif
                    @error('mobile_image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6" id="alt_text_field">
                    <label class="form-label">Alt Text</label><span class="text-danger">*</span>
                    <input type="text" name="alt_text" id="alt_text" class="form-control" value="{{ old('alt_text', $banner->alt_text ?? '') }}">
                    <div class="invalid-feedback">The banners alt field is required.</div>
                    @error('alt_text') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- VIDEO FIELDS - hidden by default, JS decides visibility based on $banner->type --}}
            <div id="video_fields" class="row g-3 col-md-12" style="display:none;">
                <div class="col-md-6">
                    <label class="form-label">Video</label>
                    <input type="file" name="video" id="video" class="form-control"
                        {{ !empty($banner->video) ? 'data-has-existing="true"' : '' }}>
                    <div class="invalid-feedback">The banners video field is required.</div>
                    @if(!empty($banner->video))
                        <video width="150" controls class="mt-2 d-block">
                            <source src="{{ asset('public/images/admin/banner/videos/'.$banner->video) }}">
                        </video>
                    @endif
                    @error('video') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mobile Video</label>
                    <input type="file" name="mobile_video" class="form-control">
                    @if(!empty($banner->mobile_video))
                        <video width="150" controls class="mt-2 d-block">
                            <source src="{{ asset('public/images/admin/banner/videos/'.$banner->mobile_video) }}">
                        </video>
                    @endif
                    @error('mobile_video') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label">Status</label><span class="text-danger">*</span>
                <select name="is_active" class="form-control">
                <option value="0" {{ old('is_active', $banner->is_active ?? 0) == 0 ? 'selected' : '' }}>Active</option>
                <option value="1" {{ old('is_active', $banner->is_active ?? 0) == 1 ? 'selected' : '' }}>In-Active</option>
            </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Description</label><span class="text-danger">*</span>
                <textarea name="description" id="description" class="form-control">{{ old('description', $banner->description ?? '') }}</textarea>
                <div class="invalid-feedback">The banners desc field is required.</div>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Save Banner</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('custom_scripts')
<script src="{{ asset('public/js/admin/banner.js') }}" defer></script>
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
