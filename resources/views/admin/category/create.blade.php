@extends('admin.layouts.app')

@section('title', 'Categories Add')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Categories Add</h3>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-set-task">Back</a>
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
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label class="form-label">Category Type</label><span class="text-danger">*</span>
                                <select name="category_type" class="form-control">
                                    <option value="">-- Select Type --</option>
                                    @foreach(config('global_values.category_type') as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('category_type') == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Category Name</label><span class="text-danger">*</span>
                                <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}" id="category_name">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Category URL</label><span class="text-danger">*</span>
                                <div class="input-group mb-3">
                                    <input type="text" name="category_url" class="form-control" value="{{ old('category_url') }}" id="category_url">
                                </div>
                                @error('category_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Category Title</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" id="title">
                                </div>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Category Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Meta Title</label><span class="text-danger">*</span>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Meta Description</label><span class="text-danger">*</span>
                                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Banner Image</label><span class="text-danger">*</span>
                                <input type="file" name="banner_image" class="form-control">
                                @error('banner_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr><h5>The World Section Fields</h5>
                            {{-- THE WORLD SECTION FIELDS --}}
                            <div class="col-md-6">
                                <label class="form-label">Heading First</label>
                                <input type="text" name="magic_heading_first" class="form-control" value="{{ old('magic_heading_first') }}">
                                @error('magic_heading_first')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Heading Second</label>
                                <input type="text" name="magic_heading_second" class="form-control" value="{{ old('magic_heading_second') }}">
                                @error('magic_heading_second')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="magic_title" class="form-control" value="{{ old('magic_title') }}">
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
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="magic_description" class="form-control" rows="3">{{ old('magic_description') }}</textarea>
                                @error('magic_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Save Category
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
<script>
$(document).ready(function() {
    
});
</script>
<script src="{{ asset('public/js/admin/category.js') }} " defer></script>
@endpush

@push('modals')

@endpush