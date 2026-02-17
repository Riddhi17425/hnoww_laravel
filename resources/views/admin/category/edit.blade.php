@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between flex-wrap border-bottom">
                <h3 class="fw-bold mb-0">Edit Category</h3>
            </div>
        </div>
    </div> 

    <div class="row g-3 mb-3">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Basic information</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label class="form-label">Category Type</label><span class="text-danger">*</span>
                                <select name="category_type" class="form-control">
                                    <option value="">-- Select Type --</option>
                                    @foreach(config('global_values.category_type') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('category_type', $category->category_type ?? '') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Category Name</label><span class="text-danger">*</span>
                                <input type="text" name="category_name" class="form-control" value="{{ old('category_name', $category->category_name) }}" id="category_name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Category URL</label><span class="text-danger">*</span>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_url" class="form-control" value="{{ old('category_url', $category->category_url) }}" id="category_url">
                                </div>
                                @error('category_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Category Title</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}" id="title">
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Category Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Title</label><span class="text-danger">*</span>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $category->meta_title) }}">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Meta Description</label><span class="text-danger">*</span>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $category->meta_description) }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Banner Image --}}
                            <div class="col-md-6">
                                <label class="form-label">Banner Image</label><span class="text-danger">*</span>
                                <input type="file" name="banner_image" class="form-control">
                                @error('banner_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if($category->banner_image)
                                    <div class="mt-2">
                                        <img src="{{ url('public/images/admin/category_banner/'.$category->banner_image) }}" alt="Banner" width="250">
                                    </div>
                                @endif
                            </div>

                            <hr><h5>The World Section Fields</h5>
                            {{-- THE WORLD SECTION FIELDS --}}
                            <div class="col-md-6">
                                <label class="form-label">Heading First</label>
                                <input type="text" name="magic_heading_first" class="form-control" value="{{ old('magic_heading_first', $category->magic_heading_first) }}">
                                @error('magic_heading_first')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Heading Second</label>
                                <input type="text" name="magic_heading_second" class="form-control" value="{{ old('magic_heading_second', $category->magic_heading_second) }}">
                                @error('magic_heading_second')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="magic_title" class="form-control" value="{{ old('magic_title', $category->magic_title) }}">
                                @error('magic_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Image</label>
                                <input type="file" name="magic_image" class="form-control">
                                @error('magic_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @if($category->magic_image)
                                    <div class="mt-2">
                                        <img src="{{ url('public/images/admin/category_magic/'.$category->magic_image) }}" alt="Magic Image" width="250">
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="magic_description" class="form-control" rows="3">{{ old('magic_description', $category->magic_description) }}</textarea>
                                @error('magic_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_scripts')
<script>
$(document).ready(function() {
    // Slug auto-generate
    $('#category_name').on('input', function() {
        var name = $(this).val();
        var slug = name.toLowerCase()
                       .replace(/[^a-z0-9\s-]/g, '')
                       .replace(/\s+/g, '-')
                       .replace(/-+/g, '-');
        $('#category_url').val(slug);
    });
    
});
</script>
@endpush
