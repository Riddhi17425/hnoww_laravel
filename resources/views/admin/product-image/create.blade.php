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
        <div class="row align-items-center">
            <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
                <span id="success-message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Add Product Images</h3>
                    <a href="{{ route('admin.product-images.index') }}" class="btn btn-primary btn-set-task">Back</a>
                </div>
            </div>
        </div>  

        @if ($errors->has('image.*'))
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->get('image.*') as $messages)
                        @foreach ($messages as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Section --}}
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form id="prodcutImageForm" action="{{ route('admin.product-images.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf                  
                            <div class="card mb-4 border">
                                <div class="card-header bg-light"><strong>Product Images</strong></div>
                                <div class="card-body row">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Products <span class="required-star">*</span></label>
                                            <select name="product" id="product_select"
                                                    class="form-control @error('product') is-invalid @enderror">
                                                <option value="" selected disabled>Select Product</option>
                                                @foreach ($data['products'] as $item)
                                                    <option value="{{ $item->id }}" 
                                                        {{ old('product') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('product')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <strong>Images</strong>
                                            <button type="button" class="btn btn-success btn-sm" id="addImg">+ Add More</button>
                                        </div>

                                        <div id="imageWrapper">
                                            <div class="row img-item mt-3">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Image <span class="required-star">*</span></label>
                                                    <input type="file" name="image[]" class="form-control image-input" placeholder="Select Image">
                                                </div>
                                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger removeImage">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- Submit --}}
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">Save Product Images</button>
                            </div>
                        </form>
                    </div> {{-- End Card Body --}}
                </div>
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
<script src="{{ asset('public/js/admin/product.js') }}"></script>
@endpush