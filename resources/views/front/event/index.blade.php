@extends('front.layouts.app')
@section('title', ' Events')

@section('section')

    <section class="tools_wrapper">
        <div class="container">
            <div class="row blog_header">
                <div class="col-12 col-lg-7 col-md-7 pe-lg-6">
                    <h3>{!! $event_page_content->header_left !!}</h3>
                </div>
                <div class="col-12 col-lg-5 col-md-5 ps-lg-4 ps-md-4">
                    <p>
                        {!! $event_page_content->header_right !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="{{ route('front.event') }}" class="search_form mb-5">
                <div class="row">
                    <div class="col-2">
                        <div class="page-search-block" style="bottom: -83px;">
                            <div class="filterSearchBox">
                                <div class="row">
                                    <div
                                        class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                        <div class="select-floating-admin">
                                            <select class="filter_select form-control" name="type">
                                                <option value="" hidden selected>Content Type</option>
                                                <option value="online"
                                                    {{ request()->input('type') == 'online' ? 'selected' : '' }}>Online
                                                </option>
                                                <option value="in person"
                                                    {{ request()->input('type') == 'in person' ? 'selected' : '' }}>In
                                                    person</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <input type="search" name="price" placeholder="Enter Price">
                    </div>
                    <div class="col-2">
                        <div class="page-search-block" style="bottom: -83px;">
                            <div class="filterSearchBox">
                                <div class="row">
                                    <div
                                        class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                        <div class="select-floating-admin">
                                            <select class="filter_select form-control" name="code">
                                                <option value="" hidden selected>Event Type</option>
                                                @foreach ($cat as $index => $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('code') == $item->title ? 'selected' : '' }}>
                                                        {{ ucwords($item->title) }}</option>
                                                @endforeach
                                               
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <input type="search" name="address" placeholder="Enter Location">
                    </div>
                    <div class="col-2">
                        <input type="search" name="keyword" placeholder="Enter Keyword">
                    </div>
                    <div class="col-2">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            {{-- <a type="button" href="{{ url()->current() }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if (request()->input('code') ||
            request()->input('type') ||
            request()->input('price') ||
            request()->input('address') ||
            request()->input('keyword'))
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col">
                        <div class="page-title best_deal">
                            <h2>
                                @if (request()->input('code') ||
                                    request()->input('type') ||
                                    request()->input('price') ||
                                    request()->input('address') ||
                                    request()->input('keyword'))
                                    @if ($event->count() > 0)
                                        Result found for
                                        {{ request()->input('category') ? 'category "' . request()->input('category') . '"' : '' }}
                                        {{ !empty(request()->input('category')) && !empty(request()->input('type')) && !empty(request()->input('price')) ? ' & ' : '' }}
                                        {{ request()->input('address') ? 'location "' . request()->input('address') . '"' : '' }}
                                        {{ request()->input('type') ? 'type "' . request()->input('type') . '"' : '' }}
                                        {{ request()->input('price') ? 'price "' . request()->input('price') . '"' : '' }}
                                        {{ request()->input('keyword') ? 'keyword "' . request()->input('keyword') . '"' : '' }}
                                    @else
                                        No Result found for
                                        {{ request()->input('category') ? 'category "' . request()->input('category') . '"' : '' }}
                                        {{ !empty(request()->input('category')) && !empty(request()->input('type')) && !empty(request()->input('price')) ? ' & ' : '' }}
                                        {{ request()->input('address') ? 'location "' . request()->input('address') . '"' : '' }}
                                        {{ request()->input('type') ? 'type "' . request()->input('type') . '"' : '' }}
                                        {{ request()->input('price') ? 'price "' . request()->input('price') . '"' : '' }}
                                        {{ request()->input('keyword') ? 'keyword "' . request()->input('keyword') . '"' : '' }}
                                    @endif
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($event as $eventProductkey => $data)
                        @if(CheckIfContentIsUnderSubscription($data->id, 'events'))
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
                                    </div>
                                </div>
                                {{-- </a> --}}
                            </div>
                        @else
                            <div class="col-12 col-lg-4 col-md-6 mb-3 some-list-1 ">
                                {{-- <a href=""> --}}
                                <div class="card" style="position: relative">
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
                                    </div>
                                    <div style="position: absolute; width: 100%; height: 100%; background-color: rgba(220,220,220,0.1); backdrop-filter: blur(4px);">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        <div class="container mb-2 mb-sm-5">
            <div class="row">
                <div class="col">
                    <ul class="toolsFilter Event_toolsFilter">
                        @foreach ($cat as $key => $data)
                            <li>
                                <label>
                                    <input type="radio" name="blogcategory" value="eventlist_{{ $data->id }}"
                                        {{ $key == 0 ? 'checked' : '' }}>
                                    <span>{{ ucwords($data->title) }}</span>
                                </label>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-auto">
                    <div class="d-flex cafe-listing-nav">
                        <ul class="d-flex" id="tabs-nav">
                            <li onClick="changeView('list')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2"stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-list">
                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                </svg>
                            </li>
                            <li onClick="changeView('cal')">
                                <svg id="Line" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 64 64">
                                    <title>1</title>
                                    <path
                                        d="M54,11.19482H47.57129a4.00016,4.00016,0,0,0-8-.00577c.00625.00511-15.14873.00583-15.14258-.00007a4,4,0,1,0-8,.00584H10a6.00657,6.00657,0,0,0-6,6V50.80811a6.00657,6.00657,0,0,0,6,6H54a6.00657,6.00657,0,0,0,6-6V17.19482A6.00657,6.00657,0,0,0,54,11.19482Zm-44,2h6.42871a4.0015,4.0015,0,0,0,4,3.99707,1.00016,1.00016,0,0,0-.003-2,1.99917,1.99917,0,0,1-1.997-1.99708V11.189a2,2,0,0,1,4,.00293H20.95508a1.0002,1.0002,0,0,0,.00007,2H39.57129a4.00149,4.00149,0,0,0,3.99707,4,1.00016,1.00016,0,0,0-.00007-2,1.99916,1.99916,0,0,1-1.997-1.99708V11.189a2,2,0,0,1,4,.00586H44.09961a1.00018,1.00018,0,0,0,.00005,2H54a4.00428,4.00428,0,0,1,4,4v5.56836H6V17.19482A4.00428,4.00428,0,0,1,10,13.19482ZM54,54.80811H10a4.00428,4.00428,0,0,1-4-4V24.76318H58V50.80811A4.00428,4.00428,0,0,1,54,54.80811Z" />
                                    <path
                                        d="M48,27.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,48,27.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,48,31.78564Z" />
                                    <path
                                        d="M48,36.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,48,36.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,48,40.78564Z" />
                                    <path
                                        d="M48,45.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,48,45.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,48,49.78564Z" />
                                    <path
                                        d="M32,27.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,32,27.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,32,31.78564Z" />
                                    <path
                                        d="M32,36.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,32,36.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,32,40.78564Z" />
                                    <path
                                        d="M32,45.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,32,45.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,32,49.78564Z" />
                                    <path
                                        d="M16,27.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,16,27.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,16,31.78564Z" />
                                    <path
                                        d="M16,36.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,16,36.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,16,40.78564Z" />
                                    <path
                                        d="M16,45.78564a3.00019,3.00019,0,0,0,.00009,6A3.00019,3.00019,0,0,0,16,45.78564Zm0,4a1.00019,1.00019,0,0,1,.00006-2A1.00019,1.00019,0,0,1,16,49.78564Z" />
                                </svg>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="container">
            <div class="" id="op_list_view">
                <div class="tab-content smallGapGrid" id="list">
                    <div class="row">
                        @foreach ($cat as $eventCategorykey => $item)
                            @php
                                if ($item->eventDetails->count() == 0) {
                                    continue;
                                }
                            @endphp
                            @foreach ($item->eventDetails as $eventProductkey => $data)
                            @if(CheckIfContentIsUnderSubscription($data->id, 'events'))
                                <div
                                    class="col-12 col-lg-4 col-md-6 mb-3 blog_list eventlist eventlist_{{ $data->category }}">
                                    {{-- <a href=""> --}}
                                    <div class="card">
                                        <a href="{{ route('front.event.details', $data->slug) }}">
                                            <img src="{{ asset($data->image) }}" class="card-img-top"
                                                alt="Blog Picture">
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
                                                <a href="javascript:void(0)"
                                                class="location_btn ms-auto" onclick="eventBookmark({{ $data->id }})" title="Add event to you calender">
                                             
                                               @php
                                                        if (
                                                            auth()
                                                                ->guard('user')
                                                                ->check()
                                                        ) {
                                                            $collectionExistsCheck = \App\Models\EventUser::where('event_id', $data->id)
                                                                ->where(
                                                                    'user_id',
                                                                    auth()
                                                                        ->guard('web')
                                                                        ->user()->id,
                                                                )
                                                                ->first();
                                                        } else {
                                                            $collectionExistsCheck = \App\Models\EventUser::where('event_id', $data->id)
                                                                ->where(
                                                                    'user_id',
                                                                    auth()
                                                                        ->guard('web')
                                                                        ->user()->id,
                                                                )
                                                                ->first();
                                                        }
        
                                                        if ($collectionExistsCheck != null) {
                                                            // if found
                                                            $heartColor = '#cae47f';
                                                        } else {
                                                            // if not found
                                                            $heartColor = '#fff';
                                                        }
                                                    @endphp
                                                        <svg id="saveBtn_{{$data->id}}" fill="{{ $heartColor }}" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="30px" height="30px" stroke="#000000" stroke-width="2px" >    <path d="M23,27l-8-7l-8,7V5c0-1.105,0.895-2,2-2h12c1.105,0,2,0.895,2,2V27z"/></svg>
                                                            
                                                        
                                            </a>
                                            </div>
                                           
                                            <a href="{{ route('front.event.details', $data->slug) }}"
                                                class="location_btn">
                                                <h5 class="card-title">{{ $data->title }}</h5>
                                            </a>
                                           
                                        </div>
                                    </div>
                                    
                                    {{-- </a> --}}
                                </div>
                                @else
                                <div
                                    class="col-12 col-lg-4 col-md-6 mb-3 blog_list eventlist eventlist_{{ $data->category }}">
                                    {{-- <a href=""> --}}
                                    <div class="card" style="position: relative;">
                                        <a href="{{ route('front.event.details', $data->slug) }}">
                                            <img src="{{ asset($data->image) }}" class="card-img-top"
                                                alt="Blog Picture">
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
                                                <a href="javascript:void(0)"
                                                class="location_btn ms-auto" onclick="eventBookmark({{ $data->id }})" title="Add event to you calender">
                                             
                                               @php
                                                        if (
                                                            auth()
                                                                ->guard('user')
                                                                ->check()
                                                        ) {
                                                            $collectionExistsCheck = \App\Models\EventUser::where('event_id', $data->id)
                                                                ->where(
                                                                    'user_id',
                                                                    auth()
                                                                        ->guard('web')
                                                                        ->user()->id,
                                                                )
                                                                ->first();
                                                        } else {
                                                            $collectionExistsCheck = \App\Models\EventUser::where('event_id', $data->id)
                                                                ->where(
                                                                    'user_id',
                                                                    auth()
                                                                        ->guard('web')
                                                                        ->user()->id,
                                                                )
                                                                ->first();
                                                        }
        
                                                        if ($collectionExistsCheck != null) {
                                                            // if found
                                                            $heartColor = '#cae47f';
                                                        } else {
                                                            // if not found
                                                            $heartColor = '#fff';
                                                        }
                                                    @endphp
                                                        <svg id="saveBtn_{{$data->id}}" fill="{{ $heartColor }}" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="30px" height="30px" stroke="#000000" stroke-width="2px" >    <path d="M23,27l-8-7l-8,7V5c0-1.105,0.895-2,2-2h12c1.105,0,2,0.895,2,2V27z"/></svg>
                                                            
                                                        
                                            </a>
                                            </div>
                                           
                                            <a href="{{ route('front.event.details', $data->slug) }}"
                                                class="location_btn">
                                                <h5 class="card-title">{{ $data->title }}</h5>
                                            </a>
                                           
                                        </div>
                                        <div style="position: absolute; width: 100%; height: 100%; background-color: rgba(220,220,220,0.1); backdrop-filter: blur(4px);">
                                        </div>
                                    </div>
                                    {{-- </a> --}}
                                </div>
                              @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="" id="op_cal_view" style="display:none">
                <div class="tab-content smallGapGrid" id="calender"></div>
            </div>
        </div>
        {{--  <div class="container text-center mt-4 mt-lg-5">
        <a href="#" class="load_more">Load more tools..</a>
    </div> --}}
    </section>
@endsection
@section('script')
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <script>
        // $(document).ready(function() {
        //     // page is now ready, initialize the calendar...
        //     $('#calender').fullCalendar({
        //         // put your options and callbacks here
        //         //locale: 'zh-cn',
        //         header: {
        //             left: 'prev,next today',
        //             center: 'title',
        //             right: 'month,basicWeek,basicDay'
        //         },
        //         defaultDate: '2018-03-12',
        //         navLinks: true, // can click day/week names to navigate views
        //         editable: true,
        //         eventLimit: true, // allow "more" link when too many events
        //         events: [
        //             {
        //             title: 'All Day Event',
        //             start: '2018-03-01'
        //             },
        //             {
        //             title: 'Long Event',
        //             start: '2018-03-07',
        //             end: '2018-03-10'
        //             },
        //             {
        //             id: 999,
        //             title: 'Repeating Event',
        //             start: '2018-03-09T16:00:00'
        //             },
        //             {
        //             id: 999,
        //             title: 'Repeating Event',
        //             start: '2018-03-16T16:00:00'
        //             },
        //             {
        //             title: 'Conference',
        //             start: '2018-03-11',
        //             end: '2018-03-13'
        //             },
        //             {
        //             title: 'Meeting',
        //             start: '2018-03-12T10:30:00',
        //             end: '2018-03-12T12:30:00'
        //             },
        //             {
        //             title: 'Lunch',
        //             start: '2018-03-12T12:00:00'
        //             },
        //             {
        //             title: 'Meeting',
        //             start: '2018-03-12T14:30:00'
        //             },
        //             {
        //             title: 'Happy Hour',
        //             start: '2018-03-12T17:30:00'
        //             },
        //             {
        //             title: 'Dinner',
        //             start: '2018-03-12T20:00:00'
        //             },
        //             {
        //             title: 'Birthday Party',
        //             start: '2018-03-13T07:00:00'
        //             },
        //             {
        //             title: 'Click for Google',
        //             url: 'http://google.com/',
        //             start: '2018-03-28'
        //             }
        //         ]
        //     })
        // });

        function changeView(id) {
            if (id == 'cal') {
                $('#op_list_view').fadeOut();
                $('#op_cal_view').fadeIn();
                $('#calender').fullCalendar({
            // put your options and callbacks here
            events: [
                @foreach ($cat as $eventCategorykey => $item)
                            @php
                                if ($item->eventDetails->count() == 0) {
                                    continue;
                                }
                            @endphp
                            @foreach ($item->eventDetails as $eventProductkey => $data)
                            {
                                title: '{{ $data->title }}',
                                start: '{{ $data->start_date }}',
                                end: '{{ $data->end_date }}',
                                url: '{{ URL::to('event/' . $data->slug) }}'
                    },
                @endforeach
                @endforeach
               
            ]
        })
            } else if (id == 'list') {
                $('#op_cal_view').fadeOut();
                $('#op_list_view').fadeIn();
            }
        }
    </script>
    <script>
    function eventBookmark(jobId) {
        $.ajax({
            url: '{{ route('front.event.calender') }}',
            method: 'post',
            data: {
                '_token': '{{ csrf_token() }}',
                id: jobId,
            },
            success: function(result) {
                // alert(result);
                if (result.type == 'add') {
                    // toastr.success(result.message);
                    toastFire("success", result.message);
                    $('#saveBtn_'+jobId).attr('fill', '#cae47f');
                } else {
                    toastFire("warning", result.message);
                    // toastr.error(result.message);
                    $('#saveBtn_'+jobId).attr('fill', '#fff');
                }
            }
        });
    }
    </script>
@endsection
