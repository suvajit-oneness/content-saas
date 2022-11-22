@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.expertise.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                    </div>
                    <h2>Add  Specialities</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.expertise.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="degree">Degree <span class="m-l-5 text-danger">
                                            *</span></label>
                                            <select class="form-control" name="speciality_id">
                                                <option value="" hidden selected>Select...</option>
                                                @foreach ($expertise as $index => $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                        </select>

                                    @error('speciality_id')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label" for="description"> Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>

                            <div class="tile-footer">
                                <button class="saveBTN d-inline-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                                    </button>
                                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.expertise.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                                &nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
