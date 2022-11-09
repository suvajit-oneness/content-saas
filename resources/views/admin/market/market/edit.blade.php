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
                <form action="{{ route('admin.market.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="tag">Tag <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('tag') is-invalid @enderror" type="text" name="tag"
                                id="tag" value="{{ old('tag', $targetmarket->tag) }}" />
                                <input type="hidden" name="id" value="{{$targetmarket->id}}">
                            @error('tag')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title', $targetmarket->title) }}" />
                            @error('title')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" type="text"
                                name="short_description" id="short_description">
                                {{ old('short_description', $targetmarket->short_description) }}</textarea>
                            @error('short_description')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="market_btn">Button <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('market_btn') is-invalid @enderror" type="text"
                                name="market_btn" id="market_btn"
                                value="{{ old('market_btn', $targetmarket->market_btn) }}" />
                            @error('market_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="market_btn_link">Button Link <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('market_btn_link') is-invalid @enderror" type="text"
                                name="market_btn_link" id="market_btn_link"
                                value="{{ old('market_btn_link', $targetmarket->market_btn_link) }}" />
                            @error('market_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetmarket->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($targetmarket->image) }}" id="blogImage"
                                                class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        id="image" name="image" />
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_content_heading">Short Content Heading <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_content_heading') is-invalid @enderror" type="text"
                                name="short_content_heading" id="short_content_heading"
                                value="{{ old('short_content_heading', $targetmarket->short_content_heading) }}" />
                            @error('short_content_heading')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_content">Short Content<span> (max 500
                                    characters)</span></label>
                            <textarea type="text" class="form-control" rows="4" name="short_content" id="short_content">{{ old('short_content', $targetmarket->short_content) }}</textarea>
                            @error('short_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_content_btn">Short Content Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_content_btn') is-invalid @enderror" type="text"
                                name="short_content_btn" id="short_content_btn"
                                value="{{ old('short_content_btn', $targetmarket->short_content_btn) }}" />
                            @error('short_content_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_content_btn_link">Short Content Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('short_content_btn_link') is-invalid @enderror"
                                type="text" name="short_content_btn_link" id="short_content_btn_link"
                                value="{{ old('short_content_btn_link', $targetmarket->short_content_btn_link) }}" />
                            @error('short_content_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="sticky_content_heading">Sticky Content Heading <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sticky_content_heading') is-invalid @enderror"
                                type="text" name="sticky_content_heading" id="sticky_content_heading"
                                value="{{ old('sticky_content_heading', $targetmarket->sticky_content_heading) }}" />
                            @error('sticky_content_heading')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="sticky_content">Sticky Content<span> (max 500
                                    characters)</span></label>
                            <textarea type="text" class="form-control" rows="4" name="sticky_content" id="sticky_content">{{ old('sticky_content', $targetmarket->sticky_content) }}</textarea>
                            @error('sticky_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="sticky_content_btn">Sticky Content Button <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sticky_content_btn') is-invalid @enderror" type="text"
                                name="sticky_content_btn" id="sticky_content_btn"
                                value="{{ old('sticky_content_btn', $targetmarket->sticky_content_btn) }}" />
                            @error('sticky_content_btn')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="sticky_content_btn_link">Sticky Content Button Link <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('sticky_content_btn_link') is-invalid @enderror"
                                type="text" name="sticky_content_btn_link" id="sticky_content_btn_link"
                                value="{{ old('sticky_content_btn_link', $targetmarket->sticky_content_btn_link) }}" />
                            @error('sticky_content_btn_link')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="medium_content_heading">Middle Section Content Heading <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('medium_content_heading') is-invalid @enderror"
                                type="text" name="medium_content_heading" id="medium_content_heading"
                                value="{{ old('medium_content_heading', $targetmarket->medium_content_heading) }}" />
                            @error('medium_content_heading')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="medium_content">Middle Section Content<span> (max 500
                                    characters)</span></label>
                            <textarea type="text" class="form-control" rows="4" name="medium_content" id="medium_content">{{ old('medium_content', $targetmarket->medium_content) }}</textarea>
                            @error('medium_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="faq_heading">Faq Content Heading <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('faq_heading') is-invalid @enderror" type="text"
                                name="faq_heading" id="faq_heading"
                                value="{{ old('faq_heading', $targetmarket->faq_heading) }}" />
                            @error('faq_heading')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="faq_short">Faq Short Content<span> (max 500
                                    characters)</span></label>
                            <textarea type="text" class="form-control" rows="4" name="faq_short" id="faq_short">{{ old('faq_short', $targetmarket->faq_short) }}</textarea>
                            @error('faq_short')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="blog_heading">Blog Content Heading <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('blog_heading') is-invalid @enderror" type="text"
                                name="blog_heading" id="blog_heading"
                                value="{{ old('blog_heading', $targetmarket->blog_heading) }}" />
                            @error('blog_heading')
                                {{ $message ?? '' }}
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targetmarket->faq_banner_image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($targetmarket->faq_banner_image) }}"
                                                id="blogImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label"> Image</label>
                                    <input class="form-control @error('faq_banner_image') is-invalid @enderror"
                                        type="file" id="faq_banner_image" name="faq_banner_image" />
                                    @error('faq_banner_image')
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
                        <a class="btn btn-secondary" href="{{ route('admin.market.index') }}"><i
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
        $('#short_description').summernote({
            height: 400
        });
        $('#faq_short').summernote({
            height: 400
        });
        $('#short_content').summernote({
            height: 400
        });
        $('#sticky_content').summernote({
            height: 400
        });
        $('#medium_content').summernote({
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