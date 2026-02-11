@include('layouts.frontheader')
<style>
.theme-green .header-scrolled {
    background: #EDEAE4;
}

.theme-green .language-select .dropdown-input-lan {
    color: #0e2233;
}
.status_pill {
    display: inline-block;
    width: fit-content;
    padding: 5px 10px;
    background-color: #0d5e4c;
    border-radius: 20px;
    color: white;
    font-size: 14px;
}
.status_green{background-color: #0d5e4c;}
.status_red{background-color: #C3181E;}
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
                <span>Your Orders</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">My Orders</h2>
        </div>

        <div class="shopping-cart">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery" style="--bs-table-bg:--bs-table-bg;">
                        <thead>
                            <tr class="main-hading">
                                <th>ORDER NO.</th>
                                <th>TOTAL AMOUNT</th>
                                <th>ORDER STATUS</th>
                                <th>PAYMENT STATUS</th>
                                <th>ORDER VIEW</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($orderData) && is_countable($orderData) && count($orderData) > 0)
                            @foreach($orderData as $key => $val)
                            <tr>
                                <td>#{{$val->order_number ?? $val->id}}</td>
                                <td>{{$val->order_total ?? '-'}}</td>
                                <td><span class="status_pill status_green">{{strtoupper($val->status) ?? '-'}}</span></td>
                                <td><span class="status_pill status_red">{{strtoupper($val->payment_status) ?? '-'}}</span></td>
                                <td>
                                    <a class="view_btn" href="{{route('front.order_detail.view', $val->id)}}"> 
                                        <svg class="eye-open" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M1 12C1 12 5 20 12 20C19 20 23 12 23 12" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.frontfooter')