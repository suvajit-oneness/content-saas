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
                                <th class="table-tab active" onclick="location.href='{{ route('front.portfolio.portfolio.index')}}'">Portfolio</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.expertise.index')}}'">Specialities</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.work-experience.index')}}'">Employment History</th>
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
                        <tbody class="tbody-content tbody-content-edit" id="portfolio" style="display:block;">
                            <tr>
                                <td>
                                    <div class="row mt-2">
                                        <div class="col-12 text-end">
                                            <a href="{{ route('front.portfolio.portfolio.create') }}" class="add-btn-edit d-inline-block">Create <i class="fa-solid fa-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row mt-1">
                                    @foreach($data->portfolios as $key => $item)
                                        <div class="col-12 col-lg-6 col-md-12" style="height:100%;">
                                            <div class="card userPortfolio mb-4">
                                                <div class="market-research-content">
                                                    <img src="{{ asset($item->image) }}" id="articleImage" class="img-fluid " alt="" height="50">
                                                    <div class="action">
                                                        <a href="{{ route('front.portfolio.portfolio.edit', $item->id) }}"><i class="fa-solid fa-pen edit table-icon"></i></a>

                                                        <a href="{{ route('front.portfolio.portfolio.delete', $item->id) }}" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                                    </div>
                                                    <div class="edit-card">
                                                        <div class="market-research-date">
                                                            <div class="market-research-badge">
                                                                <span>{{ $item->category }}</span>
                                                            </div>
                                                            <h6>{{ date('j M, Y', strtotime($item->created_at)) }}</h6>
                                                        </div>
                                                        <div class="edit-heading">
                                                            <h4>{{ $item->title }}</h4>
                                                            <p> {!! portfolioTagsHtml($item->id) !!}</p>
                                                            <p>{{ substr($item->short_desc,0,100) }} @if(strlen($item->short_desc)>100)<small class="text-underline text-primary text-lowercase showMore" style="cursor: pointer">more...</small>@endif</p>
                                                            <p style="display: none;">{{ $item->short_desc }} @if(strlen($item->short_desc)>100)<small class="text-underline text-primary text-lowercase showLess" style="cursor: pointer">less</small>@endif</p>
                                                        

                                                        </div>
                                                    </div>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('frontend/dist/owl.carousel.min.js') }}"></script>

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