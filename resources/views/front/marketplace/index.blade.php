@extends('front.layouts.app')
@section('title',' Freelancers Marketplace')

@section('section')
<section class="freelance-market-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="markets-banner-content freelance-market-banner-content">
                    <div class="market-badge">
                        {{-- <span>Best job seekers in the world</span> --}}
                        <span>{{$marketplace_page_content->header}}</span>
                    </div>

                    <h1>{{$marketplace_page_content->header_bold}}</h1>
                    <p>{{$marketplace_page_content->header_short_description}}</p>

                    <div class="banner-input">
                        <form action="">
                            <select name="category" id="category">
                                @forelse ($master_categories as $item)
                                    @if($item != '')
                                        <option value="{{$item}}" {{$item == trim(request()->input('category')) ? 'selected' : ''}}>{{ucwords($item)}}</option>
                                    @endif
                                @empty
                                    <option value="">No user have any category!</option>
                                @endforelse    
                            </select>
                            <div class="input">
                                <input type="text" placeholder="What are you looking for?" value="{{request()->input('name')}}" name="name">
                                <button type="submit">
                                    <img src="{{ asset('frontend/img/freelance-search.png')}}" alt="">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <div class="freelance-img">
                    <img src="{{ asset($marketplace_page_content->header_side_image)}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="recommended-writers">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 text-center text-lg-start">
                <div class="recommended-writers-left">
                    <h6>Writers </h6>
                    <span>{{count($writers)}} writer found!</span>
                </div>
            </div>
            {{-- <div class="col-lg-6 col-md-6 col-12 text-center text-lg-end">
                <div class="recommended-writers-right">
                    <a href="{{ route('front.marketplace.index') }}" class="browse-writers">browse all writers</a>
                </div>
            </div> --}}
        </div>

        <div class="row mt-4">
            @forelse ($writers as $data)
                <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4">
                    <div class="recommended-writers-content">
                        <div class="content-top">
                            <img src="{{ asset($data->image)}}" height="60px" width="60px" class="rounded" alt="">
                            <div class="content-top-info">
                                <h4>{{$data->first_name . ' ' . $data->last_name}}</h4>
                                <span>{{$data->occupation}}</span>
                            </div>
                        </div>

                        <div class="content-mid">
                            <ul class="list-unstyled p-0 m-0" id="showLessContent">
                                @for($i=0; $i<count(explode(',',$data->categories)); $i++)
                                    @if($i<2)
                                        @if(explode(',',$data->categories)[$i] != '')
                                            <li>{{explode(',',$data->categories)[$i]}}</li>
                                        @endif
                                    @endif
                                @endfor
                                @if(count(explode(',',$data->categories)) > 2)
                                    <li id="showMore" style="cursor: pointer;">+ {{count(explode(',',$data->categories)) - 2}} more</li>
                                @endif
                            </ul>
                            <ul class="list-unstyled p-0 m-0 d-none" style="flex-flow: wrap;" id="showMoreContent">
                                @for($i=0; $i<count(explode(',',$data->categories)); $i++)
                                    @if(explode(',',$data->categories)[$i] != '')
                                        <li class="my-1">{{explode(',',$data->categories)[$i]}}</li>
                                    @endif
                                @endfor
                            </ul>
                        </div>

                        <div class="line"></div>

                        <div class="content-btm">
                            <a href="{{route('front.portfolio.index', $data->slug)}}">
                                get started now
                                <img src="{{ asset('frontend/img/arrow-right-freelance.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <h3><i class="text-success">Sorry No Such Writer found!</i></h3>
            @endforelse
            <div class="text"></div>
            {{-- <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4">
                <div class="recommended-writers-content">
                    <div class="content-top">
                        <img src="{{ asset('frontend/img/writer2.png')}}" alt="">
                        <div class="content-top-info">
                            <h4>Mindy Johnson</h4>
                            <span>Writer/Novelist
                            </span>
                        </div>
                    </div>

                    <div class="content-mid">
                        <ul class="list-unstyled p-0 m-0">
                            <li>Copywriting</li>
                            <li>Social media</li>
                            <li>+ 10 more</li>
                        </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                        <a href="">
                            get started now
                            <img src="{{ asset('frontend/img/arrow-right-freelance.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4">
                <div class="recommended-writers-content">
                    <div class="content-top">
                        <img src="{{ asset('frontend/img/writer3.png')}}" alt="">
                        <div class="content-top-info">
                            <h4>Kylie Jefferson</h4>
                            <span>Professional Copywriter

                            </span>
                        </div>
                    </div>

                    <div class="content-mid">
                        <ul class="list-unstyled p-0 m-0">
                            <li>Copywriting</li>
                            <li>Social media</li>
                            <li>+ 10 more</li>
                        </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                        <a href="">
                            get started now
                            <img src="{{ asset('frontend/img/arrow-right-freelance.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4">
                <div class="recommended-writers-content">
                    <div class="content-top">
                        <img src="{{ asset('frontend/img/writer4.png')}}" alt="">
                        <div class="content-top-info">
                            <h4>Lindsay Day</h4>
                            <span>Education and curriculum
                                writer


                            </span>
                        </div>
                    </div>

                    <div class="content-mid">
                        <ul class="list-unstyled p-0 m-0">
                            <li>Copywriting</li>
                            <li>Social media</li>
                            <li>+ 10 more</li>
                        </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                        <a href="">
                            get started now
                            <img src="{{ asset('frontend/img/arrow-right-freelance.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4 mb-4">
                <div class="recommended-writers-content">
                    <div class="content-top">
                        <img src="{{ asset('frontend/img/writer5.png')}}" alt="">
                        <div class="content-top-info">
                            <h4>Samuel Powers</h4>
                            <span>Education and curriculum
                                writer



                            </span>
                        </div>
                    </div>

                    <div class="content-mid">
                        <ul class="list-unstyled p-0 m-0">
                            <li>Copywriting</li>
                            <li>Social media</li>
                            <li>+ 10 more</li>
                        </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                        <a href="">
                            get started now
                            <img src="{{ asset('frontend/img/arrow-right-freelance.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-md-4">
                <div class="recommended-writers-content">
                    <div class="content-top">
                        <img src="{{ asset('frontend/img/writer6.png')}}" alt="">
                        <div class="content-top-info">
                            <h4>Ashton Porter</h4>
                            <span>Education and curriculum
                                writer




                            </span>
                        </div>
                    </div>

                    <div class="content-mid">
                        <ul class="list-unstyled p-0 m-0">
                            <li>Copywriting</li>
                            <li>Social media</li>
                            <li>+ 10 more</li>
                        </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                        <a href="">
                            get started now
                            <img src="{{ asset('frontend/img/arrow-right-freelance.png')}}" alt="">
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>


<section class="recommeded-products">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 text-center text-lg-start">
                <div class="recommended-writers-left">
                    <h6>Recommended Writers</h6>
                    <span>{{$recomended_writers->count()}}</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 text-center text-lg-end">
                <div class="recommended-writers-right">
                    {{-- <a href="" class="browse-writers">browse all writers</a> --}}
                </div>
            </div>
        </div>

        <div class="row mt-5">
            @forelse ($recomended_writers as $item)
                <div class="col-lg-4 col-md-4 col-12 mb-lg-4 mb-md-4 mb-4 br">
                    <div class="recommended-products-top">
                        <img src="{{ asset($item->image)}}" alt="">
                        <h6>{{$item->first_name . ' ' . $item->last_name}}</h6>
                    </div>
                    <div class="recommended-products-info">
                        <h4><a href="{{route('front.portfolio.index', $item->slug)}}">{{substr($item->short_desc,0,15)}}...</a></h4>
                        <p>{{$item->categories}}</p>
                    </div>
                    <div class="recommended-products-btm">
                        <div class="recommended-pro-badge">
                            <span>{{$item->duration}}</span>
                        </div>
                        <div class="price">
                            <span> ${{$item->charge}}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center"><h4>No Recomended writers found!</h4></div>
            @endforelse
            {{-- <div class="col-lg-4 col-md-4 col-12 mb-lg-4 mb-md-4 mb-4 br">
                <div class="recommended-products-top">
                    <img src="{{ asset('frontend/img/writer1.png')}}" alt="">
                    <h6>Shana Tanenbaum</h6>
                </div>
                <div class="recommended-products-info">
                    <h4><a href="">Non porttitor massa pulvinar</a></h4>
                    <p>Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.</p>
                </div>
                <div class="recommended-products-btm">
                    <div class="recommended-pro-badge">
                        <span>up to 7 days</span>
                    </div>
                    <div class="price">
                        <span> $3000</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="recommended-products-top">
                    <img src="{{ asset('frontend/img/writer1.png')}}" alt="">
                    <h6>Shana Tanenbaum</h6>
                </div>
                <div class="recommended-products-info">
                    <h4><a href="">Non porttitor massa pulvinar</a></h4>
                    <p>Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.</p>
                </div>
                <div class="recommended-products-btm">
                    <div class="recommended-pro-badge">
                        <span>up to 7 days</span>
                    </div>
                    <div class="price">
                        <span> $3000</span>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="line"></div>

        {{-- <div class="row">
            <div class="col-lg-4 col-md-4 col-12 mb-lg-4 mb-md-4 mb-4 br">
                <div class="recommended-product-img text-center">
                    <img src="{{ asset('frontend/img/research.png')}}" alt="" class="img-fluid">
                </div>
                <div class="recommended-products-top mt-3">
                    <img src="{{ asset('frontend/img/writer1.png')}}" alt="">
                    <h6>Shana Tanenbaum</h6>
                </div>
                <div class="recommended-products-info">
                    <h4><a href="">Non porttitor massa pulvinar</a></h4>
                    <p>Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.</p>
                </div>
                <div class="recommended-products-btm">
                    <div class="recommended-pro-badge">
                        <span>up to 7 days</span>
                    </div>
                    <div class="price">
                        <span> $3000</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12 mb-lg-4 mb-md-4 mb-4 br">
                <div class="recommended-product-img text-center">
                    <img src="{{ asset('frontend/img/research2.png')}}" alt="" class="img-fluid">
                </div>
                <div class="recommended-products-top mt-3">
                    <img src="{{ asset('frontend/img/writer1.png')}}" alt="">
                    <h6>Shana Tanenbaum</h6>
                </div>
                <div class="recommended-products-info">
                    <h4><a href="">Non porttitor massa pulvinar</a></h4>
                    <p>Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.</p>
                </div>
                <div class="recommended-products-btm">
                    <div class="recommended-pro-badge">
                        <span>up to 7 days</span>
                    </div>
                    <div class="price">
                        <span> $3000</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="recommended-product-img text-center">
                    <img src="{{ asset('frontend/img/research3.png')}}" alt="" class="img-fluid">
                </div>
                <div class="recommended-products-top mt-3">
                    <img src="{{ asset('frontend/img/writer1.png')}}" alt="">
                    <h6>Shana Tanenbaum</h6>
                </div>
                <div class="recommended-products-info">
                    <h4><a href="">Non porttitor massa pulvinar</a></h4>
                    <p>Pellentesque ullamcorper lectus non orci fermentum, tempus dapibus magna fermentum.</p>
                </div>
                <div class="recommended-products-btm">
                    <div class="recommended-pro-badge">
                        <span>up to 7 days</span>
                    </div>
                    <div class="price">
                        <span> $3000</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>


<section class="faq-sec freelancer-faq">
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
                        @foreach ($marketplacefaq as $key => $item)
                            <li class="faq-tab {{$key == 0 ? 'active' : ''}}" data-tab="data_tab{{$item->header_id}}">{{$item->header}}  
                                <div class="fac-tab-check">
                                    <img src="{{ asset('frontend/img/check-normal.png')}}" alt="">
                                </div>
                            </li>
                        @endforeach
                        {{-- <li class="faq-tab " data-tab="payments">Payments <div class="fac-tab-check">
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
                @foreach ($marketplacefaq as $key => $item)
                    <div class="faq-content {{$key == 0 ? 'active' : ''}}" id="data_tab{{$item->header_id}}">
                        <div class="faq-content-badge">
                            <span>{{$item->header}}</span>
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach (App\Models\MarketPlaceFaq::where('header_id',$item->header_id)->get() as $i => $mfaq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsible{{$i}}" aria-expanded="false" aria-controls="collapsible{{$i}}">
                                            {{ $mfaq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapsible{{$i}}" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>{!! $mfaq->answer ?? '' !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="accordion-item">
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
                            </div> --}}
                        </div>
                    </div>
                @endforeach
                {{-- <div class="faq-content" id="payments">
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
                                    data-bs-target="#collapseSeven" aria-expanded="false"
                                    aria-controls="collapseSeven">
                                    Which features can I use during the trial?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
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
                                    data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
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
                                    data-bs-target="#collapseEleven" aria-expanded="false"
                                    aria-controls="collapseEleven">
                                    How does the 7-day free trial work?
                                </button>
                            </h2>
                            <div id="collapseEleven" class="accordion-collapse collapse"
                                aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
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
                                    data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                    Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13"
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
                            <h2 class="accordion-header" id="heading14">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
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
                                    data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
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
                                    data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                                    Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18"
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
                            <h2 class="accordion-header" id="heading19">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse19" aria-expanded="false" aria-controls="collapse19">
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
                                    data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
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
                                    data-bs-target="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                    Lorem ipsum dolor sit amet consectetur adipisicing?
                                </button>
                            </h2>
                            <div id="collapse23" class="accordion-collapse collapse" aria-labelledby="heading23"
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
                            <h2 class="accordion-header" id="heading24">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse24" aria-expanded="false" aria-controls="collapse24">
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
                                    data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
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
    $('#showMore').click(function(){
        $('#showMoreContent').removeClass('d-none');
        $('#showLessContent').addClass('d-none');
    })
</script>
@endsection