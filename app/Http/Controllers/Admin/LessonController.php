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
use App\Exports\Lesson as ExportsLesson;
use App\Models\Category;
use App\Models\CourseCategory;
use App\Models\courseType;
use App\Models\Lesson;
use App\Models\LessonTopic;
use App\Models\Topic;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session as FacadesSession;

class LessonController extends BaseController
{
    public function index(Request $request)
    {
        $pageTitle = "Lessons";
        if(!empty($request->term))
            $lessons = Lesson::where('title','like','%'.$request->term.'%')->paginate(25);
        else
            $lessons = Lesson::paginate(25);
        return view('admin.lesson.index', compact('lessons','pageTitle'));
    }

    public function create()
    {
        $categories = CourseCategory::latest('title')->get();
        $this->setPageTitle('Lessons', 'Create lessons');
        return view('admin.lesson.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'lesson_title'      =>  'required|max:191',
            'lesson_image'      =>  'required|file|mimes:png,jpg',
        ]);

        $params = $request->except('_token');

        $lesson = new Lesson();
        $lesson->title = $params['lesson_title'];

        // slug
        $lesson->slug = slugGenerate($params['lesson_title'], 'lessons');

        // image
        $lesson->image = imageUpload($params['lesson_image'], 'lessons');

        $lesson->description = $params['short_description'];
        $lesson->save();

        if (!$lesson) {
            return $this->responseRedirectBack('Error occurred while creating Lesson.', 'error', true, true);
        }

        return $this->responseRedirect('admin.lesson.index', 'Lesson has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);
        $topics = Topic::all();
        $this->setPageTitle('Lesson', 'Lesson Edit : '.$lesson->title);
        return view('admin.lesson.edit', compact('lesson','topics'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required|max:191',
            'description' => 'required| min:2',
            'image' => 'nullable|file|mimes:jpeg,png'
        ]);

        $lesson = Lesson::find($request->id);

        if($lesson->title != $request->title){
            $lesson->title = $request->title;
            $lesson->slug = slugGenerate($request->title, 'lessons');
        }

        $lesson->description = $request->description;

        if(!empty($request->image))
            $lesson->image = imageUpload($request->image, 'lessons');

        if (!$lesson->save()) {
            return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
        }
        return $this->responseRedirectBack('Lesson has been updated successfully' ,'success',false, false);
    }

    public function updateLessonTopic($id, Request $request)
    {
        // dd($request->all());
        foreach ($request->topics as $value) {
            LessonTopic::insert(['lesson_id'=>$id, 'topic_id'=>$value]);
        }
        return $this->responseRedirectBack('Lesson Topics updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = Lesson::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.lesson.index', 'Lesson has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        // dd($request->all());

        $lesson = Lesson::find($request->id);
        $lesson->status = $request->check_status;

        if ($lesson->save()) {
            return response()->json(array('message'=>'Lesson status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $lesson = Lesson::find($id);

        $this->setPageTitle('Lesson', 'Lesson Details : '.$lesson->title);
        return view('admin.lesson.details', compact('lesson'));
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
                                $slugExistCount = FacadesDB::table('lessons')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => isset($importData[0]) ? $importData[0] : null,
                                    "description" => isset($importData[1]) ? $importData[1] : null,
                                    "image" => isset($importData[2]) ? $importData[2] : null,
                                    "slug" => $slug
                                );

                                $resp =Lesson::insert($insertData);
                                $count = $count + 1;
                                // $successArr = $resp['successArr'];
                                // $failureArr = $resp['failureArr'];
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
        return redirect()->route('admin.lesson.index');
    }
    // csv upload

    public function export()
    {
        return Excel::download(new ExportsLesson, 'lesson.xlsx');
    }
}
