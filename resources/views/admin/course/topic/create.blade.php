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
                <span class="top-form-btn">
                    <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                </span>

                <h3 class="tile-title">{{ $subTitle }}</h3>

                <hr>

                <form action="{{ route('admin.topic.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" />

                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="short_description">Short description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea name="short_description" id="short_description" class="form-control @error('title') is-invalid @enderror">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Description <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea name="description" id="description" class="form-control @error('title') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="further_readings">Further Reading <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="further_readings" id="further_readings" class="form-control @error('further_readings') is-invalid @enderror">{{ old('further_readings')}}</textarea>
                            {{-- <textarea name="description" id="description" class="summernote form-control @error('title') is-invalid @enderror">{{ old('description') ? old('description') : $topic->description }}</textarea> --}}

                            @error('further_readings')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="external_links">External Links (comma , separated)<span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="external_links" id="external_links" class="form-control @error('external_links') is-invalid @enderror" >{{ old('external_links')}}</textarea>
                            {{-- <textarea name="description" id="description" class="summernote form-control @error('title') is-invalid @enderror">{{ old('description') ? old('description') : $topic->description }}</textarea> --}}

                            @error('external_links')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <h3>Additional Topic Details</h3>
                        <hr>

                        <div class="form-group">
                            <label class="control-label">Topic Preview Video</label>
                            <input class="form-control @error('preview_video') is-invalid @enderror" type="file"
                                id="preview_video" name="preview_video" />
                            @error('preview_video')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Topic Video</label>
                            <input class="form-control @error('video') is-invalid @enderror" type="file" id="video"
                                name="video" />
                            @error('video')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Topic Video Length(hours*)<span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('video_length') is-invalid @enderror" type="float"
                                name="video_length" id="video_length" value="{{ old('video_length') }}" />
                            @error('video_length')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name"><span class="m-l-5">Is downloadable?</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="videodownloadableCheck();"
                                            id="video_downloadable" name="video_downloadable" value="1"
                                            {{ old('video_downloadable') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="video_downloadable">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="videodownloadableCheck();"
                                            id="video_downloadable" name="video_downloadable" value="0"
                                            {{ old('video_downloadable') != 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="video_downloadable">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('video_downloadable')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Create
                                & Save as Draft</button>
                            <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        videodownloadableCheck();

    function videodownloadableCheck() {
        if (document.getElementById('video_downloadable').checked) {
            document.getElementById('yes').style.display = 'block';
        } else document.getElementById('yes').style.display = 'none';
    }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script type="text/javascript">
            $('#description').summernote({
                height: 400
            });
            $('#short_description').summernote({
                height: 400
            });
            $('#further_readings').summernote({
                height: 400
            });
    </script>
@endpush

