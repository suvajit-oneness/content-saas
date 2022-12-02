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
                                <th class="table-tab " onclick="location.href='{{ route('front.portfolio.work-experience.index')}}'">Employment History</th>
                                <th class="table-tab active" onclick="location.href='{{ route('front.portfolio.client.index')}}'">Clients</th>
                                <th class="table-tab " onclick="location.href='{{ route('front.portfolio.education.index')}}'">Education</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.feedback.index')}}'">Feedback </th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.testimonial.index')}}'">Testimonials</th>
                                <th class="table-tab" onclick="location.href='{{ route('front.portfolio.certification.index')}}'">Certification </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive table-content">
                    <table class="table table-hovered table-striped">
                        <tbody class="tbody-content tbody-content-edit" id="client" style="display:block;">
                            {{-- <tr>
                                <td>
                                    <div class="action">
                                        <a type="button" href="{{ route('front.portfolio.client.create') }}" class="add-btn-edit d-inline-block" title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                    </div>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>
                                    <div class="row mt-2">
                                        <div class="col-12 text-end">
                                            <a type="button" href="{{ route('front.portfolio.client.create') }}" class="add-btn-edit d-inline-block" title="Create">Create <i class="fa-solid fa-plus-circle"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @if (count($data->clients) > 0)
                            <tr>
                                <td style="width:10%">
                                    @foreach($data->clients as $key=> $item)
                                        <div class="portfolio-v4-content-list">
                                            <div class="portfolio-v4-client-flex">
                                                <img src="{{ asset($item->image) }}" alt="" width="100" height="100" style="border-radius:50%" />
                                                <div class="portfolio-v4-client-info">
                                                    <h4>{{$item->client_name}}</h4>
                                                    <span>{{$item->occupation}}</span>
                                                    <p class="mb-0">{{$item->company_name}}</p>
                                                    <a href="{{$item->link}}" target="_blank" class="mb-0">{{$item->link}}</a>
                                                </div>
                                            </div>
                                            <div class="action justify-content-end">
                                                <a href="{{ route('front.portfolio.client.edit', $item->id) }}" title="Edit Profile"><i class="fa-solid fa-pen edit table-icon"></i></a>
                                                <a href="{{ route('front.portfolio.client.delete', $item->id) }}" title="Delete" onclick="return confirm('Are you sure ?')"><i class="fa-solid fa-trash-can trash table-icon"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            @else
                                <tr class="d-flex justify-content-center">
                                    <td>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <p class="text-muted">No data found</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
