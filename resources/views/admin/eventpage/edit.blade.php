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
                    <a class="btn btn-secondary" href="{{ route('admin.events.page.index') }}">
                        <i class="fa fa-fw fa-lg fa-times-circle"></i>Back
                    </a>
                </div>
                <form action="{{ route('admin.events.page.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$event_page->id}}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header_left">Header Left Content <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea class="form-control summernote @error('header_left') is-invalid @enderror" type="text" name="header_left"
                                id="header_left"> {{ old('header_left', $event_page->header_left) }} </textarea>
                            @error('header_left') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header_right">Header Right Content <span class="m-l-5 text-danger">
                                    *</span></label>
                                <textarea class="form-control summernote @error('header_right') is-invalid @enderror" type="text" name="header_right"
                                    id="header_right"> {{ old('header_right', $event_page->header_right) }} </textarea>
                            @error('header_right') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.events.page.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection