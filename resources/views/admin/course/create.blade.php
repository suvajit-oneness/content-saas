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

            <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i
                    class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
            </span>
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <hr>
                <form action="{{ route('admin.course.store') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_id"> Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="category_id">
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($course_category as $index => $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title">Course Name <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Course Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description</label>
                            <textarea type="text" class="form-control" rows="4" name="short_description" id="short_description">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <h4>Additional Course description</h4>
                        <hr>

                        <div class="form-group">
                            <label class="control-label" for="certificate">Course certification</label>
                            <input type="checkbox" name="certificate" id="certificate" class="form-control">
                            @error('certificate')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="price">Price ($)</label>
                            <input type="number" name="price" id="price" class="form-control">
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="preview_video">Preview Video</label>
                            <input type="file" name="preview_video" id="preview_video" class="form-control">
                            @error('preview_video')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="course_content">Course Content</label>
                            <textarea name="course_content" id="course_content" class="form-control"></textarea>
                            @error('course_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="requirements">Requirments</label>
                            <input type="text" name="requirements" id="requirements" class="form-control">
                            @error('requirements')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="target">Target Audience</label>
                            <input type="text" name="target" id="target" class="form-control">
                            @error('target')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" class="form-control">
                            @error('company_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="language">Language</label>
                            <select name="language" id="language" class="form-control">
                                <option value="English">English</option>
                            </select>
                            @error('language')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        


                    </div><br>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Course</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
