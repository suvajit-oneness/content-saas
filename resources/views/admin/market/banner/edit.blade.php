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
                <form action="{{ route('admin.market.banner.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content_heading">Banner Heading <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('content_heading') is-invalid @enderror" type="text" name="content_heading" id="content_heading" value="{{ old('content_heading',$targetbanner->content_heading) }}"/>
                            <input type="hidden" name="id" value="{{ $targetbanner->id }}">
                            @error('content_heading') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content">Banner Content <span class="m-l-5 text-danger"> *</span></label>
                            <textarea type="text" class="form-control" rows="4" name="content" id="content">{{ old('content', $targetbanner->content) }}</textarea>
                            <input type="hidden" name="id" value="{{ $targetbanner->id }}">
                            @error('content') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content_btn">Banner Button <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('content_btn') is-invalid @enderror" type="text" name="content_btn" id="content_btn" value="{{ old('content_btn',$targetbanner->content_btn) }}"/>
                            @error('content_btn') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="content_btn_link">Banner Button Link <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('content_btn_link') is-invalid @enderror" type="text" name="content_btn_link" id="content_btn_link" value="{{ old('content_btn_link',$targetbanner->content_btn_link) }}"/>
                            @error('content_btn_link') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                @if ($targetbanner->image != null)
                                    <figure class="mt-2" style="width: 80px; height: auto;">
                                        <img src="{{ asset('/uploads/marketbanner/'.$targetbanner->image) }}" id="blogImage" class="img-fluid" alt="img">
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
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update banner</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.market.banner.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
