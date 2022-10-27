<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\JobContract;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobExport;
use App\Models\JobCategory;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class JobController extends BaseController
{
    /**
     * @var JobContract
     */
    protected $JobRepository;


    /**
     * JobController constructor.
     * @param JobContract $JobRepository
     *
     */
    public function __construct(JobContract $JobRepository)
    {
        $this->JobRepository = $JobRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $job = $this->JobRepository->searchJobData($request->term);
        }else{
            $job = Job::orderby('title')->paginate(25);
        }
        $categories = $this->JobRepository->listCategory();

        $this->setPageTitle('Job', 'List of all Job');
        return view('admin.job.index', compact('job','categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->JobRepository->listCategory();
        $country=DB::table('countries')->orderby('country_name')->get();
        $this->setPageTitle('Job', 'Create Job');
        return view('admin.job.create', compact('categories','country'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       // dd($request->all());

        $this->validate($request, [
            'category_id' =>  'required',
            'title'      =>  'required',
            'description' =>  'required',
            'employment_type' =>  'required',
            'address' =>  'required',
            'postcode' =>  'required',
            'city' =>  'required',
            'state' =>  'required',
            'country' =>  'required',
            'skill' =>  'required',
            'experience' =>  'required',
            'scope' =>  'required',
            'start_date' =>  'required',
            'end_date' =>  'required',
            'salary' =>  'nullable',
        ]);

        $params = $request->except('_token');

        $Job = $this->JobRepository->createJob($params);

        if (!$Job) {
            return $this->responseRedirectBack('Error occurred while creating Job.', 'error', true, true);
        }
        return $this->responseRedirect('admin.job.index', 'Job has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $Job = $this->JobRepository->findJobById($id);
        $country=DB::table('countries')->orderby('country_name')->get();
        $categories = $this->JobRepository->listCategory();
        $this->setPageTitle('Job', 'Edit Job : '.$Job->title);
        return view('admin.job.edit', compact('Job','categories','country'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'category_id' =>  'required',
            'title'      =>  'required',
            'description' =>  'required',
            'employment_type' =>  'required',
            'address' =>  'required',
            'postcode' =>  'required',
            'city' =>  'required',
            'state' =>  'required',
            'country' =>  'required',
            'start_date' =>  'required',
            'end_date' =>  'required',
            'salary' =>  'nullable',
            'skill' =>  'required',
            'experience' =>  'required',
            'scope' =>  'required',
          //  'link' =>  'nullable|url',
           // 'location' =>  'nullable|url',
            //'image'     =>  'nullable|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');

        $Job = $this->JobRepository->updateJob($params);

        if (!$Job) {
            return $this->responseRedirectBack('Error occurred while updating Job.', 'error', true, true);
        }
        return $this->responseRedirectBack('Job has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $Job = $this->JobRepository->deleteJob($id);

        if (!$Job) {
            return $this->responseRedirectBack('Error occurred while deleting Job.', 'error', true, true);
        }
        return $this->responseRedirect('admin.job.index', 'Job has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $Job = $this->JobRepository->updatejobtatus($params);

        if ($Job) {
            return response()->json(array('message'=>'Job status has been successfully updated'));
        }
    }
     /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatefeatureStatus(Request $request){

        $params = $request->except('_token');

        $Job = $this->JobRepository->updateJobfeatureStatus($params);

        if ($Job) {
            return response()->json(array('message'=>'Job status has been successfully updated'));
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatebeginnerStatus(Request $request){

        $params = $request->except('_token');

        $Job = $this->JobRepository->updateJobbegineerfriendlyStatus($params);

        if ($Job) {
            return response()->json(array('message'=>'Job status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $job = $this->JobRepository->detailsJob($id);
        $Job = $job[0];

        $this->setPageTitle('Job', 'Job Details : '.$Job->title);
        return view('admin.job.details', compact('Job'));
    }

    public function csvStore(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'admin/uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database



                    foreach ($importData_arr as $importData) {

                        $commaSeperatedCats = '';

                            $catExistCheck = JobType::where('title', $importData[1])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new JobType();
                                $dirCat->title = $importData[1];
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId . ',';
                            }

                        $count = 0;
                        $commaSeperatedSubCats = '';
                         $count = $total = 0;
                        $successArr = $failureArr = [];



                        if (!empty($importData[0])) {
                            // dd($importData[0]);
                            $titleArr = explode(',', $importData[0]);

                            // echo '<pre>';print_r($titleArr);exit();

                            foreach ($titleArr as $titleKey => $titleValue) {
                                // slug generate
                                $slug = Str::slug($titleValue, '-');
                                $slugExistCount = DB::table('job')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => $titleValue,
                                    "content" => isset($importData[7]) ? $importData[7] : null,
                                    "meta_title" => isset($importData[8]) ? $importData[8] : null,
                                    "meta_key" => isset($importData[6]) ? $importData[6] : null,
                                    "article_category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                                    "article_sub_category_id" => isset($commaSeperatedSubCats) ? $commaSeperatedSubCats : null,
                                    "article_tertiary_category_id" => isset($commaSeperatedSublevelCats) ? $commaSeperatedSublevelCats : null,
                                    "slug" => $slug,
                                    "meta_description" => isset($importData[8]) ? $importData[8] : null,

                                );

                                $resp =Job::insertData($insertData, $count,$successArr,$failureArr);
                                $count = $resp['count'];
                                $successArr = $resp['successArr'];
                                $failureArr = $resp['failureArr'];
                                $total++;
                            }
                        }
                    }
                    //Session::flash('message', 'Import Successful.');
                        if($count==0){
                            FacadesSession::flash('csv', 'Already Uploaded. ');
                        }
                        else{
                             FacadesSession::flash('csv', 'Import Successful. '.$count.' Data Uploaded');
                        }
                } else {
                    FacadesSession::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                FacadesSession::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            FacadesSession::flash('message', 'No file found.');
        }
        return redirect()->route('admin.Job.index');
    }
    // csv upload

    public function export()
    {
        return Excel::download(new JobExport, 'Job.xlsx');
    }
}
