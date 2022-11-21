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
                 @foreach($cat as $key=> $data)
                    <li>
                        <label>
                            <input type="radio" name="blogcategory" value="bloglist_{{ $data->id }}" {{ ($key == 0) ? 'checked' : '' }}>
                            <span>{{  $data->title }}</span>
                        </label>
                    </li>
                 @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row blog_list">
        @foreach($cat as $blogCategorykey => $blogCategory)
            @php
                $blogsUnderCategory = \DB::table('articles')
                ->whereRaw("article_category_id LIKE '$blogCategory->id%' OR article_category_id LIKE '%,$blogCategory->id%' ")
                ->where('status', 1)
                ->orderby('id','desc')
                ->get();

                // $blogsUnderCategory = \DB::table('articles')->where('article_category_id', 'like', $blogCategory->id.',%')->where('status', 1)->orderby('id','desc')->limit(8)->get();
            @endphp

            @if ($blogsUnderCategory->count() > 0)
                @foreach($blogsUnderCategory as $blogProductkey => $data)
                    @php
                        $cat = $data->article_category_id;
                        //dd($cat);
                        $displayCategoryName = '';
                        foreach(explode(',' ,$cat) as $catKey => $catVal) {
                            // dd($catVal);
                            $catDetails = DB::table('article_categories')->where('id', $catVal)->first();
                            if(!empty($catDetails)) {
                                $displayCategoryName = $catDetails->id ;
                                // dd('here', $displayCategoryName);
                            }
                        }
                    @endphp

                    <div class="col-12 col-lg-4 col-md-6 mb-3 blog-list-panel bloglist_{{ $displayCategoryName }}">
                        <a href="">
                            <div class="card">
                                <img src="{{ asset($data->image) }}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <span class="subHead_badge">@php
                                            $cat = $data->article_category_id ?? '';
                                            //dd($cat);
                                            $displayCategoryName = '';
                                            foreach(explode(',', $cat) as $catKey => $catVal) {
                                            //
                                                $catDetails = DB::table('article_categories')->where('id', $catVal)->first();
                                                //dd($catDetails);
                                                if($catDetails == ''){
                                                $displayCategoryName .=  '';}
                                                else{
                                                $displayCategoryName .= $catDetails->title.' , ' ?? '';

                                                //dd($displayCategoryName);
                                                }
                                                }

                                        @endphp
                                        {{substr($displayCategoryName, 0, -2) ?? '' }}</span></a>
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
            @endif
        @endforeach
        </div>
    </div>
    {{--  <div class="container text-center mt-4 mt-lg-5">
        <a href="#" class="load_more">Load more tools..</a>
    </div>--}}
</section>
@endsection


