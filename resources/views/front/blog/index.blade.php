@extends('front.layouts.app')
@section('title',' Blog')
@section('section')

<section class="tools_wrapper">
    <div class="container">
        <div class="row blog_header">
            <div class="col-12 col-lg-7 col-md-7 pe-lg-6">
                <h3>{!! $article_page_content->header_left !!}</h3>
            </div>
            <div class="col-12 col-lg-5 col-md-5 ps-lg-4 ps-md-4">
                <p> {!! $article_page_content->header_right !!} </p>
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
                 @foreach($cat as $key => $data)
                    <li>
                        <label>
                            <form action="" method="GET">
                                <input class="d-none" type="checkbox" onclick="$(this).parent().submit()" name="category" value="{{ $data->slug }}" {{ (request()->input('category') == $data->slug) ? 'checked' : '' }}>
                            </form>
                            <span class="{{ ((request()->input('category') ?? $cat[0]->slug) == $data->slug) ? 'bg-success' : '' }}">{{  $data->title }}</span>
                        </label>
                    </li>
                 @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row blog_list">
            @foreach($blogs as $key => $blog)
                <div class="col-12 col-lg-4 col-md-6 mb-3 blog-list-panel" id="blog{{implode('-',explode(',',$blog->article_category_id))}}">
                    <a href="">
                        <div class="card">
                            <img src="{{ asset($blog->image) }}" class="card-img-top" alt="">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    @foreach (CategoryNames($blog->article_category_id) as $item)
                                        <span class="subHead_badge mx-1">{{$item}}</span>
                                    @endforeach
                                    <div class="dateBox blog_date">
                                        <span class="date">
                                            {{ date('d', strtotime($blog->created_at)) }}
                                        </span>
                                        <span class="month">
                                            {{ date('M', strtotime($blog->created_at)) }}
                                        </span>
                                        <span class="year">
                                            {{ date('Y', strtotime($blog->created_at)) }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('front.article.details',$blog->slug) }}" class="location_btn"><h5 class="card-title">{{ $blog->title }}</h5></a>
                                <div class="card-text">
                                    {!! $blog->short_desc !!}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    {{--  <div class="container text-center mt-4 mt-lg-5">
        <a href="#" class="load_more">Load more tools..</a>
    </div>--}}
</section>
@endsection


