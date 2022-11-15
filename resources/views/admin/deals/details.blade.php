@extends('admin.app')
@section('title')
    {{ $pageTitle }}
@endsection

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
                            <td>Image</td>
                            <td class="d-flex justify-content-start"><img src="{{ asset($deals->company_logo) }}" class="mx-2" alt="" height="100"></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $deals->title }}</td>
                        </tr>
                        <tr>
                            <td>Short Description</td>
                            <td>{!! $deals->short_description !!}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! $deals->description !!}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>$15</td>
                        </tr>
                        <tr>
                            <td>Company name</td>
                            <td>{!! $deals->company_name !!}</td>
                        </tr>
                        <tr>
                            <td>Company link</td>
                            <td><a href="{!! $deals->company_website_link !!}">{!! $deals->company_website_link !!}</a></td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.deals.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
