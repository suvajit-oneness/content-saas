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
                    <h2>Add  Area of Expertise</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.expertise.update') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="degree">Degree <span class="m-l-5 text-danger">
                                            *</span></label>
                                            <select class="form-control" name="speciality_id">
                                                <option value="" hidden selected>Select...</option>
                                                @foreach ($speciality as $index => $item)
                                                    <option value="{{ $item->id }}"{{ ($expertise->speciality_id==$item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                        </select>

                                    @error('speciality_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="description"> Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description',$expertise->description) }}</textarea>
                                    <input type="hidden" name="id" value="{{ $expertise->id }}">
                                    @error('description')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                            <div class="tile-footer">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                    </button>
                                    <a class="btn btn-secondary" href="{{ route('front.user.portfolio.manage') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
