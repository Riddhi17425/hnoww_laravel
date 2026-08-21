@include('layouts.frontheader')
<link rel="stylesheet" href="{{ asset('public/front/css/custom-profile.css') }}">
<style>
.theme-green .header-scrolled {
    background: #EDEAE4;
}

.theme-green .language-select .dropdown-input-lan {
    color: #0e2233;
}

@media (max-width:767px) {
    .sticky-header {
        /*background: #EDEAE4;*/
    }
}
</style>

<section class="mt_60 mb_120">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <div class="section_header text-center mb-5">
            <p class="sub_head mb-0 justify-content-center d-flex align-items-center gap-3" style="color: #B58A46; text-transform: uppercase; font-size: 14px; letter-spacing: 2px;">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z" fill="#B58A46" /></svg></span>
                <span>Your Profile</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z" fill="#B58A46" /></svg></span>
            </p>
            <h2 class="title_60" style="color: #B58A46; font-family: 'Playfair Display', serif; font-size: 48px; margin-top: 10px;">My Account</h2>
        </div>

        <div class="profile_main_wrapper mt-5">
            <div class="row">
                <!-- Sidebar / Tabs -->
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="profile_sidebar">
                        <div class="user_info_top text-center mb-4">
                            <div class="profile_img_wrapper">
                                <img src="{{ $user->profile_image ? asset('public/images/front/profile/'.$user->profile_image) : asset('public/images/front/user-placeholder.png') }}" alt="Profile" class="profile_img" id="profileImagePreview" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=D0C2AA&color=fff';">
                                <form method="POST" action="{{ route('front.profile.update') }}" enctype="multipart/form-data" id="profileImageForm">
                                    @csrf
                                <label for="profile_upload" class="edit_icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                </label>
                                <input type="file" name="profile_image" id="profile_upload" class="d-none" accept="image/*">
                                </form>
                            </div>
                            <h4 class="mt-3" style="font-family: 'Playfair Display', serif; color: #0e2233;">{{$user->name ?? 'John Doe'}}</h4>
                            <p class="text-muted" title="{{$user->email ?? 'johndoe@example.com'}}" style="font-family: 'Inter', sans-serif; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;">{{$user->email ?? 'johndoe@example.com'}}</p>
                        </div>
                        
                        <div class="nav flex-column nav-pills profile_tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Personal Info
                            </button>
                            <!-- <button class="nav-link" id="v-pills-orders-tab" data-bs-toggle="pill" data-bs-target="#v-pills-orders" type="button" role="tab" aria-controls="v-pills-orders" aria-selected="false" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                My Orders
                            </button> -->
                            <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                Change Password
                            </button>
                            <button class="nav-link" id="v-pills-addresses-tab" data-bs-toggle="pill" data-bs-target="#v-pills-addresses" type="button" role="tab" aria-controls="v-pills-addresses" aria-selected="false" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                My Addresses
                            </button>
                            
                            <!-- Logout Button -->
                            <a href="{{ route('front.logout') }}" class="nav-link text-danger mt-3" style="font-weight: 500; display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content profile_content_wrapper" id="v-pills-tabContent">
                        <!-- Profile Edit Form -->
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="ct_form">
                                <h3 class="tab_title mb-4">Edit Profile</h3>
                                <form method="POST" action="{{ route('front.profile.update') }}" id="profileUpdateForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="ct_input">
                                                <label for="name" class="sub_head">Name</label>
                                                <input type="text" name="name" id="name" pattern="^[A-Za-z\s]+$" value="{{$user->name ?? ''}}" title="Please use only letters" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="ct_input">
                                                <label for="email" class="sub_head">Email Address</label>
                                                <input type="email" name="email" id="email" value="{{$user->email ?? ''}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="ct_input">
                                                <label for="phone" class="sub_head">Phone Number</label>
                                                <input type="tel" name="phone" id="phone" value="{{$user->phone ?? ''}}" pattern="^\+?[1-9]\d{1,14}$" title="Please enter a valid phone number" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="ct_input">
                                                <label for="dob" class="sub_head">Date of Birth</label>
                                                <input type="date" name="dob" id="dob" value="{{$user->dob ?? ''}}" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-lg-4">
                                        <button class="com_btn" type="submit">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                            <div class="ct_form">
                                <h3 class="tab_title mb-4">Change Password</h3>
                                <form method="POST" action="{{ route('front.profile.password') }}" id="changePasswordForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="ct_input">
                                                <label for="new_password" class="sub_head mb-2 d-block">New Password</label>
                                                <div class="password-wrapper">
                                                    <input type="password" name="new_password" id="new_password" class="custom-input" required>
                                                    <span class="password-toggle-icon">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="ct_input">
                                                <label for="confirm_password" class="sub_head mb-2 d-block">Confirm New Password</label>
                                                <div class="password-wrapper">
                                                    <input type="password" name="new_password_confirmation" id="confirm_password" class="custom-input" required>
                                                    <span class="password-toggle-icon">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-lg-4">
                                        <button class="com_btn" type="submit">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-addresses" role="tabpanel" aria-labelledby="v-pills-addresses-tab">
                            <div class="ct_form">
                                <h3 class="tab_title mb-4">My Addresses</h3>
                                @forelse($addresses as $address)
                                <div class="order_card mb-3 d-flex justify-content-between align-items-start gap-3">
                                    <div>
                                        <h5>{{ $address->name }}</h5>
                                        <p class="mb-1">{{ $address->address_line1 }}, {{ $address->address_line2 }}</p>
                                        <p class="mb-1">{{ $address->emirate }} | {{ $address->contact_no }}</p>
                                        @if($address->landmark)<p class="mb-0">Landmark: {{ $address->landmark }}</p>@endif
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-dark edit-address" data-address='@json($address)'>Edit</button>
                                        <form method="POST" action="{{ route('front.profile.address.delete', $address->id) }}" onsubmit="return confirm('Delete this address?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted">No saved addresses yet.</p>
                                @endforelse

                                <form method="POST" action="{{ route('front.profile.address.save') }}" id="addressForm">
                                    @csrf
                                    <input type="hidden" name="address_id" id="address_id">
                                    <h4 id="addressFormTitle" class="mt-4 mb-3">Add New Address</h4>
                                    <div class="row">
                                        <div class="col-md-6"><div class="ct_input"><label class="sub_head">Name</label><input class="form-control" name="name" required></div></div>
                                        <div class="col-md-6"><div class="ct_input"><label class="sub_head">Contact Number</label><input class="form-control" name="contact_no" required></div></div>
                                        <div class="col-md-6"><div class="ct_input"><label class="sub_head">WhatsApp Number</label><input class="form-control" name="whatsapp_no"></div></div>
                                        <div class="col-md-6"><div class="ct_input"><label class="sub_head">Emirate</label><input class="form-control" name="emirate" required></div></div>
                                        <div class="col-md-6"><div class="ct_input"><label class="sub_head">Flat/House No., Building</label><input class="form-control" name="address_line1" required></div></div>
                                        <div class="col-md-6"><div class="ct_input"><label class="sub_head">Area, Street, Sector, Town</label><input class="form-control" name="address_line2" required></div></div>
                                        <div class="col-12"><div class="ct_input"><label class="sub_head">Landmark</label><textarea class="form-control" name="landmark"></textarea></div></div>
                                    </div>
                                    <button class="com_btn mt-3" type="submit">Save Address</button>
                                </form>
                            </div>
                        </div>

                        <!-- Orders List -->
                        <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                            <h3 class="tab_title mb-4">My Orders</h3>
                            <div class="orders_list">
                                @forelse($orders as $order)
                                <div class="order_card mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="order_id">Order #{{ $order->order_number ?? $order->id }}</h5>
                                        <span class="badge bg-success" style="font-weight: 400; padding: 6px 12px; border-radius: 4px;">{{ ucfirst($order->status ?? 'Pending') }}</span>
                                    </div>
                                    <p class="mb-1 text-muted" style="font-size: 14px;">Placed on: {{ optional($order->created_at)->format('M d, Y') }}</p>
                                    <p class="mb-1 text-muted" style="font-size: 14px;">Payment: {{ ucfirst($order->payment_status ?? 'Unpaid') }}</p>
                                    <p class="mb-1 text-muted" style="font-size: 14px;">{{ $order->orderProducts->sum('quantity') }} item(s)</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">

                                        <p class="order_total fw-bold mb-0" style="color: #0e2233; font-size: 16px;">Total: AED {{ number_format($order->order_total, 2) }}</p>
                                        <a href="{{ route('front.order_detail.view', $order->id) }}" class="btn btn-sm btn-outline-dark">View Details</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted">You have not placed any orders yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script for image preview -->
<script>
    document.getElementById('profile_upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
            if ($('#profileImageForm').valid()) {
                document.getElementById('profileImageForm').submit();
            }
        }
    });

    // Password toggle functionality
    document.querySelectorAll('.password-toggle-icon').forEach(function(icon) {
        icon.addEventListener('click', function() {
            var input = this.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            } else {
                input.type = 'password';
                this.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
            }
        });
    });
</script>
@push('script')
<script>
$(function() {
    $('#profileUpdateForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                pattern: /^[A-Za-z\s]+$/
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                pattern: /^\+?[1-9]\d{7,14}$/
            },
            dob: {
                //required: true,
                date: true
            }
        },
        messages: {
            name: {
                required: 'Please enter your name',
                minlength: 'Name must be at least 2 characters',
                pattern: 'Name can contain letters and spaces only'
            },
            email: {
                required: 'Please enter your email address',
                email: 'Please enter a valid email address'
            },
            phone: {
                required: 'Please enter your phone number',
                pattern: 'Please enter a valid phone number'
            },
            dob: {
                //required: 'Please enter your date of birth',
                date: 'Please enter a valid date'
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    $('#changePasswordForm').validate({
        rules: {
            new_password: {
                required: true,
                minlength: 6
            },
            new_password_confirmation: {
                required: true,
                equalTo: '#new_password'
            }
        },
        messages: {
            new_password: {
                required: 'Please enter a new password',
                minlength: 'Password must be at least 6 characters'
            },
            new_password_confirmation: {
                required: 'Please confirm your new password',
                equalTo: 'Passwords do not match'
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });

    $('#addressForm').validate({
        rules: {
            name: { required: true, minlength: 3 },
            contact_no: { required: true },
            emirate: { required: true },
            address_line1: { required: true },
            address_line2: { required: true }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function(element) { $(element).addClass('is-invalid'); },
        unhighlight: function(element) { $(element).removeClass('is-invalid'); }
    });

    $('.edit-address').on('click', function() {
        const address = $(this).data('address');
        const form = $('#addressForm');

        form.attr('action', '{{ url('/profile/address') }}/' + address.id);
        $('#address_id').val(address.id);
        $('#addressFormTitle').text('Edit Address');
        form.find('[name="name"]').val(address.name);
        form.find('[name="contact_no"]').val(address.contact_no);
        form.find('[name="whatsapp_no"]').val(address.whatsapp_no);
        form.find('[name="emirate"]').val(address.emirate);
        form.find('[name="address_line1"]').val(address.address_line1);
        form.find('[name="address_line2"]').val(address.address_line2);
        form.find('[name="landmark"]').val(address.landmark);
        $('#addressFormTitle')[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    $('#profileImageForm').validate({
        rules: {
            profile_image: {
                required: true,
                extension: 'jpg|jpeg|png|webp',
                accept: 'image/*'
            }
        },
        messages: {
            profile_image: {
                required: 'Please select an image',
                extension: 'Only JPG, JPEG, PNG, or WEBP images are allowed',
                accept: 'Please select a valid image'
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback'
    });
});
</script>
@endpush
@include('layouts.frontfooter')