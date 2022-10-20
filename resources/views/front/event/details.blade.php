@extends('front.layouts.app')
@section('title','Event Details')
@section('section')
    <style>
        .a2a_svg svg {
            margin-right: 0!important;
        }
    </style>

    <section class="artiledetails_banner">
        <div class="container-fluid">
            <div class="artiledetails_banner_img">
                @if($event->image!='')
                    <img class="w-100" src="{{asset($event->image)}}" alt="">
                @else
                <img class="w-100" src="{{URL::to('/').'/Blogs/'}}{{placeholder-image.png}}">
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="artiledetails_banner_text">
                        <ul class="breadcumb_list mb-2 mb-sm-4">
                            <li><a href="{!! URL::to('') !!}">Home</a></li>
                            <li>/</li>
                            <li><a href="{!! URL::to('event') !!}">Event</a></li>
                            <li>/</li>
                            <li>@if(is_array($event->category) && count($event->category)>0)</li>
                            <li>
                            @endif
                            @php
                                $cat = $event->category ?? '';
                                $displayCategoryName = '';
                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                    $catDetails = DB::table('event_types')->where('id', $catVal)->first();
                                     if($catDetails!=''){
                                        $displayCategoryName .= ''.$catDetails->title.' > ';
                                    }
                                }
                                echo substr($displayCategoryName, 0, -2);
                            @endphp
                            </li>
                            <li>/</li>

                            <li>{{ $event->title }}</li>
                        </ul>
                        </div>
                        <h1>{{ $event->title }}</h1>
                        <div class="row">
                            <div class="col">
                                <ul class="articlecat">
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                        {{ $event->created_at->format('d M Y') }}
                                    </li>

                                    <li>
                                        <div class="share-btns">
                                            <div class="dropdown">
                                                <button class="share_button dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#898989" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <div class="w-100 pl-2">
                                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                                            <a class="a2a_button_facebook"></a>
                                                            <a class="a2a_button_twitter"></a>
                                                            <a class="a2a_button_whatsapp"></a>
                                                            <a class="a2a_button_pinterest"></a>
                                                            <a class="a2a_button_linkedin"></a>
                                                            <a class="a2a_button_telegram"></a>
                                                            <a class="a2a_button_reddit"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-2 py-sm-4 art-dtls">
        <div class="container">
            <div class="row">
            @if($event->event_host)
		    <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </figure>
                    <figcaption>
                        <h5>Host:</h5>
                        <h3>{!! $event->host !!}</h3>
                    </figcaption>
                </div>
		    </div>
            @endif
            @if($event->location)
		     <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </figure>
                    <figcaption>
                        <h5>Location:</h5>
                        <h3>{!! $event->location !!}</h3>
                    </figcaption>
                </div>
		    </div>
            @endif
            @if($event->start_date)
		    <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </figure>
                    <figcaption>
                        <h5>Start Date:</h5>
                        <h3>{!! $event->start_date !!}</h3>
                    </figcaption>
                </div>
		    </div>
            @endif
            @if($event->end_date)
		    <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </figure>
                    <figcaption>
                        <h5>End Date:</h5>
                        <h3>{!! $event->end_date !!}</h3>
                    </figcaption>
                </div>
		    </div>
            @endif
            @if($event->type)
		     <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                    </figure>
                    <figcaption>
                        <h5> Type:</h5>
                        <h3>{{ $event->type }}</h3>
                    </figcaption>
                </div>
		    </div>
            @endif
            @if($event->contact_phone)
		    <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                    </figure>
                    <figcaption>
                        <h5>Contact Person Mobile:</h5>
                        <h3>{!! $event->contact_phone !!}</h3>
                    </figcaption>
                </div>

		    </div>
            @endif
            @if($event->contact_email)
		    <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="event_meta">
                    <figure>
                    </figure>
                    <figcaption>
                        <h5>Contact Person Email:</h5>
                        <h3>{!! $event->contact_email !!}</h3>
                    </figcaption>
                </div>

		    </div>
            @endif
                   <div class="col-lg-12 mb-4 mb-lg-0">
                    {!! $event->description !!}
                   </div>
            </div>
        </div>
    </section>
    <section class="py-2 py-sm-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <div class="page-title best_deal">
                        <h2>Relevent Event</h2>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="articleSliderBtn">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="swiper Bestdeals Bestdeals2">
                    <div class="swiper-wrapper">
                        @foreach($latestevents as  $key => $event)
                        <div class="swiper-slide jQueryEqualHeight">
                            <div class="card eventCart border-0">
                                <div class="bst_dimg">
                                     @if($event->image)
                                   <img src="{{asset($event->image)}}" class="card-img-top" alt="ltItem">
                                     @else
                                    <img class="w-100" src="{{URL::to('/').'/Demo/'}}{{placeholder-image.png}}" class="card-img-top" style="height: 350px;object-fit: cover;">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title m-0"><a href="{!! URL::to('article/'.$event->slug) !!}" class="location_btn">{{ $event->title }}</a></h5>
                                        @if($event->event_type)
                                        <div class="article_badge_wrap mt-3 mb-1">
                                            @php
                                                $cat = $event->event_type;
                                                $displayCategoryName = '';
                                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                                    $catDetails = DB::table('event_types')->where('id', $catVal)->first();
                                                   if($catDetails!=''){
                                                        $displayCategoryName .= ''.'<span class="badge p-1" style="font-size: 10px;">'.$catDetails->title.'</span>'.'  ';
                                                    }
                                                }
                                                echo $displayCategoryName;
                                            @endphp
                                        </div>
                                        @endif
                                    </div>
                                    <div class="card-body-bottom">
                                        <a href="{!! URL::to('event/'. $event->slug) !!}" class="readMoreBtn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
@endpush
