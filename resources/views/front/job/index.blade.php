@extends('front.layouts.appprofile')
@section('title', 'job')

@section('section')
<div class="dashboard-content">
          <div class="row">
            <div class="col-12 col-lg-3 col-md-3 mt-3">
              <div class="jobs-filter-content">
                <form action="">
                  <div class="jobs-filter-heading">
                    <h6>filter</h6>
                    <span class="clear-filter">clear filter</span>
                  </div>
                  <div class="jobs-filter-keywords">
                    <h4>keywords</h4>
                    <input type="text" placeholder="Enter keywords" class="form-control" />
                  </div>
                  <div class="jobs-filter-checkbox jobs-filter-employment">
                    <h4>employment type</h4>
                    <div class="checkbox-content">
                      <input type="checkbox" id="fulltime" />
                      <label for="fulltime">full time</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="remote" />
                      <label for="remote">remote</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="freelance" />
                      <label for="freelance">freelance</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="contract" />
                      <label for="contract">contract</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="parttime" />
                      <label for="parttime">part time</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="telecomute" />
                      <label for="telecomute">telecommute</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="temporary" />
                      <label for="temporary">temporary</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="internship" />
                      <label for="internship">internship</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="unpaid" />
                      <label for="unpaid">unpaid</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="checkbox" id="fuiltime" />
                      <label for="fuiltime">fuil time</label>
                    </div>
                  </div>
                  <div class="jobs-filter-checkbox job-filter-location">
                    <h4>location</h4>
                    <div class="checkbox-content">
                      <input type="checkbox" id="nearMe" />
                      <label for="nearMe">near me</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="text" id="remote2" class="form-control" />

                    </div>
                  </div>

                  <div class="jobs-filter-checkbox job-filter-salary">
                    <h4>Salary per</h4>
                    <div class="checkbox-content">
                      <input type="radio" id="year" checked class="year" name="salary"/>
                      <label for="year">year</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="hour" class="hour" name="salary"/>
                      <label for="hour">hour</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="month" class="month" name="salary"/>
                      <label for="month">month</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="article" class="article" name="salary"/>
                      <label for="article">article</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="word" class="word" name="salary"/>
                      <label for="word">word</label>
                    </div>
                  </div>

                  <div class="jobs-filter-checkbox job-filter-source">
                    <h4>Source</h4>
                    <div class="checkbox-content">
                      <input type="radio" id="indeed" checked class="indeed" name="source"/>
                      <label for="indeed">indeed</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="problogger" class="problogger" name="source"/>
                      <label for="problogger">problogger</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="medabistro" class="medabistro" name="source"/>
                      <label for="medabistro">mediabistro</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="journalism" class="journalism" name="source"/>
                      <label for="journalism">journalism</label>
                    </div>
                    <div class="checkbox-content">
                      <input type="radio" id="writers" class="writers" name="source"/>
                      <label for="writers">writers work</label>
                    </div>
                  </div>

                  <div class="jobs-filter-checkbox job-filter-featured">
                    <h4>featured</h4>
                    <div class="checkbox-content">
                      <input type="checkbox" id="featured" />
                      <label for="featured">show only featured jobs</label>
                    </div>

                  </div>

                  <div class="jobs-filter-checkbox job-filter-beginner-friendly">
                    <h4>beginner friendly</h4>
                    <div class="checkbox-content">
                      <input type="checkbox" id="beginner" />
                      <label for="beginner">show only beginner friendly jobs</label>
                    </div>

                  </div>


                  <div class="job-filter-save">
                    <button type="submit">SAVE FILTER</button>
                    <div class="view-saved-filter-main">
                      <h6>saved filters</h6>
                      <span>No filters</span>

                      <div class="view-saved-filter-content"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-12 col-lg-9 col-md-9">
              <div class="dashboard-featured mt-3">
                <div class="top-info">
                  <span>recent featured jobs</span>
                  {{-- <a href="" class="show-all">show all</a> --}}
                </div>
                <div class="row mt-2 g-2">
                @foreach ($job as $data)

                  <div class="col-12 col-lg-6 col-md-12">
                    <div class="recommended-writers-content">
                      <div class="featured-jobs-badge">
                        <span>featured</span>
                      </div>
                      <div class="featured-jobs-badge">
                      <a href="javascript:void(0)" class="wishlist_button" onclick="jobBookmark({{$data->id}})">
                        @php
                            if(auth()->guard('user')->check()) {
                                $collectionExistsCheck = \App\Models\JobUser::where('job_id', $data->id)->where('user_id', auth()->guard('web')->user()->id)->first();
                            } else {
                                $collectionExistsCheck = \App\Models\JobUser::where('job_id', $data->id)->where('user_id', auth()->guard('web')->user()->id)->first();
                            }

                            if($collectionExistsCheck != null) {
                                // if found
                                $heartColor = "#ffffff";
                            } else {
                                // if not found
                                $heartColor = "none";
                            }
                        @endphp
                        <svg id="saveBtn" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{$heartColor}}" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </a>
                </div>
                      <div class="content-top">
                        <div class="content-top-info">
                          <h4>{{ $data->title }}</h4>
                          <span class="mt-3">{{$data->category->title}}</span>
                          <p>
                          {!!$data->description!!}
                          </p>
                        </div>
                      </div>

                      <div class="content-mid">
                        <ul class="list-unstyled p-0 m-0">
                         @foreach($tag as $tagKey => $tagVal)
                          <li>{{ ucwords($tagVal->title) }} </li>
                          @endforeach
                        </ul>
                      </div>

                      <div class="line"></div>

                      <div class="content-btm">
                        <a href="{{ route('front.job.details',$data->slug) }}">
                          get started now
                          <img src="assets/img/arrow-right-freelance.png" alt="" />
                        </a>
                      </div>
                    </div>
                  </div>

               @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

