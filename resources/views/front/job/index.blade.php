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
                            <a href="{{ url()->current() }}">
                                <span class="clear-filter"><small>Clear filter</small></span>
                            </a>
                        </div>
                        <div class="jobs-filter-keywords">
                            {{-- <h4>keywords</h4> --}}
                            <input type="text" name="keyword" placeholder="Enter keywords" class="form-control" value="{{ request()->input('keyword') }}" />
                        </div>
                        <div class="jobs-filter-checkbox jobs-filter-employment">
                            <h4>Employment type</h4>

                            {{-- {{ dd(request()->input('employment_type')) }} --}}

                            <div class="checkbox-content">
                                <input type="checkbox" name="employment_type[]" id="fulltime" value="fulltime" {{ request()->input('employment_type') ? (in_array('fulltime', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                {{-- <input type="checkbox" name="employment_type[]" id="fulltime" value="fulltime" {{ request()->input('employment_type') == 'fulltime' ? 'checked' : '' }} /> --}}
                                <label for="fulltime">full time</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="remote" name="employment_type[]" value="remote" {{ request()->input('employment_type') ? (in_array('remote', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="remote">remote</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="freelance" name="employment_type[]" value="freelance" {{ request()->input('employment_type') ? (in_array('freelance', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="freelance">freelance</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="contract" name="employment_type[]" value="contract" {{ request()->input('employment_type') ? (in_array('contract', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="contract">contract</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="parttime" name="employment_type[]" value="parttime" {{ request()->input('employment_type') ? (in_array('parttime', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="parttime">part time</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="telecomute" name="employment_type[]" value="telecomute" {{ request()->input('employment_type') ? (in_array('telecomute', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="telecomute">telecommute</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="temporary" name="employment_type[]" value="temporary" {{ request()->input('employment_type') ? (in_array('temporary', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="temporary">temporary</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="internship" name="employment_type[]" value="internship" {{ request()->input('employment_type') ? (in_array('internship', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="internship">internship</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="unpaid" name="employment_type[]" value="unpaid" {{ request()->input('employment_type') ? (in_array('unpaid', request()->input('employment_type')) ? 'checked' : '') : '' }} />
                                <label for="unpaid">unpaid</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="checkbox" id="unpaid" name="employment_type[]" value="other" {{ request()->input('employment_type') ? (in_array('other', request()->input('employment_type')) ? 'checked' : '') : '' }} />
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
                                <input type="text" name="address" id="remote2" class="form-control" placeholder="Enter location city/state/postcode" />
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
                        <div class="jobs-filter-checkbox job-filter-location">
                            <h4>Salary Estimate</h4>
                            <div class="checkbox-content">
                                <input type="text" name="payment" id="payment" class="form-control" placeholder="$" />
                            </div>
                        </div>
                        <div class="jobs-filter-checkbox job-filter-source">
                            <h4>Source</h4>
                            <div class="checkbox-content">
                                <input type="radio" id="indeed" class="indeed" name="source"
                                    value="indeed" {{ request()->input('source') == 'indeed' ? 'checked' : '' }} />
                                <label for="indeed">indeed</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="problogger" class="problogger" name="source"
                                    value="problogger" {{ request()->input('source') == 'problogger' ? 'checked' : '' }} />
                                <label for="problogger">problogger</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="medabistro" class="medabistro" name="source"
                                    value="medabistro" {{ request()->input('source') == 'medabistro' ? 'checked' : '' }} />
                                <label for="medabistro">mediabistro</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="journalism" class="journalism" name="source"
                                    value="journalism" {{ request()->input('source') == 'journalism' ? 'checked' : '' }}  />
                                <label for="journalism">journalism</label>
                            </div>
                            <div class="checkbox-content">
                                <input type="radio" id="writers" class="writers" name="source" value="writers" {{ request()->input('source') == 'writers' ? 'checked' : '' }} />
                                <label for="writers">writers work</label>
                            </div>
                        </div>

                        <div class="jobs-filter-checkbox job-filter-featured">
                            <h4>featured</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" id="featured" name="featured_flag" value="1" {{ request()->input('featured_flag') == '1' ? 'checked' : '' }} />
                                <label for="featured">show only featured jobs</label>
                            </div>
                        </div>

                        <div class="jobs-filter-checkbox job-filter-beginner-friendly">
                            <h4>beginner friendly</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" id="beginner" name="beginner_friendly" value="1" {{ request()->input('beginner_friendly') == '1' ? 'checked' : '' }}  />
                                <label for="beginner">show only beginner friendly jobs</label>
                            </div>
                        </div>

                        <div class="jobs-filter-checkbox job-filter-beginner-friendly">
                            <h4>Saved jobs</h4>
                            <div class="checkbox-content">
                                <input type="checkbox" id="savedJobs" name="saved_jobs" value="1" {{ request()->input('saved_jobs') == '1' ? 'checked' : '' }}  />
                                <label for="savedJobs">show only saved jobs</label>
                            </div>
                        </div>

                        <div class="job-filter-save">
                            <input type="hidden" name="filter" value="on">
                            <button type="submit" class="btn button">Search</button>


                            {{-- <div class="view-saved-filter-main">
                                <h6>Saved filters</h6>
                                <span>No filters</span>
                                <div class="view-saved-filter-content"></div>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-9 col-md-9">
                <div class="dashboard-featured mt-3">
                    {{-- <div class="page-title best_deal">
                        <p>
                            @if (request()->input('keyword') ||
                                request()->input('employment_type') ||
                                request()->input('address') ||
                                request()->input('salary') ||
                                request()->input('source') ||
                                request()->input('featured_flag') ||
                                request()->input('beginner_friendly'))
                                @if ($job->count() > 0)
                                    Results found for
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
                    </div> --}}
                    <div class="top-info">
                        @if (!request()->input('filter'))
                            <span>Showing all jobs</span>
                        @else
                            @if ($job->count() > 0)
                                <span>Results found.</span>
                            @else
                                <span>No Results found. Please try again with a different filter.</span>
                            @endif
                        @endif
                    </div>
                    <div class="row mt-2 g-2">
                        @foreach ($job as $data)
                            @if (request()->input('featured_flag') == '1')
                                @if ($data->featured_flag == 0)
                                    @continue
                                @endif
                            @endif

                            @if (request()->input('saved_jobs') == '1')
                                @if (!savedJobs($data->id))
                                    @continue
                                @endif
                            @endif
                             @if (interestJobs($data->id))
                             @continue
                             @endif
                             @if (reportJobs($data->id))
                             @continue
                             @endif
                            <div class="col-12 col-lg-6 col-md-12">
                                <div class="recommended-writers-content">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            @if ($data->featured_flag)
                                            <div class="featured-jobs-badge">
                                                <span>featured</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="featured-jobs-badge wishlish">
                                                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0)" class="wishlist_button nav-link" onclick="jobBookmark({{ $data->id }})">
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
                                                                $heartColor = '#cae47f';
                                                            } else {
                                                                // if not found
                                                                $heartColor = '#fff';
                                                            }
                                                        @endphp
                                                        <svg id="saveBtn_{{$data->id}}" fill="{{ $heartColor }}" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="24px" stroke="#000000" stroke-width="2px" ><path d="M23,27l-8-7l-8,7V5c0-1.105,0.895-2,2-2h12c1.105,0,2,0.895,2,2V27z"/></svg>
                                                          Save Job
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        {{-- <a href="javascript:void(0)" class="wishlist_button" onclick="jobInterest({{ $data->id }})"> --}}
                                                            <form id="form" action="{{route('front.job.interest',$data->id)}}" method="POST">@csrf</form>
                                                            <a href="javascript:void(0)"  class="nav-link" onclick="document.getElementById('form').submit()">
                                                        @php
                                                            if (
                                                                auth()
                                                                    ->guard('user')
                                                                    ->check()
                                                            ) {
                                                                $collectionExistsCheck = \App\Models\NotInterestedJob::where('job_id', $data->id)
                                                                    ->where(
                                                                        'user_id',
                                                                        auth()
                                                                            ->guard('web')
                                                                            ->user()->id,
                                                                    )
                                                                    ->first();
                                                            } else {
                                                                $collectionExistsCheck = \App\Models\NotInterestedJob::where('job_id', $data->id)
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
                                                                $heartColor = '#cae47f';

                                                            } else {
                                                                // if not found
                                                                $heartColor = '#fff';
                                                            }
                                                        @endphp
                                                        <svg id="interestBtn_{{$data->id}}" width="24" height="24" viewBox="0 0 24 24" fill="{{ $heartColor }}" role="presentation" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM4 12C4 7.58 7.58 4 12 4C13.85 4 15.55 4.63 16.9 5.69L5.69 16.9C4.63 15.55 4 13.85 4 12ZM12 20C10.15 20 8.45 19.37 7.1 18.31L18.31 7.1C19.37 8.45 20 10.15 20 12C20 16.42 16.42 20 12 20Z" fill="#2d2d2d"></path></svg>
                                                           Not interested
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a type="button" class="wishlist_button nav-link" data-bs-toggle="modal" data-bs-target="#yourModal{{$data->id}}">
                                                        @php
                                                            if (
                                                                auth()
                                                                    ->guard('user')
                                                                    ->check()
                                                            ) {
                                                                $collectionExistsCheck = \App\Models\ReportJob::where('job_id', $data->id)
                                                                    ->where(
                                                                        'user_id',
                                                                        auth()
                                                                            ->guard('web')
                                                                            ->user()->id,
                                                                    )
                                                                    ->first();
                                                            } else {
                                                                $collectionExistsCheck = \App\Models\ReportJob::where('job_id', $data->id)
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
                                                                $heartColor = '#cae47f';
                                                            } else {
                                                                // if not found
                                                                $heartColor = '#fff';
                                                            }
                                                        @endphp

                                                            <svg id="reportBtn_{{$data->id}}" width='24' height='24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M3 3.5a.5.5 0 01.5-.5h9.191a.5.5 0 01.447.276l.724 1.448a.5.5 0 00.447.276H20.5a.5.5 0 01.5.5v10a.5.5 0 01-.5.5h-6.191a.5.5 0 01-.447-.276l-.724-1.448a.5.5 0 00-.447-.276H5v6.5a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5v-17z' fill='#2D2D2D'/></svg>
                                                             Report job
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-top">
                                        <div class="content-top-info">
                                            <h4>{{ $data->title }}</h4>
                                            <span>{{ $data->category->title }}</span>
                                            <p class="small text-muted mt-3 short-desc">{!! $data->short_description !!}</p>
                                            {{-- <p>
                                                {!! $data->description !!}
                                            </p> --}}
                                        </div>
                                    </div>

                                    {!! jobTagsHtml($data->id) !!}

                                    {{-- <div class="content-mid">
                                        <ul class="list-unstyled p-0 m-0">
                                            @foreach ($tag as $tagKey => $tagVal)
                                                <li>{{ ucwords($tagVal->title) }} </li>
                                            @endforeach
                                        </ul>
                                    </div> --}}

                                    <div class="line"></div>

                                    <div class="content-btm">
                                        <a href="{{ route('front.job.details', $data->slug) }}">
                                            get started now
                                            <img src="assets/img/arrow-right-freelance.png" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="yourModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header flex-column align-items-start">
                                            <div class="d-flex align-items-center w-100">
                                                <h5 class="modal-title" id="exampleModalLabel">{{$data->title}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <h6 id="exampleModalLabel">{{$data->company_name}}</h6>
                                        </div>
                                        <form action="{{ route('front.job.report',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="job_id" value="{{$data->id}}">
                                            <div class="modal-body">
                                                <div class="form-group">

                                                    <textarea type="text" class="form-control" rows="4" name="comment" id="comment" placeholder="Describe your problem">{{ old('comment') }}</textarea>

                                                    @error('comment')
                                                        <p class="small text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="submit" class="add-btn-edit d-inline-block">Report</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row justify-content-end mt-4">
                        <div class="col-12 text-end pagination-custom">
                            {{ $job->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
       // job interest

    </script>
@endsection
