<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Job;

class HomeController extends Controller
{
    public function index(Request $request) {
        $home=Home::all();
        $job=Job::all();
        return view('front.index',compact('home','job'));
    }
}