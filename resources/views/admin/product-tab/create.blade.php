@extends('admin.layouts.app')

@section('content')
<style>
    .required-star { color: red; }
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
                    <h3 class="fw-bold mb-0">Add Product Tab</h3>
                    <a href="{{ route('admin.product-tabs.index') }}" class="btn btn-primary btn-set-task">Back</a>
                </div>
            </div>
        </div>  

        {{-- Form Section --}}
        <div class="row clearfix g-3">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form id="prodcutTabForm" action="{{ route('admin.product-tabs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf                   
                            {{-- Product Info --}}
                            <div class="card mb-4 border">
                                <div class="card-header bg-light"><strong>Product Tabs Information</strong></div>
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
                                            <strong>Tab's</strong>
                                            <button type="button" class="btn btn-success btn-sm" id="addTab">+ Add More</button>
                                        </div>

                                        <div id="tabWrapper">
                                            <div class="row tab-item mt-3">
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">Title <span class="required-star">*</span></label>
                                                    <input type="text" name="title[]" class="form-control" placeholder="Enter Tab Title">
                                                </div>
                                                <div class="col-md-8 mb-3">
                                                    <label class="form-label">Details <span class="required-star">*</span></label>
                                                    <textarea name="details[]" class="form-control tab-details" placeholder="Enter Tab Details"></textarea>
                                                </div>
                                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger removeTab">
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
                                <button type="submit" class="btn btn-primary">Save Product Tabs</button>
                            </div>
                        </form>
                    </div> {{-- End Card Body --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS Section --}}
<script src="{{ asset('public/js/admin/product.js') }}" defer></script>

@endsection