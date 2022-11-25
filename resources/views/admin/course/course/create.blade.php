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

                        {{-- Internal course field --}}
                        <div class="form-group">
                            <label class="control-label">Internal Courses (Course created by Content-Saas) <span class="m-l-5 text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            id="presented_by_yes" name="presented_by" value="content-saas"
                                            {{ old('presented_by') != 'other' ? 'checked' : '' }} style="width:16px;height: 16px;margin-top:0.25rem;">
                                        <label class="form-check-label" for="presented_by_yes">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            id="presented_by_no" name="presented_by" value="other"
                                            {{ old('presented_by') == 'other' ? 'checked' : '' }} style="width:16px;height: 16px;margin-top:0.25rem;">
                                        <label class="form-check-label" for="presented_by_no">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                            @error('presented_by')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Category field --}}
                        <div class="form-group">
                            <label class="control-label" for="category_id"> Category <span class="m-l-5 text-danger">*</span></label>
                            <select class="filter_select form-control" name="category_id">
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($course_category as $index => $item)
                                    <option value="{{ $item->id }}" {{old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Course Name --}}
                        <div class="form-group">
                            <label class="control-label" for="title">Course Name <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                                id="title" value="{{ old('title') }}" />
                            @error('title')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Course Image Field --}}
                        <div class="form-group">
                            <label class="control-label">Course Image <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                                name="image" />
                            @error('image')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Course Short Description field --}}
                        <div class="form-group">
                            <label class="control-label" for="short_description">Short Description (200 characters max) <span class="m-l-5 text-danger">*</span></label>
                            <textarea type="text" class="form-control" rows="4" name="short_description" id="short_description">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label class="control-label" for="description">Description <span class="m-l-5 text-danger">*</span></label></label>
                            <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <h4>Additional Course description </h4>
                        <hr>

                        {{-- Course certification --}}
                        <div class="form-group">
                            <label class="control-label">Course certification <span class="m-l-5 text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            id="certificate_yes" name="certificate" value="1"
                                            {{ old('certificate') == 1 ? 'checked' : '' }} style="width:16px;height: 16px;margin-top:0.25rem;">
                                        <label class="form-check-label" for="certificate_yes">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            id="certificate" name="certificate" value="0"
                                            {{ old('certificate') == 0 ? 'checked' : '' }} style="width:16px;height: 16px;margin-top:0.25rem;">
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

                        {{-- Cost --}}
                        <div class="form-group">
                            <label class="control-label">Price <span class="m-l-5 text-danger">*</span></label>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input form control" type="radio" onclick="$('#priceother').val('0')"  id="free" name="is_paid" value="0" {{ old('is_paid') == 0 ? 'checked' : '' }} style="width:16px;height: 16px;margin-top:0.25rem;">
                                        <label class="form-label mb-0" for="free">Free</label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"  id="premium" name="is_paid" value="1" {{ old('is_paid') == 1  ? 'checked' : '' }} style="width:16px;height: 16px;margin-top:0.25rem;">
                                        <label class="form-label mb-0" for="premium">Paid</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cost" style="display: {{old('is_paid') > 0 ? 'block;' : 'none;'}}">
                            <div class="form-group">
                                <label class="control-label" for="price">Price($) <span class="m-l-5 text-danger">*</span></label>
                                <input type="number" name="price" id="priceother" value="{{ old('price') }}"
                                    class="form-control">
                                @error('price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label class="control-label" for="offer_price">Offer Price ($)</label>
                                <input type="number" name="offer_price" id="offer_price" value="{{ old('offer_price') }}"
                                    class="form-control">
                                @error('offer_price')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}
                        </div>

                        {{-- Course preview video --}}
                        <div class="form-group">
                            <label class="control-label">Preview Video <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('preview_video') is-invalid @enderror" type="file"
                                id="preview_video" name="preview_video" />
                            @error('preview_video')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Course Content --}}
                        <div class="form-group">
                            <label class="control-label" for="course_content">What you will learn (comma
                                seperated)<span class="m-l-5 text-danger">*</span></label>
                            <textarea name="course_content" id="course_content" class="form-control">{{ old('course_content') }}</textarea>
                            @error('course_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Requirments --}}
                        <div class="form-group">
                            <label class="control-label" for="requirements">Course Requirments <span class="m-l-5 text-danger">*</span></label>
                            <input type="text" name="requirements" id="requirements"
                                value="{{ old('requirements') }}" class="form-control">
                            @error('requirements')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="target">Target Audience <span class="m-l-5 text-danger">*</span></label>
                            <input type="text" name="target" id="target" value="{{ old('target') }}"
                                class="form-control">
                            @error('target')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name (Optional)</label>
                            <input type="text" name="company_name" id="company_name"
                                value="{{ old('company_name') }}" class="form-control">
                            @error('company_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="category_id"> Writer <span class="m-l-5 text-danger">*</span></label>
                            <select class="filter_select form-control" name="author_name" id="writerName">
                                <option value="" hidden selected>Select...</option>
                                @foreach ($writer as $index => $item)
                                    <option value="{{$item->id}}">{{ $item->first_name . ' ' . $item->last_name }}</option>
                                @endforeach
                                <option value="other" {{ old('author_name') == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @error('author_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div id="writer" style="display: {{ old('author_name') == 'other' ? 'block;' : 'none;' }}">
                            <div class="form-group">
                                <label class="control-label" for="other_author_name">Writer Name <span class="m-l-5 text-danger">*</span></label>
                                <input class="form-control @error('other_author_name') is-invalid @enderror" type="text"
                                    name="other_author_name" id="other_author_name" value="{{ old('other_author_name') }}"
                                    placeholder="Type here" />
                                @error('other_author_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label class="control-label" for="other_author_description">Writer Description <span class="m-l-5 text-danger">*</span></label>
                                <textarea type="text" class="form-control" rows="4" name="other_author_description" id="other_author_description">{{ old('other_author_description') }}</textarea>
                                @error('other_author_description')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label class="control-label">Writer Image <span class="m-l-5 text-danger">*</span></label>
                                        <input class="form-control @error('other_author_image') is-invalid @enderror" type="file"
                                            id="image" name="other_author_image" />
                                    </div>
                                </div>
                                @error('other_author_image')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Language --}}
                        <div class="form-group">
                            <label class="control-label" for="language">Language <span class="m-l-5 text-danger">*</span></label>
                            <select name="language" id="language" class="form-control" value="{{ old('language') }}">
                                @foreach ($languages as $l)
                                    <option value="{{ $l->name }}" {{$l->name == old('language') ? 'checked' : ''}}>{{ $l->name }}</option>
                                @endforeach
                            </select>
                            @error('language')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <br>
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
        // $('#short_description').summernote({
        //     height: 400
        // });
        $('#author_description').summernote({
            height: 400
        });
        
        $('input[name="is_paid"]').on('change',function(){
            // alert($(this).val());
            if($(this).val() != 0){
                $('#cost').show();
            }else{
                $('#cost').hide();
            }
        });

        $('select[name="author_name"]').on('change',function(){
            if($(this).val() == 'other'){
                $('#writer').show();
            }else{
                $('#writer').hide();
            }
        });
    </script>
@endpush
