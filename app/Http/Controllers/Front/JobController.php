<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
class JobController extends Controller
{
    public function index(Request $request)
    {
        $job=Job::where('featured_flag',1)->orderby('title')->get();
        $category=JobCategory::where('status',1)->orderby('title')->get();
        return view('front.job.index',compact('job','category'));
    }
}
