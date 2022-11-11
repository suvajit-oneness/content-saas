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
                <form action="{{ route('admin.footer.content.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title', $data->title) }}">
                                <input type="hidden" name="id" value="{{$data->id}}">
                            @error('title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_desc"> Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('short_desc') is-invalid @enderror" type="text" name="short_desc"
                                id="short_desc">{{ old('short_desc', $data->short_desc) }}</textarea>
                            @error('short_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="btn_text">Button <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('btn_text') is-invalid @enderror" type="text"
                                name="btn_text" id="btn_text" value="{{ old('btn_text', $data->btn_text) }}" />
                            @error('btn_text')
                                {{ $message ?? '' }}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="btn_link">Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('btn_link') is-invalid @enderror" type="text"
                                name="btn_link" id="btn_link" value="{{ URL::to('/').'/'.'user/login' }}" />
                            @error('btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="btn_desc">Button Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('btn_desc') is-invalid @enderror" type="text" name="btn_desc"
                                id="btn_desc">{{ old('btn_desc', $data->btn_desc) }}</textarea>
                            @error('btn_desc')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($data->footer_logo != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($data->footer_logo) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Footer Logo</label>
                                    <input class="form-control @error('footer_logo') is-invalid @enderror" type="file"
                                        id="footer_logo" name="footer_logo" />
                                    @error('footer_logo')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($data->footer_background != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($data->footer_background) }}" id="blogImage" class="img-fluid"
                                                alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Footer Background Image</label>
                                    <input class="form-control @error('footer_background') is-invalid @enderror" type="file"
                                        id="footer_background" name="footer_background" />
                                    @error('footer_background')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="control-label" for="footer_tag">Footer Bottom Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('footer_tag') is-invalid @enderror" type="text" name="footer_tag"
                                id="footer_tag">{{ old('footer_tag', $data->footer_tag) }}</textarea>
                            @error('footer_tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.footer.content.index') }}"><i
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
        $('#footer_tag').summernote({
            height: 400
        });
        $('#btn_desc').summernote({
            height: 400
        });
        $('#short_desc').summernote({
            height: 400
        });
       
    </script>
@endpush