@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <h2>Manage Portfolio</h2>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="table-responsive table-tabs">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="table-tab active" data-tab-table="basic-details">Basic Details</th>
                                    <th class="table-tab" data-tab-table="expertise">Area of Expertise</th>
                                    <th class="table-tab" data-tab-table="education">Education</th>
                                    <th class="table-tab" data-tab-table="work-experience">Work Experience</th>
                                    <th class="table-tab" data-tab-table="portfolio">Portfolio</th>
                                    <th class="table-tab" data-tab-table="client">Client</th>
                                    <th class="table-tab" data-tab-table="certificate">Certification </th>
                                    <th class="table-tab" data-tab-table="testimonial">Testimonials</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive table-content">
                        <table class="table table-hovered table-striped">
                            <tbody class="tbody-content active" id="basic-details">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                             <a href="{{ route('front.portfolio.profile.create', $data->user->slug) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $data->user->first_name.' '.$data->user->last_name }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Headline</td>
                                    <td>{{ $data->user->occupation }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Description</td>

                                    <td>{{ $data->user->short_desc	 }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td><span class="country-name">{{ $data->user->country }}</span></td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social media profiles</td>
                                    <td>
                                    @foreach ($data->socialMedias as $socialMedia)
                                    <a href="{{ $socialMedia->link }}" target="_blank">
                                       {!! $socialMedia->socialMediaDetails ? $socialMedia->socialMediaDetails->icon : '' !!}
                                    </a>
                                    @endforeach
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Favorite Quote</td>
                                    <td><span class="quote-author">{{ $data->user->quote_by }}</span>
                                        <p class="quote-desc">{!! $data->user->quote !!}</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Color Scheme</td>
                                    <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#{{ $data->user->color_scheme }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="quote-author"></span>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Banner Image</td>
                                    @if($data->user->banner_image)
                                    <td> <img src="{{ asset('uploads/user/'.$data->user->banner_image) }}" id="articleImage" class="img-fluid" alt="" width="100" height="100">
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Worked For</td>
                                    <td>{{ $data->user->worked_for }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $data->user->categories }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tbody class="tbody-content" id="expertise">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                             <a type="button" href="{{ route('front.portfolio.expertise.create') }}" class="btn btn-primary" title="Edit Profile">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->specialities as $key=> $item)
                                <tr>
                                    <td>Area of Expertise</td>
                                    <td>{{ $item->specialityDetails->name }}</td>
                                    <td rowspan="4">
                                        <div class="action">
                                            {{-- <i class="fa-solid fa-pen edit table-icon" data-bs-toggle="modal" data-bs-target="#workexperienceEditmodal01"></i> --}}
                                            <a href="{{ route('front.portfolio.expertise.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.expertise.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>

                                    <td>{{ $item->description }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Date</td>
                                    <td class="border-bottom"><span class="date">
                                        {{ date('d', strtotime($item->created_at)) }}
                                    </span>
                                    <span class="month">
                                        {{ date('M', strtotime($item->created_at)) }}
                                    </span>
                                    <span class="year">
                                        {{ date('Y', strtotime($item->created_at)) }}
                                    </span></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tbody class="tbody-content" id="education">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.education.create') }}" class="btn btn-primary"  title="Create">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->educations as $key=> $item)
                                <tr>
                                    <td>Degree</td>
                                    <td>{{ $item->degree }}</td>
                                    <td rowspan="4">
                                        <div class="action">

                                            <a href="{{ route('front.portfolio.education.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.education.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Institution Name</td>
                                    <td>{{ $item->college_name }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Duration</td>

                                    <td>{{ $item->year_from.' - '.$item->year_to }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Percentage</td>

                                    <td>{{ $item->score }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>

                                    <td>{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>

                                    <td>{{ $item->long_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Url</td>

                                    <td class="border-bottom">{{ $item->link }}</td>
                                    <td></td>
                                </tr>

                                @endforeach

                            </tbody>
                            <tbody class="tbody-content" id="work-experience">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.work-experience.create') }}" class="btn btn-primary"  title="Create">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->employments as $key=> $item)
                                <tr>
                                    <td>Designation</td>
                                    <td>{{ $item->occupation }}</td>
                                    <td rowspan="4">
                                        <div class="action">

                                            <a href="{{ route('front.portfolio.work-experience.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.work-experience.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Company Name</td>

                                    <td>{{ $item->company_title }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Duration</td>

                                    <td>{{ $item->year_from.' - '.$item->year_to }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>

                                    <td>{{ $item->phone_number }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Email</td>

                                    <td>{{ $item->email_id }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Owner Name</td>

                                    <td>{{ $item->owner_name }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Manager Name</td>

                                    <td>{{ $item->manager_name }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Url</td>

                                    <td>{{ $item->link }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>

                                    <td>{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Long Description</td>

                                    <td class="border-bottom">{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tbody class="tbody-content" id="portfolio">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.portfolio.create') }}" class="btn btn-primary"  title="Create">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->portfolios as $key=> $item)
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $item->category }}</td>
                                    <td rowspan="4">
                                        <div class="action">
                                            <a href="{{ route('front.portfolio.portfolio.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.portfolio.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Title</td>

                                    <td>{{ $item->title }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tags</td>

                                    <td>{{ $item->tags }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>

                                    <td>{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>

                                    <td>{{ $item->long_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Url</td>

                                    <td>{{ $item->link }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Image</td>

                                    <td class="border-bottom">
                                        @if($item->image)
                                        <td> <img src="{{ asset('uploads/portfolio/'.$item->image) }}" id="articleImage" class="img-fluid" alt="">
                                        </td>
                                        @else
                                        <td></td>
                                        @endif</td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tbody class="tbody-content" id="client">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.client.create') }}" class="btn btn-primary"  title="Create">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->clients as $key=> $item)
                                <tr>
                                    <td>Client Name</td>
                                    <td>{{ $item->client_name }}</td>
                                    <td rowspan="4">
                                        <div class="action">

                                            <a href="{{ route('front.portfolio.client.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.client.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Designation</td>

                                    <td>{{ $item->occupation }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>

                                    <td>{{ $item->phone_number }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Email</td>

                                    <td>{{ $item->email_id }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Url</td>

                                    <td>{{ $item->link }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Description</td>

                                    <td>{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>

                                    <td>{{ $item->long_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Image</td>
                                    @if($item->image)
                                    <td  class="border-bottom"> <img src="{{ asset('uploads/client/'.$item->image) }}" id="articleImage" class="img-fluid" alt="" width="100" height="100">
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tbody class="tbody-content" id="certificate">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.certification.create') }}" class="btn btn-primary"  title="Create">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->certificates as $key=> $item)
                                <tr>
                                    <td>Title</td>
                                    <td>{{ $item->certificate_title }}</td>
                                    <td rowspan="4">
                                        <div class="action">

                                            <a href="{{ route('front.portfolio.certification.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.certification.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Type</td>

                                    <td>{{ $item->certificate_type }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Url</td>

                                    <td>{{ $item->link }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>

                                    <td>{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>

                                    <td>{{ $item->long_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Certificate</td>

                                    <td class="border-bottom">
                                        @if($item->file)
                                        <td> <img src="{{ asset('uploads/certificate/'.$item->file) }}" id="articleImage" class="img-fluid" alt="">
                                        </td>
                                        @else
                                        <td></td>
                                        @endif</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tbody class="tbody-content" id="testimonial">
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.testimonial.create') }}" class="btn btn-primary"  title="Create">Create</a>
                                        </div>
                                    </td>
                                </tr>
                            @foreach($data->testimonials as $key=> $item)
                                <tr>
                                    <td>Client Name</td>
                                    <td>{{ $item->client_name }}</td>
                                    <td rowspan="4">
                                        <div class="action">

                                            <a href="{{ route('front.portfolio.testimonial.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.testimonial.delete', $item->id) }}" title="Delete"><i class="fa-solid fa-trash-can trash table-icon"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Designation</td>

                                    <td>{{ $item->occupation }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>

                                    <td>{{ $item->phone_number }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Email</td>

                                    <td>{{ $item->email_id }}</td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Url</td>

                                    <td>{{ $item->link }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Short Description</td>

                                    <td>{{ $item->short_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Long Description</td>

                                    <td>{{ $item->long_desc }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="border-bottom">Image</td>

                                    <td class="border-bottom">
                                        @if($item->file)
                                        <td> <img src="{{ asset('uploads/testimonial/'.$item->image) }}" id="articleImage" class="img-fluid" alt="">
                                        </td>
                                        @else
                                        <td></td>
                                        @endif</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
            </div>
@endsection

