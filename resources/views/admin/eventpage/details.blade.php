@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div class="d-flex justify-content-between w-100">
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <a type="button" class="btn btn-primary" href="{{ route('admin.homepagemanagement.index') }}">Back</a>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase"> Title</td>
                                        <td>{{ $data->title ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <a type="button" class="btn btn-primary" href="{{ route('admin.homepagemanagement.index') }}">Back</a>
            </div>
        </div>
    @endsection
