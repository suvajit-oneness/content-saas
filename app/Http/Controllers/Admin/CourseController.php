<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\CourseContract;
use App\Exports\Course as ExportsCourse;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\BaseController;
use Auth;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourseExport;
use App\Exports\Lesson as ExportsLesson;
use App\Models\Category;
use App\Models\CourseCategory;
use App\Models\CourseLesson;
use App\Models\courseType;
use App\Models\Language;
use App\Models\Lesson;
// use App\Models\Lesson;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session as FacadesSession;

class CourseController extends BaseController
{
    public function index(Request $request)
    {
        $pageTitle = "Course";
        if (!empty($request->term))
            $courses = Course::where('title', 'like', '%' . $request->term . '%')->paginate(25);
        else
            $courses = Course::paginate(25);
        return view('admin.course.index', compact('courses', 'pageTitle'));
    }

    public function create()
    {
        $course_category = CourseCategory::orderBy('title')->get();
        $languages = Language::orderBy('name')->get();
        $this->setPageTitle('Course', 'Create Course');
        return view('admin.course.create',compact('course_category','languages'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:191',
            'image' => 'required|file|mimes:png,jpg',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required',
            'preview_video' => 'required|file|mimes:mp4',
            'course_content' => 'required',
            'requirements' => 'required',
            'target' => 'required',
            'company_name' => 'required',
            'language' => 'required',
        ]);

        $params = $request->except('_token');

        $course = new Course();
        $course->title = $params['title'];

        $course->category_id = $params['category_id'];

        // slug
        $course->slug = slugGenerate($params['title'], 'courses');

        // image
        $course->image = imageUpload($params['image'], 'courses');
        $course->preview_video = imageUpload($params['preview_video'], 'courses/video');

        $course->short_description = $params['short_description'];
        $course->description = $params['description'];
        
        $course->price = $params['price'];
        $course->course_content = $params['course_content'];
        $course->requirements = $params['requirements'];
        $course->target = $params['target'];
        $course->company_name = $params['company_name'];
        $course->language = $params['language'];

        $course->certificate = isset($request->certificate) ? 1 : 0;

        $course->status = 0;

        $course->save();

        if (!$course) {
            return $this->responseRedirectBack('Error occurred while creating course.', 'error', true, true);
        }

        return $this->responseRedirect('admin.course.index', 'Course has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $course = Course::find($id);

        $this->setPageTitle('Course', 'Course Edit : ' . $course->title);

        $course_lessons = CourseLesson::where('course_id', $id)->join('lessons as l', 'l.id', '=', 'lesson_id')->get();
        $selected_lesson_ids = [];
        foreach ($course_lessons as $value) {
            array_push($selected_lesson_ids, $value->lesson_id);
        }
        // dd($course_lessons);

        $lessons = Lesson::whereNotIn('id', $selected_lesson_ids)->get();

        $course_category = CourseCategory::orderBy('title')->get();

        return view('admin.course.edit', compact('course', 'lessons', 'course_lessons', 'course_category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required|max:191',
            'image' => 'nullable|file|mimes:png,jpg',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required',
            'preview_video' => 'nullable|file|mimes:mp4',
            'course_content' => 'required',
            'requirements' => 'required',
            'target' => 'required',
            'company_name' => 'required',
            'language' => 'required',
        ]);

        $course = Course::find($request->id);

        $course->category_id = $request->category_id;

        if ($course->title != $request->title) {
            $course->title = $request->title;
            $course->slug = slugGenerate($request->title, 'courses');
        }

        $course->description = $request->description;

        $course->short_description = $request->short_description;
        $course->price = $request->price;
        $course->course_content = $request->course_content;
        $course->requirements = $request->requirements;
        $course->target = $request->target;
        $course->company_name = $request->company_name;
        $course->language = $request->language;

        $course->certificate = isset($request->certificate) ? 1 : 0;


        if (!empty($request->image))
            $course->image = imageUpload($request->image, 'courses');

        if (!empty($request->preview_video))
            $course->preview_video = imageUpload($request->preview_video, 'courses/video');

        if (!$course->save()) {
            return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
        }

        return $this->responseRedirectBack('Course has been updated successfully', 'success', false, false);
    }

    public function updateCourseLesson($id, Request $request)
    {
        // dd($request->all());
        foreach ($request->lesson as $value) {
            if (CourseLesson::where('course_id', $id)->where('lesson_id', $value)->count() <= 0)
                CourseLesson::insert(['course_id' => $id, 'lesson_id' => $value]);
        }
        return $this->responseRedirectBack('Course lessons updated successfully', 'success', false, false);
    }


    public function deleteCourseLesson($cid, $lid)
    {
        CourseLesson::where('lesson_id', $lid)->where('course_id', $cid)->delete();
        return $this->responseRedirectBack('Course Lesson deleted successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = Course::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.course.index', 'Lesson has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        // dd($request->all());

        $lesson = Course::find($request->id);
        $lesson->status = $request->check_status;

        if ($lesson->save()) {
            return response()->json(array('message' => 'Course status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $courses = Course::find($id);
        $course_lessons = CourseLesson::where('course_id', $id)->join('lessons as l', 'l.id', '=', 'lesson_id')->get();
        $this->setPageTitle('Course', 'Course Details : ' . $courses->title);
        return view('admin.course.details', compact('courses', 'course_lessons'));
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
                                $slugExistCount = FacadesDB::table('courses')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => isset($importData[0]) ? $importData[0] : null,
                                    "description" => isset($importData[1]) ? $importData[1] : null,
                                    "image" => isset($importData[2]) ? $importData[2] : null,
                                    "slug" => $slug
                                );

                                $resp = Course::insert($insertData);
                                $count = $count + 1;
                                // $successArr = $resp['successArr'];
                                // $failureArr = $resp['failureArr'];
                                $total++;
                            }
                        }
                    }
                    //Session::flash('message', 'Import Successful.');
                    if ($count == 0) {
                        FacadesSession::flash('csv', 'Already Uploaded. ');
                    } else {
                        FacadesSession::flash('csv', 'Import Successful. ' . $count . ' Data Uploaded');
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
        return Excel::download(new ExportsCourse, 'courses.xlsx');
    }
}
