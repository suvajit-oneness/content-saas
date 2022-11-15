@extends('front.layouts.app')
@section('title', ' Deals')

@section('section')
    <section class="tools_wrapper">
        <div class="container">
            <div class="row blog_header">
                <div class="col-12 col-lg-7 col-md-7 pe-lg-6">
                    <h3>{!! $deal_page_content->header_left !!}</h3>
                </div>
                <div class="col-12 col-lg-5 col-md-5 ps-lg-4 ps-md-4">
                    <p>
                        {!! $deal_page_content->header_right !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="" class="search_form mb-5">
                <div class="row">
                    {{-- <div class="col-2">
                        <select  name="code">
                            <option value="" hidden selected>Select Category...</option>
                            @foreach ($cat as $index => $item)
                                 <option value="{{$item->title}}" {{ (request()->input('code') == $item->title) ? 'selected' : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-5">
                        <div class="page-search-block" style="bottom: -83px;">
                            <div class="filterSearchBox">
                                <div class="row">
                                    <div
                                        class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                        <div class="select-floating-admin">
                                            <select class="filter_select form-control" name="category">
                                                <option value="" hidden selected>Select Category...</option>
                                                @foreach ($deal_category as $index => $item)
                                                    <option value="{{ $item->slug }}"
                                                        {{ request()->input('category') == $item->slug ? 'selected' : '' }}>
                                                        {{ ucwords($item->title) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <input type="search" name="search" placeholder="Search Title..." value="{{request()->input('search')}}">
                    </div>
                    {{-- <div class="col-2">
                        <input type="search" name="address" placeholder="Enter Location">
                    </div>
                    <div class="col-2">
                        <input type="search" name="keyword" placeholder="Enter Keyword">
                    </div> --}}
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
        {{-- @if (request()->input('category') || request()->input('search')) --}}
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col">
                        <div class="page-title best_deal">
                            <h2>
                                @if (request()->input('category') || request()->input('search'))
                                    @if ($deal->count() > 0)
                                        {{ $deal->count() }} result found for
                                        {{ request()->input('category') ? 'category "' . request()->input('category') . '"' : '' }}
                                        {{ !empty(request()->input('search')) ? ' & ' . request()->input('search') : '' }}
                                    @else
                                        No Result found for
                                        {{ request()->input('category') ? 'category "' . request()->input('category') . '"' : '' }}
                                        {{ !empty(request()->input('search')) ? ' & ' . request()->input('search') : '' }}
                                    @endif
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($deal as $dealProductkey => $data)
                        <div class="col-12 col-lg-4 col-md-6 mb-3 some-list-1">
                            <div class="card">
                                <a href="{{$data->company_website_link}}" target="_blank">
                                    <img src="{{ asset($data->company_logo) }}" class="card-img-top">
                                </a>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="subHead_badge">{{ $data->title }}</span>
                                    </div>
                                    <div class="location_btn">
                                        <div class="d-flex align-items-baseline">
                                            <h6 class="card-title mt-3">{{ $data->short_description }}</h6>
                                        </div>
                                    </div>
                                    <div class="location_btn">
                                        <a href="{{route('front.deals.detail',$data->slug)}}" class="btn btn-primary btn-sm">Get Coupon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        {{-- @endif --}}
        {{-- <div class="container mb-2 mb-sm-5">
            <div class="row">
                <div class="col">
                    <ul class="toolsFilter Event_toolsFilter">
                        @foreach ($deal_category as $key => $data)
                            <li>
                                <label>
                                    <input type="radio" name="blogcategory" value="category_{{ $data->id }}"
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
                @foreach ($deal as $dealProductkey => $data)
                    <div class="col-12 col-lg-4 col-md-6 mb-3 some-list-1">
                        <div class="card">
                            <a href="{{ route('front.event.details', $data->slug) }}">
                                <img src="{{ asset($data->company_logo) }}" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="subHead_badge">{{ $data->title }}</span>
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
                    </div>
                @endforeach
            </div>
        </div> --}}
        {{-- <div class="container text-center mt-4 mt-lg-5">
        <a href="#" class="load_more">Load more tools..</a> --}}
    </div>
    </section>
@endsection

{{-- @section('script')
    <script>
    </script>
@endsection --}}
