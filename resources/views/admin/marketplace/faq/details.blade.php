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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="2">{{$faq[0]->header}}</td>
                                    </tr>
                                    @for ($i = 0; $i < count($faq); $i++)
                                        <tr>
                                            <td width="15%" class="text-right text-uppercase">Q.{{$i+1}})</td>
                                            <td>{{ $faq[$i]->question }}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%" class="text-right text-uppercase">Answer:</td>
                                            <td>{!! $faq[$i]->answer !!}</td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
