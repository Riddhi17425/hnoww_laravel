@extends('admin.layouts.app')

@section('title', 'Banner List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Banners List</h3>
        </div>
        <div class="col-md-6 text-end">
            {{-- <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Add Banner</a> --}}
        </div>
    </div>
    <div class="col-md-2 mb-3">
        <select id="status" class="form-control input-default">
            <option value=""> -- Select Status -- </option>
            <option value="0">Active</option>
            <option value="1">In-active</option>
        </select>
    </div>
    <table id="bannerTable" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Description</th>
                <th>Media</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('custom_scripts')
<script>
window.APP_URLS = {
    getBanners: "{{ route('admin.banner.fetch') }}",
    updateStatus: "{{ route('admin.banner.update.status') }}",
    deleteBanner: "{{ route('admin.banners.destroy', ['banner' => '__ID__']) }}",
    csrfToken: "{{ csrf_token() }}"
};
</script>
<script src="{{ asset('public/js/admin/banner.js') }}" defer></script>
@endpush