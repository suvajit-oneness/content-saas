@extends('front.layouts.app')
@section('title',' Course')
@section('section')


<section class="courses">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Online Courses</h2>
            </div>
        </div>

       {{--   <div class="row mt-4">
            <div class="col-12">
                <div class="courses-filter">
                    <div class="courses-filter-content">
                        <label for="">Specialization - </label>
                        <select name="" id="">
                            <option value="">All</option>
                            <option value="">Marketing</option>
                        </select>
                    </div>
                    <div class="courses-filter-content">
                        <label for="">Language - </label>
                        <select name="" id="">
                            <option value="">All</option>
                            <option value="">English</option>
                            <option value="">Spanish</option>
                        </select>
                    </div>
                    <div class="courses-filter-content">
                        <label for="">Course - </label>
                        <select name="" id="">
                            <option value="">Free</option>
                            <option value="">Paid</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>--}}

        <div class="row mt-2 g-3">
            @foreach($course as $key => $data)
            <div class="col-12 col-lg-4 col-md-6">
                <div class="courses-content">
                    <div class="courses-img">
                        <img src="{{URL::to('/').'/course/'}}{{$data->image}}" alt="" class="img-fluid">
                    </div>
                    <div class="courses-info">
                        <div class="courses-badge">
                            @if($data->category)
                                <span><img src="{{URL::to('/').'/coursecategories/'}}{{$data->category->image}}" alt=""> {{ $data->category->title }}</span>
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
                                    @php
                                        $totalhrs = 0;
                                        // echo $data->id;
                                        $lessons = App\Models\CourseLesson::where('course_id', $data->id)->get();
                                        foreach($lessons as $l){
                                            // echo $l->id;
                                            $eachtopic = App\Models\LessonTopic::where('lesson_id', $l->id)->get();
                                            foreach ($eachtopic as $key => $value) {
                                                $top = App\Models\Topic::find($value->topic_id);
                                                $totalhrs += $top->video_length;  
                                            } 
                                        }   
                                    @endphp
                                    <li>
                                        <i class="fa-solid fa-clock"></i>
                                        {{$totalhrs}} hours
                                    </li>
                                </ul>
                                <p style="bold">
                                    <span>$</span>{{ $data->price }}
                                </p>
                            </div>
                        </div>

                        <div class="courses-desc">
                            <p>{!! $data->description !!}</p>

                            <a href="{{ route('front.course.details',$data->slug) }}" class="course-btn">Enroll</a>
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
