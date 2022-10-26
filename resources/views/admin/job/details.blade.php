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
                            <td>Title</td>
                            <td>{{ empty($Job['title'])? null:$Job['title'] }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ empty($Job->category->title)? null:($Job->category->title) }}</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td>@if($Job->image!='')
                                <img style="width: 150px;height: 100px;" src="{{asset($Job->image)}}">
                                @endif</td>
                        </tr>
                        <tr>
                            <td>Employment Type </td>
                            <td>{{ empty($Job['employment_type'])? null:($Job['employment_type']) }}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{ empty($Job['location'])? null:($Job['location']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Salary</td>
                            <td>{{ empty($Job['salary'])? null:($Job['salary']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{ empty($Job['location'])? null:($Job['location']) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('admin.job.index') }}" class="btn btn-primary"><i class="fa fa-left-arrow"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
