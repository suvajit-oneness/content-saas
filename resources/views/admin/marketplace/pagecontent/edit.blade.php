@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <div class="d-flex justify-content-between my-2">
                    <h3 class="tile-title">{{ $subTitle }}</h3>
                    <a class="btn btn-secondary" href="{{ route('admin.marketplace.page.index') }}">
                        <i class="fa fa-fw fa-lg fa-times-circle"></i>Back
                    </a>
                </div>
                <form action="{{ route('admin.marketplace.page.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$plans_page->id}}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header">Header <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea class="form-control summernote @error('header') is-invalid @enderror" type="text" name="header"
                                id="header"> {{ old('header', $plans_page->header) }} </textarea>
                            @error('header') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header_bold">Header Bold Content <span class="m-l-5 text-danger">
                                    *</span></label>
                                <textarea class="form-control summernote @error('header_bold') is-invalid @enderror" type="text" name="header_bold"
                                    id="header_bold"> {{ old('header_bold', $plans_page->header_bold) }} </textarea>
                            @error('header_bold') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header_short_description">Header Short description <span class="m-l-5 text-danger">
                                    *</span></label>
                                <textarea class="form-control summernote @error('header_short_description') is-invalid @enderror" type="text" name="header_short_description"
                                    id="header_short_description"> {{ old('header_short_description', $plans_page->header_short_description) }} </textarea>
                            @error('header_short_description') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="d-flex">
                            <div class="col-3">
                                <img src="{{ asset(old('header_side_image', $plans_page->header_side_image)) }}" height="100px" width="100px" alt="">
                            </div>
                            <div class="form-group col-9">
                                <label class="control-label" for="header_side_image">Header Right Content <span class="m-l-5 text-danger">
                                        *</span></label>
                                    <input class="form-control @error('header_side_image') is-invalid @enderror" type="file" name="header_side_image"
                                        id="header_side_image"/>
                                @error('header_side_image') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.marketplace.page.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection