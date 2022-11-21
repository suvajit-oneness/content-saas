@extends('front.layouts.appprofile')
@section('title', 'Topic')

@section('section')
<section class="edit-sec edit-basic-detail">
    <div class="course-content-accordions">
        <div class="col-12 mt-3 mb-3 text-end">
            <a href="{!! URL::to('/user/my-courses'.'/'.$courseData->slug) !!}" class="add-btn-edit d-inline-block secondary-btn"><i
                    class="fa-solid fa-chevron-left"></i> Back</a>
        </div>
        <div class="row mt-2 g-3">
            @foreach ($topic as $key => $data)
            
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="courses-content">
                        <div class="courses-info">
                            <div class="courses-heading">
                                <h4>{{ $data->topic->title }}</h4>
                                <div class="courses-lession-time">
                                    <ul class="list-unstyled p-0 m-0">
                                        
                                        @php
                                            $topic=App\Models\LessonTopic::where('lesson_id',$data->lesson_id)->with('topic')->get();
                                            //dd($topic);
                                        @endphp
                                        <li>
                                            <i class="fa-solid fa-book"></i>
                                            {{ $data->topic->video_length  }} Hour
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>

                            <div class="courses-desc">
                                <p>{!! $data->topic->short_description !!}</p>
                                <a href="{!! URL::to('/user/my-courses/'.$courseData->slug .'/'.$data->lesson->slug.'/'.$data->topic->slug) !!}" class="course-btn">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</section><br>
@endsection