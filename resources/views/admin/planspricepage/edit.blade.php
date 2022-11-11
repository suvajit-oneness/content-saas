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
                    <a class="btn btn-secondary" href="{{ route('admin.plans.page.index') }}">
                        <i class="fa fa-fw fa-lg fa-times-circle"></i>Back
                    </a>
                </div>
                <form action="{{ route('admin.plans.page.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$plans_page->id}}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header_top">Header Top Content <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea class="form-control summernote @error('header_top') is-invalid @enderror" type="text" name="header_top"
                                id="header_top"> {{ old('header_top', $plans_page->header_top) }} </textarea>
                            @error('header_top') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header_bottom">Header Bottom Content <span class="m-l-5 text-danger">
                                    *</span></label>
                                <textarea class="form-control summernote @error('header_bottom') is-invalid @enderror" type="text" name="header_bottom"
                                    id="header_bottom"> {{ old('header_bottom', $plans_page->header_bottom) }} </textarea>
                            @error('header_bottom') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body d-flex">
                        <div class="col-5">
                            <img src="{{asset(old('middle_section_content_image', $plans_page->middle_section_content_image))}}" alt="" width="200px" height="100px">
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <label class="control-label" for="middle_section_content_image">Middle Section Content Image <span class="m-l-5 text-danger">
                                        *</span></label>
                                    <input class="form-control @error('middle_section_content_image') is-invalid @enderror" type="file" name="middle_section_content_image"
                                        id="middle_section_content_image">
                                @error('middle_section_content_image') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="middle_section_content_description">Middle Section Content Description <span class="m-l-5 text-danger">
                                    *</span></label>
                                <textarea class="form-control summernote @error('middle_section_content_description') is-invalid @enderror" type="text" name="middle_section_content_description"
                                    id="middle_section_content_description"> {{ old('middle_section_content_description', $plans_page->middle_section_content_description) }} </textarea>
                            @error('middle_section_content_description') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.plans.page.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection