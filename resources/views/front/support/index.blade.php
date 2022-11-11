@extends('front.layouts.app')
@section('title', ' Support')
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
                @if(count($supportWidget)>0)
                @foreach ($supportWidget as $key => $data)
                    <div class="col-12 col-md-6">
                        <div class="support-getting-started-content">
                            <div class="img">
                                <img src="{{ asset($data->image) }}" alt="">
                            </div>
                            <div class="info">
                                <h4>{{ $data->title }}</h4>
                                <p>{!! $data->description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <p class="text-center">No data found</p>
                @endif
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
                            @foreach ($faqCat as $key => $data)
                                <li class="faq-tab {{$key == 0 ? 'active' : ''}}" data-tab="{{ $data->id }}">{{ $data->title }} <div
                                        class="fac-tab-check">
                                        <img src="{{ asset('frontend/img/check-normal.png') }}" alt="">
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    @foreach ($faqCat as $key => $data)
                        <div class="faq-content {{ $key == 0 ? 'active' : '' }}" id="{{ $data->id }}">
                            <div class="faq-content-badge">
                                <span>{{ $data->title }}</span>
                            </div>
                            <div class="accordion" id="accordionExample">
                                @foreach($data->faqDetails as $key => $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $item->id }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $item->id }}"
                                            aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                            {!! $item->question !!}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $item->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>{!! $item->answer !!}</p>
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
        </div>
        </div>
    </section>

@endsection
