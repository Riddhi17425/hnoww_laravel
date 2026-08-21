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
                                <img src="{{ asset('public/images/front/user-placeholder.png') }}" alt="Profile" class="profile_img" id="profileImagePreview" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=D0C2AA&color=fff';">
                                <label for="profile_upload" class="edit_icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                </label>
                                <input type="file" id="profile_upload" class="d-none" accept="image/*">
                            </div>
                            <h4 class="mt-3" style="font-family: 'Playfair Display', serif; color: #0e2233;">{{$user->name ?? 'John Doe'}}</h4>
                            <p class="text-muted" style="font-family: 'Inter', sans-serif; font-size: 14px;">{{$user->email ?? 'johndoe@example.com'}}</p>
                        </div>
                        
                        <div class="nav flex-column nav-pills profile_tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Personal Info
                            </button>
                            <button class="nav-link" id="v-pills-orders-tab" data-bs-toggle="pill" data-bs-target="#v-pills-orders" type="button" role="tab" aria-controls="v-pills-orders" aria-selected="false" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                My Orders
                            </button>
                            <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false" style="display: flex; align-items: center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2" style="margin-right: 8px;">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                Change Password
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
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ct_input">
                                                <label for="name" class="sub_head">Name</label>
                                                <input type="text" name="name" id="name" pattern="^[A-Za-z\s]+$" value="{{$user->name ?? ''}}" title="Please use only letters" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ct_input">
                                                <label for="email" class="sub_head">Email Address</label>
                                                <input type="email" name="email" id="email" value="{{$user->email ?? ''}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ct_input">
                                                <label for="phone" class="sub_head">Phone Number</label>
                                                <input type="tel" name="phone" id="phone" value="{{$user->phone ?? ''}}" pattern="^\+?[1-9]\d{1,14}$" title="Please enter a valid phone number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ct_input">
                                                <label for="dob" class="sub_head">Date of Birth</label>
                                                <input type="date" name="dob" id="dob" value="{{$user->dob ?? ''}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-4">
                                        <button class="com_btn" type="submit">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                            <div class="ct_form">
                                <h3 class="tab_title mb-4">Change Password</h3>
                                <form>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="ct_input">
                                                <label for="current_password" class="sub_head mb-2 d-block">Current Password</label>
                                                <div class="password-wrapper">
                                                    <input type="password" name="current_password" id="current_password" class="custom-input" required>
                                                    <span class="password-toggle-icon">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <input type="password" name="confirm_password" id="confirm_password" class="custom-input" required>
                                                    <span class="password-toggle-icon">
                                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end mt-4">
                                        <button class="com_btn" type="submit">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Orders List -->
                        <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                            <h3 class="tab_title mb-4">My Orders</h3>
                            <div class="orders_list">
                                <!-- Dummy Order Item 1 -->
                                <div class="order_card mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="order_id">Order #ORD-20260821</h5>
                                        <span class="badge bg-success" style="font-weight: 400; padding: 6px 12px; border-radius: 4px;">Delivered</span>
                                    </div>
                                    <p class="mb-1 text-muted" style="font-size: 14px;">Placed on: Aug 21, 2026</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <p class="order_total fw-bold mb-0" style="color: #0e2233; font-size: 16px;">Total: AED 450.00</p>
                                        <button class="btn btn-sm btn-outline-dark">View Details</button>
                                    </div>
                                </div>
                                <!-- Dummy Order Item 2 -->
                                <div class="order_card mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="order_id">Order #ORD-20260715</h5>
                                        <span class="badge bg-primary" style="font-weight: 400; padding: 6px 12px; border-radius: 4px; background-color: #B58A46 !important;">Processing</span>
                                    </div>
                                    <p class="mb-1 text-muted" style="font-size: 14px;">Placed on: Jul 15, 2026</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <p class="order_total fw-bold mb-0" style="color: #0e2233; font-size: 16px;">Total: AED 1,200.00</p>
                                        <button class="btn btn-sm btn-outline-dark">View Details</button>
                                    </div>
                                </div>
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
@include('layouts.frontfooter')