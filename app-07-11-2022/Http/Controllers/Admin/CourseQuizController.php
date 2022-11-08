<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\CourseQuizContract;
use Illuminate\Http\Request;
use App\Models\Coursequiz;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursequizExport;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class CourseQuizController extends BaseController
{
    /**
     * @var CourseQuizContract
     */
    protected $CourseQuizRepository;


    /**
     * CoursequizController constructor.
     * @param CourseQuizContract $CourseQuizContract
     */
    public function __construct(CourseQuizContract $CourseQuizRepository)
    {
        $this->CourseQuizRepository = $CourseQuizRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request,$id)
    {
        if (!empty($request->term)) {
            $quiz = $this->CourseQuizRepository->getSearchquiz($request->term);
        } else {
            $quiz = CourseQuiz::where('course_id',$id)->orderby('question')->paginate(25);
        }
        $this->setPageTitle('Course quiz', 'List of all course quiz');
        return view('admin.course.quiz.index', compact('quiz','request','id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $this->setPageTitle('Course quiz', 'Create Course quiz');
        return view('admin.course.quiz.create');
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
            'question'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');

        $category = $this->CourseQuizRepository->createquiz($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating Course quiz.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Course quiz has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $quiz = $this->CourseQuizRepository->findquizById($id);

        $this->setPageTitle('Course quiz', 'Edit Course quiz : ');
        return view('admin.course.quiz.edit', compact('quiz'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'question'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $quiz = $this->CourseQuizRepository->updatequiz($params);

        if (!$quiz) {
            return $this->responseRedirectBack('Error occurred while updating Course quiz.', 'error', true, true);
        }
        return $this->responseRedirectBack('Course quiz has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $quiz = $this->CourseQuizRepository->deletequiz($id);

        if (!$quiz) {
            return $this->responseRedirectBack('Error occurred while deleting Course quiz.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Course quiz has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $quiz = $this->CourseQuizRepository->updatequizStatus($params);

        if ($quiz) {
            return response()->json(array('message' => 'Course quiz status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->CourseQuizRepository->detailsquiz($id);
        $quiz = $categories[0];

        $this->setPageTitle('Course quiz Details', 'Course quiz Details : ' . $category->title);
        return view('admin.course.quiz.details', compact('quiz'));
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
                        $storeData = 0;
                        if (isset($importData[3]) == "Carry In") $storeData = 1;
                            $titleArr = explode(',', $importData[0]);
                        foreach ($titleArr as $titleKey => $titleValue) {
                            // slug generate
                            $slug = Str::slug($titleValue, '-');
                            $slugExistCount = DB::table('course_quizs')->where('title', $titleValue)->count();
                            if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                        $insertData = array(
                            "title" => isset($importData[0]) ? $importData[0] : null,
                            "slug" => $slug,
                            "description" => isset($importData[1]) ? $importData[1] : null,

                        );
                        // echo '<pre>';print_r($insertData);exit();
                        $resp = Coursequiz::insertData($insertData, $count, $successArr, $failureArr);
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
        return Excel::download(new CoursequizExport, 'coursequiz.xlsx');
    }
}
