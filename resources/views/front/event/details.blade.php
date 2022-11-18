@extends('front.layouts.app')
@section('title',$event->title)

@section('section')
    <style>
        .a2a_svg svg {
            margin-right: 0 !important;
        }
    </style>

    <section class="artiledetails_banner eventDetails">
        <div class="container-fluid">
            <div class="artiledetails_banner_img">
                @if ($event->image != '')
                    <img class="w-100" src="{{ asset($event->image) }}" alt="">
                @else
                    <img class="w-100" src="{{ URL::to('/') . '/Blogs/' }}{{ placeholder - image . png }}">
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
                            <li>
                                @if (is_array($event->category) && count($event->category) > 0)
                            </li>
                            <li>
                                @endif
                                @php
                                    $cat = $event->category ?? '';
                                    $displayCategoryName = '';
                                    foreach (explode(',', $cat) as $catKey => $catVal) {
                                        $catDetails = DB::table('event_types')
                                            ->where('id', $catVal)
                                            ->first();
                                        if ($catDetails != '') {
                                            $displayCategoryName .= '' . $catDetails->title . ' > ';
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                            ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $event->created_at->format('d M Y') }}
                                </li>

                                <li>
                                    <div class="share-btns">
                                        <div class="dropdown">
                                            <button class="share_button dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="#898989" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-share-2">
                                                    <circle cx="18" cy="5" r="3"></circle>
                                                    <circle cx="6" cy="12" r="3"></circle>
                                                    <circle cx="18" cy="19" r="3"></circle>
                                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49">
                                                    </line>
                                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49">
                                                    </line>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton">
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
                @if ($event->start_date)
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="event_meta">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2"
                                        ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </figure>
                            <figcaption>
                                <h5>Start Date:</h5>
                                <div class="dateBox blog_date">
                                    <span class="date">
                                        {{ date('d', strtotime($event->start_date)) }}
                                    </span>
                                    <span class="month">
                                        {{ date('M', strtotime($event->start_date)) }}
                                    </span>
                                    <span class="year">
                                        {{ date('Y', strtotime($event->start_date)) }}
                                    </span>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                @endif
                @if ($event->end_date)
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="event_meta">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2"
                                        ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </figure>
                            <figcaption>
                                <h5>End Date:</h5>
                                <div class="dateBox blog_date">
                                    <span class="date">
                                        {{ date('d', strtotime($event->end_date)) }}
                                    </span>
                                    <span class="month">
                                        {{ date('M', strtotime($event->end_date)) }}
                                    </span>
                                    <span class="year">
                                        {{ date('Y', strtotime($event->end_date)) }}
                                    </span>
                                </div>
                            </figcaption>
                        </div>
                    </div>
                @endif
                @if ($event->type)
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="event_meta">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                    <rect x="1" y="4" width="22" height="16" rx="2"
                                        ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </figure>
                            <figcaption>
                                <h5> Type:</h5>
                                <h3>{{ ucwords($event->type) }}</h3>
                            </figcaption>
                        </div>
                    </div>
                @endif
                @if ($event->type == 'online')
                    @if ($event->link)
                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <div class="event_meta">
                                <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </figure>
                                <figcaption>
                                    <h5>Link:</h5>
                                    <h3>{!! $event->link !!}</h3>
                                </figcaption>
                            </div>
                        </div>
                    @endif
                @else
                    @if ($event->address)
                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <div class="event_meta">
                                <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </figure>
                                <figcaption>
                                    <h5>Address:</h5>
                                    <h3>{!! $event->address !!}</h3>
                                </figcaption>
                            </div>
                        </div>
                    @endif
                    @if ($event->pin)
                        <div class="col-lg-3 mb-4 mb-lg-0">
                            <div class="event_meta">
                                <figure>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </figure>
                                <figcaption>
                                    <h5>Postcode:</h5>
                                    <h3>{!! $event->pin !!}</h3>
                                </figcaption>
                            </div>
                        </div>
                    @endif
                @endif
                @if ($event->host)
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="event_meta">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                    <rect x="1" y="4" width="22" height="16" rx="2"
                                        ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                            </figure>
                            <figcaption>
                                <h5> Host:</h5>
                                <h3>{{ ucwords($event->host) }}</h3>
                            </figcaption>
                        </div>
                    </div>
                @endif
                @if ($event->contact_phone)
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="event_meta">
                            <figure>
                                <svg width="20px" height="20px" viewBox="-11.25 0 70 70"
                                    xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"
                                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="m -57.751301,747.54907 c -0.93707,-0.3601 -1.99781,-1.3954 -2.4766,-2.4171 l -0.37123,-0.7922 -0.0355,-31.2104 c -0.0392,-34.4979 -0.1023,-31.9774 0.83303,-33.293 0.58608,-0.8243 1.32136,-1.3943 2.24404,-1.7395 0.74667,-0.2794 0.88571,-0.281 20.82584,-0.2456 l 20.07415,0.036 0.92976,0.4577 c 1.08482,0.5341 1.83709,1.3814 2.28184,2.5701 l 0.28545,0.7629 -0.0352,31.334 -0.0352,31.3339 -0.45127,0.9166 c -0.54172,1.1004 -1.40116,1.9066 -2.45129,2.2995 -0.73808,0.2762 -0.96367,0.2791 -20.82101,0.272 -19.80541,-0.01 -20.08454,-0.011 -20.7968,-0.2846 z m 25.71423,-4.6777 c 0.43564,-0.1985 0.75131,-0.767 0.75131,-1.3532 0,-0.3087 -0.13355,-0.566 -0.46682,-0.8992 l -0.46682,-0.4669 -4.41412,0 c -4.86773,0 -5.01611,0.023 -5.44005,0.8428 -0.30228,0.5846 -0.15803,1.2461 0.36828,1.689 l 0.41776,0.3515 4.44523,0 c 3.15398,0 4.5498,-0.048 4.80523,-0.164 z m 14.06932,-32.4445 0,-25.1944 -18.94728,0 -18.94728,0 0,25.1944 0,25.1944 18.94728,0 18.94728,0 0,-25.1944 z m -9.89088,-27.9663 c 0.19291,-0.207 0.27994,-0.4864 0.27994,-0.8987 0,-0.7715 -0.41607,-1.2158 -1.25277,-1.3377 -0.89611,-0.1306 -16.35075,-0.022 -16.63552,0.1165 -0.66346,0.3234 -0.84569,1.5478 -0.31008,2.0834 l 0.33701,0.337 8.65073,0 8.65074,0 0.27995,-0.3005 z"
                                        fill="#95C800" transform="translate(60.653 -677.835)" />
                                </svg>
                            </figure>
                            <figcaption>
                                <h5>Contact Person Mobile:</h5>
                                <h3>{!! $event->contact_phone !!}</h3>
                            </figcaption>
                        </div>

                    </div>
                @endif
                @if ($event->contact_email)
                    <div class="col-lg-3 mb-4 mb-lg-0">
                        <div class="event_meta">
                            <figure>

                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"
                                viewBox="0 0 75.294 75.294" style="enable-background:new 0 0 75.294 75.294;" xml:space="preserve">
                           <g>
                               <path d="M66.097,12.089h-56.9C4.126,12.089,0,16.215,0,21.286v32.722c0,5.071,4.126,9.197,9.197,9.197h56.9
                                   c5.071,0,9.197-4.126,9.197-9.197V21.287C75.295,16.215,71.169,12.089,66.097,12.089z M61.603,18.089L37.647,33.523L13.691,18.089
                                   H61.603z M66.097,57.206h-56.9C7.434,57.206,6,55.771,6,54.009V21.457l29.796,19.16c0.04,0.025,0.083,0.042,0.124,0.065
                                   c0.043,0.024,0.087,0.047,0.131,0.069c0.231,0.119,0.469,0.215,0.712,0.278c0.025,0.007,0.05,0.01,0.075,0.016
                                   c0.267,0.063,0.537,0.102,0.807,0.102c0.001,0,0.002,0,0.002,0c0.002,0,0.003,0,0.004,0c0.27,0,0.54-0.038,0.807-0.102
                                   c0.025-0.006,0.05-0.009,0.075-0.016c0.243-0.063,0.48-0.159,0.712-0.278c0.044-0.022,0.088-0.045,0.131-0.069
                                   c0.041-0.023,0.084-0.04,0.124-0.065l29.796-19.16v32.551C69.295,55.771,67.86,57.206,66.097,57.206z" fill="#95C800"/>
                           </g>
                           </svg>
                            </figure>
                            <figcaption>
                                <h5>Contact Person Email:</h5>
                                <h3>{!! $event->contact_email !!}</h3>
                            </figcaption>
                        </div>

                    </div>
                @endif
                <div class="col-lg-12 mb-4 mb-lg-0 w-100 eventDesc">
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
                        <a type="button" class="btn btn-primary" href="{{ route('front.event') }}">
                            View All
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($latestevents as $eventProductkey => $data)
                    <div class="col-12 col-lg-4 col-md-6 mb-3 some-list-1">
                        {{-- <a href=""> --}}
                        <div class="card">
                            <a href="{{ route('front.event.details', $data->slug) }}">
                                <img src="{{ asset($data->image) }}" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="subHead_badge">{{ $data->eventCategory->title }}</span>
                                    <div class="dateBox blog_date">
                                        <span class="date">
                                            {{ date('d', strtotime($data->start_date)) }}
                                        </span>
                                        <span class="month">
                                            {{ date('M', strtotime($data->start_date)) }}
                                        </span>
                                        <span class="year">
                                            {{ date('Y', strtotime($data->start_date)) }}
                                        </span>
                                    </div>
                                    <div class="ms-2">-</div>
                                    <div class="dateBox blog_date ms-2">
                                        <span class="date">
                                            {{ date('d', strtotime($data->end_date)) }}
                                        </span>
                                        <span class="month">
                                            {{ date('M', strtotime($data->end_date)) }}
                                        </span>
                                        <span class="year">
                                            {{ date('Y', strtotime($data->end_date)) }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('front.event.details', $data->slug) }}" class="location_btn">
                                    <h5 class="card-title mt-3">{{ $data->title }}</h5>
                                </a>
                                <a href="{!! URL::to('event/' . $event->slug) !!}" class="readMoreBtn text-center">Read More</a>
                            </div>
                        </div>
                        {{-- </a> --}}
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script async src="https://static.addtoany.com/menu/page.js"></script>
@endpush
