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
                <h3 class="tile-title">{{ $subTitle }}
                    <span class="top-form-btn">
                        <a class="btn btn-secondary" href="{{ route('admin.market.faq.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span>
                </h3>
                <hr>
                <form action="{{ route('admin.marketplace.faq.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="header">Header <span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('header') is-invalid @enderror" type="text" name="header" id="header" value="{{ old('header') }}"/>
                            @error('header') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="question">Questions (Comma Separated for multiple questions)<span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('question') is-invalid @enderror" type="text" name="question" id="question" value="{{ old('question') }}"/>
                            @error('question') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="answer">Answers (Comma Separated for multiple questions)<span class="m-l-5 text-danger">*</span></label>
                            <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer" value="{{ old('answer') }}"/>
                            @error('answer') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save faq</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.market.faq.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
