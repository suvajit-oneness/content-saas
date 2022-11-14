@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
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
                            <td>Order Id</td>
                            <td>{{ $order['order_no'] }}</td>
                        </tr>
                        <tr>
                            <td>Purchased By</td>
                            <td><a href="{{route('admin.users.details',$order->user_id)}}">{{$order->users->first_name}} {{$order->users->last_name}}</a></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>$ {{ number_format($order['amount']) }}</td>
                        </tr>
                        <tr>
                            <td>Tax amount</td>
                            <td>$ {{ number_format($order['tax_amount']) }}</td>
                        </tr>
                        <tr>
                            <td>Total Price</td>
                            <td>$ {{ number_format($order['final_amount']) }}</td>
                        </tr>
                        <tr>
                            <td>Course Purchased</td>
                            <td>
                                @foreach ($order->orderProducts as $item)
                                    @if($item->type == 1)
                                        <li><a href="{{route('admin.course.details',$item->course_id)}}">{{$item->courseName->title}}</a>(${{$item->courseName->price}}) - bought at ${{$item->price}}</li>
                                    @endif
                                    @if($item->type == 4)
                                        <li><a href="{{ route('admin.plans.management.details', $item->course_id) }}">{{getSubscriptionDetails($item->course_id)->name}} Subscription</a> - ${{$item->price}}</li>
                                    @endif                                
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('admin.order.index') }}" class="btn btn-primary"><i class="fa fa-left-arrow"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
