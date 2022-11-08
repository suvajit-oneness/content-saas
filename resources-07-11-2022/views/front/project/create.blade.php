@extends('front.layouts.appprofile')
@section('title', 'Create Project')

@section('section')
<section class="edit-sec">
    <div class="container">
        <div class="row mt-0">
            <div class="col-12 mt-3 mb-3 text-end">
                <a href="{{ route('front.project.index') }}" class="add-btn-edit d-inline-block secondary-btn"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                        <div class="tile">
                        <span class="top-form-btn">
                            <form action="{{ route('front.project.store') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                                <div class="tile-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="control-label" for="title">Status : 
                                                    {{-- <strong>{{ $data->status }}</strong> --}}
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="" disabled>Change Status</option>
                                                    @foreach ($status as $item)
                                                        <option value="{{$item->slug}}" {{ ($item->slug == "icebox") ? 'checked' : '' }}>{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        @error('status')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="title">Title <span class="m-l-5 text-danger">*</span></label>

                                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}" />
    
                                        @error('title')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="short_desc">Short Description (optional)</label>

                                        <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc') }}</textarea>

                                        @error('short_desc')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="document">Document (optional)</label>

                                        <input class="form-control @error('document') is-invalid @enderror" type="file" id="document" name="document"/>

                                        @error('document')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror

                                        <p class="mt-2 text-muted"><small>Upload any project related document, if any. You can also download it later.</small></p>
                                    </div>

                                    <br>

                                    <div class="tile-footer">
                                        <button class="saveBTN d-inline-block" type="submit"><i class="fas fa-check-circle"></i> Save</button>

                                        <a class="saveBTN d-inline-block secondary-btn" href="{{ route('front.project.index') }}"><i class="fas fa-chevron-left"></i>Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

