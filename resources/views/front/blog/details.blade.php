@extends('front.layouts.app')
@section('title','Blog Details')
@section('section')
    <style>
        .a2a_svg svg {
            margin-right: 0!important;
        }
    </style>

    <section class="artiledetails_banner">
        <div class="container-fluid">
            <div class="artiledetails_banner_img">
                @if($blog->image)
                    <img class="w-100" src="{{ asset($blog->image) }}" alt="">
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
                            <li><a href="{!! URL::to('article') !!}">Article</a></li>

                            <li>/</li>
                            @if(is_array($blog->category) && count($blog->category)>0)
                            <li> <a href="{!! URL::to('category/'.$blog->category->slug) !!}">
                            @endif
                            @php
                                $cat = $blog->article_category_id ?? '';
                                $displayCategoryName = '';
                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                    $catDetails = DB::table('article_categories')->where('id', $catVal)->first();
                                    if($catDetails!=''){
                                        $displayCategoryName .= ''.$catDetails->title.' > ';
                                    }
                                }
                                echo substr($displayCategoryName, 0, -2);
                            @endphp
                            </a></li>
                            <li>/</li>

                            <li>{{ $blog->title }}</li>
                        </ul>
                        {{-- <div class="article_badge_wrap">
                            <span class="badge">{{$blog->suburb? $blog->suburb->name : ''}}</span>

                            <span class="badge">{{ $blog->subcategory? $blog->subcategory->title : ''}}</span>
                            @if($blog->blog_tertiary_category_id == 10)

                            @else
                                <span class="badge">{{$blog->subcategorylevel? $blog->subcategorylevel->title : ''}}</span>
                            @endif
                        </div> --}}
                        <h1>{{ $blog->title }}</h1>
                        <div class="row">
                            <div class="col">
                                <ul class="articlecat">
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                        {{ $blog->created_at->format('d M Y') }}
                                    </li>

                                    @if($blog->tag!='')
                                        <li>
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg><a href=""> --}}
                                             @php
                                                $cat =$blog->tag;
                                               // dd($cat);
                                                $displayCategoryName = '';
                                                foreach(explode(',' , $cat) as $catKey => $catVal) {
                                                    //dd($catVal);
                                                     $displayCategoryName .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>'.$catVal.' ';
                                                }
                                                echo $displayCategoryName;
                                            @endphp
                                            {{-- <span class="tag_text">{{ trim($catVal) }}</span> --}}
                                        </a>
                                        </li>
                                        @endif

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
                <div class="col-lg-7 mb-4 mb-lg-0 eventDesc">
                    {!! $blog->content !!}
                </div>
            </div>
        </div>
    </section>
    <section class="py-2 py-sm-4 py-lg-5 bg-light">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <div class="page-title best_deal">
                        <h2>Relevent Articles</h2>
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
                        @foreach($latestblogs as  $key => $blog)
                        <div class="swiper-slide jQueryEqualHeight">
                            <div class="card blogCart border-0">
                                <div class="bst_dimg">
                                     @if($blog->image)
                                   <img src="{{ asset($blog->image) }}" class="card-img-top" alt="ltItem">
                                     @else
                                    <img class="w-100" src="{{URL::to('/').'/Demo/'}}{{placeholder-image.png}}" class="card-img-top" style="height: 350px;object-fit: cover;">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title m-0"><a href="{!! URL::to('article/'.$blog->slug) !!}" class="location_btn">{{ $blog->title }}</a></h5>
                                        @if($blog->article_category_id)
                                        <div class="article_badge_wrap mt-3 mb-1">
                                            @php
                                                $cat = $blog->article_category_id;
                                                $displayCategoryName = '';
                                                foreach(explode(',', $cat) as $catKey => $catVal) {
                                                    $catDetails = DB::table('article_categories')->where('id', $catVal)->first();
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
                                        <span class="tag_text">{{ $blog->tag }}</span>
                                        <!--<a href="{!! URL::to('blog-details/'.$blog->id.'/'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $blog->title))) !!}" class="location_btn">Read More <img src="{{asset('site/images/right-arrow.png')}}"></a>-->
                                        <a href="{!! URL::to('article/'. $blog->slug) !!}" class="readMoreBtn">Read More</a>
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
