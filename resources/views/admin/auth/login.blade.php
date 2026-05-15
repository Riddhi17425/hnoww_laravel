@extends('admin.layouts.auth')

@section('title', 'Signin')

@section('content')

<div class="container-xxl">
    <div class="row g-0">

        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-h100">
            <div style="max-width: 25rem;">
                <div class="text-center mb-5">
                    <i class="bi bi-bag-check-fill text-primary" style="font-size: 90px;"></i>
                </div>

                <div class="mb-5">
                    <h2 class="text-center">A few clicks is all it takes.</h2>
                </div>

                <div class="text-center">
                    <img src="{{ asset('public/admin_public/dist/assets/images/login-img.svg') }}" alt="login-img" class="img-fluid">
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="col-lg-6 d-flex justify-content-center align-items-center auth-h100">
            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">

                <form method="POST" action="{{ route('admin.login.submit') }}" class="row g-3 p-3 p-md-4">
                    @csrf

                    <div class="col-12 text-center mb-3">
                        <h1>Admin Login</h1>
                    </div>

                    <!-- Email -->
                    <div class="col-12">
                        <label class="form-label">Email address</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control form-control-lg"
                               placeholder="name@example.com">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control form-control-lg"
                               placeholder="********">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Button -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit"
                                class="btn btn-lg btn-block btn-light text-uppercase">
                            Login
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush
