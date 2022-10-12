@extends('front.layouts.app')

@section('title', $data->user->first_name.' '.$data->user->last_name.' Portfolio')

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/dist/assets/owl.theme.default.min.css') }}">
@endsection

@section('section')
<section class="portfolio-v4-banner" style="background: linear-gradient({{$data->user->color_scheme}}, #d9d9d900), url({{ asset($data->user->banner_image) }}) no-repeat;background-size: cover;"></section>

<section class="portfolio-v4-info">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-2 col-md-12 mb-4 mb-md-0 portfolio-v4-info-left">
                <div class="img">
                    <img src="{{ asset($data->user->image) }}" alt="" />
                </div>
            </div>

            <div class="col-12 col-lg-8 col-md-12 portfolio-v4-info-right">
                <h2>{{ $data->user->first_name.' '.$data->user->last_name }}</h2>
                <div class="portfolio-v4-info-flex">
                    <h5>{{$data->user->occupation}}</h5>
                    <div class="country">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>{{$data->user->country}}</span>
                    </div>
                </div>
                <p>
                    {{$data->user->short_desc}}
                </p>

                @if($data->socialMedias)
                <div class="socials">
                    @foreach ($data->socialMedias as $socialMedia)
                        <a href="{{ $socialMedia->link }}" target="_blank">
                            {!! $socialMedia->socialMediaDetails ? $socialMedia->socialMediaDetails->icon : '' !!}
                        </a>
                    @endforeach
                </div>
                @endif

                <div class="language">
                    <span>Language</span>
                </div>
                @if($data->languages)
                <div class="view-lang">
                    <ul class="list-unstyled p-0 m-0">
                        @foreach ($data->languages as $language)
                            <li>{!! $language->languageDetails ? $language->languageDetails->name : '' !!}</li>
                        @endforeach
                    </ul>
                </div>
                @else
                <p class="small">No languages found</p>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="portfolio-v4-category">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list-unstyled p-0 m-0">
                    <li class="portv4-tab port-tab active" data-port="portfolio">
                        Portfolio
                    </li>
                    <li class="portv4-tab port-tab" data-port="specialities">
                        Specialities
                    </li>
                    <li class="portv4-tab port-tab" data-port="worked-for">
                        Who I&apos;ve Worked For
                    </li>
                    <li class="portv4-tab port-tab" data-port="categories">
                        Categories
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-1 gx-3 gy-5">
            @forelse ($data->portfolios as $portfolio)
            <div class="col-12 col-lg-4 col-md-6 portfolio-links-item active" id="portfolio">
                <div class="market-research-content">
                    <div class="img">
                        <a href="{{ $portfolio->link }}" class="research-link" target="_blank"><img src="{{ asset($portfolio->image) }}" alt="" /></a>
                    </div>
                    <div class="market-research-date">
                        <div class="market-research-badge">
                            <span>{{ $portfolio->category }}</span>
                        </div>
                        <h6>{{ date('j M, Y', strtotime($portfolio->created_at)) }}</h6>
                    </div>
                    <div class="marker-research-info">
                        <a href="{{ $portfolio->link }}" class="research-link">{{$portfolio->title}}</a>
                        <p>{{$portfolio->short_desc}}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-lg-4 col-md-6 portfolio-links-item">
                {{-- <div class="market-research-content"> --}}
                    <p class="small text-light">No portfolio found</p>
                {{-- </div> --}}
            </div>
            @endforelse

            @forelse ($data->specialities as $speciality)
            <div class="col-12 col-lg-4 col-md-6 portfolio-links-item" id="specialities">
                <div class="market-research-content">
                    {{-- <div class="img">
                        <a href="" class="research-link"><img src="{{ asset($speciality->image) }}" alt="" /></a>
                    </div> --}}
                    <div class="market-research-date">
                        {{-- <div class="market-research-badge">
                            <span>{{ $speciality->specialityDetails->name }}</span>
                        </div> --}}
                        <h6>{{ date('j M, Y', strtotime($speciality->created_at)) }}</h6>
                    </div>
                    <div class="marker-research-info">
                        <a href="" class="research-link">{{ ucwords($speciality->specialityDetails->name) }}</a>
                        <p>{{$speciality->description}}</p>
                        {{-- <p>{{$speciality->specialityDetails->short_desc}}</p> --}}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 col-lg-4 col-md-6 portfolio-links-item">
                {{-- <div class="market-research-content"> --}}
                    <p class="small text-light">No speciality found</p>
                {{-- </div> --}}
            </div>
            @endforelse

            @if ($data->user->worked_for)
                @foreach (explode(', ', $data->user->worked_for) as $worked_for)
                <div class="col-12 col-lg-4 col-md-6 portfolio-links-item" id="worked-for">
                    <div class="market-research-content">
                        <div class="marker-research-info mt-0">
                            <a href="" class="research-link">{{ ucwords($worked_for) }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="col-12 col-lg-4 col-md-6 portfolio-links-item">
                <p class="small text-light">No work details found</p>
            </div>
            @endif

            @if ($data->user->categories)
                @foreach (explode(', ', $data->user->categories) as $category)
                <div class="col-12 col-lg-4 col-md-6 portfolio-links-item" id="categories">
                    <div class="market-research-content">
                        <div class="marker-research-info mt-0">
                            <a href="" class="research-link">{{ ucwords($category) }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="col-12 col-lg-4 col-md-6 portfolio-links-item">
                <p class="small text-light">No categories found</p>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- emplyment --}}
<section class="porfolio-v4-employement">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 m-auto">
                <div class="porfolio-v4-employement-content portfolio-v4-content">
                    <div class="portfolio-v4-content-header">
                        <h3>Employment History</h3>
                    </div>

                    @if(count($data->employments) > 0)
                    <div class="portfolio-v4-content-body">
                        @foreach ($data->employments as $employment)
                        <div class="portfolio-v4-content-list">
                            <h4>{{$employment->occupation}} | {{$employment->company_title}}</h4>
                            <span class="badge"> {{$employment->year_from}} - {{$employment->year_to}} </span>
                            <p>{{$employment->short_desc}}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="portfolio-v4-education-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="small">No employment found</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- clients --}}
<section class="porfolio-v4-employement porfolio-v4-client">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 m-auto">
                <div class="porfolio-v4-client-content portfolio-v4-content">
                    <div class="portfolio-v4-content-header">
                        <h3>Manage Clients</h3>
                        <div class="add-client-btn">

                        </div>
                    </div>

                    @if(count($data->clients) > 0)
                    <div class="portfolio-v4-content-body">
                        @foreach ($data->clients as $client)
                        <div class="portfolio-v4-content-list">
                            <div class="portfolio-v4-client-flex">
                                <img src="{{ asset('uploads/client/'.$client->image) }}" alt="" width="100" height="100" />
                                <div class="portfolio-v4-client-info">
                                    <h4>{{$client->client_name}}</h4>
                                    <span>{{$client->occupation}}</span>
                                    <p class="mb-0">{{$client->short_desc}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="portfolio-v4-education-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="small">No clients found</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- education --}}
<section class="porfolio-v4-employement porfolio-v4-education">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 m-auto">
                <div class="porfolio-v4-education-content portfolio-v4-content">
                    <div class="portfolio-v4-content-header">
                        <h3>Education</h3>
                        <div class="add-client-btn">

                        </div>
                    </div>

                    @if(count($data->educations) > 0)
                    <div class="portfolio-v4-education-body">
                        <div class="row g-3">
                            @foreach ($data->educations as $education)
                            <div class="col-12 col-lg-4 col-md-6">
                                <div class="portfolio-v4-education-info">
                                    <h4> {{$education->college_name}} </h4>
                                    <span class="designation">{{$education->degree}}</span>
                                    <span class="year">Year {{$education->year_from}} - {{$education->year_to}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="portfolio-v4-education-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <p class="small">No education found</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- rating --}}
<section class="porfolio-v4-employement porfolio-v4-feedback-rating">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 m-auto">
                <div class="porfolio-v4-education-content portfolio-v4-content">
                    <div class="portfolio-v4-content-header">
                        <h3>Feedback Rating</h3>
                        {{-- <div class="add-client-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div> --}}
                    </div>

                    <div class="portfolio-v4-content-body">
                        @foreach($data->feedback as $key => $item)
                        <div class="portfolio-v4-rating-list">

                            <div class="portfolio-v4-rating-flex">
                                <span>{{ $item->date_from.' - '.$item->date_to }}</span>
                                <div class="rating-list-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <h4>{{ $item->title }}</h4>
                            <p>{{ $item->description }}</p>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- testimonial --}}
<section class="porfolio-v4-employement porfolio-v4-testimonials">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 m-auto">
                <div class="porfolio-v4-testimonial-content portfolio-v4-content">
                    <div class="portfolio-v4-content-header">
                        <h3>Testimonials</h3>
                        <div class="add-client-btn" data-bs-toggle="modal" data-bs-target="#exampleModal2">

                        </div>
                    </div>

                    @if (count($data->testimonials) > 0)
                    <div class="portfolio-v4-testimonials-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="owl-carousel owl-theme portfolio-v4-testimonials">
                                    @foreach ($data->testimonials as $testimonial)
                                    <div class="item">
                                        <div class="port-v4-testi-content">
                                            <img src="{{ asset($testimonial->image) }}" alt="">
                                            <h4>{{$testimonial->client_name}}</h4>
                                            <span>-{{$testimonial->occupation}}</span>
                                            <p>{{$testimonial->short_testimonial}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="portfolio-v4-testimonials-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="small">No testimonials yet</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- certification --}}
<section class="porfolio-v4-employement porfolio-v4-certification">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 m-auto">
                <div class="porfolio-v4-certification-content portfolio-v4-content">
                    <div class="portfolio-v4-content-header">
                        <h3>Certification</h3>
                        <div class="add-client-btn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal3">

                        </div>
                    </div>

                    @if (count($data->certificates) > 0)
                    <div class="portfolio-v4-testimonials-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="owl-carousel owl-theme portfolio-v4-testimonials">
                                    @foreach ($data->certificates as $certificate)
                                    <div class="item">
                                        <div class="port-v4-testi-content port-v4-certi-content">
                                            <img src="{{ asset('uploads/certificate/'.$certificate->file) }}" alt="">
                                            <h4>{{$certificate->certificate_title}}</h4>
                                            <span>-{{$certificate->certificate_type}}</span>
                                            <p>{{$certificate->short_desc}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="portfolio-v4-testimonials-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="small">No certificates yet</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- contact me --}}
<section class="portfolio-v4-newsletter">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 col-md-8 m-auto">
                <div class="portfolio-v4-newsletter-content">
                    <img src="assets/img/newsletter-img-portv4.png.png" alt="">
                    <h2>contact me</h2>
                    <p>{{ $data->user->email }}</p>
                    <p>Sign up to our newsletter to receive the latest updates</p>
                    <form action="">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Your e-mail address..">
                            <button type="submit"><i class="fa-brands fa-telegram"></i> Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal-rating">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a Rating</h5>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating-info mt-3">
                        <h5>Lorem ipsum dolor sit.</h5>
                        <ul class="list-unstyled p-0 m-0">
                            <li>
                                <div class="stars reviews-stars">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="star-name">
                                    <span>reviews</span>
                                </div>
                            </li>
                            <li>
                                <div class="stars ratings-stars">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="star-name">
                                    <span>ratings</span>
                                </div>
                            </li>
                            <li>
                                <div class="stars course-completed-stars">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="star-name">
                                    <span>no. of course completed</span>
                                </div>
                            </li>
                            <li>
                                <div class="stars activity-stars">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="star-name">
                                    <span>activity</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="rating-score">
                        <h5>Total Score: <span class="score">0</span></h5>
                    </div>
                    <div class="rating-feedback-form">
                        <h4>
                            Share your experience with this client to the community:
                        </h4>
                        <form action="">
                            <textarea name="" id="" cols="30" rows="6" class="form-control"></textarea>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-testimonial">
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add Testimonial
                    </h5>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group mb-2">
                            <label for="">Name</label>
                            <input type="text" class="form-control" placeholder="Ex..John Doe" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Designation</label>
                            <input type="text" class="form-control" placeholder="Ex..Writer" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Upload Image</label>
                            <input type="file" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Message</label>
                            <textarea name="" id="" cols="30" rows="6" class="form-control"
                                placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit">Add Testimonials</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-certification">
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add Certification
                    </h5>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="" id="" class="form-control">
                        <option value="">Select a Certication</option>
                        <option value="">Google Digital Bootcamps</option>
                        <option value="">Surfer SEO certificate</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="add-custom" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#exampleModal4">
                        Add a custom certification
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-certification custom-certification">
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add a custom certification
                    </h5>
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="">Certification Name</label>
                                    <input type="text" class="form-control" placeholder="Ex..." />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="">Provider</label>
                                    <input type="text" class="form-control" placeholder="Ex..." />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="">Designation</label>
                                    <textarea name="" id="" cols="30" rows="6" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">Issue Date</label>
                                    <input type="date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">Expiration Date</label>
                                    <input type="date" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label for="">Certification Id(Optional)</label>
                                    <input type="text" class="form-control" placeholder="Ex..." />
                                </div>
                            </div>

                            <div class="col-12 add-custom-certification">
                                <button type="">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
            <button class="add-custom" data-bs-dismiss="modal">Add a custom certification</button>
          </div> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('frontend/dist/owl.carousel.min.js') }}"></script>
@endsection