@extends('front.layouts.app')

@section('title', 'Homepage')

@section('section')

    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-md-9 text-center">
                    <h1>{{ $home[0]->title }}</h1>
                    <p>{!! $home[0]->short_desc !!}</p>
                    <a href="{{ $home[0]->btn_link }}" class="button text-white">{{ $home[0]->btn_text }}</a>
                    <p class="mt-0"><small>{!! $home[0]->btn_desc !!}</small></p>
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
                            <img src="{{ asset($home[0]->video_image) }}">
                            
                                {{-- <a source src="{{ asset($home[0]->video) }}" type="video/mp4">
                                    <img src="{{ asset('frontend/img/play.svg') }}">
                                </a> --}}
                        </figure>
                        <p>
                            {!! $home[0]->video_desc !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row job_part align-items-center">
                <div class="col-12 col-lg-6 col-md-6">
                    <img src="{{ asset($home[0]->section_one_icon) }}" class="job_icon">
                    <p class="mb-2"><small>We Have <span>{{ $job->count() }}</span> Live Jobs</small></p>
                    <h2>{{ $home[0]->section_one_title }}</h2>
                    <p>{!! $home[0]->section_one_short_desc !!}</p>
                    <a href="{{ $home[0]->section_one_btn_link }}"
                        class="button hover-white">{{ $home[0]->section_one_btn_text }}</a>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                    <img src="{{ asset($home[0]->section_one_image) }}" class="resp_image">
                </div>
            </div>
        </div>
    </section>

    <section class="career_sec">
        <div class="container-fluid">
            <div class="row align-items-end">
                <div class="col-12 col-lg-6 col-md-6 p-0">
                    <img src="{{ asset($home[0]->section_two_image) }}">
                </div>
                <div class="col-12 col-lg-6 col-md-6 pl-0">
                    <div class="career_block">
                        <span class="subHead_badge">{{ $home[0]->section_two_tag }}</span>
                        <h3>{{ $home[0]->section_two_title }}</h3>
                        <p>
                            {!! $home[0]->section_two_short_desc !!}
                        </p>
                        <ul>
                            @php
                                $cat = $home[0]->section_two_category;
                                
                                $displayCategoryName = '';
                                foreach (explode(',', $cat) as $catKey => $catVal) {
                                    $catDetails = DB::table('homes')
                                        ->where('section_two_category', 'LIKE', '%' . $catVal . '%')
                                        ->first();
                                    // dd($catDetails);
                                    if ($catDetails != '') {
                                        $displayCategoryName .= '<a href="">' . '<li>' . $catVal . '</li>' . '</a>  ';
                                    }
                                }
                                echo $displayCategoryName;
                            @endphp
                            {{-- <li>Professional Copywriter </li>
                            <li>Writer/Novelist</li>
                            <li>Copywriting</li>
                            <li>Press releases</li>
                            <li>Blog posts</li>
                            <li>SEO Copywriting</li>
                            <li>Creative Copywriting </li> --}}
                        </ul>
                        <a href="{{ $home[0]->section_two_btn_link }}" class="button">{{ $home[0]->section_two_btn }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="project_management">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-md-8 text-center">
                    <img src="{{ asset($home[0]->section_three_icon) }}" width="92px">
                    <h6>{{ $home[0]->section_three_tag }}</h6>
                    <h5>{{ $home[0]->section_three_title }}</h5>
                    <p>
                        {!! $home[0]->section_three_short_desc !!}
                    </p>
                </div>
                <div class="col-12 col-lg-9 col-md-9 text-center">
                    <img src="{{ asset($home[0]->section_three_image) }}" class="w-100 mt-lg-4 mt-md-4">
                    <a href="{{ $home[0]->section_three_btn_link }}" class="button">{{ $home[0]->section_three_btn }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="grammar_help">
        <div class="container-fluid p-lg-0">
            <div class="row justify-content-between">
                <div class="col-12 col-lg-5 col-md-6 offset-0 offset-lg-1 offset-lg-1 grammer_text">
                    <span class="subHead_badge">{{ $home[0]->section_four_tag }}</span>
                    <h2>{{ $home[0]->section_four_title }}</h2>
                    <p>
                        {!! $home[0]->section_four_short_desc !!}

                    </p>
                    <a href="{{ $home[0]->section_four_btn_link }}" class="button">{{ $home[0]->section_four_btn }}</a>
                </div>
                <div class="col-12 col-lg-5 col-md-6 p-0">
                    <img src="{{ asset($home[0]->section_four_image) }}" class="w-100">
                </div>
            </div>
        </div>
    </section>

    <section class="project_management submission">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 col-md-8 text-center">
                    <img src="{{ asset($home[0]->section_five_icon) }}" width="92px">
                    <h6>{{ $home[0]->section_five_tag }}</h6>
                    <h5>{{ $home[0]->section_five_title }}</h5>
                    <p>
                        {!! $home[0]->section_five_short_desc !!}
                    </p>
                </div>
                <div class="col-12 col-lg-9 col-md-9 text-center">
                    <img src="{{ asset($home[0]->section_five_image) }}" class="w-100 mt-lg-4 mt-md-4 mb-4">
                    <a href="{{ $home[0]->section_five_btn_link }}" class="button">{{ $home[0]->section_five_btn }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="portfolio" style="background-image: url('{{ asset($home[0]->section_six_image) }}');">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-12 col-lg-5 col-md-5">

                    <span class="subHead_badge dark">{{ $home[0]->section_six_tag }}</span>
                    <h2>{{ $home[0]->section_six_title }}</span></h2>
                    <p>
                        {!! $home[0]->section_six_short_desc !!}
                    </p>
                    <a href="{{ $home[0]->section_six_btn_link }}" class="button">{{ $home[0]->section_six_btn }}</a>
                </div>
            </div>
        </div>
    </section>

@endsection
