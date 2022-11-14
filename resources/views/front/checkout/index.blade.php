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
                        <li class="d-flex border p-2 m-2">
                            <figure class="w-25">
                                @if($cartValue->purchase_type != 'subscription')
                                    <img src="{{$cartValue->course_image}}" class="w-75"/>
                                @else
                                    <img src="{{$cartValue->course_image}}" class="w-75"/>
                                @endif
                            </figure>
                            <figcaption>
                                <div class="cart-info">
                                    @if($cartValue->purchase_type != 'subscription')
                                        <h4>{{$cartValue->course_name}}</h4>
                                        <h6>By {{$cartValue->author_name}}</h6>
                                        <p class="m-0">QTY : {{$cartValue->qty}}</p>
                                    @else
                                        <h4>{{$cartValue->course_name}} Subscription</h4>
                                        <h6>-- Subscription --</h6>
                                        <p class="m-0">QTY : {{$cartValue->qty}}</p>
                                    @endif
                                </div>
                                <div class="card-meta">
                                    <h4>${{$cartValue->price}}</h4>
                                </div>
                            </figcaption>
                        </li>
                            @php
                            // subtotal calculation
                                $subTotal += (int) $cartValue->price * $cartValue->qty;
                            @endphp

                        @endforeach
                    </ul>
                    <div class="w-100">
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Subtotal
                            </div>
                            <div class="cart-total-value">
                                ₹ {{number_format($subTotal)}}
                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-label mt-3 mb-3">
                                Shipping Method
                            </div>
                        </div>
                        <ul class="checkout-meta mb-2">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shipping_method" id="flexRadioDefault1" value="standard" checked="">
                                    <label class="form-check-label" for="flexRadioDefault1">Standard</label>
                                </div>
                            </li>
                        </ul>
                        
                        <div class="cart-total">
                            <div class="cart-total-label">Shipping Charges</div>
                            <div class="cart-total-value">₹0</div>
                        </div>
                        <div id="appliedCouponHolder"></div>
                        <div class="cart-total">
                            <div class="cart-total-label">Total</div>
                            <div class="cart-total-value">
                                <input type="hidden" value="{{$subTotal}}" name="grandTotalWithoutCoupon">
                                ₹<span id="displayGrandTotal">{{$subTotal}}</span>
                            </div>
                        </div>
                    </div>
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
        </form>
    </div>
</section>
@endsection

