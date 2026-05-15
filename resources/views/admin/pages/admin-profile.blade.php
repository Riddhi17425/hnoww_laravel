@extends('admin.layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">   <h3 class="fw-bold mb-0">Admin Profile</h3>
            </div>
        </div>
    </div>

    {{-- @if(session('success'))
    <div class="alert alert-success auto-hide">
        {{ session('success') }}
    </div>
    @endif --}}

    <div class="row g-3">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">Profile Settings</h6>
                </div>
                <div class="card-body">
                    <form class="row g-4" method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">User Name</label>
                                <input class="form-control"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', optional(auth()->guard('admin')->user())->name) }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input class="form-control"
                                    type="password"
                                    name="password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="email"
                                    class="form-control"
                                    name="email"
                                    value="{{ old('email', optional(auth()->guard('admin')->user())->email) }}">
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary text-uppercase px-5">
                                SAVE
                            </button>
                        </div>
                    </form>
                </div>
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
<!-- Edit Password-->
<div class="modal fade" id="authchange" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Authentication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="deadline-form">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="item1" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="item1" value="Adrian007">
                            </div>
                            <div class="col-sm-6">
                                <label for="taxtno111" class="form-label">Password</label>
                                <input type="password" class="form-control" id="taxtno111" value="abcxyzabc">
                            </div>
                            <div class="col-sm-12">
                                <label for="taxtno11" class="form-label">Conform Password</label>
                                <input type="text" class="form-control" id="taxtno11">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit profile-->
<div class="modal fade" id="editprofile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="expeditLabel1111"> Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="deadline-form">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <label for="item100" class="form-label">Name</label>
                                <input type="text" class="form-control" id="item100" value="Adrian Allan">
                            </div>
                            <div class="col-sm-12">
                                <label for="taxtno200" class="form-label">Profile</label>
                                <input type="file" class="form-control" id="taxtno200">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <label class="form-label">Details</label>
                                <textarea class="form-control"
                                    rows="3">Duis felis ligula, pharetra at nisl sit amet, ullamcorper fringilla mi. Cras luctus metus non enim porttitor sagittis. Sed tristique scelerisque arcu id dignissim. Aenean sed erat ut est commodo tristique ac a metus. Praesent efficitur congue orci. Fusce in mi condimentum mauris maximus sodales. Quisque dictum est augue, vitae cursus quam finibus in. Nulla at tempus enim. Fusce sed mi et nibh laoreet consectetur nec vitae lacus.</textarea>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" value="California">
                            </div>
                            <div class="col-sm-6">
                                <label for="abc1" class="form-label">Birthday date</label>
                                <input type="date" class="form-control w-100" id="abc1" value="1980-03-19">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="mailid" class="form-label">Mail</label>
                                <input type="text" class="form-control" id="mailid" value="adrianallan@gmail.com">
                            </div>
                            <div class="col-sm-6">
                                <label for="phoneid" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phoneid" value="202-555-0174">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" rows="3">2734 West Fork Street,EASTON 02334.</textarea>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endpush