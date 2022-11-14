@extends('front.layouts.app')

@section('title', 'Cart')

@section('section')
<style>
.cart-item.item-qty .qty-box a {
    width: 20px;
    height: 20px;
    border: none;
    background: #101010;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 3px;
}
.cart-item.item-qty .qty-box a:hover {
    background: #c10909;
}
.cart-item.item-qty .qty-box a svg {
    width: 14px;
    height: 14px;
}
</style>
@if(count($data) > 0)
<section class="cart-header mt-5 mb-3 mb-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h4>Shopping Cart</h4>
            </div>
        </div>
    </div>
</section>

<section class="cart-wrapper">
    <div class="container">
        {{-- @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if (Session::get('failure'))
        <div class="alert alert-danger">{{Session::get('failure')}}</div>
        @endif --}}

        <div class="cart-holder">
            <div class="cart-row cart-row--header">
                <div class="cart-item item-thumb">Image</div>
                <div class="cart-item item-title">Name</div>
                <div class="cart-item item-attr">Author</div>
                <div class="cart-item item-color">Contents</div>
                <div class="cart-item item-price">Price</div>
                <div class="cart-item item-remove">Action</div>
            </div>

            @php
                $subTotal = $grandTotal = $couponCodeDiscount = $shippingCharges = $taxPercent = 0;
            @endphp

            @foreach($data as $cartKey => $cartValue)
            <div class="cart-row">
                <div class="cart-item item-thumb">
                    <figure>
                       <img style="width: 100px;height: 100px;" src="{{asset($cartValue->course_image)}}">
                    </figure>
                </div>
                <div class="cart-item item-title">
                    @if($cartValue->purchase_type != 'subscription')
                        <h4>{{$cartValue->course_name}}</h4>
                    @else
                        <h4>{{$cartValue->course_name}} Subscription</h4>
                    @endif
                </div>
                <div class="cart-item item-author">
                    @if($cartValue->purchase_type != 'subscription')
                        <h6>By {{$cartValue->author_name}}</h6>
                    @else
                        <h6>-- Subscription --</h6>
                    @endif
                </div>
                <div class="cart-item item-author">
                    @if($cartValue->purchase_type != 'subscription')
                        <h6><li>{{totalLessonsAndTopics($cartValue->course_id)->lesson_count}} Lessons</li></h6>
                        <h6><li>{{totalLessonsAndTopics($cartValue->course_id)->topic_count}} Topics</li></h6>
                    @else
                        <h6>-- Subscription --</h6>
                    @endif
                </div>
                
                <div class="cart-item item-price">
                    <div class="cart-text">Amount</div>
                    <h4>${{$cartValue->price * $cartValue->qty}}</h4>
                </div>
                <div class="cart-item item-remove">
                    <a href="{{route('front.cart.delete', $cartValue->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg><!--<span>Remove</span>--></a>
                </div>
            </div>

            @php
                // subtotal calculation
                $subTotal += (int) $cartValue->price * $cartValue->qty;

               
                // grand total calculation
                $grandTotalWithoutCoupon = $subTotal;
                $grandTotal = ($subTotal + $shippingCharges);
            @endphp

            @endforeach
        </div>
    </div>
    <div class="container mt-3 mt-sm-5">
        <div class="cart-summary">
            <div class="row justify-content-between flex-row-reverse">
                <div class="col-md-6 col-lg-5">
                    <div class="w-100">
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Subtotal
                            </div>
                            <div class="cart-total-value">
                                $<span id="subTotalAmount">{{$subTotal}}</span>
                            </div>
                        </div>
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Tax
                            </div>
                            <div class="cart-total-value">
                                ${{$shippingCharges}}
                            </div>
                        </div>
                        {{-- <div class="cart-total">
                            <div class="cart-total-label">
                                Tax and Others - <strong>{{$taxPercent}}%</strong><br/>
                                <small>(Inclusive of all taxes)</small>
                            </div>
                            <div class="cart-total-value"></div>
                        </div> --}}
                       
                        <div class="cart-total">
                            <div class="cart-total-label">
                                Total
                            </div>
                            <div class="cart-total-value">
                                <input type="hidden" value="{{$grandTotalWithoutCoupon}}" name="grandTotalWithoutCoupon">
                                $<span id="displayGrandTotal">{{$grandTotal}}</span>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="row justify-content-between">
                <div class="col-sm-12 text-end mt-4">
                    <form action="{{route('front.checkout.index')}}" method="GET">
                        <button type="submit" class="btn checkout-btn button">Proceed to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@else
<section class="cart-header mb-3 mb-sm-5"></section>
<section class="cart-wrapper">
    <div class="container">
        <div class="complele-box">
            <figcaption>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                <h2>Your cart is empty</h2>
                <p>Purchase Exclusive Courses.</p>
                <a href="{{route('front.course')}}">Back to Home</a>
            </figcaption>
        </div>
    </div>
</section>
@endif

@endsection