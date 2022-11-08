@extends('front.layouts.app')
@section('title',' Tools & Features')
@section('section')

<section class="tools_banner">
    <div class="container-fluid p-0">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-6 col-md-6">
                <div class="toolsBannerText">
                    <span class="subHead_badge">Contrary to popular belief</span>
                    <h2>Make your life easier with help from <span class="text-green">Copy</span>writer</h2>
                    <p>We help businesses elevate their value through custom software development, product design, QA & consultancy services.</p>
                    <a href="javascript:void(0);" class="button">Get Started Today</a>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-6 p-0">
                <img src="{{ asset('frontend/img/tools_banner.png')}}" class="w-100">
            </div>
        </div>
    </div>
</section><!--end_grammar_help-->

<section class="tools_wrapper">
    <div class="container text-center">
        <h3 class="mb-2 mb-sm-5">Choose your area of interest</h3>
    </div>
    <div class="container mb-2 mb-sm-5">
        <div class="row">
            <div class="col">
                <ul class="toolsFilter">
                    <li><a href="#" class="active">All</a></li>
                    <li><a href="#">Seo</a></li>
                    <li><a href="#">Content</a></li>
                    <li><a href="#">Market Research</a></li>
                    <li><a href="#">SMM & SERM</a></li>
                    <li><a href="#">Advertising</a></li>
                </ul>
            </div>
            <div class="col-sm-auto">
                <form class="toolSearch">
                    <input type="search" placeholder="Enter here to search tools">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <ul class="tools_list">
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/rocket.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/flickr.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/it.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/rocket.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/flickr.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/it.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/rocket.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/flickr.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/it.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/rocket.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/flickr.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="tools_header">
                    <figure>
                        <img src="{{ asset('frontend/img/it.png')}}">
                    </figure>
                    <figcaption>
                        Keyword Search
                    </figcaption>
                </div>
                <div class="tools_body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat amet, laoreet id urna laoreet pretium ut malesuada. Purus odio eu accumsan, ullamcorper adipiscing placerat interdum eu tellus. Dolor phasellus fringilla fames turpis sit. Morbi proin odio luctus eget in etiam dictum ultricies. Phasellus etiam habitant ipsum nibh le</p>
                    <p>Aenean et dui sed magna dapibus tincidunt vitae at erat.</p>
                </div>
                <a href="#" class="tools_footer">
                    <span>Learn More</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
    <div class="container text-center">
        <a href="#" class="load_more">Load more tools..</a>
    </div>
</section>

@endsection
