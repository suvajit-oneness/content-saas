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
                                <th class="table-tab active" data-tab-table="basic-details">Basic Details</th>
                                <th class="table-tab" data-tab-table="portfolio">Portfolio</th>
                                <th class="table-tab" data-tab-table="speciality">Speciality</th>
                                <th class="table-tab" data-tab-table="employment-history">Employment History</th>
                                <th class="table-tab" data-tab-table="client">Clients</th>
                                <th class="table-tab" data-tab-table="education">Education</th>
                                <th class="table-tab" data-tab-table="testimonial">Testimonials</th>
                                <th class="table-tab" data-tab-table="certificate">Certification </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive table-content">
                    <table class="table table-hovered table-striped">
                        <tbody class="tbody-content active tbody-content-edit" id="basic-details">
                            {{-- <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="action">
                                        <a type="button" href="{{ route('front.user.portfolio.manage.basic-details.edit', auth()->guard('web')->user()->slug) }}" class="btn btn-primary" title="Edit Profile">Edit</a>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>
                                    <div class="row mt-2">
                                        <div class="col-12 text-end">
                                            <a href="{{ route('front.user.portfolio.manage.basic-details.edit', auth()->guard('web')->user()->slug) }}" class="add-btn-edit d-inline-block">Edit <i class="fa-solid fa-edit"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><img src="{{ asset(auth()->guard('web')->user()->image) }}" alt="image" height="100"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Banner Image</td>
                                @if(auth()->guard('web')->user()->banner_image)
                                    <td> <img src="{{ asset(auth()->guard('web')->user()->banner_image) }}" id="articleImage" class="img-fluid" alt="" width="100" height="100">
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td></td>
                            </tr>
                            <tr>
                                <td>Color Scheme</td>
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{ auth()->guard('web')->user()->color_scheme }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg><span class="quote-author"></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ auth()->guard('web')->user()->first_name.' '.auth()->guard('web')->user()->last_name }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Headline</td>
                                <td>{{ auth()->guard('web')->user()->occupation }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Description</td>

                                <td>{{ auth()->guard('web')->user()->short_desc	 }}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td><span class="country-name">{{ auth()->guard('web')->user()->country }}</span></td>
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
                                <td><span class="quote-author">{{ auth()->guard('web')->user()->quote_by }}</span>
                                    <p class="quote-desc">{!! auth()->guard('web')->user()->quote !!}</p>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Worked For</td>
                                <td>{{ auth()->guard('web')->user()->worked_for }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>{{ auth()->guard('web')->user()->categories }}
                                </td>
                                <td></td>
                            </tr>
                        </tbody>



                        <tbody class="tbody-content tbody-content-edit" id="portfolio">
                            <tr>
                                <td>
                                    <div class="row mt-2">
                                        <div class="col-12 text-end">
                                            <a href="{{ route('front.portfolio.portfolio.create') }}" class="add-btn-edit d-inline-block">Add <i class="fa-solid fa-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row g-3 mt-1">
                                    @foreach($data->portfolios as $key => $item)
                                        <div class="col-12 col-lg-6 col-md-12">
                                            <div class="edit-card">
                                                <div class="action">
                                                    <a href="{{ route('front.portfolio.portfolio.edit', $item->id) }}"><i class="fa-solid fa-pen edit table-icon"></i></a>

                                                    <a href="{{ route('front.portfolio.portfolio.delete', $item->id) }}" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                                </div>
                                                <img src="{{ asset($item->image) }}" id="articleImage" class="img-fluid mb-3" alt="" height="50">
                                                <div class="date">
                                                    <span>{{ date('j F Y, g:i a', strtotime($item->created_at)) }}</span>
                                                </div>
                                                <div class="edit-heading">
                                                    <h4>{{ $item->title }}</h4>
                                                    <p>Category: <span class="text-dark">{{ $item->category }}</span></p>
                                                    <p>{{ $item->tags }}</p>
                                                    <p>{{ $item->short_desc }}</p>
                                                    <p>{{ $item->long_desc }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr>
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
                            @endforeach --}}
                        </tbody>



                        <tbody class="tbody-content tbody-content-edit" id="speciality">
                            <tr>
                                <td>
                                    <div class="row mt-2">
                                        <div class="col-12 text-end">
                                            <a href="{{ route('front.portfolio.expertise.create') }}" class="add-btn-edit d-inline-block">Add <i class="fa-solid fa-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row g-3 mt-1">
                                    @foreach($data->specialities as $key=> $item)
                                        <div class="col-12 col-lg-6 col-md-12">
                                            <div class="edit-card">
                                                <div class="action">
                                                    <a href="{{ route('front.portfolio.expertise.edit', $item->id) }}"><i class="fa-solid fa-pen edit table-icon"></i></a>

                                                    <a href="{{ route('front.portfolio.expertise.delete', $item->id) }}" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                                </div>
                                                <div class="date">
                                                    <span>{{ date('j F Y, g:i a', strtotime($item->created_at)) }}</span>
                                                </div>
                                                <div class="edit-heading">
                                                    <h4>{{ $item->specialityDetails->name }}</h4>
                                                    <p>{{ $item->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>



                        <tbody class="tbody-content tbody-content-edit" id="employment-history">
                            <tr>
                                <td>
                                    <div class="action">
                                        <a type="button" href="{{ route('front.portfolio.work-experience.create') }}" class="add-btn-edit d-inline-block"  title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                    </div>
                                    @foreach($data->employments as $key=> $item)
                                        <div class="employmentBox">
                                            <div class="action">
                                                <a href="{{ route('front.portfolio.work-experience.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                                <a href="{{ route('front.portfolio.work-experience.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <label>Designation</label>
                                                    <p>{{ $item->occupation }}</p>
                                                </div>
                                                <div class="col-3">
                                                    <label>Company Name</label>
                                                    <p>{{ $item->company_title }}</p>
                                                </div>
                                                <div class="col-3">
                                                    <label>Duration</label>
                                                    <p>{{ $item->year_from.' - '.$item->year_to }}</p>
                                                </div>
                                                <div class="col-3">
                                                    <label>Contact</label>
                                                    <p>{{ $item->phone_number }}</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <label>Email</label>
                                                    <p>{{ $item->email_id }}</p>
                                                </div>
                                                <div class="col-3">
                                                    <label>Owner Name</label>
                                                    <p>{{ $item->owner_name }}</p>
                                                </div>
                                                <div class="col-3">
                                                    <label>Manager Name</label>
                                                    <p>{{ $item->manager_name }}</p>
                                                </div>
                                                <div class="col-3">
                                                    <label>Url</label>
                                                    <p>{{ $item->link }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="box">
                                                        <h4>Short Description</h4>
                                                        <p>{{ $item->short_desc }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="box">
                                                        <h4>Long Description</h4>
                                                        <p>{{ $item->short_desc }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach   
                                </td>
                            </tr>
                        </tbody>



                        <tbody class="tbody-content tbody-content-edit" id="client">
                            <tr>
                                <td>
                                    <div class="action">
                                        <a type="button" href="{{ route('front.portfolio.client.create') }}" class="add-btn-edit d-inline-block"  title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                    </div>
                                    @foreach($data->clients as $key=> $item)
                                        <div class="employmentBox">
                                            <div class="action">
                                                <a href="{{ route('front.portfolio.client.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                                <a href="{{ route('front.portfolio.client.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                @if($item->image)
                                                <img src="{{ asset('uploads/client/'.$item->image) }}" id="articleImage" class="img-fluid" alt="" width="100" height="100">
                                                @else
                                                <span></span>
                                                @endif
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>Client Name</label>
                                                    <p>{{ $item->client_name }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-3 mb-3">
                                                    <label>Designation</label>
                                                    <p>{{ $item->occupation }}</p>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>Email</label>
                                                    <p>{{ $item->email_id }}</p>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>Contact</label>
                                                    <p>{{ $item->phone_number }}</p>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>Url</label>
                                                    <p>{{ $item->link }}</p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="box">
                                                        <h4>Short Description</h4>
                                                        <p>{{ $item->short_desc }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="box">
                                                        <h4>Long Description</h4>
                                                        <p>{{ $item->long_desc }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach    
                                </td>
                            </tr>
                        </tbody>



                        <tbody class="tbody-content tbody-content-edit" id="education">
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



                        <tbody class="tbody-content tbody-content-edit" id="testimonial">
                            <tr>
                                <td>
                                    <div class="action">
                                        <a type="button" href="{{ route('front.portfolio.testimonial.create') }}" class="add-btn-edit d-inline-block"  title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                    </div>
                                    @foreach($data->testimonials as $key=> $item)
                                    <div class="employmentBox">
                                        <div class="action">
                                            <a href="{{ route('front.portfolio.testimonial.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                            <a href="{{ route('front.portfolio.testimonial.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label>Image</label>
                                                {{-- @if($item->file) --}}
                                                <img src="{{ asset($item->image) }}" id="articleImage" class="img-fluid" alt="" style="height: 100px">
                                                {{-- @else
                                                <span></span>
                                                @endif --}}
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label>Client Name</label>
                                                <p>{{ $item->client_name }}</p>
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label>Designation</label>
                                                <p>{{ $item->occupation }}</p>
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label>Contact</label>
                                                <p>{{ $item->phone_number }}</p>
                                            </div>
                                            <div class="col-3 mb-3">
                                                <label>Email</label>
                                                <p>{{ $item->email_id }}</p>
                                            </div>
                                            <div class="col-3 mb-3">
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



                        <tbody class="tbody-content tbody-content-edit" id="certificate">
                            <tr>
                                <td>
                                    <div class="action">
                                        <a type="button" href="{{ route('front.portfolio.certification.create') }}" class="add-btn-edit d-inline-block"  title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                    </div>
                                    @foreach($data->certificates as $key=> $item)
                                        <div class="employmentBox">
                                            <div class="action">
                                                <a href="{{ route('front.portfolio.certification.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                                <a href="{{ route('front.portfolio.certification.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                    <label>Title</label>
                                                    <p>{{ $item->certificate_title }}</p>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>Type</label>
                                                    <p>{{ $item->certificate_type }}</p>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>Url</label>
                                                    <p>{{ $item->link }}</p>
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label>Certificate</label>
                                                    @if($item->file)
                                                    <img src="{{ asset('uploads/certificate/'.$item->file) }}" id="articleImage" class="img-fluid" alt="">
                                                    @else
                                                    <span></span>
                                                    @endif
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label>Short Description</label>
                                                    <p>{{ $item->short_desc }}</p>
                                                </div>
                                                <div class="col-6 mb-3">
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

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> --}}
@endsection

