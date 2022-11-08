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
                                      <td width="15%" class="text-right text-uppercase">Title</td>
                                      <td>{{ $support->title ?? ''}}</td>
                                   </tr>
                                   <tr>
                                      <td width="15%" class="text-right text-uppercase">Description</td>
                                      <td>{!! $support->description ?? '' !!}</td>
                                   </tr>
                                   <tr>
                                    <td width="15%" class="text-right text-uppercase">Icon</td>
                                    <td>@if($support->image!='')
                                        <img style="width: 100px;height: 100px;" src="{{asset($support->image)}}">
                                        @endif</td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <a type="button" class="btn btn-primary" href="{{ route('admin.support.widget.index') }}">Back</a>
                </div>
            </div>
        </div>




@endsection
