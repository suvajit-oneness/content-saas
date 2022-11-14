@extends('front.layouts.app')

@section('page', 'Order Complete')

@section('section')

@if(Session::get('success'))
    <section class="cart-header mb-3 mb-sm-5"></section>
    <section class="cart-wrapper">
        <div class="container">
            <div class="complele-box">
                <figure class="text-center">
                    <img src="{{asset('frontend/img/check.svg')}}" width="120px">
                </figure>
                <figcaption>
                    <h2>Your order is complete</h2>
                    <p>{{Session::get('success')}}</p>
                    <p>You will receive an email confirmation shortly.</p>
                    <a href="{{route('front.user.orders')}}">View all orders</a>
                    <a href="{{url('/')}}">Return Home</a>
                </figcaption>
            </div>
        </div>
    </section>
@else
    {{-- <h1>Hi</h1> --}}
    <script>window.location = "{{url('/')}}";</script>
@endif

@endsection