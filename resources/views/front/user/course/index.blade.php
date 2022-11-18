@extends('front.layouts.appprofile')
@section('title', 'My Courses')

@section('section')
<section class="edit-sec edit-basic-detail">
    
    <div class="course-content-accordions">
        <div class="course-content-accordions">
            <div class="row mt-2 g-3">
                @forelse ($course as $data)
                    @foreach($data->orderProducts as $courseKey => $courseProduct)
                    <div class="col-12 col-lg-4 col-md-6">
                        <div class="courses-content purchased">
                            <div class="courses-img">
                                @if(!empty($courseProduct->courseName->image))
                                <img src="{{ asset($courseProduct->courseName->image) }}" alt="" class="img-fluid">
                                @endif
                            </div>
                            <div class="courses-info">
                                <div class="courses-badge">
                                    @if (!empty($courseProduct->courseName->category))
                                        @if(!empty($courseProduct->courseName->category->image))
                                            <span>
                                                <img src="{{ asset($courseProduct->courseName->category->image) }}" alt="">
                                                {{ $courseProduct->courseName->category->title }}
                                            </span>
                                        @else
                                            <span>No Category</span>
                                        @endif
                                    @endif
                                </div>
                                <div class="courses-heading">
                                    <h4>{{ $courseProduct->courseName->title ?? ''}}</h4>
                                    <div class="courses-lession-time">
                                        <ul class="list-unstyled p-0 m-0">
                                            <li>
                                                <i class="fa-solid fa-list"></i>
                                                {{ $courseProduct->courseName->language ?? ''}}
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-clock"></i>
                                                {{ countTotalHours($courseProduct->courseName->id ??'') }}
                                            </li>
                                            @php
                                                $totalLessonsAndTopics = totalLessonsAndTopics($courseProduct->courseName->id);
                                            @endphp
                                            <li>
                                                <i class="fa-solid fa-book"></i>
                                                {{ $totalLessonsAndTopics->lesson_count ?? '' }} Lessons
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="courses-desc">
                                    <p>{!! $courseProduct->courseName->short_description ?? ''!!}</p>
                                    <a href="{{route('front.user.courses.details',$courseProduct->courseName->slug)}}" class="course-btn">Start Course</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @empty
                    <p class="text-muted">No Course found</p>
                @endforelse
            </div>
        </div>
    </div>
</section><br>
@endsection