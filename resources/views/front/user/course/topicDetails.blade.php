@extends('front.layouts.appprofile')
@section('title', 'Topic')

@section('section')
<h3>{{ $topic->title }}</h3>
<section class="edit-sec edit-basic-detail p-0">
    <div class="crs-details lession-details">
        <div class="topic-video">
            <video width="640" height="320" controls id="contentVideo" style="" controlsList="{{$topic->video_downloadable == 0 ? 'nodownload' : '' }}">
                <source src="{{asset($topic->video)}}" type="video/mp4"><i class="fas fa-angle-down">Next</i>
            </video>
        </div>
        <a href="#" onclick="changeTopic(`{{route('front.user.courses.savetopic')}}`)">
            Next
            <i class="fas fa-angle-side"></i>
        </a>
        <input type="hidden" name="topic_id" value="{{ $topic->id}}">
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
                    <p>{!! $topic->description !!}</p>
                </div>
                <div class="tab-pane" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                    <form action="{{ route('front.user.courses.rating.store') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
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
             $totalLessonsAndTopics = totalLessonsAndTopics($courseData->id);
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
                            <a href="{!! URL::to('/user/my-courses/'.$courseData->slug .'/'.$lesson->lesson->slug.'/'.$data->topic->slug) !!}" class="{{ request()->is('$data->topic->slug') ? 'active' : '' }}">
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
@endsection
