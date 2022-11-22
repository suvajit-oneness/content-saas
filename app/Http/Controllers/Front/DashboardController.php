<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\JobUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $project = Project::where('created_by', auth()->guard('web')->user()->id)->get();
        $job = JobUser::where('user_id', auth()->guard('web')->user()->id)->get();
        $orders = Order::where('user_id', auth()->guard('web')->user()->id)->with('orderProducts')->orderBy('id','DESC')->get();
        return view('front.dashboard.index',compact('orders','project','job'));
    }
}
