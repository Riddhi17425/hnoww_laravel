@extends('admin.layouts.app')

@section('title', 'Products List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Corporate Kit</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.corporate-kits.create') }}" class="btn btn-primary">Add Corporate Kit</a>
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
    </div>
    

    <div class="card">
        <div class="card-body">
            <table class="table table-hover align-middle mb-0" id="corporateKitTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Short Description</th>
                        <th>Image</th>
                        <th>AED Range</th>
                        <th>MOQ</th>
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
            getCorporateKits: "{{ route('admin.corporate-kit.fetch') }}",
            updateStatus:"{{ route('admin.corporate-kit.update.status') }}",
            deleteCorporateKit: "{{ route('admin.corporate-kits.destroy', ['corporate_kit' => '__ID__']) }}",
            csrfToken: "{{ csrf_token() }}"
        };

</script>
<script src="{{ asset('public/js/admin/corporatekit.js') }} " defer></script>
@endpush