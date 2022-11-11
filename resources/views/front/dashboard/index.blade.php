@extends('front.layouts.appprofile')
@section('title', 'Dashboard')

@section('section')
@php

$project = App\Models\Project::where('status','1')->get();
$job = App\Models\Job::where('status','1')->get();
$course = App\Models\Course::where('status','1')->get();
@endphp
<div class="dashboard-content">
    <div class="dashboard-stats">
        {{-- <div class="top-info">
            <span>today's writing stats</span>
            <a href="" class="show-all">show all</a>
        </div> --}}
        <div class="row mt-3 gx-3">
            <div class="col-12 col-lg-4 col-md-4 mb-4">
                <div class="dashboard-stats-content">
                    <div class="typed">
                        <h4>{{count($course)}}</h4>
                        <span>Course</span>
                    </div>
                    {{-- <div class="line"></div>
                    <div class="times">
                        <span><strong class="count">0</strong> per minute</span>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 mb-4">
                <div class="dashboard-stats-content dashboard-stats-content2">
                    <div class="typed">
                        <h4>{{count($job)}}</h4>
                        <span>Job</span>
                    </div>
                    {{-- <div class="line"></div>
                    <div class="times">
                        <span><strong class="count">0</strong> per minute</span>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-4 mb-4">
                <div class="dashboard-stats-content dashboard-stats-content3">
                    <div class="typed">
                        <h4>{{count($project)}}</h4>
                        <span>Project</span>
                    </div>
                    {{-- <div class="line"></div>
                    <div class="times">
                        <span><strong class="count">0</strong> per minute</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-documents">
        <div class="top-info">
            <span>recent orders</span>
            <a href="{{route('front.user.courses')}}" class="show-all">show all</a>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                {{-- <ul class="list-unstyled p-0 m-0 recent-documents">
                    <li>
                        <h6 class="">
                            <i class="fa-solid fa-folder"></i> Lorem ipsum dolor
                            sit amet.
                        </h6>
                        <div class="document-right">
                            <span>recently edited</span>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                    </li>
                    <li>
                        <h6>
                            <i class="fa-solid fa-folder"></i> Lorem ipsum dolor
                            sit amet.
                        </h6>
                        <div class="document-right">
                            <span>recently edited</span>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                    </li>
                    <li>
                        <h6>
                            <i class="fa-solid fa-folder"></i> Lorem ipsum dolor
                            sit amet.
                        </h6>
                        <div class="document-right">
                            <span>recently edited</span>
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </div>
                    </li>
                </ul> --}}
                <div class="course-content-accordions">
                  @foreach($orders as $o)
                      <div class="course-content-accor">
                          <div class="accor-top">
                              <div class="accor-top-left">
                                  <i class="fa-solid fa-angle-down"></i>
                                  <span>ORD ID: {!! $o->order_no !!}</span>
                              </div>
                              <div class="accor-top-right">
                                  <div class="duraton">
                                      <span>{{$o->created_at}}</span>
                                  </div>
                              </div>
                          </div>
                          <div class="accor-content">
                              <ul class="list-unstyled p-0 m-0">
                              @foreach($o->orderProducts as $op)
                                  <li><a href="{{route('front.course.details', getProductSlug($op->course_id)->slug)}}">{{getProductSlug($op->course_id)->title}}</a></li>
                              @endforeach
                              </ul>
                          </div>
                      </div>
                  @endforeach
                  </div>
            </div>
        </div>
    </div>

    {{-- <div class="dashboard-messages mt-3">
        <div class="top-info">
            <span>recent messages</span>
            <a href="" class="show-all">show all</a>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <ul class="list-unstyled p-0 m-0">
                    <li>
                        <p class="msg">
                            Lorem ipsum dolor sit, amet consectetur adipisicing
                            elit. Tenetur eos est enim similique vitae impedit
                            quod beatae, nulla ipsum nostrum aliquam
                            reprehenderit, unde laboriosam dolores sit
                            obcaecati, velit iusto tempora!
                        </p>
                        <a href="" class="view-msg">view msg</a>
                    </li>
                    <li>
                        <p class="msg">
                            Lorem ipsum dolor sit, amet consectetur adipisicing
                            elit. Tenetur eos est enim similique vitae impedit
                            quod beatae, nulla ipsum nostrum aliquam
                            reprehenderit, unde laboriosam dolores sit
                            obcaecati, velit iusto tempora!
                        </p>
                        <a href="" class="view-msg">view msg</a>
                    </li>
                    <li>
                        <p class="msg">
                            Lorem ipsum dolor sit, amet consectetur adipisicing
                            elit. Tenetur eos est enim similique vitae impedit
                            quod beatae, nulla ipsum nostrum aliquam
                            reprehenderit, unde laboriosam dolores sit
                            obcaecati, velit iusto tempora!
                        </p>
                        <a href="" class="view-msg">view msg</a>
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}

    {{-- <div class="dashboard-featured mt-3">
        <div class="top-info">
            <span>recent featured jobs</span>
            <a href="" class="show-all">show all</a>
        </div>
        <div class="row mt-2 g-2">
            <div class="col-12 col-lg-4 col-md-6">
                <div class="recommended-writers-content">
                    <div class="featured-jobs-badge">
                      <span>featured</span>
                    </div>
                    <div class="content-top">
                      <div class="content-top-info">
                        <h4>Lorem ipsum dolor sit?</h4>
                        <span>Education and curriculum writer </span>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Consequatur vitae necessitatibus optio. Quos
                          laborum voluptatum libero cumque alias accusantium
                          asperiores!
                        </p>
                      </div>
                    </div>

                    <div class="content-mid">
                      <ul class="list-unstyled p-0 m-0">
                        <li>Copywriting</li>
                        <li>Social media</li>
                        <li>+ 10 more</li>
                      </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                      <a href="">
                        get started now
                        <img
                          src="{{ asset('frontend/img/arrow-right-freelance.png')}}"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6">
                <div class="recommended-writers-content">
                    <div class="featured-jobs-badge">
                      <span>featured</span>
                    </div>
                    <div class="content-top">
                      <div class="content-top-info">
                        <h4>Lorem ipsum dolor sit?</h4>
                        <span>Education and curriculum writer </span>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Consequatur vitae necessitatibus optio. Quos
                          laborum voluptatum libero cumque alias accusantium
                          asperiores!
                        </p>
                      </div>
                    </div>

                    <div class="content-mid">
                      <ul class="list-unstyled p-0 m-0">
                        <li>Copywriting</li>
                        <li>Social media</li>
                        <li>+ 10 more</li>
                      </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                      <a href="">
                        get started now
                        <img
                          src="{{ asset('frontend/img/arrow-right-freelance.png')}}"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6">
                <div class="recommended-writers-content">
                    <div class="featured-jobs-badge">
                      <span>featured</span>
                    </div>
                    <div class="content-top">
                      <div class="content-top-info">
                        <h4>Lorem ipsum dolor sit?</h4>
                        <span>Education and curriculum writer </span>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Consequatur vitae necessitatibus optio. Quos
                          laborum voluptatum libero cumque alias accusantium
                          asperiores!
                        </p>
                      </div>
                    </div>

                    <div class="content-mid">
                      <ul class="list-unstyled p-0 m-0">
                        <li>Copywriting</li>
                        <li>Social media</li>
                        <li>+ 10 more</li>
                      </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                      <a href="">
                        get started now
                        <img
                          src="{{ asset('frontend/img/arrow-right-freelance.png')}}"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6">
                <div class="recommended-writers-content">
                    <div class="featured-jobs-badge">
                      <span>featured</span>
                    </div>
                    <div class="content-top">
                      <div class="content-top-info">
                        <h4>Lorem ipsum dolor sit?</h4>
                        <span>Education and curriculum writer </span>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Consequatur vitae necessitatibus optio. Quos
                          laborum voluptatum libero cumque alias accusantium
                          asperiores!
                        </p>
                      </div>
                    </div>

                    <div class="content-mid">
                      <ul class="list-unstyled p-0 m-0">
                        <li>Copywriting</li>
                        <li>Social media</li>
                        <li>+ 10 more</li>
                      </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                      <a href="">
                        get started now
                        <img
                          src="{{ asset('frontend/img/arrow-right-freelance.png')}}"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6">
                <div class="recommended-writers-content">
                    <div class="featured-jobs-badge">
                      <span>featured</span>
                    </div>
                    <div class="content-top">
                      <div class="content-top-info">
                        <h4>Lorem ipsum dolor sit?</h4>
                        <span>Education and curriculum writer </span>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Consequatur vitae necessitatibus optio. Quos
                          laborum voluptatum libero cumque alias accusantium
                          asperiores!
                        </p>
                      </div>
                    </div>

                    <div class="content-mid">
                      <ul class="list-unstyled p-0 m-0">
                        <li>Copywriting</li>
                        <li>Social media</li>
                        <li>+ 10 more</li>
                      </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                      <a href="">
                        get started now
                        <img
                          src="{{ asset('frontend/img/arrow-right-freelance.png')}}"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
            </div>
            <div class="col-12 col-lg-4 col-md-6">
                <div class="recommended-writers-content">
                    <div class="featured-jobs-badge">
                      <span>featured</span>
                    </div>
                    <div class="content-top">
                      <div class="content-top-info">
                        <h4>Lorem ipsum dolor sit?</h4>
                        <span>Education and curriculum writer </span>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Consequatur vitae necessitatibus optio. Quos
                          laborum voluptatum libero cumque alias accusantium
                          asperiores!
                        </p>
                      </div>
                    </div>

                    <div class="content-mid">
                      <ul class="list-unstyled p-0 m-0">
                        <li>Copywriting</li>
                        <li>Social media</li>
                        <li>+ 10 more</li>
                      </ul>
                    </div>

                    <div class="line"></div>

                    <div class="content-btm">
                      <a href="">
                        get started now
                        <img
                          src="{{ asset('frontend/img/arrow-right-freelance.png')}}"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
