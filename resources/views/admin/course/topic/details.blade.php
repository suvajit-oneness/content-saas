@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
    </div>

    @include('admin.partials.flash')

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <table class="table table-hover custom-data-table-style table-striped table-col-width" id="sampleTable">
                    <tbody>
                        <tr>
                            <td>Image/Preview Video/Video</td>
                            <td class="d-flex justify-content-start">
                                <img src="{{ asset($topic->image) }}" alt="" height="100">
                                <video src="{{ asset($topic->preview_video) }}" alt="" height="100"></video>
                                <video src="{{ asset($topic->video) }}" alt="" height="100"></video>
                            </td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $topic->title }}</td>
                        </tr>
                        <tr>
                            <td>Video Length</td>
                            <td>{{ $topic->video_length }}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{{ $topic->short_description }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! $topic->description !!}</td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.topic.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
