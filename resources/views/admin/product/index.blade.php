@extends('admin.layouts.app')

@section('title', 'Products List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Products List</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-2">                      
            <select id="status" class="form-control input-default">
                <option value=""> -- Select Status -- </option>
                <option value="0">Active</option>
                <option value="1">In-active</option>
            </select>
        </div> 
        <div class="col-md-3">                      
            <select id="product_type" class="form-control input-default">
                <option value=""> -- Select Product Type -- </option>
                @foreach(config('global_values.category_type') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

    </div>
    

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped" id="productTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Short Description</th>
                        <th>Product Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('custom_scripts')
<script>
window.APP_URLS = {
            getProducts: "{{ route('admin.products.fetch') }}",
            updateStatus:"{{ route('admin.products.update.status') }}",
            deleteProduct:"{{ route('admin.products.delete' , [':id']) }}",
            csrfToken: "{{ csrf_token() }}"
        };
const normalCategories = @json($categories);
const corporateCategories = @json($corporateCategories);
const weddingCategories = @json($weddingCategories);

</script>
<script src="{{ asset('public/js/admin/product.js') }} " defer></script>
@endpush