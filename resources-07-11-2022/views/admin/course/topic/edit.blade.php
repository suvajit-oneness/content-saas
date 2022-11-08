@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

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
                <span class="top-form-btn">
                    <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                </span>

                <h3 class="tile-title">{{ $subTitle }}</h3>

                <hr>

                <form action="{{ route('admin.topic.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : $topic->title }}" />

                            @error('title')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($topic->image) }}" alt="" class="w-100 mt-2">
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                </div>
                            </div>

                            @error('image')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="short_description">Short description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="short_description" id="short_description" class="form-control @error('title') is-invalid @enderror">{{ old('short_description') ?? $topic->short_description }}</textarea>
                            @error('short_description')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="description" id="description" class="form-control @error('title') is-invalid @enderror">{{ old('description') ? old('description') : $topic->description }}</textarea>
                            {{-- <textarea name="description" id="description" class="summernote form-control @error('title') is-invalid @enderror">{{ old('description') ? old('description') : $topic->description }}</textarea> --}}

                            @error('description')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <h3>Additional Topic Details</h3>
                        <hr>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <video src="{{asset($topic->preview_video)}}" controls height="150px" width="150px"></video>
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label" >Preview video</label>
                                    <input class="form-control @error('preview_video') is-invalid @enderror" type="file" id="image" name="preview_video"/>
                                </div>
                            </div>
                            @error('preview_video')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <video src="{{asset($topic->video)}}" controls height="150px" width="150px"></video>
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label">Video</label>
                                    <input class="form-control @error('video') is-invalid @enderror" type="file" id="image" name="video"/>
                                </div>
                            </div>
                            @error('video')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Topic Video Length(hours*)<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('video_length') is-invalid @enderror" type="float" name="video_length" id="video_length" value="{{ old('video_length') ?? $topic->video_length }}" />
                            @error('video_length')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name"><span class="m-l-5">Is downloadable?</span></label>
                            <input {{$topic->video_downloadable == 1 ? 'checked' : ''}} class="form-control @error('video_downloadable') is-invalid @enderror" type="checkbox" name="video_downloadable" id="video_downloadable"/>
                            @error('video_downloadable')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="tile-footer">
                            <input type="hidden" name="id" value="{{ $topic->id }}">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create & Save as Draft</button>

                            <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.course.topic.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="course_id" value="{{$topic->course_id}}">
                    <input type="hidden" name="module_id" value="{{$topic->module_id}}">
                    <div class="form-group">
                        <label class="control-label" for="topic">Topic</label>
                        <textarea class="form-control" rows="4" name="topic" id="topic">{{ old('topic', $topic->topic) }}</textarea>
                        <input type="hidden" name="id" value="{{ $topic->id }}">
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
