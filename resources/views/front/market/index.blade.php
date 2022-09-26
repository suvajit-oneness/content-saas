@extends('front.layouts.app')
@section('title',' Markets')
@section('section')

@foreach($market as $key => $data)
<section class="markets-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="markets-banner-content">
                    <div class="market-badge">
                        <span>{{ $data->tag }}</span>
                    </div>
                    <h1>{{$data->title}}</h1>
                    <p>{!! $data->short_description !!}</p>
                    <a href="{{$data->market_btn_link}}" class="button text-white">{{$data->market_btn}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@foreach($market as $key => $data)
<section class="market-info-sec1">
    <div class="container">
        <div class="row">
            <div class="col-lg-11 m-auto text-center">
                <h2>{!! $data->short_content_heading !!}</h2>
                <p>{!! $data->short_content !!}</p>
                <a href="{{$data->short_content_btn_link}}" class="button">{{$data->short_content_btn}}</a>
            </div>
        </div>
    </div>
</section>
@endforeach
@foreach($market as $key => $data)
<section class="writing-career-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 mb-2">
                <div class="writing-career-content">
                    <h4>{!! $data->sticky_content_heading !!}
                    </h4>
                    <p>{!! $data->sticky_content !!}</p>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 text-center text-md-end">
                <a href="{{$data->sticky_content_btn_link}}" class="button hover-white">{{$data->sticky_content_btn}}</a>
            </div>
        </div>
    </div>
</section>
@endforeach
@foreach($market as $key => $data)
<section class="market-info-sec1 market-info-sec2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto text-center">
                <h2>{!! $data->medium_content_heading !!}</h2>
                <p>{!! $data->medium_content !!}</p>

                <ul class="p-0 m-0 mt-2 mt-md-5">
                    @foreach($cat as $key => $categoryValue)
                    <li class="market-tab active" data-tab-market="{{ $categoryValue->id }}">
                        <a href="#{{ $categoryValue->id }}"><img src="{{URL::to('/').'/uploads/marketcategories/'}}{{$categoryValue->image}}" alt="">
                            <span>{{ $categoryValue->title}}</span></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endforeach
<section class="market-content">
    @foreach($cat as $key => $categoryValue)
    <div class="row g-0 active" id="{{ $categoryValue->id }}">
        <div class="col-lg-6 col-md-6 col-12 mb-4">
            <div class="market-content-inner">
                <img src="{{URL::to('/').'/uploads/marketcategories/'}}{{$categoryValue->category_description_image}}" alt="" class="img-fluid">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="market-content-inner market-content-inner-info">
                <h2>{{ $categoryValue->category_description_heading}}</h2>
                <div class="para">
                    <p>{!! $categoryValue->category_description !!}</p>
                </div>
                <a href="{{ $categoryValue->category_description_btn_link}}" class="button">{{ $categoryValue->category_description_btn }}</a>
            </div>
        </div>
    </div>
    @endforeach
</section>
@foreach($banner as $key => $data)
<section class="market-content-audience">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <h2>{!! $data->content_heading !!}</h2>
                <div class="para">
                    <p>{!! $data->content !!}</p>

                </div>
                <a href="{{ $data->content_btn_link }}" class="button">{{ $data->content_btn }}</a>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <img src="{{URL::to('/').'/uploads/marketbanner/'}}{{$data->image}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</section>
@endforeach

<section class="market-content-info market-content-audience">
    <div class="container">
        <div class="row align-items-center">


            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <img src="{{ asset('frontend/img/market-content-info-img.png')}}" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <h2>Curabitur <span>purus veu</span> fermentum interdum</h2>
                <div class="para">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form, by humour. There are many variations of passages of Lorem
                        available.</p>
                    <p>Curabitur convallis mi eget placerat hendrerit. Morbi auctor ornare nulla. Suspendisse a eros
                        lorem. Duis sed risus ac nunc iaculis convallis eu sed magna. Curabitur in mi dolor. Nam
                        semper enim sit amet velit pulvinar venenatis. Mauris semper id quam vel euismod.</p>
                </div>
                <a href="javascript:void(0);" class="button">Learn More</a>
            </div>
        </div>
    </div>
</section>


<section class="market-content-info2 market-content-audience">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <h2>Content <span>Reaches your</span> audience’s audience.</h2>
                <div class="para">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form, by humour. There are many variations of passages of Lorem
                        available.</p>
                    <p>Curabitur convallis mi eget placerat hendrerit. Morbi auctor ornare nulla. Suspendisse a eros
                        lorem. Duis sed risus ac nunc iaculis convallis eu sed magna. Curabitur in mi dolor. Nam
                        semper enim sit amet velit pulvinar venenatis. Mauris semper id quam vel euismod.</p>
                </div>
                <a href="javascript:void(0);" class="button">Learn More</a>
            </div>
            <div class="col-lg-6 col-md-6 ">
                <img src="{{ asset('frontend/img/market-content-info-img2.png')}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</section>

@foreach($market as $key => $data)
<section class="market-faq-sec">
    <div class="container">

        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="market-faq-info">
                    <h2>{{$data->faq_heading}}</h2>
                    <p>{!! $data->faq_short !!}</p>

                    <div class="faq-content active">

                        <div class="accordion" id="accordionExample">
                            @foreach($faq as $key => $data)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $data->id }}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $data->id }}"
                                        aria-expanded="false" aria-controls="collapse{{ $data->id }}">
                                        {{ $data->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $data->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{$data->answer}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 text-center m-auto">
                <div class="market-faq-img">
                    <img src="{{URL::to('/').'/uploads/market/'}}{{$data->faq_banner_image}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@foreach($market as $key => $data)
<section class="market-research-sec">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 col-md-10 text-center m-auto">
                <h2>{{$data->blog_heading}}</h2>
            </div>
        </div>

        <div class="row mt-4 mt-md-5">
            <div class="col-12 col-lg-4 col-md-12 mb-4">
                <div class="market-research-content">
                    <div class="img">
                        <a href="" class="research-link"><img src="{{ asset('frontend/img/research.png')}}" alt=""></a>
                    </div>
                    <div class="market-research-date">
                        <div class="market-research-badge">
                            <span>Market Research</span>
                        </div>
                        <h6>14 JAN, 2022</h6>
                    </div>

                    <div class="marker-research-info">
                        <a href="" class="research-link">Sed semper neque eget urna iaculis
                            tristique.</a>
                        <p>Pellentesque ullamcorper lectus non orci fermentum,
                            tempus dapibus magna fermentum.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-12 mb-4">
                <div class="market-research-content">
                    <div class="img">
                        <a href="" class="research-link"><img src="{{ asset('frontend/img/research2.png')}}" alt=""></a>
                    </div>
                    <div class="market-research-date">
                        <div class="market-research-badge">
                            <span>Market Research</span>
                        </div>
                        <h6>14 JAN, 2022</h6>
                    </div>

                    <div class="marker-research-info">
                        <a href="" class="research-link">Sed semper neque eget urna iaculis
                            tristique.</a>
                        <p>Pellentesque ullamcorper lectus non orci fermentum,
                            tempus dapibus magna fermentum.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-12 mb-4">
                <div class="market-research-content">
                    <div class="img">
                        <a href="" class="research-link"><img src="{{ asset('frontend/img/research3.png')}}" alt=""></a>
                    </div>
                    <div class="market-research-date">
                        <div class="market-research-badge">
                            <span>Market Research</span>
                        </div>
                        <h6>14 JAN, 2022</h6>
                    </div>

                    <div class="marker-research-info">
                        <a href="" class="research-link">Sed semper neque eget urna iaculis
                            tristique.</a>
                        <p>Pellentesque ullamcorper lectus non orci fermentum,
                            tempus dapibus magna fermentum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@endsection
