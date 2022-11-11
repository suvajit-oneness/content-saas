@extends('front.layouts.appprofile')
@section('title', 'Profile Details')

@section('section')
<section class="edit-sec edit-basic-detail">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center top-heading">
                <h2>Update Profile details</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
            <div class="tile">
                <span class="top-form-btn">
                    <form action="{{ route('front.portfolio.profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{Auth::guard('web')->user()->id }}">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="first_name">First Name <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name',Auth::guard('web')->user()->first_name) }}">
                                @error('first_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="last_name">Last Name <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name"
                                    id="last_name" value="{{ old('last_name',Auth::guard('web')->user()->last_name) }}">
                                @error('last_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="email">Email <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" value="{{ old('email',Auth::guard('web')->user()->email) }}" readonly>
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="mobile">Mobile <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('mobile') is-invalid @enderror" type="number" name="mobile"
                                    id="mobile" value="{{ old('mobile',Auth::guard('web')->user()->mobile) }}">
                                @error('mobile')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        @if (Auth::guard('web')->user()->image != null)
                                            <figure class="mt-2" style="width: 80px; height: auto;">
                                                <img src="{{ asset(auth()->guard('web')->user()->image) }}" id="articleImage" class="img-fluid" alt="">
                                            </figure>
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <label class="control-label">Profile Image</label>
                                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                        @error('image') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="country">Country <span class="m-l-5 text-danger">
                                        *</span></label>
                                    <select class="form-control" name="country">
                                            <option value="" hidden selected>Select Country...</option>
                                            @foreach ($country as $index => $item)
                                                <option value="{{ $item->country_name }}"{{ (Auth::guard('web')->user()->country==$item->country_name) ? 'selected' : '' }}>{{ $item->country_name }}</option>
                                            @endforeach
                                    </select>
                                @error('country')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="charge">Charge <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('charge') is-invalid @enderror" type="text" name="charge"
                                    id="charge" value="{{ old('charge',Auth::guard('web')->user()->charge) }}">
                                @error('charge')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label class="control-label" for="duration">Duration <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('duration') is-invalid @enderror" type="text" name="duration"
                                    id="duration" value="{{ old('duration',Auth::guard('web')->user()->duration) }}">
                                @error('duration')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm">Update profile</button>
                            </div>
                        </div>
                    </form>
                </span>
            </div>
        </div>
    </div>
</section>
@endsection