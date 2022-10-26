@extends('front.layouts.app')
@section('title', ' Job')
@section('section')

    <section class="course-details-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 col-md-12 mb-3 mb-lg-0">
                    <div class="course-details-left">
                        <div class="theiaStickySidebar">
                            <div class="course-details-left-content">
                                <div class="course-details-main-info">
                                    <h2>{{ $job[0]->title ?? '' }}</h2>
                                    <p>{{ $job[0]->category->title ?? '' }}</p>
                                    <p>Skill : {{ $job[0]->skill ?? '' }}</p>
                                    <p id="all_text" style="display: none;">{!! $job[0]->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-12 mb-3 mb-lg-0">
                    <form action="{{ route('admin.article-category.store') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="name">Name <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                    name="title" id="title" value="{{ old('title',auth()->guard('web')->user()->first_name.' '.auth()->guard('web')->user()->last_name) }}" />
                                @error('title')
                                    {{ $message ?? '' }}
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email">Email<span> </span></label>
                                <input type="text" class="form-control" rows="4" name="email" id="email" value="{{ old('email',auth()->guard('web')->user()->email) }}">
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="mobile">Mobile<span> </span></label>
                                <input type="text" class="form-control" rows="4" name="mobile" id="email" value="{{ old('mobile',auth()->guard('web')->user()->mobile) }}">
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label"> Resume</label>
                                <input class="form-control @error('cv') is-invalid @enderror" type="file"
                                    id="cv" name="cv" />
                                @error('cv')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="course-details-right-btn">
                            <form method="POST" action="{{ route('front.cart.add') }}" class="d-flex" id="addToCartForm">
                                @csrf
                                <input type="hidden" name="course_id" value="">
                                <input type="hidden" name="course_name" value="">
                                <input type="hidden" name="course_image" value="">
                                <input type="hidden" name="author_name" value="">
                                <input type="hidden" name="course_slug" value="">
                                <input type="hidden" name="price" value="">
                                @if (Auth::guard('web')->check())
                                    <button type="submit" id="addToCart__btn" class="course-deails-btn">Apply</button>
                                @else
                                    <a href="{{ route('front.user.login') }}" class="course-deails-btn">Login To
                                        Purchase</a>
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
                    $('#addToCart__btn').attr('disabled', false).removeClass(
                        'missingVariationSelection').html(
                        `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> <span>Add to Cart</span>`
                    );
                    // $('#addToCart__btn').attr('disabled', false).removeClass('missingVariationSelection').text('Add to Cart');
                    $('.wishlist_btn').attr('disabled', false);
                },
            });
        });
    </script>
