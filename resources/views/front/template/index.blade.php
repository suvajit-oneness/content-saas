@extends('front.layouts.appprofile')
@section('title', 'Template')

@section('section')
    <div class="dashboard-content">
        <div class="row">
            <div class="col-12 col-lg-3 col-md-3 mt-3">
                <div class="jobs-filter-content">
                    <form action="{{ route('front.template.index') }}">
                        <div class="jobs-filter-heading">
                            <h6>filter</h6>
                            <a href="{{ url()->current() }}"><span class="clear-filter">clear filter</span></a>
                        </div>
                        <div class="jobs-filter-keywords">
                            <h4>Category</h4>
                            <div class="filterSearchBox">
                                <div class="row">
                                    <div
                                        class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                        <div class="select-floating-admin">
                                            <select class="form-control" name="cat_id">
                                                <option value="" hidden selected>Select Category...</option>
                                                @foreach ($category as $index => $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('cat_id') == $item->id ? 'selected' : '' }}>
                                                        {{ucwords($item->title) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs-filter-keywords">
                            <h4>Sub Category</h4>
                            <div class="filterSearchBox">
                                <div class="row">
                                    <div
                                        class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                        <div class="select-floating-admin">
                                            <select class=" form-control" name="sub_cat_id">
                                                <option value="" hidden selected>Select Subcategory...</option>
                                                @foreach ($subcategory as $index => $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('sub_cat_id') == $item->id ? 'selected' : '' }}>
                                                        {{ucwords($item->title) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs-filter-keywords">
                            <h4>Type</h4>
                            <div class="filterSearchBox">
                                <div class="row">
                                    <div
                                        class="mb-sm-0 col col-lg fcontrol position-relative filter_selectWrap filter_selectWrap2">
                                        <div class="select-floating-admin">
                                            <select class=" form-control" name="type">
                                                <option value="" hidden selected>Select</option>
                                                @foreach ($type as $index => $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ request()->input('type') == $item->title ? 'selected' : '' }}>
                                                        {{($item->title) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs-filter-keywords">
                            <h4>keywords</h4>
                            <input type="text" name="keyword" placeholder="Enter keywords" class="form-control" />
                        </div>
                        <div class="job-filter-save">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-9 col-md-9">
                <div class="dashboard-featured mt-3">
                    <div class="page-title best_deal">
                        <p>
                            {{-- @if (request()->input('keyword') ||
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
                                    {{ request()->input('employment_type') ? 'type "' . request()->input('type') . '"' : '' }}
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
                            @endif --}}
                        </p>
                    </div>
                    <div class="top-info">
                        {{-- <span>recent featured jobs</span> --}}
                        {{-- <a href="" class="show-all">show all</a> --}}
                    </div>
                    <div class="row mt-2 g-2">
                        @foreach ($template as $data)
                            <div class="col-12 col-lg-6 col-md-12">
                                <div class="recommended-writers-content">
                                    <div class="featured-jobs-badge">
                                        <span>featured</span>
                                    </div>
                                    {{-- <div class="featured-jobs-badge">
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
                                    </div> --}}
                                    <div class="content-top">
                                        <div class="content-top-info">
                                            <h4>{{ $data->title }}</h4><br>
                                            {{-- <span class="mt-3">{{ $data->categoryDetails->title ?? ''}}</span><br>
                                            <span class="mt-3">{{ $data->subcategory->title ?? ''}}</span><br>
                                            <span class="mt-3">{{ $data->type->title ?? ''}}</span> --}}
                                            <p>
                                                @if($data->file!='')
                                                <figure class="mt-2" style="width: 80px; height: auto;">
                                                     <a href="{{ asset($data->file) }}" target="_blank">
                                                        <img src="{{asset($data->image)}}" alt="">
                                                    </a>
                                                </figure>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="line"></div>
                                    <div class="content-btm">
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
