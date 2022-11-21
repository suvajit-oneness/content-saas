@extends('front.layouts.appprofile')
@section('title',' Course')
@section('section')

<section class="course-details-section">
    <div class="container">
        <div class="row mt-0">
        <div class="col-12 mt-3 mb-3 text-end">
            <a href="{{ route('front.course') }}" class="add-btn-edit d-inline-block secondary-btn"><i
                class="fa-solid fa-chevron-left"></i> Back</a>
        </div>
            <div class="col-12 col-lg-8 col-md-12 mb-3 mb-lg-0">
                <div class="course-details-left">
                    <div class="theiaStickySidebar">
                        <div class="course-details-left-content">
                            <div class="course-details-main-info">
                                <h2>{{ $course->title ?? '' }}</h2>
                                <p id="less_text">{!! substr($course->description,0,150) ?? '' !!}...<span style="font-size: 10px"><a onclick="$('#less_text').hide(); $('#all_text').show();" href="javascript:void(0)">See More</a></span></p>
                                <p id="all_text" style="display: none;">{!! $course->description !!}</p>
                            </div>

                            <div class="learn">
                                <h5>What you'll learn : </h5>
                                @foreach (explode(',',$course->course_content) as $item)
                                    <div class="row g-2">
                                        <div class="col-12 col-md-6">
                                            <span><i class="fa-solid fa-check"></i>
                                                {{ $item }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- <div style="display: flex;align-items: flex-start;border:1px solid rgb(209, 212, 219);border-radius:10px;padding: 16px 20px 20px;margin-top: 20px;">
                                <div style="margin-right: 20px;">
                                    <span style="display: flex;align-items: center;justify-content: center; width:32px;height:32px;border-radius: 50%;background-color: rgb(255, 100, 45);color: #ffffff;">1</span>
                                </div>
                                <div style="width: 80%">
                                    <h4>Introduction - Course Overview and What You’ll Learn</h4>
                                    <p>In this lesson, you’ll gain a better understanding of GA4 and discover why migrating to Google Analytics’ new website tracking software should be a top priority.</p>
                                </div>
                                <div style="margin-left: auto">
                                    <p>1 video</p>
                                    <p>4 minues</p>
                                </div>
                            </div> --}}

                            <div class="course-content">
                                <h5>Course content : </h5>
                                @php
                                    $totalLessonsAndTopics = totalLessonsAndTopics($course->id);
                                @endphp
                                <ul class="list-unstyled p-0 m-0 course-content-details">
                                    <li>{{ $totalLessonsAndTopics->lesson_count }} Lessons</li>
                                    <li>{{ $totalLessonsAndTopics->topic_count }} Topics</li>
                                    <li>{{ countTotalHours($course->id)}} total length</li>
                                </ul>

                                <div class="course-content-accordions">
                                    <div class="course-content-accordions">
                                    @foreach($totalLessonsAndTopics->lessons as $key => $lesson)
                                        <div class="course-content-accor">
                                            <div class="accor-top">
                                                <div class="accor-top-left">
                                                    <i class="fa-solid fa-angle-down"></i>
                                                    <span>{!! $lesson->lesson->title !!}</span>
                                                </div>
                                                {{-- <div class="accor-top-right">
                                                    <div class="duraton">
                                                        <span></span>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="accor-content">
                                                <ul class="list-unstyled p-0 m-0">
                                                @foreach($totalLessonsAndTopics->topics[$key] as $data)
                                                    @if(Auth::guard('web')->check())
                                                        @if(CheckIfUserBoughtTheCourse($course->id, Auth::guard('web')->user()->id))
                                                            <li><a href=""><div class="d-flex align-items-center"><i class="fa-solid fa-circle-play"></i>{!! $data->topic->title  !!} ({{ number_format((float)$data->topic->video_length, 2, ':', '') }} hours)</div><span onclick="playVideo('{{asset($data->topic->video)}}')">Watch Full video <i class="fa-solid fa-circle-play"></i></span></a></li>
                                                        @else
                                                            <li><a href=""><div class="d-flex align-items-center"><i class="fa-solid fa-circle-play"></i>{!! $data->topic->title  !!} ({{ number_format((float)$data->topic->video_length, 2, ':', '') }} hours)</div><span onclick="playVideo('{{asset($data->topic->preview_video)}}')">Preview <i class="fa-solid fa-circle-play"></i></span></a></li>
                                                        @endif
                                                    @else
                                                        <li><a href=""><div class="d-flex align-items-center"><i class="fa-solid fa-circle-play"></i>{!! $data->topic->title  !!} ({{ number_format((float)$data->topic->video_length, 2, ':', '') }} hours)</div><span onclick="playVideo('{{asset($data->topic->preview_video)}}')">Preview <i class="fa-solid fa-circle-play"></i></span></a></li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="requirements">
                                <h5>Course Requirements : </h5>
                                <ul class="list-unstyled p-0 m-0">
                                    @foreach (explode(',',$course->requirements) as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="target-market">
                                <h5>Who is this course for :</h5>
                                <p>{!! $course->target !!}</p>
                            </div>

                            <div class="course-certification">
                                <h5>Course Certification : </h5>
                                @if($course->certificate == 1)
                                    <p> &#x2611; Yes </p>
                                @else
                                    <p> &#8594; No </p>
                                @endif
                            </div>

                            <div class="course-languages">
                                <h5>Language : </h5>
                                <p>&#x2611; {{ $course->language }}</p>
                            </div>

                            <div class="about-company">
                                <h5>Company Name : </h5>
                                <span>{{ $course->company_name }}</span>
                                <p>{{ $course->company_description }}</p>

                                <p class="mb-0">Join us on our platform today! </p>
                            </div>
                            <hr>
                            @if(!empty($course->author_image))
                            <div class="row">
                                <div class="col-md-3">
                                    <div style="border-radius:10px;background-color:rgb(69, 224, 168);overflow:hidden;">
                                        <img src="{{asset($course->author_image)}}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h4>{{$course->author_name}}</h4>
                                    <p>{!!$course->author_description !!}</p>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal to open video --}}
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Video</h5>
                            <p class="close btn btn-success" style="float:right" onclick="$('#videoModal').modal('hide')">&times;</p>
                        </div>
                        <div class="modal-body">
                            <video id="videoplace" autoplay muted controls width="100%" height="350" src=""></video>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Video Modal Ends --}}

            <div class="col-12 col-lg-4 col-md-12 sidebar">
                <div class="theiaStickySidebar">
                    <div class="course-details-right-content">
                        <div class="course-details-video" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="course-details-video-img">
                                {{-- <video src="{{asset($course->preview_video)}}"></video> --}}
                                <img src="{{asset($course->image)}}" alt="">
                            </div>
                            <span onclick="playVideo('{{asset($course->preview_video)}}')"><i class="fa-solid fa-play"></i></span>
                            <small>Preview Course</small>
                        </div>
                        <h3 class="course-price">
                            <span>$</span>{{ $course->price }}
                        </h3>


                        <div class="course-include">
                            <h5>This course includes:</h5>
                            <ul class="list-unstyled p-0 m-0">
                                <li>
                                    <img src="{{ asset('frontend/img/on-demand.png') }}" alt="">
                                    {{ countTotalHours($course->id)}} on-demand video
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/course-file.png') }}" alt="">
                                    {{ $totalLessonsAndTopics->lesson_count }} Lessons {{ $totalLessonsAndTopics->topic_count }} Topics
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/download.png') }}" alt="">
                                    {{ $totalLessonsAndTopics->total_downloadable_contents }} downloadable resources
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/infinity-access.png') }}" alt="">
                                    Full lifetime access
                                </li>
                                @if($course->certificate == 1)
                                <li>
                                    <img src="{{ asset('frontend/img/trophy.png') }}" alt="">
                                    Certificate of completion
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="course-details-right-btn">
                            <form method="POST" action="{{route('front.cart.add')}}" class="d-flex" id="addToCartForm">@csrf
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <input type="hidden" name="course_name" value="{{$course->title}}">
                                <input type="hidden" name="course_image" value="{{asset($course->image)}}">
                                <input type="hidden" name="author_name" value="{{$course->company_name}}">
                                <input type="hidden" name="course_slug" value="{{$course->slug}}">
                                <input type="hidden" name="price" value="{{$course->price}}">
                                <input type="hidden" name="purchase_type" value="course">
                                @if(Auth::guard('web')->check())
                                    @if(!CheckIfUserBoughtTheCourse($course->id, Auth::guard('web')->user()->id))
                                        <button type="submit" id="addToCart__btn" class="course-deails-btn">Add to Cart</button>
                                    @else
                                        <button type="button" class="course-deails-btn disabled">Already Purchased</button>
                                    @endif
                                @else
                                    <a href="{{route('front.user.login')}}" class="course-deails-btn">Add to Cart</a>
                                @endif
                            </form>
                            {{-- <a href="" class="course-deails-btn">Add to cart</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function playVideo(videoUrl) {
        event.preventDefault();
        $('#videoModal').modal('show');
        // $('#videoplace').attr('src', window.location.origin + '/' + videoUrl);
        $('#videoplace').attr('src', videoUrl);
    }

    // add to cart ajax
	$('#addToCartForm').on('submit', function(e) {
		e.preventDefault();
		var data = $(this).serialize();
		$.ajax({
			url: $(this).attr('action'),
			method: $(this).attr('method'),
			data: data,
			beforeSend: function() {
				$('#addToCart__btn').addClass('missingVariationSelection').text('Adding to Cart');
			},
			success: function(result) {
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 2000,
					// timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer)
						toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				})
				if (result.status == 200) {
					Toast.fire({
					  icon: 'success',
					  title: result.message
					})
					$('#cart-count').text(result.response).removeClass('d-none');
				} else {
					Toast.fire({
					  icon: 'error',
					  title: result.message
					})
				}
				$('#addToCart__btn').attr('disabled', false).removeClass('missingVariationSelection').html(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> <span>Add to Cart</span>`);
				// $('#addToCart__btn').attr('disabled', false).removeClass('missingVariationSelection').text('Add to Cart');
				$('.wishlist_btn').attr('disabled', false);
			},
		});
	});
</script>
