<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobUser;
use App\Models\JobTag;
class JobController extends Controller
{
    public function index(Request $request)
    {
        $job=Job::where('featured_flag',1)->orderby('title')->get();
        $category=JobCategory::where('status',1)->orderby('title')->get();
        $tag=JobTag::orderby('title')->get();
        return view('front.job.index',compact('job','category','tag'));
    }
    public function details(Request $request,$slug)
    {
        $job=Job::where('slug',$slug)->get();
        $category=JobCategory::where('status',1)->orderby('title')->get();
        $tag=JobTag::orderby('title')->get();
        return view('front.job.details',compact('job','category','tag'));
    }
    public function store(Request $request){
	    // check if collection already exists
        if(auth()->guard('user')->check()) {
           $collectionExistsCheck = JobUser::where('job_id', $request->id)->where('user_id', auth()->guard('web')->user()->id)->first();
        } else {
           $collectionExistsCheck = JobUser::where('job_id', $request->id)->first();
        }
        if($collectionExistsCheck != null) {
            // if found
            $data = JobUser::destroy($collectionExistsCheck->id);
            return response()->json(['status' => 200, 'type' => 'remove', 'message' => 'Job removed from saved']);
        } else {
            // if not found
            $data = new JobUser();
            $data->user_id = auth()->guard('web')->user() ? auth()->guard('web')->user()->id : 0;
            $data->job_id = $request->id;
            $data->save();
            return response()->json(['status' => 200, 'type' => 'add', 'message' => 'Job saved']);
        }
	}

}
