@extends('front.layouts.app')
@section('title',' Course')
@section('section')

<section class="course-details-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 col-md-12 mb-3 mb-lg-0">
                <div class="course-details-left">
                    <div class="theiaStickySidebar">
                        <div class="course-details-left-content">
                            <div class="course-details-main-info">
                                <h2>{{ $course->course_name ?? '' }}</h2>
                                <p>{!! $course->description ?? '' !!}</p>
                            </div>

                            <div class="learn">
                                <h5>What you'll learn : </h5>
                                <div class="row g-2">
                                    <div class="col-12 col-md-6">
                                        <span><i class="fa-solid fa-check"></i>
                                            {!! $course->target !!}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="course-content">
                                <h5>Course content : </h5>
                                <ul class="list-unstyled p-0 m-0 course-content-details">
                                    <li>{{ count($topic) }} sections</li>
                                    <li>{{ count($topic) }} lectures</li>
                                    <li>14h 20m total length</li>
                                </ul>

                                <div class="course-content-accordions">
                                    <div class="course-content-accordions">
                                    @foreach($module as $categoryKey => $categoryValue)
                                        <div class="course-content-accor">
                                            <div class="accor-top">
                                                <div class="accor-top-left">
                                                    <i class="fa-solid fa-angle-down"></i>
                                                    <span>{!! $categoryValue->title !!}</span>
                                                </div>
                                                <div class="accor-top-right">
                                                    <div class="duraton">
                                                        <span>{{$categoryValue->duration}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accor-content">
                                                <ul class="list-unstyled p-0 m-0">
                                                @foreach($categoryValue->topic as $key => $data)
                                                    <li><a href=""><div class="d-flex align-items-center"><i class="fa-solid fa-circle-play"></i>{!! $data->topic !!}</div> <span>Preview</span></a></li>
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
                                    <li>{{ $course->requirements }}</li>
                                </ul>
                            </div>

                            <div class="target-market">
                                <h5>Who this course is for :</h5>
                                <p>{!! $course->target !!}</p>
                            </div>

                            <div class="course-certification">
                                <h5>Course Certification : </h5>
                                <form action="">
                                    <div class="form-group">
                                        <input type="radio" id="yes" name="certification" checked>
                                        <label for="yes">Yes</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="no" name="certification">
                                        <label for="no">No</label>
                                    </div>
                                </form>
                            </div>

                            <div class="course-languages">
                                <h5>Language : </h5>
                                <select name="" id="">
                                    <option value="">{{ $course->language }}</option>

                                </select>
                            </div>

                            <div class="about-company">
                                <h5>Company Name : </h5>
                                <span>{{ $course->company_name }}</span>
                                <p>{{ $course->company_description }}</p>

                                <p class="mb-0">Join us on our platform today! </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-md-12 sidebar">
                <div class="theiaStickySidebar">
                    <div class="course-details-right-content">
                        <div class="course-details-video" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="course-details-video-img">
                                <img src="{{ asset('frontend/img/course-video.jpg') }}" alt="">
                            </div>
                            <span><i class="fa-solid fa-play"></i></span>
                            <small>Preview Course</small>
                        </div>
                        <h3 class="course-price">
                            <span>&#8377;</span>{{ $course->price }}
                        </h3>
                       

                        <div class="course-include">
                            <h5>This course includes:</h5>
                            <ul class="list-unstyled p-0 m-0">
                                <li>
                                    <img src="{{ asset('frontend/img/on-demand.png') }}" alt="">
                                    14 hours on-demand video
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/course-file.png') }}" alt="">
                                    1 article
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/download.png') }}" alt="">
                                    3 downloadable resources
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/infinity-access.png') }}" alt="">
                                    Full lifetime access
                                </li>
                                <li>
                                    <img src="{{ asset('frontend/img/trophy.png') }}" alt="">
                                    Certificate of completion
                                </li>
                            </ul>
                        </div>
                        <div class="course-details-right-btn">
                            <form method="POST" action="{{route('front.cart.add')}}" class="d-flex" id="addToCartForm">@csrf
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <input type="hidden" name="course_name" value="{{$course->course_name}}">
                                <input type="hidden" name="course_image" value="{{asset($course->image)}}">
                                <input type="hidden" name="author_name" value="{{$course->author_name}}">
                                <input type="hidden" name="course_slug" value="{{$course->slug}}">
                                <input type="hidden" name="price" value="{{$course->price}}">
                                <button type="submit" id="addToCart__btn" class="course-deails-btn">Add to Cart</button>
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
