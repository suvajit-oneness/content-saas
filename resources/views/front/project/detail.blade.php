@extends('front.layouts.appprofile')
@section('title', ' Job')
@section('section')
    <section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="btn btn-secondary" href="{{ route('front.job.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
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
                                    <p>{{ $job[0]->category->title ?? '' }}</p>

                                    {!! $job[0]->description !!}

                                    <p>Skill : {{ $job[0]->skill ?? '' }}</p>
                                    <p>Experience : {{ $job[0]->experience ?? '' }}</p>
                                    <p>Scope : {{ $job[0]->scope ?? '' }}</p>
                                    <p>Address : {{ $job[0]->address ?? '' }}</p>
                                    <p>Postcode : {{ $job[0]->postcode ?? '' }}</p>
                                    <p>City : {{ $job[0]->city ?? '' }}</p>
                                    <p>State : {{ $job[0]->state ?? '' }}</p>
                                    <p>Country : {{ $job[0]->country ?? '' }}</p>
                                    <p>Salary : ${{ number_format($job[0]->payment) ?? '' }} per {{ $job[0]->salary ?? '' }}</p>
                                    {{-- <div><p id="all_text">{!! $job[0]->description !!}</p></div> --}}
                                    <div class="content-mid">
                                        <ul class="list-unstyled p-0 m-0">
                                         @foreach($tag as $tagKey => $tagVal)
                                          <li>{{ ucwords($tagVal->title) }} </li>
                                          @endforeach
                                        </ul>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-12 mb-3 mb-lg-0 border-dark">
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

                    @endif
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
