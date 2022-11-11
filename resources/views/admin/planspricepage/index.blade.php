@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div class="row w-100">
            <div class="col-md-6">
                <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
                <p></p>
            </div>
            <div class="col-md-6 text-right">
            </div>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="row align-items-center justify-content-between">
                <div class="col">
                </div>
            </div>

            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped">
                        <thead>
                            <tr>
                                <th> Bottom Section Image </th>
                                <th> Header top part </th>
                                <th> Header bottom part </th>
                                <th> Bottom Image Text </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans_page as $key => $data)
                                <tr>
                                    <td><img src="{{asset($data->middle_section_content_image)}}" height="100px" width="200px"></td>
                                    <td>{!! $data->header_top !!}</td>
                                    <td>{!! $data->header_bottom !!}</td>
                                    <td>{!! $data->middle_section_content_description !!}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.plans.page.edit', $data['id']) }}"
                                                class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
