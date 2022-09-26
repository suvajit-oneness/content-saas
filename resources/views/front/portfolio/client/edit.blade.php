@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <h2>Update  Client Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.client.update') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="client_name">Client Name <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('client_name') is-invalid @enderror" type="text" name="client_name"
                                        id="client_name" value="{{ old('client_name',$client->client_name) }}" />
                                        <input type="hidden" name="id" value="{{ $client->id }}">

                                    @error('client_name')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="occupation">Occupation <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('occupation') is-invalid @enderror" type="text" name="occupation"
                                        id="occupation" value="{{ old('occupation',$client->occupation) }}" />
                                    @error('occupation')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>


                                <div class="form-group">
                                    <label class="control-label" for="phone_number">Contact <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number"
                                        id="phone_number" value="{{ old('phone_number',$client->phone_number) }}" />
                                    @error('phone_number')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="email_id">Email <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('email_id') is-invalid @enderror" type="text" name="email_id"
                                        id="email_id" value="{{ old('email_id',$client->email_id) }}" />
                                    @error('email_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="link">Url <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                                        id="link" value="{{ old('link',$client->link) }}" />
                                    @error('link')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="short_desc">Short Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc',$client->short_desc) }}</textarea>
                                    @error('short_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="long_desc">Long Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="long_desc" id="long_desc">{{ old('long_desc',$client->long_desc) }}</textarea>
                                    @error('long_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            @if ($client->image != null)
                                                <figure class="mt-2" style="width: 80px; height: auto;">
                                                    <img src="{{ asset('uploads/client/'.$client->image) }}" id="articleImage" class="img-fluid" alt="">
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

                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
