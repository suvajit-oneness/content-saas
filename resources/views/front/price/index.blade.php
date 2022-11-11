@extends('front.layouts.app')
@section('title',' Plans & Pricing')
@section('section')

<section class="pricing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-10 m-auto">
                <div class="pricing-banner-content">
                    <h2>{!!$plan_page->header_top!!}</h2>
                    <p>{!!$plan_page->header_bottom!!}</p>
                    <div class="pricing-pay">
                        <small>I want to pay every month
                            in
                        </small>
                        <form class="select" action="">
                            <select id="currency_select" name="currency">
                                @foreach ($currencies as $item)
                                    <option value="{{$item->id}}" {{request()->input('currency') == $item->id ? 'selected' : ''}}>{{$item->currency_symbol}}({{$item->currency}})</option>    
                                @endforeach
                                {{-- <option value="">$ (USD)</option>
                                <option value="">£ (GBP)</option>
                                <option value="">AU$ (AUD)</option>
                                <option value="">€ (EUR)</option> --}}
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pricing-card-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 m-auto">
                <div class="row">
                    {{-- <div class="col-lg-6 col-md-6 mb-5">
                        <div class="pricing-content">
                            <img src="{{ asset('frontend/img/heart.png')}}" alt="">
                            <h4>Free</h4>
                            <p>Perfect plan for Starters</p>
                            <a href="" class="button">Start Free Today</a>
                            <div class="limited-access">
                                <span>$0</span> / <small>for limited access</small>
                            </div>

                            <ul class="offers p-0 m-0 mt-4">
                                <li>
                                    <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                    All limited links
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                    Aliquam facilisis neque in lorem
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                    Vivamus at sem sit amet ante
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                    Donec vulputate sapien ac cursus
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                    Curabitur vel nulla vehicula
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                    Proin bibendum justo ac mattis
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    @forelse ($plans_with_price as $item)
                        <div class="col-lg-6 col-md-6">
                            <div class="pricing-content {{$item->planDet->recomended == 1 ? 'pricing-content-prem' : ''}}">
                                @if($item->planDet->recomended == 1)
                                    <div class="premium-heading">
                                        <h6>Recommended</h6>
                                    </div>
                                @endif
                                <img src="{{ asset($item->planDet->icon)}}" alt="">
                                <h4>{{$item->planDet->name}}</h4>
                                <p>{{$item->planDet->description}}</p>
                                <a href="javascript:void(0)" class="button">{{$item->planDet->button_text}}</a>
                                <div class="limited-access">
                                    <span>{{$item->currencyDet->currency_symbol . $item->price}}</span> / <small>{{$item->price_limit}}</small>
                                </div>

                                <ul class="offers p-0 m-0 mt-4">
                                    @foreach (explode(',',$item->planDet->benifits) as $b)
                                    <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        {{$b}}
                                    </li>
                                    @endforeach
                                    {{-- <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        All limited links
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        Aliquam facilisis neque in lorem
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        Vivamus at sem sit amet ante
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        Donec vulputate sapien ac cursus
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        Curabitur vel nulla vehicula
                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend/img/check.png')}}" alt="">
                                        Proin bibendum justo ac mattis
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-6 col-md-6 container">
                            <h5 class="text-center my-2">Sorry no plans found!</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-10 col-md-10 m-auto">
                <div class="payments-content">
                    <a href=""><img src="{{ asset($plan_page->middle_section_content_image)}}" alt="payments" class="img-fluid"></a>
                    <p class="">{!!$plan_page->middle_section_content_description!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faq-sec">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center faq-sec-heading">
                <h2>Frequently Asked Questions</h2>
                <p>Find answers to commonly asked questions about Hiver. If your question
                    doesn't figure here, reach out to us at support@copywriting.com</p>
            </div>
        </div>

        <div class="row faq-sec-margin-top">
            <div class="col-lg-3 col-md-3 mb-4 mb-md-0">
                <div class="faq-tabs">
                    <ul class="p-0 m-0">
                        @foreach ($plan_page_faq as $key => $item)
                            <li class="faq-tab {{$key == 0 ? 'active' : ''}}" data-tab="data_tab{{$item->header_id}}">{{$item->header}}  
                                <div class="fac-tab-check">
                                    <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                                </div>
                            </li>
                        @endforeach
                        {{-- <li class="faq-tab active" data-tab="free-trial">free trial <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " data-tab="payments">Payments <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " data-tab="privacy">Privacy <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " data-tab="subscriptions">Subscriptions <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " data-tab="general">General <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>

            <div class="col-md-9">

                @foreach ($plan_page_faq as $key => $item)
                    <div class="faq-content {{$key == 0 ? 'active' : ''}}" id="data_tab{{$item->header_id}}">
                        <div class="faq-content-badge">
                            <span>{{$item->header}}</span>
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach (App\Models\PlansPriceFaq::where('header_id',$item->header_id)->get() as $i => $pfaq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsible{{$i}}" aria-expanded="false" aria-controls="collapsible{{$i}}">
                                            {{ $pfaq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapsible{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>{!! $pfaq->answer ?? '' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                {{-- <div class="faq-content active" id="free-trial">
                    <div class="faq-content-badge">
                        <span>Free Trial</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-content" id="payments">
                    <div class="faq-content-badge">
                        <span>Payments</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false"
                                    aria-controls="collapseEight">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNine" aria-expanded="false"
                                    aria-controls="collapseNine">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTen" aria-expanded="false"
                                    aria-controls="collapseTen">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-content" id="privacy">
                    <div class="faq-content-badge">
                        <span>Privacy</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEleven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading12">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading13">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse13" aria-expanded="false"
                                    aria-controls="collapse13">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse13" class="accordion-collapse collapse"
                                aria-labelledby="heading13" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading14">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse14" aria-expanded="false"
                                    aria-controls="collapse14">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading15">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse15" aria-expanded="false"
                                    aria-controls="collapse15">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-content" id="subscriptions">
                    <div class="faq-content-badge">
                        <span>Subscriptions</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading16">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading17">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading18">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse18" aria-expanded="false"
                                    aria-controls="collapse18">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse18" class="accordion-collapse collapse"
                                aria-labelledby="heading18" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading19">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse19" aria-expanded="false"
                                    aria-controls="collapse19">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading19"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading20">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse20" aria-expanded="false"
                                    aria-controls="collapse20">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-content" id="general">
                    <div class="faq-content-badge">
                        <span>General</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading21">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading22">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapse22" class="accordion-collapse collapse" aria-labelledby="heading22"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading23">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse23" aria-expanded="false"
                                    aria-controls="collapse23">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse23" class="accordion-collapse collapse"
                                aria-labelledby="heading23" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading24">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse24" aria-expanded="false"
                                    aria-controls="collapse24">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapse24" class="accordion-collapse collapse" aria-labelledby="heading24"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading20">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse20" aria-expanded="false"
                                    aria-controls="collapse20">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $('#currency_select').on('change',function(){
            $('.select').submit();
        });
    </script>
@endsection
