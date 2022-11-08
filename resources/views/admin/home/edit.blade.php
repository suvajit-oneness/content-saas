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
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.home.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Section One Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title', $home->title) }}" />
                                <input type="hidden" name="id" value="{{$home->id}}">
                            @error('title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="short_desc">Section One Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('short_desc') is-invalid @enderror" type="text" name="short_desc"
                                id="short_desc">{{ old('short_desc', $home->short_desc) }}</textarea>
                            @error('short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="btn_text">Section One Button <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('btn_text') is-invalid @enderror" type="text"
                                name="btn_text" id="btn_text" value="{{ old('btn_text', $home->btn_text) }}" />
                            @error('btn_text')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="btn_link">Section One Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('btn_link') is-invalid @enderror" type="text"
                                name="btn_link" id="btn_link" value="{{ old('btn_link', $home->btn_link) }}" />
                            @error('btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->video_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->video_image) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section One Video Image</label>
                                    <input class="form-control @error('video_image') is-invalid @enderror" type="file"
                                        id="video_image" name="video_image" />
                                    @error('video_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->video != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->video) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section One Video</label>
                                    <input class="form-control @error('video') is-invalid @enderror" type="file"
                                        id="video" name="video" />
                                    @error('video')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="video_desc">Section One Video Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('video_desc') is-invalid @enderror" type="text" name="video_desc"
                                id="video_desc">{{ old('video_desc', $home->video_desc) }}</textarea>
                            @error('video_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_one_icon != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_one_icon) }}" id="blogImage"
                                                class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Two Icon</label>
                                    <input class="form-control @error('section_one_icon') is-invalid @enderror"
                                        type="file" id="section_one_icon" name="section_one_icon" />
                                    @error('section_one_icon')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_one_title">Section Two Title <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_one_title') is-invalid @enderror" type="text"
                                name="section_one_title" id="section_one_title"
                                value="{{ old('section_one_title', $home->section_one_title) }}" />
                            @error('section_one_title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_one_short_desc">Section Two Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('section_one_short_desc') is-invalid @enderror" type="text"
                                name="section_one_short_desc" id="section_one_short_desc">{{ old('section_one_short_desc', $home->section_one_short_desc) }}</textarea>
                            @error('section_one_short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_one_btn_text">Section Two Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_one_btn_text') is-invalid @enderror"
                                type="text" name="section_one_btn_text" id="section_one_btn_text"
                                value="{{ old('section_one_btn_text', $home->section_one_btn_text) }}" />
                            @error('section_one_btn_text')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_one_btn_link">Section Two Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_one_btn_link') is-invalid @enderror"
                                type="text" name="section_one_btn_link" id="section_one_btn_link"
                                value="{{ old('section_one_btn_link', $home->section_one_btn_link) }}" />
                            @error('section_one_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_one_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_one_image) }}" id="blogImage"
                                                class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Two Banner Image</label>
                                    <input class="form-control @error('section_one_image') is-invalid @enderror"
                                        type="file" id="section_one_image" name="section_one_image" />
                                    @error('section_one_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_two_tag">Section Three Tag <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_two_tag') is-invalid @enderror" type="text"
                                name="section_two_tag" id="section_two_tag"
                                value="{{ old('section_two_tag', $home->section_two_tag) }}" />
                            @error('section_two_tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_two_title">Section Three Title <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_two_title') is-invalid @enderror" type="text"
                                name="section_two_title" id="section_two_title"
                                value="{{ old('section_two_title', $home->section_two_title) }}" />
                            @error('section_two_title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_two_short_desc">Section Three Short Description
                                <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('section_two_short_desc') is-invalid @enderror" type="text"
                                name="section_two_short_desc" id="section_two_short_desc">{{ old('section_two_short_desc', $home->section_two_short_desc) }}</textarea>
                            @error('section_two_short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_two_category">Section Three Category <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_two_category') is-invalid @enderror"
                                type="text" name="section_two_category" id="section_two_category"
                                value="{{ old('section_two_category', $home->section_two_category) }}" />
                            @error('section_two_category')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_two_btn">Section Three Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_two_btn') is-invalid @enderror" type="text"
                                name="section_two_btn" id="section_two_btn"
                                value="{{ old('section_two_btn', $home->section_two_btn) }}" />
                            @error('section_two_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_two_btn_link">Section Three Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_two_btn_link') is-invalid @enderror"
                                type="text" name="section_two_btn_link" id="section_two_btn_link"
                                value="{{ old('section_two_btn_link', $home->section_two_btn_link) }}" />
                            @error('section_two_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_two_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_two_image) }}" id="blogImage"
                                                class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Three Banner Image</label>
                                    <input class="form-control @error('section_two_image') is-invalid @enderror"
                                        type="file" id="section_two_image" name="section_two_image" />
                                    @error('section_two_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_three_icon != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_three_icon) }}" id="blogImage"
                                                class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Four Icon</label>
                                    <input class="form-control @error('section_three_icon') is-invalid @enderror"
                                        type="file" id="section_three_icon" name="section_three_icon" />
                                    @error('section_three_icon')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_three_tag">Section Four Tag <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_three_tag') is-invalid @enderror" type="text"
                                name="section_three_tag" id="section_three_tag"
                                value="{{ old('section_three_tag', $home->section_three_tag) }}" />
                            @error('section_three_tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="section_three_title">Section Four Title <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_three_title') is-invalid @enderror" type="text"
                                name="section_three_title" id="section_three_title"
                                value="{{ old('section_three_title', $home->section_three_title) }}" />
                            @error('section_three_title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_three_short_desc">Section Four Short Description
                                <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('section_three_short_desc') is-invalid @enderror" type="text"
                                name="section_three_short_desc" id="section_three_short_desc">{{ old('section_three_short_desc', $home->section_three_short_desc) }}</textarea>
                            @error('section_three_short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_three_btn">Section Four Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_three_btn') is-invalid @enderror" type="text"
                                name="section_three_btn" id="section_three_btn"
                                value="{{ old('section_three_btn', $home->section_three_btn) }}" />
                            @error('section_three_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_three_btn_link">Section Four Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_three_btn_link') is-invalid @enderror"
                                type="text" name="section_three_btn_link" id="section_three_btn_link"
                                value="{{ old('section_three_btn_link', $home->section_three_btn_link) }}" />
                            @error('section_three_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_three_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_three_image) }}" id="blogImage"
                                                class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Four Banner Image</label>
                                    <input class="form-control @error('section_three_image') is-invalid @enderror"
                                        type="file" id="section_three_image" name="section_three_image" />
                                    @error('section_three_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_four_tag">Section Five Tag <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_four_tag') is-invalid @enderror" type="text"
                                name="section_four_tag" id="section_four_tag"
                                value="{{ old('section_four_tag', $home->section_four_tag) }}" />
                            @error('section_four_tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_four_title">Section Five Title <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_four_title') is-invalid @enderror" type="text"
                                name="section_four_title" id="section_four_title"
                                value="{{ old('section_four_title', $home->section_four_title) }}" />
                            @error('section_four_title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_four_short_desc">Section Five Short Description
                                <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('section_four_short_desc') is-invalid @enderror" type="text"
                                name="section_four_short_desc" id="section_four_short_desc">{{ old('section_four_short_desc', $home->section_four_short_desc) }}</textarea>
                            @error('section_four_short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_four_btn">Section Five Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_four_btn') is-invalid @enderror" type="text"
                                name="section_four_btn" id="section_four_btn"
                                value="{{ old('section_four_btn', $home->section_four_btn) }}" />
                            @error('section_four_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_four_btn_link">Section Five Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_four_btn_link') is-invalid @enderror"
                                type="text" name="section_four_btn_link" id="section_four_btn_link"
                                value="{{ old('section_four_btn_link', $home->section_four_btn_link) }}" />
                            @error('section_four_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_four_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_four_image) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Five Banner Image</label>
                                    <input class="form-control @error('section_four_image') is-invalid @enderror" type="file"
                                        id="section_four_image" name="section_four_image" />
                                    @error('section_four_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_five_icon != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_five_icon) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Six Icon</label>
                                    <input class="form-control @error('section_five_icon') is-invalid @enderror" type="file"
                                        id="section_five_icon" name="section_five_icon" />
                                    @error('section_five_icon')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_five_tag">Section Six Tag <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('section_five_tag') is-invalid @enderror" type="text"
                                name="section_five_tag" id="section_five_tag" value="{{ old('section_five_tag', $home->section_five_tag) }}" />
                            @error('section_five_tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_five_title">Section Six Title <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_five_title') is-invalid @enderror" type="text"
                                name="section_five_title" id="section_five_title" value="{{ old('section_five_title', $home->section_five_title) }}" />
                            @error('section_five_title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_five_short_desc">Section Six Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('section_five_short_desc') is-invalid @enderror" type="text" name="section_five_short_desc"
                                id="section_five_short_desc">{{ old('section_five_short_desc', $home->section_five_short_desc) }}</textarea>
                            @error('section_five_short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_five_btn">Section Six Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_five_btn') is-invalid @enderror" type="text"
                                name="section_five_btn" id="section_five_btn" value="{{ old('section_five_btn', $home->section_five_btn) }}" />
                            @error('section_five_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_five_btn_link">Section Six Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_five_btn_link') is-invalid @enderror" type="text"
                                name="section_five_btn_link" id="section_five_btn_link" value="{{ old('section_five_btn_link', $home->section_five_btn_link) }}" />
                            @error('section_five_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_five_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_five_image) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Six Banner Image</label>
                                    <input class="form-control @error('section_five_image') is-invalid @enderror" type="file"
                                        id="section_five_image" name="section_five_image" />
                                    @error('section_five_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_six_tag">Section Seven Tag <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_six_tag') is-invalid @enderror" type="text"
                                name="section_six_tag" id="section_six_tag" value="{{ old('section_six_tag', $home->section_six_tag) }}" />
                            @error('section_six_tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_six_title">Section Seven Title <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_six_title') is-invalid @enderror" type="text"
                                name="section_six_title" id="section_six_title" value="{{ old('section_six_title', $home->section_six_title) }}" />
                            @error('section_six_title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_six_short_desc">Section Seven Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('section_six_short_desc') is-invalid @enderror" type="text" name="section_six_short_desc"
                                id="section_six_short_desc">{{ old('section_six_short_desc', $home->section_six_short_desc) }}</textarea>
                            @error('section_six_short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_six_btn">Section Seven Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_six_btn') is-invalid @enderror" type="text"
                                name="section_six_btn" id="section_six_btn" value="{{ old('section_six_btn', $home->section_six_btn) }}" />
                            @error('section_six_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="section_six_btn_link">Section Seven Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('section_six_btn_link') is-invalid @enderror" type="text"
                                name="section_six_btn_link" id="section_six_btn_link" value="{{ old('section_six_btn_link', $home->section_six_btn_link) }}" />
                            @error('section_six_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($home->section_six_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($home->section_six_image) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Section Seven Banner Image</label>
                                    <input class="form-control @error('section_six_image') is-invalid @enderror" type="file"
                                        id="section_six_image" name="section_six_image" />
                                    @error('section_six_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.home.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#short_desc').summernote({
            height: 400
        });
        $('#video_desc').summernote({
            height: 400
        });
        $('#section_one_short_desc').summernote({
            height: 400
        });
        $('#section_two_short_desc').summernote({
            height: 400
        });
        $('#section_three_short_desc').summernote({
            height: 400
        });
        $('#section_four_short_desc').summernote({
            height: 400
        });
        $('#section_five_short_desc').summernote({
            height: 400
        });
        $('#section_six_short_desc').summernote({
            height: 400
        });
       
       
        
       
    </script>
@endpush