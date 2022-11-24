@extends('front.layouts.appprofile')
@section('title', ' Course')
@section('section')


    <section class="courses">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Online Courses</h2>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <form action="{{ route('front.course') }}">
                        <div class="courses-filter">
                            <div class="row w-100">
                                <div class="col-3">
                                    <div class="courses-filter-content">
                                        <label for="">Specialization - </label>
                                        <select class="" name="category">
                                            <option value="" selected>All</option>
                                            @foreach ($cat as $index => $item)
                                                <option value="{{$item->slug}}" {{ $item->slug == request()->input('category') ? 'selected' : '' }}>{{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="courses-filter-content">
                                        <label for="">Language - </label>
                                        <select name="language" id="language" class="" value="{{ old('language') }}">
                                            <option value="" selected>All</option>
                                            @foreach ($languages as $l)
                                                <option value="{{ $l->name }}" {{ $l->name == request()->input('language') ? 'selected' : '' }}>{{ $l->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="courses-filter-content">
                                        <label for="">Course - </label>
                                        <select name="type" id="">
                                            <option value="" selected>All</option>
                                            <option value="free" {{request()->input('type') == 'free' ? 'selected' : ''}}>Free</option>
                                            <option value="paid" {{request()->input('type') == 'paid' ? 'selected' : ''}}>Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-right d-flex">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        {{-- <button type="button" onclick="window.location.href = '{{ url()->current() }}'" class="btn btn-primary mx-1" title="Remove filter"><i class="fa fa-times"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-2 g-3">
                @foreach ($course as $key => $data)
                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="courses-content">
                            <div class="courses-img">
                                <img src="{{ asset($data->image) }}" alt="" class="img-fluid">
                            </div>
                            <div class="courses-info">
                                <!-- <div class="courses-badge">
                                    @if ($data->category)
                                        <span><img src="{{ asset($data->category->image) }}" alt="">
                                            {{ $data->category->title }}</span>
                                    @else
                                        <span>No Category</span>
                                    @endif
                                </div> -->
                                <div class="courses-heading">
                                    <h4>{{ $data->title }}</h4>
                                    <div class="courses-lession-time">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <i class="fas fa-language"></i>
                                                {{ $data->language }}
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-clock"></i>
                                                {{ countTotalHours($data->id) }}
                                            </li>
                                            @php
                                                $totalLessonsAndTopics = totalLessonsAndTopics($data->id);
                                            @endphp
                                            <li>
                                                <i class="fa-solid fa-book"></i>
                                                {{ $totalLessonsAndTopics->lesson_count }} Lessons
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="courses-desc">
                                    <p>{!! $data->short_description !!}</p>
                                    {{-- @foreach($data->review as $reviews)
                                        <div class="crs-rating-all">
                                            <span>
                                                {!! RatingHtml($reviews->rating) !!}
                                            </span>
                                            <a href="{{ route('front.course.details', $data->slug) }}">( {{ $reviews->count() }} )</a>
                                        </div>
                                    @endforeach --}}
                                    <div class="price-crs">
                                        <span>{{ $data->price == 0 ? 'Free' : '$ ' . $data->price }}</span>
                                        <a href="{{ route('front.course.details', $data->slug) }}" class="course-btn">Enroll</a>
                                    </div>
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
