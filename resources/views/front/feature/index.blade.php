@extends('front.layouts.app')
@section('title', ' Tools & Features')
@section('section')
    @foreach ($data->content as $key => $item)
        <section class="tools_banner">
            <div class="container-fluid p-0">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-lg-6 col-md-6">
                        <div class="toolsBannerText">
                            <span class="subHead_badge">{{ $item->tag }}</span>
                            <h2>{!! $item->title !!}</h2>
                            <p>{!! $item->short_desc !!}</p>
                            <a href="{!! $item->btn_link !!}" class="button">{!! $item->btn_text !!}</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-md-6 p-0">
                        <img src="{{ asset($item->image) }}" class="w-100">
                    </div>
                </div>
            </div>
        </section>
        <!--end_grammar_help-->

        <section class="tools_wrapper">
            <div class="container text-center">
                <h3 class="mb-2 mb-sm-5">{!! $item->area_desc !!}</h3>
            </div>
            <div class="container mb-2 mb-sm-5">
                <div class="row">
                    <div class="col">
                        <ul class="toolsFilter Blog_toolsFilter">
                            @foreach ($data->interestCategory as $key => $cat)
                                <li>
                                    <label>
                                        <input type="radio" name="blogcategory" value="bloglist_{{ $cat->id }}"
                                            {{ $key == 0 ? 'checked' : '' }}>
                                        <span>{{ $cat->title }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <div class="col-sm-auto">
                        <form class="toolSearch">
                            <input type="search" name="keyword" value="{{ request()->input('keyword')}}" placeholder="Enter here to search tools">
                        </form>
                    </div> --}}
                </div>
            </div>
            <div class="container">
                <div class="row blog_list">
                    <ul class="tools_list">
                        @foreach ($data->interestCategory as $blogCategorykey => $cat)
                            @php
                                if ($cat->itemDetails->count() == 0) {
                                    continue;
                                }
                            @endphp
                            @foreach ($cat->itemDetails as $itemProductkey => $data)
                            {{-- {{dd($cat->itemDetails)}} --}}
                                <li class="blog-list-panel bloglist_{{ $data->cat_id }}">
                                    <div class="tools_header">
                                        <figure>
                                            <img src="{{ asset($data->image) }}">
                                        </figure>
                                        <figcaption>
                                            {{ $data->title }}
                                        </figcaption>
                                    </div>
                                    <div class="tools_body">
                                        <p>{!! $data->description !!}</p>
                                    </div>
                                    {{-- <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a> --}}
                                </li>
                            @endforeach
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="container text-center">
                {{-- <a href="#" class="load_more">Load more tools..</a> --}}
               {{-- {{dd($data->interest)}} --}}
                {!! $interest->appends($_GET)->links() !!}
            </div>
        </section>
    @endforeach
@endsection
