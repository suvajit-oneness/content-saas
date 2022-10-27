<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ApplyJob;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\JobUser;
use App\Models\JobTag;
use App\Contracts\JobContract;
use Illuminate\Support\Facades\Validator;
class JobController extends Controller{

protected $JobRepository;

/**
 * StateManagementController constructor.
 * @param PincodeRepository $StateRepository
 */

public function __construct(JobContract $JobRepository)
{
    $this->JobRepository = $JobRepository;
}

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
    public function jobapply(Request $request){
        //dd($request->all());
        $request->validate([
            'cv'      =>  'required',

        ]);
             $params = $request->except('_token');
             $data = $this->JobRepository->applyjob($params);
            // if not found
           /* $data = new ApplyJob();
            $data->user_id = auth()->guard('web')->user() ? auth()->guard('web')->user()->id : 0;
            $data->job_id = $request->id;
            $data->cv = $request->cv;
            $data->save();*/
            if ($data) {
                return redirect()->back()->with('success','Job Applied');
                } else {
                    return redirect()->back()->with('failure','Something happened');
                }

           // return response()->json(['status' => 200, 'type' => 'add', 'message' => 'Job Applied']);
        }
        public function jobapplystore(Request $request){
       // dd($request->all());
            $validator = Validator::make($request->all(), [
                 'cv'      =>  'required',
             ]);
             if (!$validator->fails()) {

                $params = array(
                    'user_id' => auth()->guard('web')->user()->id ?? '',
                    'job_id' => $request->job_id ?? '',
                    'cv'    => $request->cv ?? ''
                );

              /*  $data = new ApplyJob();
                $data->user_id = auth()->guard('web')->user() ? auth()->guard('web')->user()->id : 0;
                $data->job_id = $request->id;
               // $data->cv = $request->cv;
               if(!empty($params['cv'])){
                // image, folder name only
                $profile_image = $params['cv'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("jobresume/",$imageName);
                $uploadedImage = $imageName;
                $data->cv = $uploadedImage;
             }
                 $data->save();*/
                 $data = $this->JobRepository->applyjob($params);
                if ($data) {
                    return response()->json(['error' => false, 'message' => 'Job Applied']);
                } else {
                    return response()->json(['error' => true, 'message' => 'Something happened']);
                }

        } else {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

}
}
