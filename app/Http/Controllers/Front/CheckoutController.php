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

        $request->validate([
            'email' => 'required|email|max:255',
            'mobile' => 'required|integer|digits:10',
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
        ]);

        $order_no = $this->checkoutRepository->create($request->except('_token'));
        
        //dd($order_no);
        // $order_no = 'CSP87655490';
        if ($order_no) {
            // dd("hi");
            return redirect()->route('front.checkout.complete')->with('success', 'Product purchased successfully ('.$order_no.')!');
            // return view('front.checkout.complete')->with('success', 'Product purchased successfully ('.$order_no.')!');
        } else {
            return redirect()->back()->with('failure', 'Something happened. Try again.')->withInput($request->all());
        }
    }
}
