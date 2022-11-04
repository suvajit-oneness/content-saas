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
                            <a href="{{ url()->current() }}">
                                <span class="clear-filter"><small>Clear filter</small></span>
                            </a>
                        </div>
                        <div class="jobs-filter-keywords">
                            {{-- <h4>Keywords</h4> --}}
                            <input type="text" name="keyword" placeholder="Enter keywords" class="form-control" value="{{ request()->input('keyword') }}" />
                        </div>
                        <div class="jobs-filter-checkbox jobs-filter-employment">
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
                        <div class="jobs-filter-checkbox jobs-filter-employment">
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
                        <div class="jobs-filter-checkbox jobs-filter-employment">
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
                        <div class="job-filter-save">
                            <input type="hidden" name="filter" value="on">
                            <button type="submit" class="btn button">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-9 col-md-9">
                <div class="dashboard-featured mt-3">

                    <div class="top-info">
                        @if (!request()->input('filter'))
                            <span>Showing all templates</span>
                        @else
                            @if ($template->count() > 0)
                                <span>Results found.</span>
                            @else
                                <span>No Results found. Please try again with a different filter.</span>
                            @endif
                        @endif
                    </div>

                    <div class="row mt-2 g-2">
                        @foreach ($template as $data)
                            <div class="col-12 col-lg-6 col-md-12">
                                <div class="recommended-writers-content">
                                    {{-- <div class="featured-jobs-badge">
                                        <span>featured</span>
                                    </div> --}}
                                    <div class="content-top">
                                        <div class="content-top-info">
                                            <h4 class="mb-2">{{ ucwords($data->title) }}</h4>

                                            <p class="badge bg-success"><small>{{ ucwords($data->categoryDetails->title) }}</small></p>
                                            <p class="badge bg-success"><small>{{ ucwords($data->subcategory->title) }}</small></p>

                                            @if(!empty($data->file))
                                                <a href="{{ asset($data->file) }}" target="_blank">
                                                    <figure class="mt-2" style="width: 100%; height: auto;">
                                                        <img src="{{asset($data->image)}}" alt="" class="w-100">
                                                    </figure>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="line"></div> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row justify-content-end mt-4">
                        <div class="col-12 text-end pagination-custom">
                            {{ $template->appends($_GET)->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
