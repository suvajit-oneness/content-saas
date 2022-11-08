@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                text-align: right;">
                <a class="btn btn-secondary" href="{{ route('front.portfolio.testimonial.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                </div>
                    <h2>Update Testimonial Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.testimonial.update') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="client_name">Client Name <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('client_name') is-invalid @enderror" type="text" name="client_name"
                                        id="client_name" value="{{ old('client_name',$testimonial->client_name) }}" />
                                    @error('client_name')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="occupation">Occupation <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('occupation') is-invalid @enderror" type="text" name="occupation"
                                        id="occupation" value="{{ old('occupation',$testimonial->occupation) }}" />
                                        <input type="hidden" name="id" value="{{$testimonial->id }}">
                                    @error('occupation')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="phone_number">Contact </label>
                                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number"
                                        id="phone_number" value="{{ old('phone_number',$testimonial->phone_number) }}" />
                                    @error('phone_number')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="email_id">Email </label>
                                    <input class="form-control @error('email_id') is-invalid @enderror" type="text" name="email_id"
                                        id="email_id" value="{{ old('email_id',$testimonial->client_name) }}" />
                                    @error('email_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="link">Url </label>
                                    <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                                        id="link" value="{{ old('link',$testimonial->link) }}" />
                                    @error('link')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="short_testimonial">Short Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="short_testimonial" id="short_testimonial">{{ old('short_testimonial',$testimonial->short_testimonial) }}</textarea>
                                    @error('short_testimonial')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="long_testimonial">Long Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="long_testimonial" id="long_testimonial">{{ old('long_testimonial',$testimonial->long_testimonial) }}</textarea>
                                    @error('long_testimonial')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            @if ($testimonial->image != null)
                                                <figure class="mt-2" style="width: 80px; height: auto;">
                                                    <img src="{{ asset($testimonial->image) }}" id="articleImage" class="img-fluid" alt="">
                                                </figure>
                                            @endif
                                        </div>
                                    <div class="col-md-10">
                                    <label class="control-label" for="image">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div></div></div><br>
                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                    </button>
                                    <a class="btn btn-secondary" href="{{ route('front.portfolio.testimonial.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
