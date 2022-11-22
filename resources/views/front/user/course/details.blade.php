@extends('front.layouts.appprofile')
@section('title')

@section('section')

<section class="edit-sec edit-basic-detail p-0">

    <h3>{{ $course->title }}</h3>
    <p>Course Preview</p>
    <div class="crs-details lession-details">
        <div class="topic-video">
            <video width="640" height="320" controls id="contentVideo" style="" controlsList="{{$course->video_downloadable == 0 ? 'nodownload' : '' }}">
                <source src="{{asset($course->preview_video)}}" type="video/mp4">
            </video>
        </div>
        <div class="topic-desc">
            <!-- <h4>Installing Python</h4>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type</p> -->
            <ul class="nav nav-tabs media-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="#" class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="#" class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" role="tab" aria-controls="comment" aria-selected="true">Comment</a>
                </li>
            </ul>
            <div class="tab-content details-tab">
                <div class="tab-pane active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <p>{!! $course->description !!}</p>
                </div>
                <div class="tab-pane" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                    <form action="{{ route('front.user.courses.rating.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="form-group">
                            <label class="control-label" for="rating"> Rating</label>
                            <div class="star-rating">
                                <input id="star-5" type="radio" name="rating" value="5" />
                                <label for="star-5" title="5 stars">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-4" type="radio" name="rating" value="4" />
                                <label for="star-4" title="4 stars">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-3" type="radio" name="rating" value="3" />
                                <label for="star-3" title="3 stars">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-2" type="radio" name="rating" value="2" />
                                <label for="star-2" title="2 stars">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                                <input id="star-1" type="radio" name="rating" value="1" />
                                <label for="star-1" title="1 star">
                                    <i class="active fa fa-star" aria-hidden="true"></i>
                                </label>
                            </div>
                            @error('rating')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Write a comment</label>
                            <textarea rows="6" name="review" class="form-control"></textarea>
                        </div>
                        <div class="form-group text-left">
                        <button type="submit" class="btn add-btn-edit ms-0 mt-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        @php
             $totalLessonsAndTopics = totalLessonsAndTopics($course->id);
        @endphp

    <div class="lessionSidebar">
        <div class="lessionSidebar-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Course Content
        </div>
        <div class="lessionSidebar-header">
            <p>
                Course Lessions
            </p>
            <a href="javascript:void(0)" class="lessionSidebar-close">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="accordion-container lessionSidebar-list">
            @foreach($totalLessonsAndTopics->lessons as $key => $lesson)
            @php
                $count=App\Models\LessonTopic::where('lesson_id',$lesson->id)->with('topic')->count();

            @endphp
            <div class="set lesstionItem">
                <a href="#">
                    {!! $lesson->lesson->title !!}
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="content">
                    <ul class="topicList">
                        @foreach($totalLessonsAndTopics->topics[$key] as $data)
                        <li>
                            <a href="{!! URL::to('/user/my-courses/'.$course->slug .'/'.$lesson->lesson->slug.'/'.$data->topic->slug) !!}">
                                <input type="checkbox" class="topicCheck">
                                <div class="stamp">
                                    <h5>{!! $data->topic->title  !!}</h5>
                                    <div class="duration">
                                        <i class="fas fa-circle-play"></i>
                                        <span>{{ number_format((float)$data->topic->video_length, 2, ':', '') }} hours</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>

        $(".lessionSidebar-close").on('click', function(){
            $('.lessionSidebar').toggleClass('active')
            setTimeout(() => {
                $('.lessionSidebar-btn').show()
            }, 300);
        })
        $(".lessionSidebar-btn").on('click', function(){
            $('.lessionSidebar').toggleClass('active')
            $(this).hide()
        })

        $(".set > a").on("click", function () {
        console.log("abcd");
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).siblings(".content").slideUp(200);
        } else {
            $(".set > a").removeClass("active");
            $(this).addClass("active");
            $(".content").slideUp(200);
            $(this).siblings(".content").slideDown(200);
        }
        });

    </script>


    <!-- <div class="course-content-accordions lessionSidebar">
        <div class="col-12 mt-3 mb-3 text-end">
            <a href="{!! URL::to('/user/my-courses') !!}" class="add-btn-edit d-inline-block secondary-btn"><i
                    class="fa-solid fa-chevron-left"></i> Back</a>
        </div>
        <div class="row mt-2 g-3">
            @foreach ($lessons as $key => $data)
                <div class="col-12 col-lg-4 col-md-6">
                    <div class="courses-content">
                        <div class="courses-info">
                            <div class="courses-heading">
                                <h4>{{ $data->lesson->title }}</h4>
                                <div class="courses-lession-time">
                                    <ul class="list-unstyled p-0 m-0">

                                        @php
                                            $topic=App\Models\LessonTopic::where('lesson_id',$data->lesson_id)->with('topic')->get();
                                            //dd($topic);
                                        @endphp
                                        <li>
                                            <i class="fa-solid fa-book"></i>
                                            {{ count($topic) }} Topic
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <div class="courses-desc">
                                <p>{!! $data->lesson->description !!}</p>
                                <a href="{!! URL::to('/user/my-courses/'.$data->course->slug .'/'.$data->lesson->slug) !!}" class="course-btn">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div> -->

@endsection
