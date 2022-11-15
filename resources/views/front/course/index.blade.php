@extends('front.layouts.app')
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
                            <div class="courses-filter-content">
                                <label for="">Specialization - </label>
                                {{-- <select name="" id="">
                            <option value="">All</option>
                            <option value="">Marketing</option>
                        </select> --}}
                                <select class="" name="category_id">
                                    <option value="" hidden selected>Select</option>
                                    @foreach ($cat as $index => $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="courses-filter-content">
                                <label for="">Language - </label>
                                {{-- <select name="" id="">
                            <option value="">All</option>
                            <option value="">English</option>
                            <option value="">Spanish</option>
                        </select> --}}
                                <select name="language" id="language" class="" value="{{ old('language') }}">
                                    <option value="" hidden selected>Select</option>
                                    @foreach ($languages as $l)
                                        <option value="{{ $l->name }}">{{ $l->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="courses-filter-content">
                                <label for="">Course - </label>
                                <select name="is_paid" id="">
                                    <option value="" hidden selected>Select</option>
                                    <option value="0">Free</option>
                                    <option value="1">Paid</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    {{-- <a type="button" href="{{ url()->current() }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Remove filter"><i class="fa fa-times"></i>
                            </a> --}}
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
                                <div class="courses-badge">
                                    @if ($data->category)
                                        <span><img src="{{ asset($data->category->image) }}" alt="">
                                            {{ $data->category->title }}</span>
                                    @else
                                        <span>No Category</span>
                                    @endif
                                </div>
                                <div class="courses-heading">
                                    <h4>{{ $data->title }}</h4>
                                    <div class="courses-lession-time">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <i class="fa-solid fa-list"></i>
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
                                        <p style="bold">
                                            {{ $data->price == 0 ? 'Free' : '$ ' . $data->price }}
                                        </p>
                                    </div>
                                </div>

                                <div class="courses-desc">
                                    <p>{!! $data->short_description !!}</p>
                                    <a href="{{ route('front.course.details', $data->slug) }}" class="course-btn">Enroll</a>
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
