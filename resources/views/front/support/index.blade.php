@extends('front.layouts.app')
@section('title',' Support')
@section('section')
<section class="support-banner">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-10 m-auto">
                <div class="support-banner-content">
                    <h2>{{ $support[0]->title }}</h2>
                    <p>{!! $support[0]->description !!}</p>
                    <form action="{{ route('front.support.index') }}">
                        <input type="text" name="keyword" placeholder="Type your question here">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="support-getting-started">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 col-md-10 m-auto text-center">
                <h2>{{ $support[0]->widget_title }}</h2>
                <p>{!! $support[0]->widget_description !!}</p>
            </div>
        </div>

        <div class="row mt-4 g-3">
            @foreach($supportWidget as $key => $data)
            <div class="col-12 col-md-6">
                <div class="support-getting-started-content">
                    <div class="img">
                        <img src="{{ asset($data->image)}}" alt="">
                    </div>
                    <div class="info">
                        <h4>{{ $data->title }}</h4>
                        <p>{!! $data->description !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
            {{--  <div class="col-12 col-md-6">
                <div class="support-getting-started-content">
                    <div class="img">
                        <img src="{{ asset('frontend/img/settings.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h4>Lorem ipsum dolor sit amet.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic distinctio ratione vel, quos provident</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="support-getting-started-content">
                    <div class="img">
                        <img src="{{ asset('frontend/img/controls.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h4>Lorem ipsum dolor sit amet.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic distinctio ratione vel, quos provident</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="support-getting-started-content">
                    <div class="img">
                        <img src="{{ asset('frontend/img/laptop.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h4>Lorem ipsum dolor sit amet.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic distinctio ratione vel, quos provident</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="support-getting-started-content">
                    <div class="img">
                        <img src="{{ asset('frontend/img/files.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h4>Lorem ipsum dolor sit amet.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic distinctio ratione vel, quos provident</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="support-getting-started-content">
                    <div class="img">
                        <img src="{{ asset('frontend/img/files.png')}}" alt="">
                    </div>
                    <div class="info">
                        <h4>Lorem ipsum dolor sit amet.</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic distinctio ratione vel, quos provident</p>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</section>
<section class="faq-sec support-faq">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center faq-sec-heading">
                <h2>{{ $support[0]->faq_title }}</h2>
                <p>{!! $support[0]->faq_description !!}</p>
            </div>
        </div>
        <div class="row faq-sec-margin-top">
            <div class="col-lg-3 col-md-3 mb-4 mb-md-0">
                <div class="faq-tabs">
                    <ul class="p-0 m-0">
                        @foreach($faqCat as $key=> $data)
                        <li class="faq-tab active" support-tab="{{ $data->id }}">{{ $data->title }} <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        @endforeach
                        {{-- <li class="faq-tab " support-tab="payments">Payments <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " support-tab="privacy">Privacy <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " support-tab="subscriptions">Subscriptions <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li>
                        <li class="faq-tab " support-tab="general">General <div class="fac-tab-check">
                                <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                @foreach($faqCat as $key=> $data)
                <div class="faq-content active" id="{{ $data->id }}">
                    <div class="faq-content-badge">
                        <span>{{ $data->title }}</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        @foreach($data->faqDetails as $faqProductkey => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $item->id }}">
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                   {!! $item->question !!}
                                </button>
                            </h2>
                            <div id="collapse{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $item->id }}"
                                support-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{!! $item->answer !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{--  <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                support-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>--}}

                    </div>
                </div>
                @endforeach
                {{--  <div class="faq-content" id="payments">
                    <div class="faq-content-badge">
                        <span>Payments</span>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseEight" aria-expanded="false"
                                    aria-controls="collapseEight">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseNine" aria-expanded="false"
                                    aria-controls="collapseNine">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseTen" aria-expanded="false"
                                    aria-controls="collapseTen">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse13" aria-expanded="false"
                                    aria-controls="collapse13">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse13" class="accordion-collapse collapse"
                                aria-labelledby="heading13" support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse14" aria-expanded="false"
                                    aria-controls="collapse14">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse15" aria-expanded="false"
                                    aria-controls="collapse15">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse18" aria-expanded="false"
                                    aria-controls="collapse18">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse18" class="accordion-collapse collapse"
                                aria-labelledby="heading18" support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse19" aria-expanded="false"
                                    aria-controls="collapse19">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading19"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse20" aria-expanded="false"
                                    aria-controls="collapse20">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapse22" class="accordion-collapse collapse" aria-labelledby="heading22"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse23" aria-expanded="false"
                                    aria-controls="collapse23">
                                   Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse23" class="accordion-collapse collapse"
                                aria-labelledby="heading23" support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse24" aria-expanded="false"
                                    aria-controls="collapse24">
                                    Do I need a credit card to sign up?
                                </button>
                            </h2>
                            <div id="collapse24" class="accordion-collapse collapse" aria-labelledby="heading24"
                                support-bs-parent="#accordionExample">
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
                                <button class="accordion-button collapsed" type="button" support-bs-toggle="collapse"
                                    support-bs-target="#collapse20" aria-expanded="false"
                                    aria-controls="collapse20">
                                    How do I import my existing emails
                                    to my Hiver shared inbox?
                                </button>
                            </h2>
                            <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20"
                                support-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis unde,
                                        illo saepe ipsam dignissimos architecto quia non voluptate corrupti ut,
                                        quidem tempore, reiciendis molestias iste veritatis necessitatibus corporis
                                        est nam.</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
