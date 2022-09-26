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
                <form action="{{ route('admin.course.quiz.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{$quiz->course_id}}">
                       <div class="form-group">
                      <input class="form-control" rows="4" name="question" id="question" placeholder="Question" value="{{ old('question',$quiz->question) }}">
                      @error('question') {{ $message }} @enderror
                      <input class="form-control" rows="4" name="optionA" id="optionA" placeholder="Option A" value="{{ old('optionA',$quiz->optionA) }}">
                      @error('optionA') {{ $message }} @enderror
                      <input class="form-control" rows="4" name="optionB" id="optionB" placeholder="Option B" value="{{ old('optionB',$quiz->optionB) }}">
                      @error('optionB') {{ $message }} @enderror
                      <input class="form-control" rows="4" name="optionC" id="optionC" placeholder="Option C"  value="{{ old('optionC',$quiz->optionC) }}">
                      @error('optionC') {{ $message }} @enderror
                      <input class="form-control" rows="4" name="optionD" id="optionD" placeholder="Option D" value="{{ old('optionD',$quiz->question) }}">
                      @error('optionD') {{ $message }} @enderror
                      <select class="form-control" name="right_answer">
                        <option value="">Select Value</option>
                        <option value="optionA">Option A</option>
                        <option value="optionB">Option B</option>
                        <option value="optionC">Option C</option>
                        <option value="optionD">Option D</option>
                     </select>
                     <input type="hidden" name="id" value="{{ $quiz->id }}">
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.course.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
