@extends('admin.layouts.app')

@section('content')
<style>
    .required-star { color: red; }
    .img-container {
        width: 100%;
        height: 500px;
        background: #f5f5f5;
    }
    .img-container img {
        display: block;
        max-width: 100%;
        max-height: 100%;
    }
    .cropper-container {
        width: 100% !important;
        height: 100% !important;
    }
</style>

<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        {{-- Page Header --}}
        <div class="row align-items-center mb-3">
            <div class="card-header py-3 no-bg bg-transparent d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0">Edit Product Images</h3>
                <a href="{{ route('admin.product-images.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Section --}}
        <div class="card mb-3">
            <div class="card-body">
                <form id="prodcutImageForm" action="{{ route('admin.product-images.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Product --}}
                    <div class="mb-3">
                        <label class="form-label">Product <span class="required-star">*</span></label>
                        <select name="product" id="product_select" class="form-control">
                            <option value="" disabled>Select Product</option>
                            @foreach ($data['products'] as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $product->id ? 'selected' : '' }}>
                                    {{ $item->product_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Images --}}
                    <div class="card mb-3">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <strong>Images</strong>
                            <button type="button" class="btn btn-success btn-sm" id="addImg">+ Add More</button>
                        </div>
                        <div id="imageWrapper" class="card-body row">
                            @foreach($productImages as $img)
                                <div class="row img-item mt-3 existing-image" data-id="{{ $img->id }}">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="hidden" name="existing_image_ids[]" value="{{ $img->id }}">
                                        <input type="file" name="image[]" class="form-control image-input">
                                        <img src="{{ asset('public/images/admin/product_images/'.$img->image) }}" alt="Product Image" class="img-thumbnail mt-2" width="150">

                                        <!-- ✅ KEEP ONLY THIS BUTTON FOR EXISTING IMAGES -->
                                        <button type="button" class="btn btn-danger removeExistingImage">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            @if(count($productImages) == 0)
                                <div class="row img-item mt-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Image <span class="required-star">*</span></label>
                                        <input type="file" name="image[]" class="form-control image-input">
                                    </div>
                                    <div class="col-md-1 mb-3 d-flex align-items-end">
                                        <!-- ✅ KEEP THIS BUTTON FOR NEWLY ADDED IMAGES -->
                                        <button type="button" class="btn btn-danger removeImage">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Update Product Images</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    <img id="cropperImage" style="max-width:100%;">
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
<script src="{{ asset('public/js/admin/product_image.js') }}"></script>
@endpush
