@extends('front.layouts.app')

@section('page', 'Checkout')

@section('section')
<style>
.cart-flow li:before {
    width: calc(1200px / 3);
}
</style>

<section class="cart-header mb-3 mb-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h4>Shopping Checkout</h4>
            </div>
        </div>
    </div>
</section>

<section class="cart-wrapper">
    <div class="container">
        <form class="checkout-form" method="POST" action="{{route('front.checkout.store')}}">@csrf
            <div class="row justify-content-between flex-sm-row-reverse">
                <div class="col-md-5 col-lg-5 mb-3 mb-sm-0">
                    <h4 class="cart-heading">Cart Summary</h4>
                    <ul class="cart-summary">
                        @php
                            $subTotal = $grandTotal = $couponCodeDiscount = $shippingCharges = $taxPercent = 0;
                        @endphp

                        @foreach ($cartData as $cartKey => $cartValue)
                        <li>
                            <figure>
                                <img src="{{$cartValue->course_image}}" class="w-100"/>
                            </figure>
                            <figcaption>
                                <div class="cart-info">
                                    <h4>{{$cartValue->course_name}}</h4>
                                    <h6>By {{$cartValue->author_name}}</h6>
                                    <p>QTY : {{$cartValue->qty}}
                                    
                                </div>
                                <div class="card-meta">
                                    <h4>${{$cartValue->price}}</h4>
                                </div>
                            </figcaption>
                        </li>
                            @php
                            // subtotal calculation
                            $subTotal += (int) $cartValue->offer_price * $cartValue->qty;
                        @endphp

                        @endforeach
                    </ul>
                </div>
                <div class="col-md-7 col-lg-7">
                    <h4 class="cart-heading">Contact Information</h4>
                    <div class="row mb-5 checkout_form_wrapper">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="checkoutFname" value="@auth{{Auth::guard('web')->user()->first_name}}@else{{old('fname')}}@endauth" placeholder="First Name">
                            </div>
                            @error('fname')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="checkoutLname" value="@auth{{Auth::guard('web')->user()->last_name}}@else{{old('lname')}}@endauth" placeholder="Last Name">
                            </div>
                            @error('lname')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label">Enter Your Email Address</label>
                                <input type="email" class="form-control" name="email" id="checkoutEmail" placeholder="Enter Your Email Address" value="@auth{{Auth::guard('web')->user()->email}}@else{{old('email')}}@endauth">
                            </div>
                            @error('email')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="floating-label">Enter Your Contact Number</label>
                                <input type="tel" class="form-control" name="mobile" id="checkoutMobile" placeholder="Enter Your Contact Number" value="@auth{{Auth::guard('web')->user()->mobile}}@else{{old('mobile')}}@endauth">
                            </div>
                            @error('mobile')<p class="small text-danger mb-0">{{$message}}</p>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-auto col-md-6 mt-3 mt-sm-0">
                        <a href="{{route('front.cart')}}" class="btn checkout-btn button">Return to Cart</a>
                    </div>
                    <div class="col-sm-auto col-md-6 text-sm-end">
                        <button type="submit" class="btn checkout-btn button m-2">Complete Order</button>
                    </div>
                </div>
            </div>
        </form
    </div>
</section>
@endsection

