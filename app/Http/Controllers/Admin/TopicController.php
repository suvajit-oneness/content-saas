<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends BaseController
{
    public function index(Request $request)
    {
        $this->setPageTitle('Topic', 'Topics list');

        if (!empty($request->term)) {
            $data = Topic::where('title', 'like', "$request->term%")->latest('id')->paginate(25);
        } else {
            $data = Topic::latest('id')->paginate(25);
        }

        return view('admin.topic.index', compact('data'));
    }


    public function create()
    {
        $this->setPageTitle('Create new Topic', 'Create topic');
        return view('admin.topic.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:255',
            'image' => 'required|image|max:100000|mimes:jpg,jpeg,png',
            'description' => 'required|min:2'
        ]);

        $topic = new Topic();
        $topic->title = $request->title;

        // slug
        $topic->slug = slugGenerate($request->title, 'topics');

        // image
        if(!empty($request->image)){
            $topic->image = imageUpload($request->image, 'topic');
        }

        $topic->description = $request->description;
        $topic->save();

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while creating topic.', 'error', true, true);
        }
        return $this->responseRedirect('admin.topic.index', 'topic has been added successfully' ,'success',false, false);
    }


    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        $this->setPageTitle('topic', 'Edit topic : '.$topic->title);
        return view('admin.topic.edit', compact('topic'));
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|min:1',
            'title' => 'required|min:2|max:255',
            'image' => 'nullable|image|max:100000|mimes:jpg,jpeg,png',
            'description' => 'required|min:2'
        ]);

        $topic = Topic::findOrFail($request->id);

        // slug
        if ($request->title != $topic->title) {
            $topic->slug = slugGenerate($request->title, 'topics');
        }

        // image
        if(!empty($request->image)){
            $topic->image = imageUpload($request->image, 'topic');
        }

        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->save();

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while updating topic.', 'error', true, true);
        }
        return $this->responseRedirectBack('topic has been updated successfully' ,'success',false, false);
    }


    public function delete($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while deleting topic.', 'error', true, true);
        }
        return $this->responseRedirect('admin.topic.index', 'topic has been deleted successfully' ,'success',false, false);
    }


    public function updateStatus(Request $request){
        $topic = Topic::findOrFail($request->id);
        $topic->status = $request->check_status;
        $topic->save();
        if ($topic) {
            return response()->json(array('message'=>'course status has been successfully updated'));
        }
    }


    public function details($id)
    {
        $topic = Topic::findOrFail($id);

        $this->setPageTitle('topic', 'topic Details : '.$topic->title);
        return view('admin.topic.details', compact('topic'));
    }

/*
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

    public function export()
    {
        return Excel::download(new CourseExport, 'course.xlsx');
    }
*/
}
