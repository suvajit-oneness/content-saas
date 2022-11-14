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
                    {{-- <div class="col-2">
                        <select  name="code">
                            <option value="" hidden selected>Select Category...</option>
                            @foreach ($cat as $index => $item)
                                 <option value="{{$item->title}}" {{ (request()->input('code') == $item->title) ? 'selected' : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    
                    <div class="col-2">
                        {{-- <input type="search" name="type" placeholder="Enter type"> --}}
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
                                                    <option value="{{ $item->title }}"
                                                        {{ request()->input('code') == $item->title ? 'selected' : '' }}>
                                                        {{ucwords($item->title) }}</option>
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
                                        {{ request()->input('code') ? 'category "' . request()->input('code') . '"' : '' }}
                                        {{ !empty(request()->input('code')) && !empty(request()->input('type')) && !empty(request()->input('price')) ? ' & ' : '' }}
                                        {{ request()->input('address') ? 'location "' . request()->input('address') . '"' : '' }}
                                        {{ request()->input('type') ? 'type "' . request()->input('type') . '"' : '' }}
                                        {{ request()->input('price') ? 'price "' . request()->input('price') . '"' : '' }}
                                        {{ request()->input('keyword') ? 'keyword "' . request()->input('keyword') . '"' : '' }}
                                    @else
                                        No Result found for
                                        {{ request()->input('code') ? 'category "' . request()->input('code') . '"' : '' }}
                                        {{ !empty(request()->input('code')) && !empty(request()->input('type')) && !empty(request()->input('price')) ? ' & ' : '' }}
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
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($cat as $eventCategorykey => $event)
                    @php
                        if ($event->eventDetails->count() == 0) {
                            continue;
                        }
                    @endphp
                    @foreach ($event->eventDetails as $eventProductkey => $data)
                        <div class="col-12 col-lg-4 col-md-6 mb-3 blog_list eventlist eventlist_{{ $data->category }}">
                            {{-- <a href=""> --}}
                            <div class="card">
                                <a href="{{ route('front.event.details', $data->slug) }}">
                                    <img src="{{ asset($data->image) }}" class="card-img-top" alt="Blog Picture">
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
                                        <h5 class="card-title">{{ $data->title }}</h5>
                                    </a>
                                </div>
                            </div>
                            {{-- </a> --}}
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        {{--  <div class="container text-center mt-4 mt-lg-5">
        <a href="#" class="load_more">Load more tools..</a>
    </div> --}}
    </section>
@endsection
