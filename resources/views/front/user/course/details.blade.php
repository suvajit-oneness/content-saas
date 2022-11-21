@extends('front.layouts.appprofile')
@section('title', 'Lesson')

@section('section')
<section class="edit-sec edit-basic-detail py-0">
    <div class="crs-details">

    </div>
    <div class="course-content-accordions lessionSidebar">
        <div class="lessionSidebar-header">
            <p>
                Course Lessions
            </p>
            <a href="javascript:void(0)">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="accordion-container lessionSidebar-list">
            <div class="set lesstionItem">
                <a href="#">
                    Lession 1
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="content">
                    <ul class="topicList">
                        <li>
                            <a href="#">
                                <input type="checkbox" class="topicCheck">
                                <div class="stamp">
                                    <h5>Topc 1</h5>
                                    <div class="duration">
                                        <i class="fas fa-play"></i>
                                        <span>9 min</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <input type="checkbox" class="topicCheck">
                                <div class="stamp">
                                    <h5>Topc 1</h5>
                                    <div class="duration">
                                        <i class="fas fa-play"></i>
                                        <span>9 min</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="set lesstionItem">
                <a href="#">
                    Lession 2
                    <i class="fas fa-angle-down"></i>
                </a>
                <div class="content">
                    <ul class="topicList">
                        <li>
                            <a href="#">
                                <input type="checkbox" class="topicCheck">
                                <div class="stamp">
                                    <h5>Topc 1</h5>
                                    <div class="duration">
                                        <i class="fas fa-play"></i>
                                        <span>9 min</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <input type="checkbox" class="topicCheck">
                                <div class="stamp">
                                    <h5>Topc 1</h5>
                                    <div class="duration">
                                        <i class="fas fa-play"></i>
                                        <span>9 min</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        
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
</section>
@endsection