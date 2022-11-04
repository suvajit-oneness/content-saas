@extends('front.layouts.appprofile')
@section('title', 'Create Project Task')

@section('section')
<section class="edit-sec">
    <div class="container">
        <div class="row mt-0">
            <div class="col-12 mt-3 mb-3 text-end">
                <a href="{{ route('front.project.detail', $project->slug) }}" class="add-btn-edit d-inline-block secondary-btn"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                        <div class="tile">
                        <span class="top-form-btn">
                            <form action="{{ route('front.project.store') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                                <div class="tile-body">
                                    <p class="text-muted mb-0"><small>Project name</small></p>
                                    <p>{{$project->title}}</p>
                                    
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
                                        <label class="control-label" for="deadline">Deadline <span class="m-l-5 text-danger">*</span></label>

                                        <input class="form-control @error('deadline') is-invalid @enderror" type="date" name="deadline" id="deadline" value="{{ old('deadline') ? old('deadline') : date('Y-m-d', strtotime('+1 day')) }}" />

                                        @error('deadline')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="label">Label <span class="m-l-5 text-danger">*</span></label>

                                        <select name="label" id="label" class="form-control">
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="normal" selected>Normal</option>
                                            <option value="low">Low</option>
                                        </select>

                                        @error('label')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="recurring">Recurring <span class="m-l-5 text-danger">*</span></label>

                                        <br>

                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" id="recurringYes" autocomplete="off" name="language_id" value="yes">
                                            <label class="btn btn-outline-success" for="recurringYes">Yes</label>

                                            <input type="radio" class="btn-check" id="recurringNo" autocomplete="off" name="language_id" value="no" checked>
                                            <label class="btn btn-outline-success" for="recurringNo">No</label>
                                        </div>

                                        @error('label')
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

                                    <div class="form-group">
                                        <label class="control-label" for="document">External Link (optional)</label>

                                        {{-- <input class="form-control @error('document') is-invalid @enderror" type="file" id="document" name="document"/> --}}

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="eg: google document link" aria-label="Username" aria-describedby="basic-addon1">
                                            <a href="javascript: void(0)" class="input-group-text add-ext-link" id="basic-addon1">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </div>

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

@section('script')
    <script>
        alert();
    </script>
@endsection