<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\ReportJob;
use App\Models\JobUser;
use App\Models\JobTag;
use App\Contracts\JobContract;
use App\Models\NotInterestedJob;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JobController extends Controller {

    protected $JobRepository;

    public function __construct(JobContract $JobRepository)
    {
        $this->JobRepository = $JobRepository;
    }

    public function index(Request $request)
    {
        if (!empty($request->filter)) {
            $keyword = $request->keyword;
            $employment_type = $request->employment_type;
            $salary = $request->salary;
            $payment = $request->payment;
            $source = $request->source;
            $featured = $request->featured_flag;
            $beginner_friendly = $request->beginner_friendly;

            DB::enableQueryLog();

            $job = Job::where('status', 1)
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', '%'.$keyword.'%');
            })
            ->when($salary, function($query, $salary) {
                return $query->where('salary', $salary);
            })
            ->when($payment, function($query, $payment) {
                return $query->where('payment', $payment);
            })
            ->when($source, function($query, $source) {
                return $query->where('source', $source);
            })
            ->when($featured, function($query, $featured) {
                return $query->where('featured_flag', $featured);
            })
            ->when($beginner_friendly, function($query, $beginner_friendly) {
                return $query->where('beginner_friendly', $beginner_friendly);
            })
            ->when($employment_type, function($query, $employment_type) {
                if (count($employment_type) > 1) {
                    foreach($employment_type as $key => $employment) {
                        if ($key == 0) {
                            $queryUpdt = $query->where('employment_type', $employment);
                        } else {
                            $queryUpdt = $query->orWhere('employment_type', $employment);
                        }
                    }
                    return $queryUpdt;
                } else {
                    return $query->where('employment_type', $employment_type[0]);
                }
            })
            ->latest('id')
            ->paginate(10);
        } else {
            $job = Job::where('status', 1)->orWhere('featured_flag', 1)->latest('id')->paginate(10);
        }
        $category = JobCategory::where('status',1)->orderby('title')->get();
        $tag = JobTag::orderby('title')->get();
        return view('front.job.index',compact('job','category','tag'));
    }

    public function details(Request $request,$slug)
    {
        $job = Job::where('slug',$slug)->get();
        $category = JobCategory::where('status',1)->orderby('title')->get();
        $tag = JobTag::orderby('title')->get();
        // check if job is already applied
        if (auth()->guard('web')->user()->id) {
            $jobApplied = ApplyJob::where('job_id', $job[0]->id)->where('user_id', auth()->guard('web')->user()->id,)->first();
        }
        return view('front.job.details',compact('job', 'category', 'tag', 'jobApplied'));
    }
    //**  save job     **//
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
            return response()->json(['status' => 200, 'type' => 'remove', 'message' => 'Job removed from savelist']);
        } else {
            // if not found
            $data = new JobUser();
            $data->user_id = auth()->guard('web')->user() ? auth()->guard('web')->user()->id : 0;
            $data->job_id = $request->id;
            $data->save();
            return response()->json(['status' => 200, 'type' => 'add', 'message' => 'Job saved']);
        }
	}
    //** Job Apply **//
    public function jobapply(Request $request){
        // dd($request->all());

        $request->validate([
            'job_id' => 'required|integer|min:1',
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|min:2|max:255',
            'mobile' => 'required|integer',
            'cv' => 'required'
        ]);

        $params = $request->except('_token');
        $data = $this->JobRepository->applyjob($params);

        if ($data) {
            return redirect()->back()->with('success', 'Successfully Applied for this Job');
        } else {
            return redirect()->back()->with('failure', 'Something happened');
        }
    }
    /* job interest*/
    public function jobinterest(Request $request,$id){
	    // check if collection already exists
        if(auth()->guard('user')->check()) {
           $collectionExistsCheck = NotInterestedJob::where('job_id', $id)->where('user_id', auth()->guard('web')->user()->id)->first();
        } else {
           $collectionExistsCheck = NotInterestedJob::where('job_id', $id)->first();
        }
        if($collectionExistsCheck != null) {
            // if found
            $data = NotInterestedJob::destroy($collectionExistsCheck->id);
            return response()->json(['status' => 200, 'type' => 'remove', 'message' => 'Job removed from savelist']);
        } else {
            // if not found
            $data = new NotInterestedJob();
            $data->user_id = auth()->guard('web')->user() ? auth()->guard('web')->user()->id : 0;
            $data->job_id = $id;
            $data->status = 1;
            $data->save();
            
            return redirect()->back()->with('success','Thank you for your feedback');
        }
	}
       /* report job */
    public function jobreport(Request $request){
	    // check if collection already exists
        if(auth()->guard('user')->check()) {
           $collectionExistsCheck = ReportJob::where('job_id', $request->id)->where('user_id', auth()->guard('web')->user()->id)->first();
        } else {
           $collectionExistsCheck = ReportJob::where('job_id', $request->id)->first();
        }
        if($collectionExistsCheck != null) {
            // if found
            $data = ReportJob::destroy($collectionExistsCheck->id);
            return response()->json(['status' => 200, 'type' => 'remove', 'message' => 'Job removed']);
        } else {
            // if not found
            $data = new ReportJob();
            $data->user_id = auth()->guard('web')->user() ? auth()->guard('web')->user()->id : 0;
            $data->job_id = $request->job_id;
            $data->comment = $request->comment;
            $data->save();
            return redirect()->back()->with('success','Thank you for your feedback');
        }
    }

}