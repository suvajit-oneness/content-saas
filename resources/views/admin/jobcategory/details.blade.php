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
                                      <td width="15%" class="text-right text-uppercase">Category</td>
                                      <td>{{ $category->title ?? ''}}</td>
                                   </tr>
                                   <tr>
                                      <td width="15%" class="text-right text-uppercase">Image</td>
                                      <td><img src="{{ asset($category->image) }}" width="150" height="150"></td>
                                   </tr>
                                   <tr>
                                      <td width="15%" class="text-right text-uppercase">Description</td>
                                      <td>{!! $category->description ?? '' !!}</td>
                                   </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><br>
            <a href="{{ route('admin.job.category.index') }}" class="btn btn-primary mb-2"><i class="fa fa-times"></i> Back</a>
        </div>




@endsection
