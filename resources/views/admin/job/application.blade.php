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
                <table class="table table-hover custom-data-table-style table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> Name </th>
                            <th> Email</th>
                            <th> Mobile </th>
                            <th> Resume </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job as $key => $data)

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->users->first_name }}</td>
                                <td>{{ $data->users->email }}</td>
                                <td>{{ $data->users->mobile }}</td>
                                <td>@if($data->cv!='')
                                    <p class="small"><a href="{{ asset($data->cv) }}" target="_blank"><i class="app-menu__icon fa fa-download"></i></a></p>
                                    @endif</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.job.index') }}" class="btn btn-primary"><i class="fa fa-left-arrow"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
