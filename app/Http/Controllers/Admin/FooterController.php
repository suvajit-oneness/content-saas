<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Footer;

class FooterController extends BaseController
{
    public function index(Request $request){
        $data= Footer::all();
        $this->setPageTitle('Footer Content', 'Footer Content');
        return view('admin.footer.index',compact('data'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data= Footer::findOrfail($id);
        $this->setPageTitle('Footer Content', 'Footer Content : ');
        return view('admin.footer.edit', compact('data'));
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
            'title'      =>  'nullable',
        ]);
        $data = Footer::findOrFail($request->id);
        $data->title = !empty($request->title) ? $request->title : '';
        $data->short_desc = !empty($request->short_desc) ? $request->short_desc : '';
        $data->btn_text = !empty($request->btn_text) ? $request->btn_text : '';
        $data->btn_link = !empty($request->btn_link) ? $request->btn_link : '';
        $data->btn_desc = !empty($request->area_desc) ? $request->area_desc : '';
        // image
        if(!empty($request['footer_logo'])){
            // image, folder name only
            $data->footer_logo = imageUpload($request['footer_logo'], 'footer');
        }
        if(!empty($request['footer_background'])){
            // image, folder name only
            $data->footer_background= imageUpload($request['footer_background'], 'footer');
        }
        $data->footer_tag = !empty($request->footer_tag) ? $request->footer_tag : '';
        $data->save();
       //dd($data);
       
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Footer Content.', 'error', true, true);
        }
        return $this->responseRedirectBack('Footer Content has been updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $obj= Footer::where('id',$id)->get();
        $data = $obj[0];
        $this->setPageTitle('Footer Content Details', 'Footer Content Details : ' . $data->title);
        return view('admin.footer.details', compact('data'));
    }
}
