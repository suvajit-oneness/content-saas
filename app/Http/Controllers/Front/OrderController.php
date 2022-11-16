<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function index(Request $request)
    {
    $orders = Order::where('user_id', auth()->guard('web')->user()->id)->with('orderProducts')->orderBy('id','DESC')->get();
    //dd($orders);
    return view('front.order.index', compact('orders'));
    }
}
