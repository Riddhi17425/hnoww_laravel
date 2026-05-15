@extends('admin.layouts.app')

@section('title', 'Categories List')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        {{-- <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
            <span id="success-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> --}}
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Categorie List</h3>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i
                        class="icofont-plus-circle me-2 fs-6"></i> Add Categories</a>
            </div>
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
            <select id="category_type" class="form-control input-default">
                <option value=""> -- Select Category Type -- </option>
                @foreach(config('global_values.category_type') as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div> 
    </div>
    <div class="row align-items-center">
        <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
            <span id="success-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="categoryTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Banner Image</th>
                                <th>Category TYpe</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_styles')
@endpush

@push('custom_scripts')
<script>
window.APP_URLS = {
            getCategories: "{{ route('admin.categories.fetch') }}",
            updateStatus:"{{ route('admin.categories.update.status') }}",
            deleteCategory:"{{ route('admin.categories.delete' , [':id']) }}",
            csrfToken: "{{ csrf_token() }}"
        };

</script>
<script src="{{ asset('public/js/admin/category.js') }} " defer></script>
@endpush