@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection

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
                            <td>Image</td>
                            <td><img src="{{ asset($lesson->image) }}" alt="" height="100"></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $lesson->title }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! $lesson->description !!}</td>
                        </tr>
                        <tr>
                            <td>Related topics:</td>
                            <td>
                                @foreach ($lesson_topics as $item)
                                    <li style="list-style: decimal;"><a href="{{ route('admin.topic.details', $item->topic_id) }}">{{ $item->title }}</a></li>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.lesson.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
