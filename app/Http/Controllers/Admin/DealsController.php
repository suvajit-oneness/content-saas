<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealCategory;
use Illuminate\Http\Request;

class DealsController extends BaseController
{
    public function index(Request $request)
    {
        $this->setPageTitle('Deals Master', 'All deals!');
        if (!empty($request->term))
            $deals = Deal::where('title', 'like', '%' . $request->term . '%')->paginate(25);
        else
            $deals = Deal::paginate(25);
        return view('admin.deals.index', compact('deals'));
    }

    public function create()
    {
        $deal_category = DealCategory::orderBy('title')->get();
        $this->setPageTitle('Deals Master', 'Create new deal!');
        return view('admin.deals.create',compact('deal_category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:191',
            'short_description' => 'required|max:60',
            'description' => 'required',

            'company_name' => 'required',
            'company_description' => 'required',
            'company_website_link' => 'required',
            'company_logo' => 'required|file|mimes:png,jpg',
            
            'discount_amount' => 'required',
            'discount_type' => 'required',
        ]);

        $params = $request->except('_token');

        $deal = new Deal();
        
        $deal->category = $params['category'];
        
        $deal->title = $params['title'];
        // slug
        $deal->slug = slugGenerate($params['title'], 'deals');
        
        $deal->description = $params['description'];
        $deal->short_description = $params['short_description'];
        
        
        $deal->company_name = $params['company_name'];
        $deal->company_description = $params['company_description'];
        $deal->company_website_link = $params['company_website_link'];
        // image
        $deal->company_logo = imageUpload($params['company_logo'], 'deals');

        
        $deal->discount_amount = $params['discount_amount'];
        $deal->discount_type = $params['discount_type'];

        $deal->status = 0;

        $deal->save();

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while creating course.', 'error', true, true);
        }

        return $this->responseRedirect('admin.deals.index', 'Course has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $deal = Deal::find($id);
        $deal_category = DealCategory::orderBy('title')->get();

        $this->setPageTitle('Deals Master', 'Edit deal: '.$deal->title . '('.$deal->slug.')');

        return view('admin.deals.edit', compact('deal_category', 'deal'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:191',
            'short_description' => 'required|max:60',
            'description' => 'required',

            'company_name' => 'required',
            'company_description' => 'required',
            'company_website_link' => 'required',
            'company_logo' => 'nullable|file|mimes:png,jpg',
            
            'discount_amount' => 'required',
            'discount_type' => 'required',
        ]);

        $params = $request->except('_token');

        $deal = Deal::find($request->id);
        
        $deal->category = $params['category'];
        
        if($deal->title != $request->title){
            $deal->title = $params['title'];
            // slug
            $deal->slug = slugGenerate($params['title'], 'deals');
        }
        
        $deal->short_description = $params['short_description'];
        $deal->description = $params['description'];
        
        
        $deal->company_name = $params['company_name'];
        $deal->company_description = $params['company_description'];
        $deal->company_website_link = $params['company_website_link'];
        // image
        if (!empty($request->company_logo))
            $deal->company_logo = imageUpload($params['company_logo'], 'deals');

        
        $deal->discount_amount = $params['discount_amount'];
        $deal->discount_type = $params['discount_type'];

        if (!$deal->save()) {
            return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
        }

        return $this->responseRedirectBack('Deal has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = Deal::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.deals.index', 'Deal has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        // dd($request->all());

        $deal = Deal::find($request->id);
        $deal->status = $request->check_status;

        if ($deal->save()) {
            return response()->json(array('message' => 'Deal has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $deals = Deal::find($id);
        $this->setPageTitle('Deals Master', 'Deal: '.$deals->title . '('.$deals->slug.')');
        return view('admin.deals.details', compact('deals'));
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
