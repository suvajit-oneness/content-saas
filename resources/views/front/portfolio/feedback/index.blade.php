@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec">
    <div class="container">
        {{-- <div class="row">
            <div class="col-12 text-center top-heading">
                <h2>Manage Portfolio</h2>
            </div>
        </div> --}}
        <div class="row mt-0">
            <div class="col-12 mt-3 mb-3 text-end">
                <a href="{{ route('front.portfolio.index', auth()->guard('web')->user()->slug) }}" class="add-btn-edit d-inline-block" target="_blank">View Public Portfolio <i class="fa-solid fa-eye"></i></a>
            </div>
            <div class="col-12">
                <div class="table-responsive table-tabs">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table-tab" onclick="location.href='{{ route('front.user.portfolio.index')}}'">Basic Details</th>
                                {{-- <th class="table-tab" data-tab-table="portfolio">Portfolio</th> --}}
                                <th class="table-tab " onclick="location.href='{{ route('front.portfolio.portfolio.index')}}'">Portfolio</th>
                                <th class="table-tab " onclick="location.href='{{ route('front.portfolio.expertise.index')}}'">Specialities</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.work-experience.index')}}'">Employment History</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.client.index')}}'">Clients</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.education.index')}}'">Education</th>
                                <th class="table-tab active" onclick="location.href='{{ route('front.portfolio.feedback.index')}}'">Feedback </th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.testimonial.index')}}'">Testimonials</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.certification.index')}}'">Certification </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive table-content">
                    <table class="table table-hovered table-striped">
                        <tbody class="tbody-content tbody-content-edit" id="speciality" style="display:block;">
                                <tr>
                                    <td>
                                        <div class="row mt-2">
                                            <div class="col-12 text-end">
                                                <a href="{{ route('front.portfolio.feedback.create') }}" class="add-btn-edit d-inline-block">Create <i class="fa-solid fa-plus-circle"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row g-3 mt-1">
                                        @foreach($data->feedback as $key=> $item)
                                            <div class="col-12 col-lg-6 col-md-12">
                                                <div class="edit-card">
                                                    <div class="action">
                                                        <a href="{{ route('front.portfolio.feedback.edit', $item->id) }}"><i class="fa-solid fa-pen edit table-icon"></i></a>

                                                        <a href="{{ route('front.portfolio.feedback.delete', $item->id) }}" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                                    </div>
                                                    <div class="date">
                                                        <span>{{ date('j F Y, g:i a', strtotime($item->date_to)) }}</span>
                                                    </div>
                                                    <div class="edit-heading">
                                                        <h4>{{ $item->title }}</h4>
                                                        <h4>  {!! RatingHtml($item->rating) !!}
                                                        </h4>
                                                        <h4>  {{$item->review_person}}
                                                        </h4>
                                                        <p>{{ $item->review }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
