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
                <form action="{{ route('admin.plans.faq.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="question">Header <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('header') is-invalid @enderror" type="text" name="header" id="header" value="{{ old('header', $targetfaq[0]->header) }}"/>
                            <input type="hidden" name="id" value="{{ $targetfaq[0]->header_id }}">
                            @error('header') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="d-flex my-2">
                        <div class="col-8"></div>
                        <button type="button" id="addNewQuestion" class="btn btn-success col-4">Add New Question</button>
                    </div>
                    <div class="completeSet my-2">
                        @foreach($targetfaq as $key => $tf)
                            <div class="eachRow my-1">
                                <div class="tile-body">
                                    <div class="form-group">
                                        <label class="control-label" for="question">Questions <span id="q_no">{{$key+1}}</span> <span class="m-l-5 text-danger">*</span></label>
                                        <input class="form-control" type="text" name="question[]" value="{{$tf->question}}" id="question"/>
                                    </div>
                                </div>
                                <div class="tile-body">
                                    <div class="form-group">
                                        <label class="control-label" for="answer">Answers <span id="a_no">{{$key+1}}</span> <span class="m-l-5 text-danger">*</span></label>
                                        <textarea class="form-control" name="answer[]" id="answer">{{$tf->answer}}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-10"></div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <button type="button" onclick="removeRow(this)" class="btn btn-warning btn-sm p-2">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update faq</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.plans.faq.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#addNewQuestion').on('click',function(){
            var total_row = $('.eachRow').length;
            var html_content = 
            '<div class="eachRow my-3">'+
                '<div class="tile-body">'+
                    '<div class="form-group">'+
                        '<label class="control-label" for="question">Questions <span id="q_no">'+ (total_row+1) +'</span> <span class="m-l-5 text-danger">*</span></label>'+
                        '<input class="form-control" type="text" name="question[]" id="question"/>'+
                    '</div>'+
                '</div>'+
                '<div class="tile-body">'+
                    '<div class="form-group">'+
                        '<label class="control-label" for="answer">Answers <span id="a_no">'+ (total_row+1) +'</span><span class="m-l-5 text-danger">*</span></label>'+
                        '<textarea class="form-control" name="answer[]" id="answer"></textarea>'+
                    '</div>'+
                '</div>'+
                '<div class="d-flex">'+
                    '<div class="col-10"></div>'+
                    '<div class="col-2 d-flex justify-content-end">'+
                        '<button type="button" onclick="removeRow(this)" class="btn btn-warning btn-sm p-2">Delete</button>'+
                    '</div>'+
                '</div>'+
            '</div>';

            $('.completeSet').append(html_content);
            
        });
        function removeRow(x) {
            $(x).parent().parent().parent().remove();
        }
    </script>
@endpush
