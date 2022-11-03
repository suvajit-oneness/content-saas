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

                <form action="{{ route('admin.topic.store') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}" />
                            @error('title')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>

                            @error('image')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="short_description">Short description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="short_description" id="short_description" class="form-control @error('title') is-invalid @enderror">{{ old('short_description') }}</textarea>
                            @error('short_description')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="description" id="description" class="form-control @error('title') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <h3>Additional Topic Details</h3>
                        <hr>

                        <div class="form-group">
                            <label class="control-label">Topic Preview Video</label>
                            <input class="form-control @error('preview_video') is-invalid @enderror" type="file" id="preview_video" name="preview_video"/>
                            @error('preview_video')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Topic Video</label>
                            <input class="form-control @error('video') is-invalid @enderror" type="file" id="video" name="video"/>
                            @error('video')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Topic Video Length(hours*)<span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('video_length') is-invalid @enderror" type="float" name="video_length" id="video_length" value="{{ old('video_length') }}" />
                            @error('video_length')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name"><span class="m-l-5">Is downloadable?</span></label>
                            <input class="form-control @error('video_downloadable') is-invalid @enderror" type="checkbox" name="video_downloadable" id="video_downloadable"/>
                            @error('video_downloadable')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create & Save as Draft</button>
                            <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        
    </script>
@endpush
