@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <style>
        #writer {
            display: none;
        }

        #yes {
            display: none;
        }
        #cost {
        display: none;
    }
    </style>
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
                            <label class="control-label" for="presented_by">Internal Courses</label>
                            {{-- <input type="checkbox" {{$course->certificate == 1 ? 'checked' : ''}} name="certificate" id="certificate" class="form-control"> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                            id="recurring" name="presented_by" value="yes"
                                            {{ old('presented_by') != 'other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="presented_by">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                            id="presented_by" name="presented_by" value="no"
                                            {{ old('presented_by') == 'other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="presented_by">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                            @error('presented_by')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="yes">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <input class="form-control @error('other_presented_by') is-invalid @enderror"
                                            type="text" name="other_presented_by" id="presented_by"
                                            value="{{ old('other_presented_by') }}" placeholder="Presented by " />
                                    </div>
                                    <div class="col-4">
                                        <input class="form-control @error('presented_by_logo') is-invalid @enderror"
                                            type="text" name="presented_by_logo" id="presented_by_logo"
                                            value="{{ old('presented_by_logo') }}" placeholder="Presented by " />
                                    </div>
                                    @error('presented_by')
                                        <p class="small text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category_id"> Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="filter_select form-control" name="category_id">
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
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" />
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
                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <h4>Additional Course description</h4>
                        <hr>

                        <div class="form-group">
                            <label class="control-label" for="certificate">Course certification</label>
                            {{-- <input type="checkbox" name="certificate" id="certificate" class="form-control"> --}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                            id="recurring" name="certificate" value="yes"
                                            {{ old('certificate') != 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="certificate">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="recurringCheck();"
                                            id="certificate" name="certificate" value="no"
                                            {{ old('certificate') == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="certificate">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('certificate')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Price <span class="m-l-5 text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="CostCheck();" id="free" name="price" value="0" {{ old('price') ? (( old('price') == "0" ) ? 'checked' : '') : 'checked' }}>
                                        <label class="form-check-label" for="free">
                                            Free
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" onClick="CostCheck();" id="premium" name="price" value="1" {{ old('price') ? (( old('price') != "1" ) ? 'checked' : '') : '' }}>
                                        <label class="form-check-label" for="premium">
                                            Paid
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cost">
                            <div class="form-group">
                                <label class="control-label" for="price">Price ($)</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="form-control">
                                @error('price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="offer_price">Offer Price ($)</label>
                                <input type="number" name="offer_price" id="offer_price" value="{{ old('offer_price') }}"
                                    class="form-control">
                                @error('offer_price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Preview Video</label>
                            <input class="form-control @error('preview_video') is-invalid @enderror" type="file"
                                id="preview_video" name="preview_video" />
                            @error('preview_video')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="course_content">What you will learn (comma
                                seperated)</label>
                            <textarea name="course_content" id="course_content" class="form-control">{{ old('course_content') }}</textarea>
                            @error('course_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="requirements">Requirments</label>
                            <input type="text" name="requirements" id="requirements"
                                value="{{ old('requirements') }}" class="form-control">
                            @error('requirements')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="target">Target Audience</label>
                            <input type="text" name="target" id="target" value="{{ old('target') }}"
                                class="form-control">
                            @error('target')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name"
                                value="{{ old('company_name') }}" class="form-control">
                            @error('company_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category_id"> Writer <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="filter_select form-control" name="author_name" id="writerName">
                                <option value="" hidden selected>Select...</option>
                                @foreach ($writer as $index => $item)
                                    <option value="{{ $item->first_name . ' ' . $item->last_name }}">
                                        {{ $item->first_name . ' ' . $item->last_name }}</option>
                                @endforeach
                                <option value="other" {{ old('author_name') == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @error('author_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="writer">
                            <div class="form-group">
                                <input class="form-control @error('author_name') is-invalid @enderror" type="text"
                                    name="author_name" id="author_name" value="{{ old('author_name') }}"
                                    placeholder="Type here" />
                                @error('author_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="author_description">Writer Description</label>
                            <textarea type="text" class="form-control" rows="4" name="author_description" id="author_description">{{ old('author_description') }}</textarea>
                            @error('author_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <label class="control-label">Writer Image</label>
                                    <input class="form-control @error('author_image') is-invalid @enderror" type="file"
                                        id="image" name="author_image" />
                                </div>
                            </div>
                            @error('author_image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="language">Language</label>
                            <select name="language" id="language" class="form-control" value="{{ old('language') }}">
                                @foreach ($languages as $l)
                                    <option value="{{ $l->name }}">{{ $l->name }}</option>
                                @endforeach
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
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#description').summernote({
            height: 400
        });
        $('#short_description').summernote({
            height: 400
        });
        $('#author_description').summernote({
            height: 400
        });
        $(function() {
            $('#writer').hide();
            $('#writerName').change(function() {
                if ($('#writerName').val() == 'other') {
                    $('#writer').show();
                } else {
                    $('#writer').hide();
                }
            });
        });
        recurringCheck();

        function recurringCheck() {
            if (document.getElementById('presented_by').checked) {
                document.getElementById('yes').style.display = 'block';
            } else document.getElementById('yes').style.display = 'none';
        }
        @if(old('is_paid')) CostCheck(); @endif
        function CostCheck() {
            if (document.getElementById('premium').checked) {
                document.getElementById('cost').style.display = 'block';
                document.getElementById('event_cost').setAttribute('value', '');
            } else {
                document.getElementById('cost').style.display = 'none';
                document.getElementById('event_cost').setAttribute('value', 0);
            }
        }
    </script>
@endpush
