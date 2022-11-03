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
                <form action="{{ route('admin.template.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="cat_id"> Category <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control" name="cat_id">
                                <option hidden selected></option>
                                @foreach ($categories as $index => $item)
                                <option value="{{$item->id}}" {{ ($item->id==$targettemplate->cat_id) ? 'selected' : ''  }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('cat_id') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="sub_cat_id"> Sub Category <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control" name="sub_cat_id">
                                <option hidden selected></option>
                                @foreach ($subcategories as $index => $item)
                                <option value="{{$item->id}}" {{($item->id==$targettemplate->sub_cat_id) ? 'selected' : ''  }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('sub_cat_id') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="type"> Type <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control" name="type">
                                <option hidden selected></option>
                                @foreach ($type as $index => $item)
                                <option value="{{$item->id}}" {{ ($item->id==$targettemplate->type) ? 'selected' : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('type') <p class="small text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title',$targettemplate->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targettemplate->id }}">
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targettemplate->image != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <img src="{{ asset($targettemplate->image) }}" id="articleImage" class="img-fluid" alt="img">
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                    @error('image') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    @if ($targettemplate->file != null)
                                        <figure class="mt-2" style="width: 80px; height: auto;">
                                            <a href="{{ asset($targettemplate->file) }}" target="_blank"><i class="app-menu__icon fa fa-download"></i></a>
                                        </figure>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">File</label>
                                    <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file"/>
                                    @error('file') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.template.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
    </script>
@endpush
