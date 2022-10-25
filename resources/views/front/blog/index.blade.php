@extends('front.layouts.app')
@section('title',' Article')
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

    <div class="container mb-2 mb-sm-5">
        {{-- <form action="{{ route('front.event') }}" class="search_form mb-5">
            <div class="row">
                <div class="col-4">
                    <input type="search" name="code" placeholder="Category">
                </div>
                <div class="col-4">
                    <input type="search" name="keyword" placeholder="Search by keyword">
                </div>
                <div class="col-4">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        {{-- <a type="button" href="{{ url()->current() }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
                        </a> --}}
                   {{--  </div>
                </div>
            </div>
        </form> --}}
        <div class="row">
            <div class="col">
                <ul class="toolsFilter Blog_toolsFilter">
                 @foreach($cat as $key=> $data)
                    <li>
                        <label>
                            <input type="radio" name="blogcategory" value="bloglist_{{ $data->id }}" {{ ($key == 0) ? 'checked' : '' }}>
                            <span>{{  $data->title }}</span>
                        </label>
                    </li>
                    <!-- <li><a data-target="bloglist_{{ $data->id }}">{{  $data->title }}</a></li> -->
                 @endforeach
                </ul>
            </div>
           {{--   <div class="col-sm-auto">
                <form class="toolSearch">
                    <input type="search" placeholder="Enter here to search tools">
                </form>
            </div>--}}
        </div>
    </div>

    <div class="container">
        <div class="row blog_list">
   @foreach($cat as $blogCategorykey => $blog)

    @php
        if($blog->blogDetails->count() == 0) { continue; }
    @endphp

           @foreach($blog->blogDetails as $blogProductkey => $data)
            <div class="col-12 col-lg-4 col-md-6 mb-3 blog-list-panel bloglist_{{ $data->article_category_id }}">
                <a href="">
                    <div class="card">
                        <img src="{{ asset($data->image) }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="subHead_badge">{{ $data->tag }}</span></a>
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
                            <a href="{{ route('front.article.details',$data->slug) }}" class="location_btn"><h5 class="card-title">{{ $data->title }}</h5></a>
                            <div class="card-text">
                                 {!! $data->content !!}
                            </div>
                        </div>
                    </div>
                </a>
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


