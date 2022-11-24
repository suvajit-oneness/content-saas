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
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.expertise.index')}}'">Specialities</th>
                                <th class="table-tab active" onclick="location.href='{{ route('front.portfolio.work-experience.index')}}'">Employment History</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.client.index')}}'">Clients</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.education.index')}}'">Education</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.feedback.index')}}'">Feedback </th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.testimonial.index')}}'">Testimonials</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.certification.index')}}'">Certification </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive table-content">
                    <table class="table table-hovered table-striped">
                        <tbody class="tbody-content tbody-content-edit" id="employment-history" style="display:block;">
                                <tr>
                                    <td>
                                        <div class="action">
                                            <a type="button" href="{{ route('front.portfolio.work-experience.create') }}" class="add-btn-edit d-inline-block"  title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                        </div>
                                        @foreach($data->employments as $key=> $item)
                                            <div class="portfolio-v4-content-list">
                                                <div class="action justify-content-end">
                                                    <a href="{{ route('front.portfolio.work-experience.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                                    <a href="{{ route('front.portfolio.work-experience.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                                </div>

                                                <h4>{{$item->occupation}} | {{$item->company_title}}</h4>
                                                @if($item->link == '')
                                                    <p></p>
                                                @else
                                                    <p><a href="{{$item->link}}" target="_blank"><small>{{$item->link}}</small></a></p>
                                                @endif
                                                <span class="badge"> {{date('M Y',strtotime($item->year_from))}} - {{$item->year_to == '' || strtotime($item->year_to) > strtotime(date('Y-m-d')) ? 'Present' : date('M Y',strtotime($item->year_to))}} </span>
                                                <p>{{$item->short_desc}}</p>
                                            </div>

                                            {{-- <div class="employmentBox">
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
                                                        <p>{{date('M Y',strtotime($item->year_from))}} - {{$item->year_to == '' || strtotime($item->year_to) > strtotime(date('Y-m-d')) ? 'Present' : date('M Y',strtotime($item->year_to))}}</p>
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
                                                            <p>{{ substr($item->long_desc,0,300) }} @if(strlen($item->long_desc)>300)<small class="text-underline text-primary text-lowercase showMore" style="cursor: pointer">more...</small>@endif</p>
                                                            <p style="display: none;">{{ $item->long_desc }} @if(strlen($item->long_desc)>300)<small class="text-underline text-primary text-lowercase showLess" style="cursor: pointer">less</small>@endif</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
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
@section('script')
    <script>
        $('.showMore').click(function(){
            $(this).parent().hide();
            $(this).parent().next().show();
        })    
        $('.showLess').click(function(){
            $(this).parent().hide();
            $(this).parent().prev().show();
        })    
    </script>
@endsection
