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

            <a class="btn btn-secondary" href="{{ route('admin.lesson.index') }}"><i
                    class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
            </span>
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <hr>
                <form action="{{ route('admin.lesson.store') }}" method="POST" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        {{-- <div class="form-group">
                            <label class="control-label" for="category_id"> Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="category_id">
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($categories as $index => $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label class="control-label" for="lesson_title">Lesson Name <span class="m-l-5 text-danger">
                                    *</span></label>
                            <input class="form-control @error('lesson_title') is-invalid @enderror" type="text" name="lesson_title"
                                id="lesson_title" value="{{ old('lesson_title') }}" />
                            @error('lesson_title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Lesson Image</label>
                            <input class="form-control @error('lesson_image') is-invalid @enderror" type="file" id="lesson_image" name="lesson_image"/>
                            @error('lesson_image')
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
                        {{-- <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        {{-- <div class="form-group">
                            <label class="control-label" for="company_name">Company Name</label>
                            <input class="form-control" rows="4" name="company_name" id="company_name"
                                value="{{ old('company_name') }}" />
                            @error('company_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_description">Company Description</label>
                            <input class="form-control" rows="4" name="company_description"
                                id="company_description"{{ old('company_description') }} />
                            @error('company_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="author_name">Author Name</label>
                            <input class="form-control" rows="4" name="author_name" multiple
                                id="author_name"{{ old('author_name') }} />
                            @error('author_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="author_description">Author Description</label>
                            <textarea type="text" class="form-control" rows="4" name="author_description" id="author_description">{{ old('author_description') }}</textarea>
                            @error('author_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label">Author Image</label>
                            <input class="form-control @error('author_image') is-invalid @enderror" type="file"
                                id="author_image" name="author_image" />
                            @error('author_image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="language">Language</label>
                            <input class="form-control" rows="4" name="language" multiple
                                id="language"{{ old('language') }} />
                            @error('language')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="requirements">Requirements</label>
                            <input class="form-control" rows="4" name="requirements" multiple
                                id="requirements"{{ old('requirements') }} />
                            @error('requirements')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="target">Target</label>
                            <input class="form-control" rows="4" name="target" multiple
                                id="target"{{ old('target') }} />
                            @error('target')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type">Type</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="">Select an option</option>
                                <option value="1">Paid</option>
                                <option value="2">Free</option>
                            </select>
                            @error('author_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="price">Price</label>
                            <input class="form-control" rows="4" name="price" multiple
                                id="price"{{ old('price') }} />
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div> --}}
                    </div><br>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Lesson</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
