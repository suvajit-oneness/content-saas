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
                                      <td width="15%" class="text-right text-uppercase">Category Title</td>
                                      <td>{{ $category->title ?? ''}}</td>
                                   </tr>
                                   <tr>
                                      <td width="15%" class="text-right text-uppercase">Image</td>
                                      <td><img src="{{ asset('/uploads/marketcategories/'.$category->image) }}" width="150" height="150"></td>
                                   </tr>
                                   <tr>
                                      <td width="15%" class="text-right text-uppercase">Category Inner Section Heading</td>
                                      <td>{!! $category->category_description_heading ?? '' !!}</td>
                                   </tr>
                                   <tr>
                                    <td width="15%" class="text-right text-uppercase">Category Inner Section Description</td>
                                    <td>{!! $category->category_description ?? '' !!}</td>
                                 </tr>
                                 <tr>
                                    <td width="15%" class="text-right text-uppercase">Category Inner Section Button</td>
                                    <td>{!! $category->category_description_btn ?? '' !!}</td>
                                 </tr>
                                 <tr>
                                    <td width="15%" class="text-right text-uppercase">Category Inner Section Button Link</td>
                                    <td>{!! $category->category_description_btn_link ?? '' !!}</td>
                                 </tr>
                                 <tr>
                                    <td width="15%" class="text-right text-uppercase">Image</td>
                                    <td><img src="{{ asset('/uploads/marketcategories/'.$category->category_description_image) }}" width="150" height="150"></td>
                                 </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




@endsection
