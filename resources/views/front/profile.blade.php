@include('layouts.frontheader')
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

        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Your Profile</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Personal Info</h2>
        </div>
        <div class="profile_wrapper mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ct_form">
                        <form>
                            <div class="ct_input">
                                <label for="name" class="sub_head">Name </label>
                                <input type="text" name="name" id="name" readonly pattern="^[A-Za-z\s]+$" value="{{$user->name ?? ''}}" title="Please use only letters" required>
                            </div>
                            <div class="ct_input">
                                <label for="email" class="sub_head">Email Address</label>
                                <input type="email" name="email" id="email" readonly value="{{$user->email ?? ''}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="ct_input">
                                <label for="phone" class="sub_head">Phone Number</label>
                                <input type="tel" name="phone" id="phone" readonly value="{{$user->phone ?? ''}}" pattern="^\+?[1-9]\d{1,14}$" title="Please enter a valid phone number" required>
                            </div>
                            <!--<div class="text-center">-->
                            <!--    <button class="com_btn bg-transparent" type="submit">Save</button>-->
                            <!--</div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')