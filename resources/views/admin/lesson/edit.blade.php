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
                    <a class="btn btn-secondary" href="{{ route('admin.lesson.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Back</a>
                </span>

                <h3 class="tile-title">{{ $subTitle }}</h3>

                <hr>

                <form action="{{ route('admin.lesson.update') }}" method="POST" role="form" enctype="multipart/form-data">@csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') ? old('title') : $lesson->title }}" />

                            @error('title')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($lesson->image) }}" alt="" class="w-100 mt-2">
                                </div>
                                <div class="col-md-10">
                                    <label class="control-label">Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"/>
                                </div>
                            </div>

                            @error('image')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="name">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea name="description" id="description" class="summernote form-control @error('title') is-invalid @enderror">{{ old('description') ? old('description') : $lesson->description }}</textarea>

                            @error('description')<p class="small text-danger">{{ $message }}</p>@enderror
                        </div>

                        <div class="tile-footer">
                            <input type="hidden" name="id" value="{{ $lesson->id }}">
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
                <h3>Select Topic</h3>
            </div>
            <div class="card-body">
                <div class="row row-eq-height">
                    <div class="col-sm-5 pt-2" style="border: 1px solid black;" data-dd="source">
                        @foreach ($topics as $topic)
                            <div><input type="checkbox" checked value="{{ $topic->id }}" name="topics[]" class="d-none">{{ $topic->title }}</div>
                        @endforeach
                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </div>
                    <form action="{{ route('admin.lesson.updateLessonTopic', $lesson->id) }}" method="POST" class="col-sm-5" style="border: 1px solid black;">
                        @csrf
                        <div style="height: 100%" id="relatedtopics" data-dd="target" data-dd-reordable="true">
                        </div>
                        <button type="submit" id="setTopic" class="d-none btn btn-primary btn-sm" style="float: right;">Set topics</button>
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
    if($('#relatedtopics').children().length > 0){
        $('#setTopic').removeClass('d-none');
        $('#setTopic').css('margin', '3px -17px;');
        $('.card-body').css('padding-bottom','36px');
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
                            $(this).append($data);
                            $("#" + ev.dataTransfer.getData("source")).remove();
                            if($('#dd-target-0').children().length > 0){
                                $('#setTopic').removeClass('d-none');
                                $('#setTopic').css('margin', '3px -17px;');
                                $('.card-body').css('padding-bottom','36px');
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
