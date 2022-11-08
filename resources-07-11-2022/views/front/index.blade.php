@extends('front.layouts.app')

@section('title', 'Homepage')

@section('section')
    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-md-9 text-center">
                    <h1>Write your way to the life you want.</h1>
                    <p>Writers Work is the all-in-one platform for launching your dream job.</p>
                    <a href="javascript:void(0);" class="button text-white">Get Started Today</a>
                    <p class="mt-0"><small>Easy set-up • 30 day money-back guarantee</small></p>
                </div>
            </div>
        </div>
    </section>

    <section class="video_section">
        <div class="container">
            <div class="row justify-content-center video_part">
                <div class="col-auto">
                    <div class="video_dive">
                        <figure>
                            <img src="{{ asset('frontend/img/video_image.png') }}">
                            <a href="javascript:void(0);">
                                <img src="{{ asset('frontend/img/play.svg') }}">
                            </a>
                        </figure>
                        <p>
                            Get career training, writing tools, an online portfolio, and more—all for one low monthly price.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row job_part align-items-center">
                <div class="col-12 col-lg-6 col-md-6">
                    <img src="{{ asset('frontend/img/portfolio_icon.svg') }}" class="job_icon">
                    <p class="mb-2"><small>We Have <span>208,000+</span> Live Jobs</small></p>
                    <h2>Find the job that fits your life</h2>
                    <p>Type your keyword, then click search to find your perfect job.</p>
                    <a href="javascript:void(0);" class="button hover-white">Get Started Today</a>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                    <img src="{{ asset('frontend/img/job_bg.png') }}" class="resp_image">
                </div>
            </div>
        </div>
    </section>

    <section class="career_sec">
        <div class="container-fluid">
            <div class="row align-items-end">
                <div class="col-12 col-lg-6 col-md-6 p-0">
                    <img src="{{ asset('frontend/img/career_pic.png') }}">
                </div>
                <div class="col-12 col-lg-6 col-md-6 pl-0">
                    <div class="career_block">
                        <span class="subHead_badge">Career Training Videos</span>
                        <h3>Your writing career, demystified.</h3>
                        <p>
                            How do I find clients? How much should I charge? How do I even start? Our built-in training course will answer all your questions. (No joke: we'll even show you how to do your taxes.)
                        </p>
                        <ul>
                            <li>Professional Copywriter </li>
                            <li>Writer/Novelist</li>
                            <li>Copywriting</li>
                            <li>Press releases</li>
                            <li>Blog posts</li>
                            <li>SEO Copywriting</li>
                            <li>Creative Copywriting </li>
                        </ul>
                        <a href="javascript:void(0);" class="button">Start Training Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="project_management">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-md-8 text-center">
                    <img src="{{ asset('frontend/img/project_m.svg') }}" width="92px">
                    <h6>Project <span class="text-green">Management</span></h6>
                    <h5>Lorem ipsum dolor sit amet</h5>
                    <p>
                        Vivamus vitae nibh quis urna mattis feugiat quis id nisl. Duis sit amet turpis ut ipsum lacinia aliquam. Nullam quis ante a lorem elementum venenatis at quis arcu.
                    </p>
                </div>
                <div class="col-12 col-lg-9 col-md-9 text-center">
                    <img src="{{ asset('frontend/img/project_dbimage.png') }}" class="w-100 mt-lg-4 mt-md-4">
                    <a href="javascript:void(0);" class="button">Get Organized Now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="grammar_help">
        <div class="container-fluid p-lg-0">
            <div class="row justify-content-between">
                <div class="col-12 col-lg-5 col-md-6 offset-0 offset-lg-1 offset-lg-1 grammer_text">
                    <span class="subHead_badge">GRAMMAR HELP</span>
                    <h2>Polish your<br/> <span class="text-green">words</span> to <span class="text-green">blinding</span>
                        perfection.
                        </h2>
                    <p>
                        Our built-in grammar checker is your new eagle-eyed best friend. Correct typos, un-dangle those modifiers, and write error-free copy that will wow your clients.

                    </p>
                    <a href="javascript:void(0);" class="button">Get Polish Today</a>
                </div>
                <div class="col-12 col-lg-5 col-md-6 p-0">
                    <img src="{{ asset('frontend/img/grammer_pic.png') }}" class="w-100">
                </div>
            </div>
        </div>
    </section>

    <section class="project_management submission">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-md-8 text-center">
                    <img src="{{ asset('frontend/img/submission_icon.svg') }}" width="92px">
                    <h6>INSTANT<span class="text-green">SUBMISSION</span>FINDER</h6>
                    <h5>Get published. Get paid.</h5>
                    <p>
                        We make it easy to find sites who will publish your articles—even if you're a first-time writer. Search a database of writers guidelines from paying sites across the web.
                    </p>
                </div>
                <div class="col-12 col-lg-9 col-md-9 text-center">
                    <img src="{{ asset('frontend/img/submission_pic2.png') }}" class="w-100 mt-lg-4 mt-md-4 mb-4">
                    <a href="javascript:void(0);" class="button">Get Organized Now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="portfolio">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-5 col-md-5">
                    <span class="subHead_badge dark">GRAMMAR HELP</span>
                    <h2>Stand out from the <span class="text-green">pack.</span></h2>
                    <p>
                        Suspendisse ullamcorper risus id libero volutpat, quis consequat lectus gravida. Cras posuere risus hendrerit dolor rutrum fermentum sed at erat.
                    </p>
                    <a href="javascript:void(0);" class="button">Get Share Today</a>
                </div>
            </div>
        </div>
    </section>
@endsection