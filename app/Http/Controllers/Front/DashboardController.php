<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', auth()->guard('web')->user()->id)->with('orderProducts')->get();

        return view('front.dashboard.index',compact('orders'));
    }
}
