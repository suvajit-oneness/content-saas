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
                                        <td colspan="2">{{$faq->header}}</td>
                                    </tr>
                                    @for ($i = 0; $i < count(explode(',',$faq->question)); $i++)
                                        <tr>
                                            <td width="15%" class="text-right text-uppercase">Question</td>
                                            <td>{{ explode(',',$faq->question)[$i] ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td width="15%" class="text-right text-uppercase">Answer</td>
                                            <td>{!! explode(',',$faq->answer)[$i] ?? '' !!}</td>
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
