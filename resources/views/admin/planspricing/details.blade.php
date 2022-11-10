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
                            <td>Icon</td>
                            <td class="d-flex justify-content-start"><img src="{{ asset($plans->icon) }}" class="mx-2" alt="" height="100"></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{ $plans->name }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! $plans->description !!}</td>
                        </tr>
                        <tr>
                            <td>Button Text</td>
                            <td>{!! $plans->button_text !!}</td>
                        </tr>
                        <tr>
                            <td>Benifits</td>
                            <td>
                                <ul>
                                    @foreach (explode(',',$plans->benifits) as $item)
                                        <li>{!! $item !!}</li>    
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Pricings</td>
                            <td>
                                <ul>
                                    @foreach ($plans_with_price as $item)
                                        <li>{{$item->currencyDet->currency}}({{$item->currencyDet->currency_symbol}}) - {{$item->currencyDet->currency_symbol}}{{$item->price}}/{{$item->price_limit}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-primary" href="{{ route('admin.plans.management.index') }}">Back</a>
            </div>
        </div>
    </div>
@endsection
