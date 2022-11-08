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
                        <a class="btn btn-secondary" href="{{ route('admin.market.category.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.market.category.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Category Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" />
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category_description_heading">Category Inner Section Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category_description_heading') is-invalid @enderror" type="text" name="category_description_heading" id="category_description_heading" value="{{ old('category_description_heading') }}"/>
                            @error('category_description_heading') {{ $message ?? '' }} @enderror
                        </div>
                    <div class="form-group">
                        <label class="control-label" for="category_description">Category Inner Section Description<span> (max 500 characters)</span></label>
                        <textarea type="text" class="form-control" rows="4" name="category_description" id="category_description">{{ old('category_description') }}</textarea>
                        @error('category_description')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                        <div class="form-group">
                            <label class="control-label" for="category_description_btn">Category Inner Section Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category_description_btn') is-invalid @enderror" type="text" name="category_description_btn" id="category_description_btn" value="{{ old('category_description_btn') }}"/>
                            @error('category_description_btn') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category_description_btn_link">Category Inner Section Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category_description_btn_link') is-invalid @enderror" type="text" name="category_description_btn_link" id="category_description_btn_link" value="{{ old('category_description_btn_link') }}"/>
                            @error('category_description_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category Inner Section Image</label>
                            <input class="form-control @error('category_description_image') is-invalid @enderror" type="file"
                                id="category_description_image" name="category_description_image" />
                            @error('category_description_image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.market.category.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
        $('#category_description_heading').summernote({
            height: 400
        });
        $('#category_description').summernote({
            height: 400
        });
    </script>
@endpush
