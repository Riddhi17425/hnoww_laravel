@extends('admin.layouts.app')

@section('title', 'Portfolio List')

@section('content')
<div class="container-xxl">

    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Portfolio</h3>

                <div class="row align-items-center mb-3">
                    <div class="col-md-12">
                        <a href="{{ route('portfolio.create') }}" class="btn btn-primary">Add Portfolio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mb-3">


        <div class="col-md-12 col-lg-12 ">
            <div class="card mb-3 bg-transparent p-2">
                @foreach ($data as $portfolio)
                <div class="card border-0 mb-1">
                    <div class="card-body d-flex align-items-center flex-column flex-md-row">

                        <div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
                            <h6 class="mb-3 fw-bold">{{ $portfolio->title }} <span
                                    class="text-muted small fw-light d-block">Reference {{ $portfolio->id }}</span>
                            </h6>

                            <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2 d-inline-flex d-md-none">
                                <a href="{{ route('portfolio.edit', ['portfolio' => $portfolio->id]) }}"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('portfolio.destroy', ['portfolio' => $portfolio->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                        <div class="ms-auto d-none d-md-flex">
                            <a href="{{ route('portfolio.edit', ['portfolio' => $portfolio->id]) }}"
                                class="btn btn-warning me-2">Edit</a>
                            <form action="{{ route('portfolio.destroy', ['portfolio' => $portfolio->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->
</div>
@endsection

@push('styles')
<!--plugin css file -->
<link rel="stylesheet" href="{!! asset('public/admin_public/dist/assets/plugin/nouislider/nouislider.min.css') !!}">
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Jquery Plugin -->
<script src="{!! asset('public/admin_public/dist/assets/plugin/nouislider/nouislider.min.js') !!}"></script>

@endpush

@push('custom_scripts')
<script>
// Your custom scripts can be added here if needed
</script>
@endpush