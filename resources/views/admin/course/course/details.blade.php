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
                            <td>Image/Preview Video</td>
                            <td class="d-flex justify-content-start"><img src="{{ asset($courses->image) }}" class="mx-2" alt="" height="100"> <video src="{{ asset($courses->preview_video) }}" alt="" height="100" controls></video></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $courses->title }}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{!! $courses->short_description !!}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! $courses->description !!}</td>
                        </tr>

                        <tr>
                            <td colspan="2" style="font-weight: 900;">
                                Other Course details
                            </td>
                        </tr>

                        <tr>
                            <td>Price</td>
                            <td>$ {!! number_format($courses->price) !!}</td>
                        </tr>
                        <tr>
                            <td>Certification</td>
                            <td> @if($courses->certificate == 1) <div class="badge badge-success">Yes</div> @else <div class="badge badge-warning">No</div> @endif </td>
                        </tr>
                        <tr>
                            <td>Course content</td>
                            <td>{!! $courses->course_content !!}</td>
                        </tr>
                        <tr>
                            <td>Target Audience</td>
                            <td>{!! $courses->target !!}</td>
                        </tr>
                        <tr>
                            <td>Course Language</td>
                            <td>{!! $courses->language !!}</td>
                        </tr>
                        <tr>
                            <td>Course requirments</td>
                            <td>{!! $courses->requirements !!}</td>
                        </tr>
                        <tr>
                            <td>Company name</td>
                            <td>{!! $courses->company_name !!}</td>
                        </tr>
                        <tr>
                            <td>Related lessons:</td>
                            <td>
                                @forelse ($course_lessons as $item)
                                    <li style="list-style: decimal;"><a
                                            href="{{ route('admin.lesson.details', $item->lesson_id) }}">{{ $item->title }}</a>
                                    </li>
                                @empty
                                    <p>No Lessons</p>
                                @endforelse
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.course.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
