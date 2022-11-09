@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p></p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Top Tag</td>
                                        <td>{{ $data->tag ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase"> Title</td>
                                        <td>{!! html_entity_decode($data->title) ?? '' !!}</td>
                                    </tr>

                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Short Description</td>
                                        <td>{!! $data->short_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Button</td>
                                        <td>{!! $data->btn_text ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Button Link</td>
                                        <td>{!! $data->btn_link ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Area of Interest Description</td>
                                        <td>{!! $data->area_desc ?? '' !!}</td>
                                    </tr>
                                    <tr>
                                        <td width="15%" class="text-right text-uppercase">Banner Image</td>
                                        <td><img src="{{ asset($data->image) }}" width="150"
                                                height="150"></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <a type="button" class="btn btn-primary" href="{{ route('admin.tools.content.index') }}">Back</a>
            </div>
        </div>
    @endsection
