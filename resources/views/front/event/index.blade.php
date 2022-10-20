@extends('front.layouts.app')
@section('title',' Event')

@section('section')
<section class="tools_wrapper">
    <div class="container">
        <div class="row blog_header">
            <div class="col-12 col-lg-7 col-md-7 pe-lg-6">
                <h3>Get the latest articles from our journal, writing, discuss and share</h3>
            </div>
            <div class="col-12 col-lg-5 col-md-5 ps-lg-4 ps-md-4">
                <p>
                    The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
                </p>
            </div>
        </div>
    </div>
    <form action="{{ route('front.event') }}">
    <div class="row">

    <div class="col-3">

            <input type="search" name="code" placeholder="Enter here to search tools">

    </div>
    <div class="col-3">

            <input type="search" name="keyword" placeholder="Enter here to search tools">

    </div>
    <div class="col-3">

            <input type="search" name="price" placeholder="Enter here to search tools">

    </div>
   </div>
   <div class="row">
    <div class="col-6">

            <input type="search" name="type" placeholder="Enter here to search tools">

    </div>
    <div class="col-3">
        <input type="search" name="address" placeholder="Enter here to search tools">
</div>
    <div class="col-6">

        <div class="mt-3 text-right">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Search </button>
            <a type="button" href="{{ url()->current() }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
            </a>
        </div>

    </div>

</div>
</form>
<div class="container">
        <div class="row">
     @foreach($event as $eventProductkey => $data)
            <div class="col-12 col-lg-4 col-md-6 mb-3 blog_list eventlist eventlist_{{ $data->category }}">
                {{-- <a href=""> --}}
                    <div class="card">
                        <a href="{{ route('front.event.details',$data->slug) }}">
                            <img src="{{asset($data->image)}}" class="card-img-top">
                        </a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                               <span class="subHead_badge">{{ $data->eventCategory->title }}</span>
                                <div class="dateBox blog_date">
                                    <span class="date">
                                        {{ date('d', strtotime($data->created_at)) }}
                                    </span>
                                    <span class="month">
                                        {{ date('M', strtotime($data->created_at)) }}
                                    </span>
                                    <span class="year">
                                        {{ date('Y', strtotime($data->created_at)) }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('front.event.details',$data->slug) }}" class="location_btn"><h5 class="card-title">{{ $data->title }}</h5></a>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            @endforeach
        </div>
    </div>
    <div class="container mb-2 mb-sm-5">
        <div class="row">
            <div class="col">
                <ul class="toolsFilter Event_toolsFilter">
                    @foreach($cat as $key=> $data)
                    <li>
                        <label>
                            <input type="radio" name="blogcategory" value="eventlist_{{ $data->id }}" {{ ($key == 0) ? 'checked' : '' }}>
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
        @foreach($cat as $eventCategorykey => $event)
        @php
            if($event->eventDetails->count() == 0) { continue; }
        @endphp
            @foreach($event->eventDetails as $eventProductkey => $data)
            <div class="col-12 col-lg-4 col-md-6 mb-3 blog_list eventlist eventlist_{{ $data->category }}">
                {{-- <a href=""> --}}
                    <div class="card">
                        <a href="{{ route('front.event.details',$data->slug) }}">
                            <img src="{{asset($data->image)}}" class="card-img-top" alt="Blog Picture">
                        </a>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                               <span class="subHead_badge">{{ $data->eventCategory->title }}</span>
                                <div class="dateBox blog_date">
                                    <span class="date">
                                        {{ date('d', strtotime($data->created_at)) }}
                                    </span>
                                    <span class="month">
                                        {{ date('M', strtotime($data->created_at)) }}
                                    </span>
                                    <span class="year">
                                        {{ date('Y', strtotime($data->created_at)) }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('front.event.details',$data->slug) }}" class="location_btn"><h5 class="card-title">{{ $data->title }}</h5></a>
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
    </div>--}}
</section>
@endsection

