<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\CourseTopicContract;
use Illuminate\Http\Request;
use App\Models\CourseTopic;
use App\Models\Course;
use App\Models\CourseSlide;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursetopicExport;
use App\Models\CourseModule;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class CourseTopicController extends BaseController
{
    /**
     * @var CourseTopicContract
     */
    protected $CourseTopicRepository;


    /**
     * CoursetopicController constructor.
     * @param CourseTopicContract $CourseTopicRepository
     */
    public function __construct(CourseTopicContract $CourseTopicRepository)
    {
        $this->CourseTopicRepository = $CourseTopicRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request,$id)
    {
        if (!empty($request->term)) {
            $topic = $this->CourseTopicRepository->getSearchtopic($request->term);
        } else {
            $topic = CourseTopic::where('course_id',$id)->orderby('topic')->paginate(25);
        }
          $topic_id=$topic[0]->id;
        //dd($topic[0]->id);
        $slide = CourseSlide::where('topic_id',$topic_id)->orderby('slide_content')->paginate(25);
       // dd($slide);
        $this->setPageTitle('Course topic', 'List of all course topic');
        return view('admin.course.topic.index', compact('topic','request','id','slide','topic_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Course topic', 'Create Course topic');
        return view('admin.course.topic.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    	//dd($request->all());
        $this->validate($request, [
            'topic'      =>  'required',

        ]);
        $params = $request->except('_token');

        $category = $this->CourseTopicRepository->createtopic($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating Course topic.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Course topic has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $topic = $this->CourseTopicRepository->findtopicById($id);

        $this->setPageTitle('Course topic', 'Edit Course topic : ');
        return view('admin.course.topic.edit', compact('topic'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'topic'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $topic = $this->CourseTopicRepository->updatetopic($params);

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while updating Course topic.', 'error', true, true);
        }
        return $this->responseRedirectBack('Course topic has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $topic = $this->CourseTopicRepository->deletetopic($id);

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while deleting Course topic.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Course topic has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $topic = $this->CourseTopicRepository->updatetopicStatus($params);

        if ($topic) {
            return response()->json(array('message' => 'Course topic status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->CourseTopicRepository->detailstopic($id);
        $topic = $categories[0];

        $this->setPageTitle('Course topic Details', 'Course topic Details : ' . $topic->title);
        return view('admin.course.topic.details', compact('topic'));
    }


    //csv upload

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
                    $insertData = [];
                    $count = $total = 0;
                    $successArr = $failureArr = [];
                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        $commaSeperatedCats = '';

                            $catExistCheck = Course::where('course_name', $importData[1])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new Course();
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

                            $catExistCheck = CourseModule::where('title', $importData[3])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedSubCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new CourseModule();
                                $dirCat->title = $importData[3];
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedSubCats .= $insertDirCatId . ',';
                            }
                        $storeData = 0;
                        if (isset($importData[3]) == "Carry In") $storeData = 1;
                            $titleArr = explode(',', $importData[0]);
                        foreach ($titleArr as $titleKey => $titleValue) {
                            // slug generate
                            $slug = Str::slug($titleValue, '-');
                            $slugExistCount = DB::table('course_topics')->where('title', $titleValue)->count();
                            if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                        $insertData = array(
                            "topic" => isset($importData[0]) ? $importData[0] : null,
                            "slug" => $slug,
                            "course_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                            "module_id" => isset($commaSeperatedSubCats) ? $commaSeperatedSubCats : null,

                        );
                        // echo '<pre>';print_r($insertData);exit();
                        $resp = Coursetopic::insertData($insertData, $count, $successArr, $failureArr);
                        $count = $resp['count'];
                        $successArr = $resp['successArr'];
                        $failureArr = $resp['failureArr'];
                        $total++;
                    }
                }
                if($count == 0){
                    FacadesSession::flash('csv', 'Already Uploaded. ');
                } else{
                     FacadesSession::flash('csv', 'Import Successful. '.$count.' Data Uploaded');
                }
                   // Session::flash('message', 'Import Successful.');
                } else {
                    FacadesSession::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                FacadesSession::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            FacadesSession::flash('message', 'No file found.');
        }
        return redirect()->route('admin.course.index');
    }
    // csv upload

    // export
    public function export()
    {
        return Excel::download(new CoursetopicExport, 'coursetopic.xlsx');
    }
}
