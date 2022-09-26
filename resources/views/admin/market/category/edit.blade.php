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
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.market.category.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Category Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetCategory->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetCategory->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                @if ($targetCategory->image != null)
                                    <figure class="mt-2" style="width: 80px; height: auto;">
                                        <img src="{{ asset('/uploads/marketcategories/'.$targetCategory->image) }}" id="blogImage" class="img-fluid" alt="img">
                                    </figure>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <label class="control-label"> Image</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                @error('image') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_description_heading">Category Inner Section Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category_description_heading') is-invalid @enderror" type="text" name="category_description_heading" id="category_description_heading" value="{{ old('category_description_heading', $targetCategory->category_description_heading) }}"/>
                            @error('category_description_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="category_description">Category Inner Section Description<span> (max 500 characters)</span></label>
                        <textarea type="text" class="form-control" rows="4" name="category_description" id="category_description">{{ old('category_description', $targetCategory->category_description) }}</textarea>
                        @error('category_description')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_description_btn">Category Inner Section Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category_description_btn') is-invalid @enderror" type="text" name="category_description_btn" id="category_description_btn" value="{{ old('category_description_btn', $targetCategory->category_description_btn) }}"/>
                            @error('category_description_btn') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_description_btn_link">Category Inner Section Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('category_description_btn_link') is-invalid @enderror" type="text" name="category_description_btn_link" id="category_description_btn_link" value="{{ old('category_description_btn_link', $targetCategory->category_description_btn_link) }}"/>
                            @error('category_description_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                @if ($targetCategory->category_description_image != null)
                                    <figure class="mt-2" style="width: 80px; height: auto;">
                                        <img src="{{ asset('/uploads/marketcategories/'.$targetCategory->category_description_image) }}" id="blogImage" class="img-fluid" alt="img">
                                    </figure>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <label class="control-label"> Image</label>
                                <input class="form-control @error('category_description_image') is-invalid @enderror" type="file" id="category_description_image" name="category_description_image"/>
                                @error('category_description_image') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Category</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.market.category.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
