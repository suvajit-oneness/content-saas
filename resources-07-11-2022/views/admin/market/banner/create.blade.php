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
                <h3 class="tile-title">{{ $subTitle }}
                    <span class="top-form-btn">
                        <a class="btn btn-secondary" href="{{ route('admin.market.banner.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.market.banner.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content_heading">Banner Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('content_heading') is-invalid @enderror" type="text" name="content_heading" id="content_heading" value="{{ old('content_heading') }}"/>
                            @error('content_heading') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content">Banner Content <span class="m-l-5 text-danger"> *</span></label>
                            <textarea type="text" class="form-control" rows="4" name="content" id="content">{{ old('content') }}</textarea>
                            @error('content') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content_btn">Banner Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('content_btn') is-invalid @enderror" type="text" name="content_btn" id="content_btn" value="{{ old('content_btn') }}"/>
                            @error('content_btn') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content_btn_link">Banner Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('content_btn_link') is-invalid @enderror" type="text" name="content_btn_link" id="content_btn_link" value="{{ old('content_btn_link') }}"/>
                            @error('content_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Banner  Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" />
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save banner</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.market.banner.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
        $('#content').summernote({
            height: 400
        });
    </script>
@endpush
