@extends('front.layouts.appprofile')
@section('title', 'Edit Task')

@section('section')
<section class="edit-sec">
    <div class="container">
        <div class="row mt-0">
            <div class="col-12 mt-3 mb-3 text-end">
                <a href="{{ route('front.project.detail', $data->projectDetail->slug) }}" class="add-btn-edit d-inline-block secondary-btn"><i class="fa-solid fa-chevron-left"></i> Back</a>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8 mx-auto edit-basic-detail-content-wrap">
                        <div class="tile">
                        <span class="top-form-btn">
                            <form action="{{ route('front.project.task.update', $data->id) }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                                <div class="tile-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="control-label" for="title">Status : 
                                                    <strong>{{ strtoupper($data->status) }}</strong>
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="" disabled selected>Change Status</option>
                                                    @foreach ($status as $item)
                                                        <option value="{{$item->slug}}" {{ ($item->slug == $data->status) ? 'selected' : '' }}>{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="title">Title <span class="m-l-5 text-danger">*</span></label>

                                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : $data->title }}" />
    
                                        @error('title')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="short_desc">Short Description (optional)</label>

                                        <textarea type="text" class="form-control" rows="4" name="short_desc" id="short_desc">{{ old('short_desc') ? old('short_desc') : $data->short_desc }}</textarea>

                                        @error('short_desc')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="deadline">Deadline <span class="m-l-5 text-danger">*</span></label>

                                        <input class="form-control @error('deadline') is-invalid @enderror" type="date" name="deadline" id="deadline" value="{{ old('deadline') ? old('deadline') : date('Y-m-d', strtotime($data->deadline)) }}" />

                                        @error('deadline')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="label">Label <span class="m-l-5 text-danger">*</span></label>

                                        <select name="label" id="label" class="form-control">
                                            <option value="high" {{ ($data->label == 'high') ? 'selected' : '' }}>High</option>
                                            <option value="medium" {{ ($data->label == 'medium') ? 'selected' : '' }}>Medium</option>
                                            <option value="normal" {{ ($data->label == 'normal') ? 'selected' : '' }}>Normal</option>
                                            <option value="low" {{ ($data->label == 'low') ? 'selected' : '' }}>Low</option>
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
                                            <input type="radio" class="btn-check" name="recurring" id="recurringYes" autocomplete="off" name="language_id" value="1"  {{ ($data->recurring == 1) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success" for="recurringYes">Yes</label>

                                            <input type="radio" class="btn-check" name="recurring" id="recurringNo" autocomplete="off" name="language_id" value="0"  {{ ($data->recurring == 0) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success" for="recurringNo">No</label>
                                        </div>

                                        @error('recurring')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label class="control-label" for="document">Document (optional)</label>
                                            @if($data->document)
                                                <a href="{{ asset($data->document) }}" class="text-success" download>View Previous Document</a>
                                            @endif
                                        </div>

                                        <input class="form-control @error('document') is-invalid @enderror" type="file" id="document" name="document"/>

                                        @error('document')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror

                                        <p class="mt-2 text-muted"><small>Upload any project related document, if any. You can also download it later.</small></p>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <label class="control-label" for="external_links">External Link (optional)</label>
                                        @if ($data->external_links)
                                            @php
                                                $explodedLink = explode(', ', $data->external_links);
                                            @endphp

                                            @foreach($explodedLink as $key => $link)
                                            <div class="multi-ext-links">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="eg: google document link" aria-label="Username" name="external_links[]" id="external_links" value="{{$link}}">
                                                    <a href="javascript: void(0)" class="input-group-text {{ ($key == 0) ? 'add-ext-link' : 'remove-ext-link' }}" id="basic-addon1">
                                                        <i class="fas fa-{{ ($key == 0) ? 'plus' : 'times' }}"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                        <div class="multi-ext-links">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="eg: google document link" aria-label="Username" name="external_links[]" id="external_links">
                                                <a href="javascript: void(0)" class="input-group-text add-ext-link" id="basic-addon1">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endif

                                        <div id="other-links"></div>

                                        @error('external_links')
                                            <p class="small text-danger">{{ $message }}</p>
                                        @enderror

                                        <p class="mt-2 text-muted"><small>Upload any project related document, if any. You can also download it later.</small></p>
                                    </div>

                                    <br>

                                    <div class="tile-footer">
                                        <input type="hidden" name="project_slug" value="{{ $data->projectDetail->slug }}">
                                        <button class="saveBTN d-inline-block" type="submit"><i class="fas fa-check-circle"></i> Save</button>

                                        <a class="saveBTN d-inline-block secondary-btn" href="{{ route('front.project.detail', $data->projectDetail->slug) }}"><i class="fas fa-chevron-left"></i>Back</a>
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
        $('.add-ext-link').on('click', function() {
            var content = `
            <div class="multi-ext-links">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="eg: google document link" name="external_links[]">
                    <a href="javascript: void(0)" class="input-group-text remove-ext-link" id="basic-addon1">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            `;

            $('#other-links').append(content);
        });

        $(document).on('click', '.remove-ext-link', function() {
            $(this).closest(".multi-ext-links").remove();
        });
    </script>
@endsection
