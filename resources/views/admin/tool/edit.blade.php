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
                <form action="{{ route('admin.tools.content.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Top Section Tag <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag"
                                id="tag" value="{{ old('tag', $tool->tag) }}" />
                                <input type="hidden" name="id" value="{{$tool->id}}">
                            @error('tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title">Top Section Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <textarea class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title">{{ old('title', $tool->title) }}</textarea>
                                <input type="hidden" name="id" value="{{$tool->id}}">
                            @error('title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_desc">Top Section Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('short_desc') is-invalid @enderror" type="text" name="short_desc"
                                id="short_desc">{{ old('short_desc', $tool->short_desc) }}</textarea>
                            @error('short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="btn_text">Top Section Button <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('btn_text') is-invalid @enderror" type="text"
                                name="btn_text" id="btn_text" value="{{ old('btn_text', $tool->btn_text) }}" />
                            @error('btn_text')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="btn_link">Top Section Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('btn_link') is-invalid @enderror" type="text"
                                name="btn_link" id="btn_link" value="{{ URL::to('/').'/'.'user/login' }}" />
                            @error('btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($tool->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($tool->image) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Top Section Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        id="image" name="image" />
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="area_desc">Area of Interest Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('area_desc') is-invalid @enderror" type="text" name="area_desc"
                                id="area_desc">{{ old('area_desc', $tool->area_desc) }}</textarea>
                            @error('area_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.tools.content.index') }}"><i
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
        $('#title').summernote({
            height: 400
        });
        $('#area_desc').summernote({
            height: 400
        });
        $('#short_desc').summernote({
            height: 400
        });
       
    </script>
@endpush