@extends('front.layouts.appprofile')
@section('title', ' Job')
@section('section')
    <section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.job.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 col-md-12 mb-3 mb-lg-0">
                    <div class="course-details-left">
                        <div class="theiaStickySidebar">
                            <div class="course-details-left-content">
                                <div class="course-details-main-info">
                                    <h2>{{ $job[0]->title ?? '' }}</h2>
                                    <p class="badge tag-badge">{{ $job[0]->category->title ?? '' }}</p>
                                    <!-- <p>
                                            {!! $job[0]->description !!}
                                        </p>
                                        <p>
                                            <b>Skill :</b>
                                            {{ $job[0]->skill ?? '' }}
                                        </p>
                                        <p>
                                            <b>Experience :</b>
                                            {{ $job[0]->experience ?? '' }}
                                        </p>
                                        <p>
                                            <b>Scope :</b>
                                            {{ $job[0]->scope ?? '' }}
                                        </p>
                                        <p>
                                            <b>Address :</b>
                                            {{ $job[0]->address ?? '' }}
                                        </p>
                                        <p>
                                            <b>Postcode :</b>
                                            {{ $job[0]->postcode ?? '' }}
                                        </p>
                                        <p>
                                            <b>City :</b>
                                            {{ $job[0]->city ?? '' }}
                                        </p>
                                        <p>
                                            <b>State :</b>
                                            {{ $job[0]->state ?? '' }}
                                        </p>
                                        <p>
                                            <b>Country :</b>
                                            {{ $job[0]->country ?? '' }}
                                        </p>
                                        <p>
                                            <b>Salary :</b>
                                            ${{ number_format($job[0]->payment) ?? '' }} per {{ $job[0]->salary ?? '' }}
                                        </p> 
                                    -->
                                    <div class="jobsearch-jobDescriptionText">
                                        <p><b>Job description</b></p>
                                        <p><b>Responsibilities</b></p>
                                        <ul>
                                            <li>Develop, record and maintain cutting edge web-based PHP applications on portal plus premium service platforms.</li>
                                            <li>Build innovative, state-of-the-art applications and collaborate with the User Experience (UX) team.</li>
                                            <li>Ensure HTML, CSS, and shared JavaScript is valid and consistent across applications.</li>
                                            <li>Prepare and maintain all applications utilizing standard development tools.</li>
                                            <li>Utilize backend data services and contribute to increase existing data services API.</li>
                                            <li>Lead the entire web application development life cycle right from concept stage to delivery and post launch support.</li>
                                            <li>Convey effectively with all task progress, evaluations, suggestions, schedules along with technical and process issues.</li>
                                            <li>Document the development process, architecture, and standard components.</li>
                                            <li>Coordinate with co-developers and keeps project manager well informed of the status of development effort and serves as liaison between development staff and project manager.</li>
                                            <li>Keep abreast of new trends and best practices in web development.</li>
                                        </ul>
                                        <p><b>Requirements and qualifications</b></p>
                                        <ul>
                                            <li>Previous working experience as a PHP / Laravel developer for 2-3 years.</li>
                                            <li>Degree in Computer Science, Engineering, MIS or similar relevant field.</li>
                                            <li>In depth knowledge of object-oriented PHP and Laravel 5 PHP Framework.</li>
                                            <li>Hands on experience with SQL schema design, SOLID principles, REST API design.</li>
                                            <li>Creative and efficient problem solver.</li>
                                        </ul>
                                        <p><b>Notice period: Immediate joiners preferred</b>.</p>
                                        <p><b>Minimum 2-3 years of Experience Required.</b></p>
                                        <p><b>Educational Qualification: </b> B.E/B.Tech/MCA.</p>
                                        <p><b>Perks and Benefits: </b></p>
                                        <p>1) Provident Fund</p>
                                        <p>2) ESIC/Mediclaim</p>
                                        <p>3) Quarterly Incentives</p>
                                        <p>4) Early Joining Bonus</p>
                                        <p>5) Paid Vacation Leave</p>
                                        <p>6) Five days work in a Week (Monday to Friday).</p>
                                        <p><b>Contact Number: </b> <span class="jobsearch-JobDescription-phone-number"><a href="#MosaicProviderCallToApplyFeedback">+91-XXXXXXXXXX</a></span> (9:30 am - 6:30 pm) Please do not call after business hours</p>
                                        <p><b>Company Website: </b> www.webstep.in</p>
                                        <p><b>About WEBSTEP Technologies: </b></p>
                                        <p>We have started on 9th Dec 2014 and have been successfully working with different Central &amp; State Government Organization in designing and developing their web applications. Our existing Customers includes, West Bengal Power &amp; NES Department, West Bengal Tourism Department, Ministry of Culture -Govt of India, Viswa Bharati University, All India Institute of Speech and Hearing- Mysore, to name a few.</p>
                                        <p>Our success has led to continued expansion in both the range of services we offer and in our global presence with the Sales &amp; Delivery Centre in London, United Kingdom and Houston, Texas, USA.</p>
                                        <p><b>Please Note: </b></p>
                                        <p>We are not associated with any recruitment agency or individuals to collect money in return for a job at WEBSTEP Technologies. WEBSTEP will not be responsible to anyone acting on an employment offer that is not directly made by us.</p>
                                        <p>Anyone making an employment offer in return for money is not authorized by WEBSTEP Technologies. WEBSTEP reserves the right to take legal action against such recruitment agencies or companies or individuals. Please let us know of any instances of unauthorized job offers by writing to HR.</p>
                                        <p>Job Types: Full-time, Regular / Permanent</p>
                                        <p>Salary: ₹15,000.00 - ₹40,000.00 per month</p>
                                        <p>Job Types: Full-time, Regular / Permanent</p>
                                        <p>Salary: ₹15,000.00 - ₹40,000.00 per month</p>
                                        <p><b>Benefits:</b></p>
                                        <ul>
                                            <li>Health insurance</li>
                                            <li>Paid sick time</li>
                                            <li>Provident Fund</li>
                                        </ul>
                                        <p><b>Schedule:</b></p>
                                        <ul>
                                            <li>Day shift</li>
                                            <li>Monday to Friday</li>
                                        </ul>
                                        <p><b>Supplemental pay types:</b></p>
                                        <ul>
                                            <li>Performance bonus</li>
                                            <li>Yearly bonus</li>
                                        </ul>
                                        <p>COVID-19 considerations: Yes.</p>
                                        <p><b>Education:</b></p>
                                        <ul>
                                            <li>Bachelor's (Preferred)</li>
                                        </ul>
                                        <p><b>Experience:</b></p>
                                        <ul>
                                            <li>PHP: 2 years (Preferred)</li>
                                            <li>total work: 2 years (Preferred)</li>
                                        </ul>
                                        <p><b>Speak with the employer</b><br>+91 9876543210</p>
                                    </div>

                                    {{-- <div><p id="all_text">{!! $job[0]->description !!}</p></div> --}}
                                    <div class="content-mid">
                                        <ul class="list-unstyled p-0 m-0">
                                            {!! jobTagsHtml($job[0]->id) !!}
                                        </ul>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-12 mb-3 mb-lg-0 ">
                    <div class="sticky-top apply__job mt-4">
                        @if (!empty($jobApplied))
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#95C800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                </div>

                                <h5 class="text-center mb-2">Thanks for your application</h5>

                                <p class="text-muted small" style="font-size: 13px;line-height: 20px;">You have successfully applied for this job. Please stay put till you hear from us.</p>
                            </div>
                        </div>
                        @else
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('front.job.apply') }}" id="helpForm" method="POST" role="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="job_id" value="{{ $job[0]->id }}">
                                    <div class="tile-body">
                                        <div class="form-group">
                                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger">
                                                    *</span></label>
                                            <input class="form-control @error('title') is-invalid @enderror" type="text"
                                                name="name" id="title"
                                                value="{{ old('title',auth()->guard('web')->user()->first_name .' ' .auth()->guard('web')->user()->last_name) }}" />
                                            @error('title')
                                                {{ $message ?? '' }}
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="control-label" for="email">Email<span> </span></label>
                                            <input type="text" class="form-control" rows="4" name="email" id="email"
                                                value="{{ old('email',auth()->guard('web')->user()->email) }}">
                                            @error('email')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="control-label" for="mobile">Mobile<span> </span></label>
                                            <input type="text" class="form-control" rows="4" name="mobile" id="email"
                                                value="{{ old('mobile',auth()->guard('web')->user()->mobile) }}">
                                            @error('email')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-3">
                                            <label class="control-label">Resume</label>
                                            <input class="form-control @error('cv') is-invalid @enderror" type="file"
                                                id="cv" name="cv" />
                                            @error('cv')
                                                <p class="small text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="job_modal_body_right">
                                        <div class="btn_group course-details-right-btn mt-3">
                                            <button type="submit" class="course-deails-btn" id="saveBtn">Apply Job</button>
                                            {{-- @php
                                                if (auth()->user()) {
                                                    $collectionExistsCheck = \App\Models\ApplyJob::where('job_id', $job[0]->id)
                                                        ->where(
                                                            'user_id',
                                                            auth()
                                                                ->guard('web')
                                                                ->user()->id,
                                                        )
                                                        ->first();
                                                } else {
                                                    $collectionExistsCheck = \App\Models\ApplyJob::where('job_id', $job[0]->id)
                                                        ->where(
                                                            'user_id',
                                                            auth()
                                                                ->guard('web')
                                                                ->user()->id,
                                                        )
                                                        ->first();
                                                }
                                            @endphp
                                            @if ($collectionExistsCheck != null)
                                                <button type="button" class="course-deails-btn disabled">Already Applied</button>
                                            @else
                                                <button type="submit" class="course-deails-btn" id="saveBtn">Apply Job</button>
                                            @endif --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
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
        /*
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
                    $('#addToCart__btn').attr('disabled', false).removeClass(
                        'missingVariationSelection').html(
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> <span>Add to Cart</span>`
                    );
                    // $('#addToCart__btn').attr('disabled', false).removeClass('missingVariationSelection').text('Add to Cart');
                    $('.wishlist_btn').attr('disabled', false);
                },
            });
        });
        */
    </script>
    <script>
        /*
        function jobApply(collectionId) {
            $.ajax({
                {{-- url: '{{ route('front.job.store') }}',--}}
                method: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    id: collectionId,
                    cv: $('#helpForm input[name="cv"]').val().replace(/C:\\fakepath\\/i, ''),
                },
                success: function(result) {
                    // alert(result);
                    if (result.type == 'add') {
                        toastr.success(result.message);
                        $('#saveBtn').attr('fill', '#ff0000');
                    } else {
                        toastr.error(result.message);
                        $('#saveBtn').attr('fill', '#000000');
                    }
                }

            });
        }
        */
    </script>
@endpush
