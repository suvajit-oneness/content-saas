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
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.expertise.index')}}'">Expertise</th>
                                <th class="table-tab " onclick="location.href='{{ route('front.portfolio.work-experience.index')}}'">Employment History</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.client.index')}}'">Clients</th>
                                <th class="table-tab active" onclick="location.href='{{ route('front.portfolio.education.index')}}'">Education</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.feedback.index')}}'">Feedback </th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.testimonial.index')}}'">Testimonials</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.certification.index')}}'">Certification </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive table-content">
                    <table class="table table-hovered table-striped">
                        <tbody class="tbody-content tbody-content-edit" id="education" style="display:block;">
                                <tr>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.education.create') }}" class="add-btn-edit d-inline-block"  title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                        </div>
                                        @foreach($data->educations as $key=> $item)
                                        <div class="employmentBox">
                                            <div class="action">
                                                <a href="{{ route('front.portfolio.education.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                                <a href="{{ route('front.portfolio.education.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                            </div>
                                            <div class="row">
                                                <div class="col-4 mb-3">
                                                    <label>Degree</label>
                                                    <p>{{ $item->degree }}</p>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>Institution Name</label>
                                                    <p>{{ $item->college_name }}</p>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <label>
                                                        Duration
                                                    </label>
                                                    <p>{{ $item->year_from.' - '.$item->year_to }}</p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label>Percentage</label>
                                                    <p>{{ $item->score }}</p>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label>Url</label>
                                                    <p>{{ $item->link }}</p>
                                                </div>

                                                <div class="col-lg-6 col-12 mb-3">
                                                    <label>Short Description</label>
                                                    <p>{{ $item->short_desc }}</p>
                                                </div>
                                                <div class="col-lg-6 col-12 mb-3">
                                                    <label>Long Description</label>
                                                    <p>{{ $item->long_desc }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

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
