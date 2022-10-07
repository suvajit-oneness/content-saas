<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\CourseContract;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourseExport;
use App\Models\CourseCategory;
use App\Models\courseType;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class CourseController extends BaseController
{
    /**
     * @var CourseContract
     */
    protected $CourseRepository;


    /**
     * CourseController constructor.
     * @param CourseContract $CourseRepository
     *
     */
    public function __construct(CourseContract $CourseRepository)
    {
        $this->CourseRepository = $CourseRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (isset($request->category) || isset($request->keyword) ||isset($request->author) || isset($request->type)) {
            $category = !empty($request->category) ? $request->category : '';
            $keyword = !empty($request->keyword) ? $request->keyword : '';
            $author = !empty($request->author) ? $request->author : '';
            $type = !empty($request->type) ? $request->type : '';
            $course = $this->CourseRepository->searchCoursesData($category,$author,$type,$keyword);
        }else{
            $course = Course::orderby('course_name')->paginate(25);
        }
        $categories = $this->CourseRepository->listCategory();
        $this->setPageTitle('course', 'List of all course');
        return view('admin.course.course.index', compact('course','categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->CourseRepository->listCategory();
        $this->setPageTitle('course', 'Create course');
        return view('admin.course.course.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'course_name'      =>  'required|max:191',
            'author_name'      =>  'required|max:191',
            'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');

        $course = $this->CourseRepository->createCourse($params);

        if (!$course) {
            return $this->responseRedirectBack('Error occurred while creating course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'course has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetcourse = $this->CourseRepository->findCourseById($id);
        $categories = $this->CourseRepository->listCategory();
        $this->setPageTitle('course', 'Edit course : '.$targetcourse->title);
        return view('admin.course.course.edit', compact('targetcourse','categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'course_name' =>  'required|max:191',
        ]);

        $params = $request->except('_token');

        $course = $this->CourseRepository->updateCourse($params);

        if (!$course) {
            return $this->responseRedirectBack('Error occurred while updating course.', 'error', true, true);
        }
        return $this->responseRedirectBack('course has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $course = $this->CourseRepository->deleteCourse($id);

        if (!$course) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'course has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $course = $this->CourseRepository->updateCourseStatus($params);

        if ($course) {
            return response()->json(array('message'=>'course status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $course = $this->CourseRepository->detailsCourse($id);
        $course = $course[0];

        $this->setPageTitle('course', 'course Details : '.$course->title);
        return view('admin.course.course.details', compact('course'));
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

                            $catExistCheck = CourseCategory::where('title', $importData[3])->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new CourseCategory();
                                $dirCat->title = $importData[3];
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
                                $slugExistCount = DB::table('courses')->where('course_name', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "course_name" => $titleValue,
                                    "short_description" => isset($importData[1]) ? $importData[1] : null,
                                    "description" => isset($importData[2]) ? $importData[2] : null,
                                    "category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                                    "slug" => $slug,
                                    "company_name" => isset($importData[4]) ? $importData[4] : null,
                                    "company_description" => isset($importData[5]) ? $importData[5] : null,
                                    "author_name" => isset($importData[6]) ? $importData[6] : null,
                                    "author_description" => isset($importData[7]) ? $importData[7] : null,
                                    "target" => isset($importData[8]) ? $importData[8] : null,
                                    "requirements" => isset($importData[9]) ? $importData[9] : null,
                                    "language" => isset($importData[10]) ? $importData[10] : null,
                                    "type" => isset($importData[11]) ? $importData[11] : null,
                                    "price" => isset($importData[12]) ? $importData[12] : null,

                                );

                                $resp =Course::insertData($insertData, $count,$successArr,$failureArr);
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
        return redirect()->route('admin.course.index');
    }
    // csv upload

    public function export()
    {
        return Excel::download(new CourseExport, 'course.xlsx');
    }
}
