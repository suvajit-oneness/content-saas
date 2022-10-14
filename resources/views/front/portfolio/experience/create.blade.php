@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="btn btn-secondary" href="{{ route('front.user.portfolio.manage') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                    </div>
                    <h2>Add  Work Experience Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.work-experience.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="occupation">Designation <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('occupation') is-invalid @enderror" type="text" name="occupation"
                                        id="occupation" value="{{ old('occupation') }}" />
                                        <input type="hidden" name="id" value="{{Auth::guard('web')->user()->id }}">
                                    @error('occupation')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="company_title">Company Name <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('company_title') is-invalid @enderror" type="text" name="company_title"
                                        id="company_title" value="{{ old('company_title') }}" />
                                    @error('company_title')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="year_from">Start Date</label>
                                    <input class="form-control @error('year_from') is-invalid @enderror" type="date" name="year_from"
                                        id="year_from" value="{{ old('year_from') }}" />
                                    @error('occupation')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="year_to">End Date </label>
                                    <input class="form-control @error('year_to') is-invalid @enderror" type="date" name="year_to"
                                        id="year_to" value="{{ old('year_to') }}" />
                                    @error('year_to')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="phone_number">Contact </label>
                                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number"
                                        id="phone_number" value="{{ old('phone_number') }}" />
                                    @error('phone_number')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="email_id">Email </label>
                                    <input class="form-control @error('email_id') is-invalid @enderror" type="text" name="email_id"
                                        id="email_id" value="{{ old('email_id') }}" />
                                    @error('email_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="owner_name">Owner Name </label>
                                    <input class="form-control @error('owner_name') is-invalid @enderror" type="text" name="owner_name"
                                        id="owner_name" value="{{ old('owner_name') }}" />
                                    @error('owner_name')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="manager_name">Manager Name </label>
                                    <input class="form-control @error('manager_name') is-invalid @enderror" type="text" name="manager_name"
                                        id="manager_name" value="{{ old('manager_name') }}" />
                                    @error('manager_name')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="link">Url </label>
                                    <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                                        id="link" value="{{ old('link') }}" />
                                    @error('link')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="short_desc">Short Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc') }}</textarea>
                                    @error('short_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="long_desc">Long Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="long_desc" id="long_desc">{{ old('long_desc') }}</textarea>
                                    @error('long_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                    <a class="btn btn-secondary" href="{{ route('front.user.portfolio.manage') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
