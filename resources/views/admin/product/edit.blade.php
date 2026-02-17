    @extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Edit Product</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Category Type</label><span class="text-danger">*</span>
                <select name="category_type" class="form-control">
                    <option value="">-- Select Type --</option>
                    @foreach(config('global_values.category_type') as $key => $value)
                        <option value="{{ $key }}"
                            {{ old('category_type', $product->product_type ?? '') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                @error('category_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            {{-- Category --}}
            <div class="col-md-4">
                <label class="form-label">Category</label><span class="text-danger">*</span>
                <input type="hidden" id="existing_cat_id" @if(isset($product->category_id)) value="{{ $product->category_id }}" @else {{ '' }} @endif>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                    {{-- @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach --}}
                </select>
                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Product Price --}}
            <div class="col-md-4">
                <label class="form-label">Product Price</label><span class="text-danger">*</span>
                <input type="text" name="product_price" class="form-control" value="{{ old('product_price', $product->product_price) }}">
                @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-6 d-none" id="moqField">
                <label class="form-label">MOQ (In Units)</label><span class="text-danger">*</span>
                <input type="text" name="moq" id="moq" class="form-control" value="{{ old('moq', $product->moq) }}">
                @error('moq') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Product Name --}}
            <div class="col-md-5">
                <label class="form-label">Product Name</label><span class="text-danger">*</span>
                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}">
                @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Product URL --}}
            <div class="col-md-5">
                <label class="form-label">Product URL</label><span class="text-danger">*</span>
                <input type="text" name="product_url" id="product_url" class="form-control" value="{{ old('product_url', $product->product_url) }}">
                @error('product_url') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-2">
                <label class="form-label">Product Stock</label><span class="text-danger">*</span>
                <input type="number" name="product_stock" id="product_stock" class="form-control" value="{{ old('product_stock', $product->product_stock) }}">
                @error('product_stock') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-8">
                <label class="form-label">List Page Image</label><span class="text-danger">*</span>
                <input type="file" name="list_img" id="list_img" class="form-control" value="{{ old('list_img') }}">
                @error('list_img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @if($product->list_page_img)
                <div class="mt-2">
                    <p class="mb-1 fw-bold">Current List Image</p>
                    <img src="{{ asset('public/images/admin/product_list/'.$product->list_page_img) }}"
                        width="150" class="img-thumbnail">
                </div>
            @endif

            <div class="col-md-8">
                <label class="form-label">Detail Page Images</label><span class="text-danger">*</span>
                <input type="file" name="detail_imgs[]" multiple id="detail_imgs" class="form-control" value="{{ old('detail_imgs') }}">
                @error('detail_imgs') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            @if($product->detail_page_imgs)
                @php $detailImages = json_decode($product->detail_page_imgs, true); @endphp
                <div class="mt-3">
                    <p class="fw-bold">Current Detail Images</p>
                    <div class="row">
                        @foreach($detailImages as $key => $img)
                            <div class="col-md-3 text-center mb-3" id="detail-img-{{ $key }}">
                                <img src="{{ asset('public/images/admin/product_detail/'.$img) }}"
                                    class="img-thumbnail mb-2"
                                    style="height:120px;object-fit:cover">

                                <button type="button"
                                    class="btn btn-sm btn-danger delete-detail-img"
                                    data-index="{{ $key }}" data-product-id="{{ $product->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="deleteAllDetailImgs"
                            class="btn btn-outline-danger btn-sm mt-2" data-product-id="{{ $product->id }}">
                        Delete All Detail Images
                    </button>
                </div>
            @endif

            <div class="col-md-6">
                <label class="form-label">Short Note</label><span class="text-danger">*</span>
                <input type="text" name="short_note" id="short_note" class="form-control" value="{{ old('short_note', $product->short_note) }}">
                @error('short_note') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Product Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control" rows="4">{{ old('short_description', $product->short_description) }}</textarea>
                @error('short_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Product Large Description</label>
                <textarea name="large_description" id="large_description" class="form-control" rows="4">{{ old('large_description', $product->large_description) }}</textarea>
                @error('large_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Product dimensions</label>
                <textarea name="dimensions" id="dimensions" class="form-control" rows="4">{{ old('dimensions', $product->dimensions) }}</textarea>
                @error('dimensions') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-12">
                <label class="form-label">Care & Maintenance</label>
                <textarea name="care_maintenance" id="care_maintenance" class="form-control" rows="4">{{ old('care_maintenance', $product->care_maintenance) }}</textarea>
                @error('care_maintenance') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Meta Title --}}
            <div class="col-md-12">
                <label class="form-label">Meta Title</label><span class="text-danger">*</span>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title) }}">
                @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            {{-- Meta Description --}}
            <div class="col-md-12">
                <label class="form-label">Meta Description</label><span class="text-danger">*</span>
                <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Update Product</button>
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
<script src="{{ asset('public/js/admin/product.js') }}" defer></script>
<script> 
const normalCategories = @json($categories);
const corporateCategories = @json($corporateCategories);
const weddingCategories = @json($weddingCategories);

$(document).ready(function() {
    $('#short_description').summernote({
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
    $('#care_maintenance').summernote({
        placeholder: 'Enter Care & Description here...',
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
