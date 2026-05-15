@extends('admin.layouts.app')

@section('content')
<style>
    .required-star { color: red; }
</style>

<div class="container-xxl">
    {{-- Page Header --}}
        <div class="row align-items-center">
            <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
                <span id="success-message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Edit Product Tabs</h3>
                    <a href="{{ route('admin.product-tabs.index') }}" class="btn btn-primary btn-set-task">Back</a>
                </div>
            </div>
        </div>

    <form action="{{ route('admin.product-tabs.update', $product->id) }}" method="POST">
        @csrf

        {{-- Product --}}
        <div class="mb-3">
            <label class="form-label">Product <span class="required-star">*</span></label>
            <input type="text" class="form-control" value="{{ $product->product_name }}" disabled>
        </div>

        {{-- Tab Details --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <strong>TABs</strong>
                <button type="button" class="btn btn-success btn-sm" id="addTab">
                    + Add More
                </button>
            </div>

            <div class="card-body" id="tabWrapper">
                @foreach ($tabs as $key => $faq)
                <div class="row tab-item mb-3">
                    <input type="hidden" name="tab_id[]" value="{{ $faq->id }}">

                    <div class="col-md-5">
                        @if($key == 0)<label class="form-label">Title <span class="required-star">*</span></label>@endif
                        <input type="text" name="title[]" class="form-control"
                               value="{{ $faq->title }}" required>
                    </div>

                    <div class="col-md-6">
                        @if($key == 0)<label class="form-label">Details <span class="required-star">*</span></label>@endif
                        <textarea name="details[]" class="form-control details" required>{!! $faq->details !!}</textarea>
                    </div>

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger removeTab">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">Update TABs</button>
        </div>
    </form>
</div>

<script src="{{ asset('public/js/admin/product-tab.js') }}" defer></script>
@endsection
