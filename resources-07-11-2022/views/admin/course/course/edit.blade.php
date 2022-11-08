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
                <span class="top-form-btn">
                    <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                </span>

                <h3 class="tile-title">{{ $subTitle }}</h3>

                <hr>

                <form action="{{ route('admin.course.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="category_id"> Category <span class="m-l-5 text-danger">
                                    *</span></label>
                            <select class="form-control" name="category_id">
                                <option value="" hidden selected>Select Categoy...</option>
                                @foreach ($course_category as $index => $item)
                                    <option {{$course->category_id == $item->id ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : $course->title }}" />

                            @error('title')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($course->image) }}" alt="" class="w-100 mt-2">
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                </div>
                            </div>
                            @error('image')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Short description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="short_description" id="short_description" class="form-control @error('title') is-invalid @enderror">{{ old('short_description') ?? $course->short_description }}</textarea>

                            @error('short_description')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="description">Description</label>
                            <textarea type="text" class="form-control" rows="4" name="description" id="description">{{ old('description') ?? $course->description }}</textarea>
                            @error('description')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <h4>Additional Course description</h4>
                        <hr>

                        <div class="form-group">
                            <label class="control-label" for="certificate">Course certification</label>
                            <input type="checkbox" {{$course->certificate == 1 ? 'checked' : ''}} name="certificate" id="certificate" class="form-control">
                            @error('certificate')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="price">Price ($)</label>
                            <input type="number" name="price" id="price" value="{{old('price') ?? $course->price }}" class="form-control">
                            @error('price')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <video src="{{ asset($course->preview_video) }}" alt="" width="150px" height="150px" controls></video>
                                </div>
                                <div class="col-md-8">
                                    <label class="control-label">Preview Video</label>
                                    <input class="form-control @error('preview_video') is-invalid @enderror" type="file" id="preview_video" name="preview_video"/>
                                </div>
                            </div>
                            @error('preview_video')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="course_content">What you will learn (comma seperated)</label>
                            <textarea name="course_content" id="course_content" class="form-control">{{old('course_content') ?? $course->course_content}}</textarea>
                            @error('course_content')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="requirements">Requirments</label>
                            <input type="text" name="requirements" id="requirements" value="{{old('requirements') ?? $course->requirements}}" class="form-control">
                            @error('requirements')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="target">Target Audience</label>
                            <input type="text" name="target" id="target" value="{{old('target') ?? $course->target}}" class="form-control">
                            @error('target')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" value="{{old('company_name') ?? $course->company_name}}" class="form-control">
                            @error('company_name')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="language">Language</label>
                            <select name="language" id="language" class="form-control" value="{{old('language')}}">
                                @foreach ($languages as $item)
                                    <option {{$course->language == $item->name ? 'selected' : ''}} value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('language')
                                <p class="small text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="tile-footer">
                            <input type="hidden" name="id" value="{{ $course->id }}">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>

                            <a class="btn btn-secondary" href="{{ route('admin.lesson.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Select Lesson</h3>
            </div>
            <div class="card-body">
                <div class="row row-eq-height">
                    <div class="col-sm-5 pt-2" style="border: 1px solid black;" data-dd="source">
                        <h3 data-dd-status="fixed" class="m-2">All Lesson</h3>
                        <hr>
                        @foreach ($lessons as $lesson)
                            <div onclick="moveToTarget(this)"><input type="checkbox" checked value="{{ $lesson->id }}" name="lesson[]" class="d-none">{{ $lesson->title }}</div>
                        @endforeach
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </div>
                    <form action="{{ route('admin.course.updateCourseLesson', $course->id) }}" method="POST" class="col-sm-5" style="border: 1px solid black;">
                        @csrf
                        <div class="d-flex justify-content-between m-2">
                            <h3 data-dd-status="fixed">Selected Lessons</h3>
                            <button type="submit" id="setTopic" class="d-none btn btn-primary btn-sm" style="float: right;">Save lessons</button>
                        </div>
                        <hr>
                        <div style="height: 100%" id="relatedtopics" data-dd="target" data-dd-reordable="true">
                            @foreach ($course_lessons as $lesson)
                                <div><input type="checkbox" checked value="{{ $lesson->id }}" name="lesson[]" class="d-none">{{ $lesson->title }} <span class="text-danger text-bold" style="cursor: pointer;" onclick="deleteLessonTopic('{{$lesson->lesson_id}}','{{$lesson->course_id}}')">X</span></div>
                            @endforeach
                        </div>
                    </form>
                </div>

                {{-- <ul>
                    @foreach ($topics as $topic)
                        <li>{{ $topic->title }}</li>
                    @endforeach
                </ul> --}}
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('admin.course.topic.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <input type="hidden" name="course_id" value="{{$topic->course_id}}">
                    <input type="hidden" name="module_id" value="{{$topic->module_id}}">
                    <div class="form-group">
                        <label class="control-label" for="topic">Topic</label>
                        <textarea class="form-control" rows="4" name="topic" id="topic">{{ old('topic', $topic->topic) }}</textarea>
                        <input type="hidden" name="id" value="{{ $topic->id }}">
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    function moveToTarget(x) {
        // console.log($(x).html());
        var source_content = '<div onclick="moveToSource(this)">' + $(x).html() + '</div>';
        $('div[data-dd="target"]').append(source_content);
        $(x).remove();

        if($('div[data-dd="target"]').children().length > 0){
            $('#setTopic').removeClass('d-none');
            $('#setTopic').css('margin', '3px');
        }
    }

    function moveToSource(x) {
        var source_content = '<div onclick="moveToTarget(this)">' + $(x).html() + '</div>';
        $('div[data-dd="source"]').append(source_content);
        $(x).remove();

        if($('div[data-dd="target"]').children().length > 0){
            $('#setTopic').removeClass('d-none');
            $('#setTopic').css('margin', '3px');
        }else{
            $('#setTopic').addClass('d-none');
        }
    }

    function deleteLessonTopic(x,y){
        window.location.href = '{{url("/")}}'+'/admin/course/' + y + '/delete/lesson/' + x;
    }
</script>
<script>
    if($('#relatedtopics').children().length > 0){
        $('#setTopic').removeClass('d-none');
        $('#setTopic').css('margin', '3px');
    }

</script>
<script>
    $.event.props.push('dataTransfer');
    $(function() {
        var $sources = $('div[data-dd="source"]');
        var $targets = $('div[data-dd="target"]');
        var i, $origin;
        if($sources.length > 0) {
            $sources.find('*').each(function(idx, item) {
                var $element = $(item);
                $element.attr("unselectable", "on"); // IE
                $element.attr("id", "dd-source-" + idx);
                if(($element.attr("data-dd-status") && $element.attr("data-dd-status") == 'draggable') || !$element.attr("data-dd-status")) {
                    $element.prop("draggable", true);
                }
                $element.on({
                    dragstart: function(ev) {
                        i = $(this).index;
                        $(this).css({ 'opacity': '0.65' });
                        $origin = $(this);
                        ev.dataTransfer.setData('text', $element[0].outerHTML);
                        ev.dataTransfer.setData('source', $element.attr("id"));
                    }
                });
            });
            $targets.each(function(idx, item) {
                var $element = $(item);
                $element.attr("id", "dd-target-" + idx);
                $element.on({
                    dragenter: function(ev) {
                        $(this).animate({
                            'box-shadow': '2px 2px 4px #aaf'
                        }, 'fast');
                        ev.preventDefault();
                    },
                    dragleave: function(ev) {
                        $(this).animate({
                            'box-shadow': 'initial'
                        }, 'fast');
                    },
                    dragover: function(ev) {
                        ev.preventDefault();
                    },
                    drop: function(ev) {
                        if(i !== $(this).index()) {
                            var data = ev.dataTransfer.getData('text');
                            var $data = $(data);
                            $data.removeAttr("opacity");
                            var source_content = '<div onclick="moveToSource(this)">' + $data.html() + '</div>';
                            $(this).append(source_content);
                            $("#" + ev.dataTransfer.getData("source")).remove();
                            if($('#dd-target-0').children().length > 0){
                                $('#setTopic').removeClass('d-none');
                                $('#setTopic').css('margin', '3px');
                            }
                        }
                        $(this).animate({
                            'box-shadow': 'initial'
                        }, 'fast');
                    },
                    dragend: function(ev) {
                        $(this).css({ 'opacity': '1.0' });
                    }
                });
            });
        }
        $("[draggable]").each(function(idx, item) {
            var $element = $(item);
            if(($element.attr("data-dd-reordable") && $element.attr("data-dd-reordable") == 'true')) {
                $element.on({
                    drop: function(ev) {
                        if(i !== $(this).index()) {

                        }
                    }
                });
            }
        });
    });
</script>
@endpush