@extends('admin.layouts.app')

@section('title', 'Edit Review')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Edit Review</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.review._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Update Review</button>
        </div>
    </form>
</div>
@endsection
