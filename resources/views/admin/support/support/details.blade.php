@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
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
                                      <td width="15%" class="text-right text-uppercase"> Title</td>
                                      <td>{{ $support->title ?? ''}}</td>
                                   </tr>

                                   <tr>
                                      <td width="15%" class="text-right text-uppercase"> Description</td>
                                      <td>{!! $support->description ?? '' !!}</td>
                                   </tr>
                                   <tr>
                                    <td width="15%" class="text-right text-uppercase"> Widget Title</td>
                                    <td>{{ $support->widget_title ?? ''}}</td>
                                 </tr>

                                 <tr>
                                    <td width="15%" class="text-right text-uppercase"> Widget Description</td>
                                    <td>{!! $support->widget_description ?? '' !!}</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
