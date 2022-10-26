<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealCategory;
use Illuminate\Http\Request;

class DealsCategoryController extends BaseController
{
    public function index(Request $request)
    {
        $pageTitle = "All deals category";
        if (!empty($request->term))
            $deals_category = DealCategory::where('title', 'like', '%' . $request->term . '%')->paginate(25);
        else
            $deals_category = DealCategory::paginate(25);
        return view('admin.deals-category.index', compact('deals_category', 'pageTitle'));
    }

    public function create()
    {
        $this->setPageTitle('Course', 'Create Course');
        return view('admin.deals-category.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required|max:191',
            'image' => 'required|file|mimes:png,jpg',
            'description' => 'required',
        ]);

        $params = $request->except('_token');

        $deals_category = new DealCategory();
        $deals_category->title = $params['title'];

        // slug
        $deals_category->slug = slugGenerate($params['title'], 'deal_categories');

        // image
        $deals_category->image = imageUpload($params['image'], 'deals/category');
        $deals_category->description = $params['description'];

        $deals_category->save();

        if (!$deals_category) {
            return $this->responseRedirectBack('Error occurred while creating course.', 'error', true, true);
        }

        return $this->responseRedirect('admin.deals.category.index', 'Deals category added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $deal_cat = DealCategory::find($id);
        $this->setPageTitle('Deals Category', 'Category edit : ' . $deal_cat->title . '(' . $deal_cat->slug . ')');
        return view('admin.deals-category.edit',compact('deal_cat'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'image' => 'nullable|file|mimes:png,jpg',
            'description' => 'required',
        ]);

        $deal_cat = DealCategory::find($request->id);
        // dd($deal_cat);

        if ($deal_cat->title != $request->title) {
            $deal_cat->title = $request->title;
            $deal_cat->slug = slugGenerate($request->title, 'deal_categories');
        }

        $deal_cat->description = $request->description;

        if (!empty($request->image))
            $deal_cat->image = imageUpload($request->image, 'deals/category');

        $deal_cat->save();

        return $this->responseRedirectBack('Deal Category updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = DealCategory::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.deals.category.index', 'Deal Category has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        // dd($request->all());

        $deal_cat = DealCategory::find($request->id);
        $deal_cat->status = $request->check_status;

        if ($deal_cat->save()) {
            return response()->json(array('message' => 'Deal-category status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    // public function details($id)
    // {
    //     $courses = DealCategory::find($id);
    //     $course_lessons = DealCategory::where('course_id', $id)->join('lessons as l', 'l.id', '=', 'lesson_id')->get();
    //     $this->setPageTitle('Course', 'Course Details : ' . $courses->title);
    //     return view('admin.course.details', compact('courses', 'course_lessons'));
    // }

    // public function csvStore(Request $request)
    // {
    //     if (!empty($request->file)) {
    //         // if ($request->input('submit') != null ) {
    //         $file = $request->file('file');
    //         // File Details
    //         $filename = $file->getClientOriginalName();
    //         $extension = $file->getClientOriginalExtension();
    //         $tempPath = $file->getRealPath();
    //         $fileSize = $file->getSize();
    //         $mimeType = $file->getMimeType();

    //         // Valid File Extensions
    //         $valid_extension = array("csv");
    //         // 50MB in Bytes
    //         $maxFileSize = 50097152;
    //         // Check file extension
    //         if (in_array(strtolower($extension), $valid_extension)) {
    //             // Check file size
    //             if ($fileSize <= $maxFileSize) {
    //                 // File upload location
    //                 $location = 'admin/uploads/csv';
    //                 // Upload file
    //                 $file->move($location, $filename);
    //                 // Import CSV to Database
    //                 $filepath = public_path($location . "/" . $filename);
    //                 // Reading file
    //                 $file = fopen($filepath, "r");
    //                 $importData_arr = array();
    //                 $i = 0;
    //                 while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
    //                     $num = count($filedata);
    //                     // Skip first row
    //                     if ($i == 0) {
    //                         $i++;
    //                         continue;
    //                     }
    //                     for ($c = 0; $c < $num; $c++) {
    //                         $importData_arr[$i][] = $filedata[$c];
    //                     }
    //                     $i++;
    //                 }
    //                 fclose($file);

    //                 // echo '<pre>';print_r($importData_arr);exit();

    //                 // Insert into database



    //                 foreach ($importData_arr as $importData) {

    //                     $commaSeperatedCats = '';
    //                     $count = 0;
    //                     $commaSeperatedSubCats = '';
    //                     $count = $total = 0;
    //                     $successArr = $failureArr = [];



    //                     if (!empty($importData[0])) {
    //                         // dd($importData[0]);
    //                         $titleArr = explode(',', $importData[0]);

    //                         // echo '<pre>';print_r($titleArr);exit();

    //                         foreach ($titleArr as $titleKey => $titleValue) {
    //                             // slug generate
    //                             $slug = Str::slug($titleValue, '-');
    //                             $slugExistCount = FacadesDB::table('courses')->where('title', $titleValue)->count();
    //                             if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

    //                             $insertData = array(
    //                                 "title" => isset($importData[0]) ? $importData[0] : null,
    //                                 "description" => isset($importData[1]) ? $importData[1] : null,
    //                                 "image" => isset($importData[2]) ? $importData[2] : null,
    //                                 "slug" => $slug
    //                             );

    //                             $resp = Course::insert($insertData);
    //                             $count = $count + 1;
    //                             // $successArr = $resp['successArr'];
    //                             // $failureArr = $resp['failureArr'];
    //                             $total++;
    //                         }
    //                     }
    //                 }
    //                 //Session::flash('message', 'Import Successful.');
    //                 if ($count == 0) {
    //                     FacadesSession::flash('csv', 'Already Uploaded. ');
    //                 } else {
    //                     FacadesSession::flash('csv', 'Import Successful. ' . $count . ' Data Uploaded');
    //                 }
    //             } else {
    //                 FacadesSession::flash('message', 'File too large. File must be less than 50MB.');
    //             }
    //         } else {
    //             FacadesSession::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
    //         }
    //     } else {
    //         FacadesSession::flash('message', 'No file found.');
    //     }
    //     return redirect()->route('admin.course.index');
    // }
    // // csv upload

    // public function export()
    // {
    //     return Excel::download(new ExportsCourse, 'courses.xlsx');
    // }
}
