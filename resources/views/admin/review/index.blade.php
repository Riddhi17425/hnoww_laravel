@extends('admin.layouts.app')

@section('title', 'Review List')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Review List</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary">Add Review</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div id="message-pop-up" class="alert alert-dismissible fade show" role="alert" style="display: none">
        <span id="success-message"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="col-md-2 mb-3">
        <select id="status" class="form-control input-default">
            <option value=""> -- Select Status -- </option>
            <option value="1">Active</option>
            <option value="0">In-active</option>
        </select>
    </div>
    <table id="reviewTable" class="table table-hover align-middle mb-0" style="width: 100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>City</th>
                <th>Rating</th>
                <th>Description</th>
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
    getReviews: "{{ route('admin.review.fetch') }}",
    updateStatus: "{{ route('admin.review.update.status') }}",
    deleteReview: "{{ route('admin.reviews.destroy', [':id']) }}",
    csrfToken: "{{ csrf_token() }}"
};
</script>
<script src="{{ asset('public/js/admin/review.js') }}" defer></script>
@endpush
