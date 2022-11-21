@extends('front.layouts.appprofile')

@section('title', 'Manage Portfolio')
@section('section')
<section class="edit-sec edit-basic-detail">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center top-heading">
                    <div class="text-right" style="
                    text-align: right;">
                    <a class="add-btn-edit d-inline-block secondary-btn" href="{{ route('front.portfolio.portfolio.index') }}"><i class="fa fa-fw fa-lg fa-chevron-left"></i>Back</a>
                    </div>
                    <h2>Add Portfolio Details</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                    <div class="tile">
                    <span class="top-form-btn">
                        <form action="{{ route('front.portfolio.portfolio.store') }}" method="POST" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="category">Category <span class="m-l-5 text-danger">
                                            *</span></label>
                                            <select class="form-control" name="category">
                                                <option value="" hidden selected>Select...</option>
                                                @foreach ($category as $index => $item)
                                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                                @endforeach
                                        </select>
                                    @error('category')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="title">Title <span class="m-l-5 text-danger">
                                            *</span></label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                        id="title" value="{{ old('title') }}" />
                                        <input type="hidden" name="id" value="{{Auth::guard('web')->user()->id }}">
                                    @error('title')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="tags">Tags (comma , separated) </label>
                                    <input class="form-control @error('tags') is-invalid @enderror" type="text" name="tags"
                                        id="tags" value="{{ old('tags') }}" />
                                    @error('tags')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="link">Url </label>
                                    <input class="form-control @error('link') is-invalid @enderror" type="text" name="link"
                                        id="link" value="{{ old('link') }}" />
                                    @error('link')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="short_desc">Short Description</label>
                                    <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc') }}</textarea>
                                    @error('short_desc')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label" for="image">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div><br>
                            <div class="tile-footer">
                                <button class="saveBTN d-inline-block secondary-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>

                                <a href="{{ route('front.portfolio.portfolio.index') }}" class="add-btn-edit d-inline-block secondary-btn"><i class="fa fa-chevron-left me-2"></i>Back</a>

                                {{-- &nbsp;&nbsp;&nbsp; --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
