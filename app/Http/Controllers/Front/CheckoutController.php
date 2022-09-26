<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Contracts\CheckoutContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(CheckoutContract $checkoutRepository) 
    {
        $this->checkoutRepository = $checkoutRepository;
    }

    public function index(Request $request)
    {
        $cartData = $this->checkoutRepository->viewCart();
        if ($cartData) {
            if (Auth::guard('web')->user()) {
            return view('front.checkout.index', compact('cartData'));
            }else{
                 return redirect()->route('front.user.login')->with('success','Login First');
            }
        } else {
            return redirect()->route('front.cart.index');
        }
    }

    
    public function store(Request $request)
    {
         //dd($request->all());

       /* $request->validate([
            'email' => 'required|email|max:255',
            'mobile' => 'required|integer|digits:10',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
        ]);*/

        $order_no = $this->checkoutRepository->create($request->except('_token'));
       //dd($order_no);
        if ($order_no) {
            return redirect()->route('front.course')->with('success', 'Course Added');
        } else {
           
            return redirect()->back()->with('failure', 'Something happened. Try again.')->withInput($request->all());
        }
    }
}
