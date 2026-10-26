@extends('admin.layouts.app')

@section('title', 'Add Review')

@section('content')
<div class="container-xxl">
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Add Review</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.review._form')
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save Review</button>
        </div>
    </form>
</div>
@endsection
