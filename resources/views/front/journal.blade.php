@include('layouts.frontheader')
@php
use Carbon\Carbon;
$currentMonthNumber = Carbon::now()->month;
$monthMap = [
'January' => 1,
'February' => 2,
'March' => 3,
'April' => 4,
'May' => 5,
'June' => 6,
'July' => 7,
'August' => 8,
'September' => 9,
'October' => 10,
'November' => 11,
'December' => 12,
];
@endphp
<!-- hero section -->
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/journal-banner.png')}}" alt="journal banner">

    <div class="hero_content_inner">
        <h2 class="main_head mb-3">The Art of Hosting</h2>
        <p class="para mb-0">Hospitality is rarely about perfection. It is about the specific vibrations of a room when people feel one with the surroundings. It is the weight of a fork, the scent of unlit wax, and the way light catches the rim of a glass.</p>
    </div>
</section>
<section class="mt_60">
    <div class="container">
        <div class="month_box_main">
            @if(isset($journal) && is_countable($journal) && count($journal) > 0)
            {{-- @foreach($journal as $key => $val)
                    <div class="month_box">
                        <h5 class="sub_head_inter">{{ $val->month_name ?? '' }}</h5>
            <p>{{ $val->title ?? '' }}</p>
            <img src="{{asset('public/images/admin/journal/thumbnail_images/'. $val->thumbnail_img)}}" alt="January">
            @if(date('F') === $val->month_name)
            <a href="#">
                <svg class="green_svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 1L1 19M19 1H5.15385M19 1V14.8462" stroke="#0D5E4C" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
            @else
            <span>
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.6667 18.3335V11.6666C11.6667 7.06428 15.3976 3.33331 20 3.33331C24.6023 3.33331 28.3333 7.06428 28.3333 11.6666V18.3335M8.33333 36.6668H31.6667C33.5077 36.6668 35 35.1743 35 33.3335V21.6668C35 19.8258 33.5077 18.3335 31.6667 18.3335H8.33333C6.49238 18.3335 5 19.8258 5 21.6668V33.3335C5 35.1743 6.49238 36.6668 8.33333 36.6668Z"
                        stroke="#C8B58D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            @endif
        </div>
        @endforeach --}}

        @foreach($journal as $key => $val)
        @php
        $journalMonthNumber = \Carbon\Carbon::createFromFormat('F', trim($val->month_name))->month;
        $monthName = trim($val->month_name);
        $journalMonthNumber = $monthMap[$monthName] ?? 0;
        @endphp
        <div class="month_box">
            <h5 class="sub_head_inter">{{ $val->month_name }}</h5>
            <p>{{ $val->title }}</p>
            <img src="{{ asset('public/images/admin/journal/thumbnail_images/'.$val->thumbnail_img) }}">
            @if($journalMonthNumber <= $currentMonthNumber) <a href="#month-{{ $journalMonthNumber }}">
                <svg class="green_svg" width="20" height="20" viewBox="0 0 20 20">
                    <path d="M19 1L1 19M19 1H5.15385M19 1V14.8462" stroke="#0D5E4C" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </a>
                @else
                <span>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.6667 18.3335V11.6666C11.6667 7.06428 15.3976 3.33331 20 3.33331C24.6023 3.33331 28.3333 7.06428 28.3333 11.6666V18.3335M8.33333 36.6668H31.6667C33.5077 36.6668 35 35.1743 35 33.3335V21.6668C35 19.8258 33.5077 18.3335 31.6667 18.3335H8.33333C6.49238 18.3335 5 19.8258 5 21.6668V33.3335C5 35.1743 6.49238 36.6668 8.33333 36.6668Z"
                            stroke="#C8B58D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                @endif
        </div>
        @endforeach
        @endif
    </div>
    </div>
</section>

<section class="mt_80 mb_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>the</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">2026 Editions</h2>
            <p>Publishing Schedule</p>
        </div>

        <div class="row g-4 g-xxl-5">
            @if(isset($journal) && is_countable($journal) && count($journal) > 0)
            {{-- @foreach($journal as $key => $val)
                    <div class="col-md-6">
                        <div class="row gy-3 gy-md-0">
                            <div class="col-md-6">
                                <div class="montheditions_lt">
                                    <img class="img-fluid" src="{{asset('public/images/admin/journal/detail_images/'. $val->detail_img)}}"
            alt="{{ $val->month_name ?? 'month image'}}">
            <a href="#" class="com_btn">
                <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="4" cy="4" r="4" fill="white" />
                </svg>
                <span class="ms-2">{{$val->month_name ?? ''}}</span></a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="montheditions_rt">
            <h3 class="sub_head mb-md-3">{{$val->title ?? ''}}</h3>
            {!! $val->description ?? ''!!}
        </div>
    </div>
    </div>
    </div>
    @endforeach --}}
    @foreach($journal as $val)
    @php
    $journalMonthNumber = Carbon::parse($val->month_name)->month;
    $journalMonthNumber = \Carbon\Carbon::createFromFormat('F', trim($val->month_name))->month;
    $monthName = trim($val->month_name);
    $journalMonthNumber = $monthMap[$monthName] ?? 0;
    @endphp

    @if($journalMonthNumber <= $currentMonthNumber) <div class="col-md-6" id="month-{{ $journalMonthNumber }}">
        <div class="row gy-3 gy-md-0">
            <div class="col-md-6">
                <div class="montheditions_lt">
                    <img class="img-fluid"
                        src="{{ asset('public/images/admin/journal/detail_images/'.$val->detail_img) }}">

                    <a href="#" class="com_btn">
                        <span class="ms-2">{{ $val->month_name }}</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                                <div class="montheditions_rt">
                                    <h3 class="sub_head mb-md-3">{{ $val->title }}</h3>
            @if(isset($val->feature_title))<p class="montheditions_para">Feature: {{$val->feature_title}}</p>@endif
            @if(isset($val->feature_description))<p>{{$val->feature_description ?? '' }}</p>@endif

            <div class="content-wrap">
                <h3 class="sub_head mt-md-4 mb-md-3">The Practice:</h3>
                <!--<p class="montheditions_para">Teach readers to curate a reflective moment � candles, scent, a silver bowl, a note of intention.</p>
                                        <p class="sub_head_inter mb-0">Ritual as self-care through design..</p> -->
                {!! $val->description !!}
            </div>
            <a href="javascript:void(0)" class="read-more-btn">Read More</a>

        </div>
        </div> 
       

        </div>
        </div>
        @endif
        @endforeach

        @endif
        </div>
        </div>
        </div>
</section>

@include('layouts.frontfooter')