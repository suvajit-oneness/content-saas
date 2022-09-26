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
                        <a class="btn btn-secondary" href="{{ route('admin.market.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.market.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="tag">Tag <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag" id="tag" value="{{ old('tag') }}"/>
                            @error('tag') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_description') is-invalid @enderror" type="text" name="short_description" id="short_description" value="{{ old('short_description') }}"/>
                            @error('short_description') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="market_btn">Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('market_btn') is-invalid @enderror" type="text" name="market_btn" id="market_btn" value="{{ old('market_btn') }}"/>
                            @error('market_btn') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="market_btn_link">Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('market_btn_link') is-invalid @enderror" type="text" name="market_btn_link" id="market_btn_link" value="{{ old('market_btn_link') }}"/>
                            @error('market_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" />
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="short_content_heading">Short Content Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_content_heading') is-invalid @enderror" type="text" name="short_content_heading" id="short_content_heading" value="{{ old('short_content_heading') }}"/>
                            @error('short_content_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="short_content">Short Content<span> (max 500 characters)</span></label>
                        <textarea type="text" class="form-control" rows="4" name="short_content" id="short_content">{{ old('short_content') }}</textarea>
                        @error('short_content')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="short_content_btn">Short Content Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_content_btn') is-invalid @enderror" type="text" name="short_content_btn" id="short_content_btn" value="{{ old('short_content_btn') }}"/>
                            @error('short_content_btn') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="short_content_btn_link">Short Content Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_content_btn_link') is-invalid @enderror" type="text" name="short_content_btn_link" id="short_content_btn_link" value="{{ old('short_content_btn_link') }}"/>
                            @error('short_content_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="sticky_content_heading">Sticky Content Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sticky_content_heading') is-invalid @enderror" type="text" name="sticky_content_heading" id="sticky_content_heading" value="{{ old('sticky_content_heading') }}"/>
                            @error('sticky_content_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="sticky_content">Sticky Content<span> (max 500 characters)</span></label>
                        <textarea type="text" class="form-control" rows="4" name="sticky_content" id="sticky_content">{{ old('sticky_content') }}</textarea>
                        @error('sticky_content')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="sticky_content_btn">Sticky Content Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sticky_content_btn') is-invalid @enderror" type="text" name="sticky_content_btn" id="sticky_content_btn" value="{{ old('sticky_content_btn') }}"/>
                            @error('sticky_content_btn') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="sticky_content_btn_link">Sticky Content Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sticky_content_btn_link') is-invalid @enderror" type="text" name="sticky_content_btn_link" id="sticky_content_btn_link" value="{{ old('sticky_content_btn_link') }}"/>
                            @error('sticky_content_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="medium_content_heading">Middle Section Content Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('medium_content_heading') is-invalid @enderror" type="text" name="medium_content_heading" id="medium_content_heading" value="{{ old('medium_content_heading') }}"/>
                            @error('medium_content_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="medium_content">Middle Section Content<span> (max 500 characters)</span></label>
                        <textarea type="text" class="form-control" rows="4" name="medium_content" id="medium_content">{{ old('medium_content') }}</textarea>
                        @error('medium_content')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="faq_heading">Faq Content Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('faq_heading') is-invalid @enderror" type="text" name="faq_heading" id="faq_heading" value="{{ old('faq_heading') }}"/>
                            @error('faq_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="faq_short">Faq Short Content<span> (max 500 characters)</span></label>
                        <textarea type="text" class="form-control" rows="4" name="faq_short" id="faq_short">{{ old('faq_short') }}</textarea>
                        @error('faq_short')
                            <p class="small text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="blog_heading">Blog Content Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('blog_heading') is-invalid @enderror" type="text" name="blog_heading" id="blog_heading" value="{{ old('blog_heading') }}"/>
                            @error('blog_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input class="form-control @error('faq_banner_image') is-invalid @enderror" type="file"
                                id="faq_banner_image" name="faq_banner_image" />
                            @error('faq_banner_image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.market.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
