@extends('admin.layouts.app')

@section('title', 'Journal List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Ceremonial List</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.ceremonials.create') }}" class="btn btn-primary">Add Ceremonial</a>
        </div>
    </div>
    <div class="col-md-2">                      
        <select id="status" class="form-control input-default">
            <option value=""> -- Select Status -- </option>
            <option value="0">Active</option>
            <option value="1">In-active</option>
        </select>
    </div>
     <table id="ceremonialTable" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
@endsection

@push('custom_scripts')
<script>
window.APP_URLS = {
        getCeremonials: "{{ route('admin.ceremonial.fetch') }}",
        updateStatus:"{{ route('admin.ceremonial.update.status') }}",
        deleteCeremonial: "{{ route('admin.ceremonials.destroy', ['ceremonial' => '__ID__']) }}",
        csrfToken: "{{ csrf_token() }}"
    };



</script>
<script src="{{ asset('public/js/admin/ceremonial.js') }} " defer></script>
@endpush