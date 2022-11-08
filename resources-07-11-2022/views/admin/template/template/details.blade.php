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
                                        <td>{{ $data->categoryDetails->title ?? ''}}</td>
                                     </tr>
                                     <tr>
                                        <td width="15%" class="text-right text-uppercase">Subcategory</td>
                                        <td>{{ $data->subcategory->title ?? ''}}</td>
                                     </tr>
                                     <tr>
                                        <td width="15%" class="text-right text-uppercase">Type</td>
                                        <td>{{ $data->type->title ?? ''}}</td>
                                     </tr>
                                   <tr>
                                      <td width="15%" class="text-right text-uppercase">Title</td>
                                      <td>{{ $template->title ?? ''}}</td>
                                   </tr>
                                   <tr>
                                   <td>
                                    @if($template->file!='')
                                    <figure class="mt-2" style="width: 80px; height: auto;">
                                         <a href="{{ asset($template->file) }}" target="_blank"><i class="app-menu__icon fa fa-download"></i></a>
                                    </figure>
                                    @endif
                                </td>
                            </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><br>
            <a href="{{ route('admin.template.category.index') }}" class="btn btn-primary mb-2"><i class="fa fa-times"></i> Back</a>
        </div>




@endsection
