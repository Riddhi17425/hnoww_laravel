@include('layouts.frontheader')

<section class="hero-section_inner">
    <img class="img-fluid" src="{{ asset('public/images/front/frequently-asked-banner.webp')}}" alt="him banner">
    <div class="hero_content_inner">
        <h2 class="main_head mb-3">Questions…Answered With Care And Clarity
</h2>
        <p class="para sec_in_mb">Everything you need to know about our objects, ordering pathways, and processes, guided with clarity, discretion, and care.
</p>
    </div>
</section>

@if(isset($faq) && is_countable($faq) && count($faq) > 0)
<section class="mt_60 mb_120">
    <div class="container">
        <div class="modern-tabs faq_cont">
            <ul class="nav nav-tabs" id="filledTabs" role="tablist">
                @foreach($faq as $key => $val)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == 0) active @endif" id="tab-{{ $key }}" data-bs-toggle="tab"
                        data-bs-target="#tab-content-{{ $key }}" type="button" role="tab"
                        aria-controls="tab-content-{{ $key }}" aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                        {{ $val->name ?? '-' }}
                    </button>
                </li>
                @endforeach
            </ul>

            <div class="tab-content border-0" id="filledTabsContent">
                @foreach($faq as $key => $val)
                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab-content-{{ $key }}" role="tabpanel"
                    aria-labelledby="tab-{{ $key }}">

                    <div class="accordion" id="accordion-{{ $key }}">
                        @foreach($val->faqs as $fkey => $fval)
                        <div class="faq_cont_acco">
                            <h2 class="according_head sub_head" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $key }}-{{ $fkey }}" aria-expanded="false"
                                aria-controls="collapse-{{ $key }}-{{ $fkey }}">
                                {{ $fval->question ?? '-' }}
                            </h2>
                            <div id="collapse-{{ $key }}-{{ $fkey }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordion-{{ $key }}">
                                <div class="accordion-body">
                                    {!! $fval->answer ?? '-' !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif


@include('layouts.frontfooter')