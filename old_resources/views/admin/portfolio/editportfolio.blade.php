@extends('admin.layouts.app')

@section('title', 'Edit Portfolio')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h3 class="fw-bold">Edit Portfolio</h3>
        </div>
    </div>

    <form method="post" enctype="multipart/form-data" action="{{ route('portfolio.update', $data->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $data->id }}" />

        <div class="card mb-4 p-4">
            <h5 class="fw-bold mb-3">Portfolio Information</h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="category_name" class="form-label">Category Name</label>
                    <select class="form-select" id="category_name" name="category_name" required>
                        <option value="" disabled {{ empty($data->category_name) ? 'selected' : '' }}>Select Category</option>
                        @foreach(['Graphics', 'Website', 'Social Media', 'LinkedIn', 'Videos'] as $category)
                            <option value="{{ $category }}" {{ $data->category_name == $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="title" class="form-label">Portfolio Title</label>
                    <input type="text" id="title" name="title" value="{{ $data->title }}" required class="form-control">
                </div>

                <div class="col-md-12">
                    <label for="short_description" class="form-label">Portfolio Detail Page Title</label>
                    <textarea id="short_description" name="short_description" class="form-control">{{ $data->short_description }}</textarea>
                </div>
                <div class="col-md-12">
                    <label for="description" class="form-label">Portfolio Description</label>
                    <textarea id="description" name="description" class="form-control">{{ $data->description }}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="url" class="form-label">Portfolio URL</label>
                    <input type="text" id="url" name="url" value="{{ $data->url }}" required class="form-control">
                </div>
            </div>
        </div>
        <div class="card mb-4 p-4">
            <h5 class="fw-bold mb-3">Portfolio Images</h5>
            <div class="mb-3">
                <label for="input-file-front" class="form-label">Main Portfolio Image</label>
                <input type="file" id="input-file-front" name="image" class="dropify" data-default-file="{{ asset('public/Portfolio_image/' . $data->image) }}">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="customFile" class="form-label">Portfolio Detail Images (Multiple)</label>
                <input type="file" name="detail_image[]" class="form-control" id="customFile" multiple>
                @error('detail_image') <span class="text-danger">{{ $message }}</span> @enderror

                @php $detail_images = explode(',', $data->detail_image); @endphp
                <div class="mt-2 d-flex flex-wrap gap-2">
                    @foreach($detail_images as $detail_image)
                        <div class="border p-1">
                            <img src="{{ asset('public/portfolio_detail_image/' . $detail_image) }}" alt="Detail Image" height="40">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="video_link" class="form-label">Portfolio Video URL</label>
            <input type="text" id="video_link" name="video_link" value="{{ $data->video_link }}" class="form-control">
        </div>
        <div class="card mb-4 p-4">
            <h5 class="fw-bold mb-3">SEO Details</h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="alt" class="form-label">Image Alt Text</label>
                    <input type="text" id="alt" name="alt" value="{{ $data->alt }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ $data->meta_title }}" class="form-control">
                </div>

                <div class="col-md-12">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="form-control">{{ $data->meta_description }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
       
    </form>
</div>
@endsection

@push('styles')
<!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<!-- Dropify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
@endpush

@push('scripts')
<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<!-- Dropify JS -->
<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

<script>
    $(document).ready(function() {
        $('.dropify').dropify();
        
        $('#description, #short_description, #meta_description').summernote({
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
