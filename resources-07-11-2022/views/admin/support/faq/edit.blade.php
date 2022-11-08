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
                <form action="{{ route('admin.market.faq.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="cat_id">Category <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control" name="cat_id">
                                <option hidden selected>Select Category...</option>
                                @foreach ($categories as $index => $item)
                                <option value="{{$item->id}}" {{ ($item->id==$targetfaq->cat_id) ? 'selected' : ''}}>{{ $item->title }}</option>
                            @endforeach
                            </select>
                            @error('cat_id') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="question">Question <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('question') is-invalid @enderror" type="text" name="question" id="question">{{ old('question', $targetfaq->question) }}</textarea>
                            <input type="hidden" name="id" value="{{ $targetfaq->id }}">
                            @error('question') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="answer">Answer<span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer">{{ old('answer', $targetfaq->answer) }}</textarea>
                            @error('answer') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update faq</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.support.faq.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
        $('#question').summernote({
            height: 400
        });
        $('#answer').summernote({
            height: 400
        });
    </script>
@endpush
