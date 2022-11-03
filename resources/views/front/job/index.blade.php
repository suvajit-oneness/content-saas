@extends('front.layouts.appprofile')
@section('title', 'job')

@section('section')
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12 col-lg-3 col-md-3 mt-3">
                <div class="jobs-filter-content">
                    <form action="{{ route('front.job.index') }}">
                        <div class="jobs-filter-heading">
                            <h6>filter</h6>
                            <a href="{{ url()->current() }}"><span class="clear-filter">clear filter</span></a>
                        </div>
                        <div class="jobs-filter-keywords">
                            <h4>keywords</h4>
                            <input type="text" name="keyword" placeholder="Enter keywords" class="form-control" />
                        </div>
                        <div class="jobs-filter-checkbox jobs-filter-employment">
                            <h4>employment type</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" name="employment_type[]" id="fulltime" value="fulltime" {{ request()->input('employment_type') == 'fulltime' ? 'checked' : '' }} multiple/>
                                <label for="fulltime">full time</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="remote" name="employment_type[]" value="remote"{{ request()->input('employment_type') == 'remote' ? 'checked' : '' }} multiple/>
                                <label for="remote">remote</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="freelance" name="employment_type[]" value="freelance" {{ request()->input('employment_type') == 'freelance' ? 'checked' : '' }}multiple/>
                                <label for="freelance">freelance</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="contract" name="employment_type[]" value="contract" {{ request()->input('employment_type') == 'contract' ? 'checked' : '' }} multiple/>
                                <label for="contract">contract</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="parttime" name="employment_type[]" value="parttime" {{ request()->input('employment_type') == 'parttime' ? 'checked' : '' }} multiple/>
                                <label for="parttime">part time</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="telecomute" name="employment_type[]" value="telecomute" {{ request()->input('employment_type') == 'telecomute' ? 'checked' : '' }} multiple/>
                                <label for="telecomute">telecommute</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="temporary" name="employment_type[]" value="temporary" {{ request()->input('employment_type') == 'temporary' ? 'checked' : '' }} multiple/>
                                <label for="temporary">temporary</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="internship" name="employment_type[]" value="internship" {{ request()->input('employment_type') == 'internship' ? 'checked' : '' }} multiple/>
                                <label for="internship">internship</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="unpaid" name="employment_type[]" value="unpaid" {{ request()->input('employment_type') == 'unpaid' ? 'checked' : '' }} multiple/>
                                <label for="unpaid">unpaid</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="unpaid" name="employment_type[]" value="other" {{ request()->input('employment_type') == 'other' ? 'checked' : '' }} multiple/>
                                <label for="unpaid">other</label>
                            </div>
                        </div>
                        <div class="jobs-filter-checkbox job-filter-location">
                            <h4>location</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" id="nearMe" />
                                <label for="nearMe">near me</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="text" name="address" id="remote2" class="form-control" />

                            </div>
                        </div>

                        <div class="jobs-filter-checkbox job-filter-salary">
                            <h4>Salary per</h4>
                            <div class="checkbox-content">
                                <input type="radio" id="year" class="year" name="salary" value="year" {{ request()->input('salary') == 'year' ? 'checked' : '' }}/>
                                <label for="year">year</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="hour" class="hour" name="salary" value="hour" {{ request()->input('salary') == 'hour' ? 'checked' : '' }}/>
                                <label for="hour">hour</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="month" class="month" name="salary" value="month" {{ request()->input('salary') == 'month' ? 'checked' : '' }}/>
                                <label for="month">month</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="article" class="article" name="salary" value="article" {{ request()->input('salary') == 'article' ? 'checked' : '' }}/>
                                <label for="article">article</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="word" class="word" name="salary" value="word" {{ request()->input('salary') == 'word' ? 'checked' : '' }}/>
                                <label for="word">word</label>
                            </div>
                        </div>

                        <div class="jobs-filter-checkbox job-filter-source">
                            <h4>Source</h4>
                            <div class="checkbox-content">
                                <input type="radio" id="indeed" class="indeed" name="source"
                                    value="indeed" />
                                <label for="indeed">indeed</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="problogger" class="problogger" name="source"
                                    value="problogger" />
                                <label for="problogger">problogger</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="medabistro" class="medabistro" name="source"
                                    value="medabistro" />
                                <label for="medabistro">mediabistro</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="journalism" class="journalism" name="source"
                                    value="journalism" />
                                <label for="journalism">journalism</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="writers" class="writers" name="source" value="writers" />
                                <label for="writers">writers work</label>
                            </div>
                        </div>

                        <div class="jobs-filter-checkbox job-filter-featured">
                            <h4>featured</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" id="featured" name="featured_flag" value="1" />
                                <label for="featured">show only featured jobs</label>
                            </div>

                        </div>

                        <div class="jobs-filter-checkbox job-filter-beginner-friendly">
                            <h4>beginner friendly</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" id="beginner" name="beginner_friendly" value="1" />
                                <label for="beginner">show only beginner friendly jobs</label>
                            </div>

                        </div>
                        <div class="job-filter-save">
                            <button type="submit" class="btn btn-primary">Search</button>
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
                    <div class="page-title best_deal">
                        <p>
                            @if (request()->input('keyword') ||
                                request()->input('employment_type') ||
                                request()->input('address') ||
                                request()->input('salary') ||
                                request()->input('source') ||
                                request()->input('featured_flag') ||
                                request()->input('beginner_friendly'))
                                @if ($job->count() > 0)
                                    Result found for
                                    {{ request()->input('keyword') ? 'keyword "' . request()->input('keyword') . '"' : '' }}
                                    {{ !empty(request()->input('keyword')) && !empty(request()->input('employment_type')) && !empty(request()->input('address')) ? ' & ' : '' }}
                                    {{ request()->input('address') ? 'location "' . request()->input('address') . '"' : '' }}
                                    {{ request()->input('employment_type[]') ? 'type "' . request()->input('employment_type[]') . '"' : '' }}
                                    {{ request()->input('salary') ? 'salary "' . request()->input('price') . '"' : '' }}
                                    {{ request()->input('source') ? 'source "' . request()->input('source') . '"' : '' }}
                                @else
                                    No Result found for
                                    {{ request()->input('keyword') ? 'keyword "' . request()->input('keyword') . '"' : '' }}
                                    {{ !empty(request()->input('keyword')) && !empty(request()->input('employment_type')) && !empty(request()->input('address')) ? ' & ' : '' }}
                                    {{ request()->input('address') ? 'location "' . request()->input('address') . '"' : '' }}
                                    {{ request()->input('employment_type') ? 'type "' . request()->input('type') . '"' : '' }}
                                    {{ request()->input('salary') ? 'salary "' . request()->input('price') . '"' : '' }}
                                    {{ request()->input('source') ? 'source "' . request()->input('source') . '"' : '' }}
                                @endif
                            @endif
                        </p>
                    </div>
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
                                        <a href="javascript:void(0)" class="wishlist_button"
                                            onclick="jobBookmark({{ $data->id }})">
                                            @php
                                                if (
                                                    auth()
                                                        ->guard('user')
                                                        ->check()
                                                ) {
                                                    $collectionExistsCheck = \App\Models\JobUser::where('job_id', $data->id)
                                                        ->where(
                                                            'user_id',
                                                            auth()
                                                                ->guard('web')
                                                                ->user()->id,
                                                        )
                                                        ->first();
                                                } else {
                                                    $collectionExistsCheck = \App\Models\JobUser::where('job_id', $data->id)
                                                        ->where(
                                                            'user_id',
                                                            auth()
                                                                ->guard('web')
                                                                ->user()->id,
                                                        )
                                                        ->first();
                                                }

                                                if ($collectionExistsCheck != null) {
                                                    // if found
                                                    $heartColor = '#ffffff';
                                                } else {
                                                    // if not found
                                                    $heartColor = 'none';
                                                }
                                            @endphp
                                            <svg id="saveBtn" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="{{ $heartColor }}"
                                                stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-heart">
                                                <path
                                                    d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="content-top">
                                        <div class="content-top-info">
                                            <h4>{{ $data->title }}</h4>
                                            <span class="mt-3">{{ $data->category->title }}</span>
                                            <p>
                                                {!! $data->description !!}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="content-mid">
                                        <ul class="list-unstyled p-0 m-0">
                                            @foreach ($tag as $tagKey => $tagVal)
                                                <li>{{ ucwords($tagVal->title) }} </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="line"></div>

                                    <div class="content-btm">
                                        <a href="{{ route('front.job.details', $data->slug) }}">
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
