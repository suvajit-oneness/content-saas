<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Tool;
class ToolsController extends BaseController
{
    public function index(Request $request){
        $tool= Tool::all();
        $this->setPageTitle('Tools & Feature Content', 'Tools & Feature Content');
        return view('admin.tool.index',compact('tool'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $tool= Tool::findOrfail($id);
        $this->setPageTitle('Tools & Feature Content', 'Edit Tools & Feature Content : ');
        return view('admin.tool.edit', compact('tool'));
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

        $data = Tool::findOrFail($request->id);
        $data->tag = !empty($request->tag) ? $request->tag : '';
        $data->title = !empty($request->title) ? $request->title : '';
        $data->short_desc = !empty($request->short_desc) ? $request->short_desc : '';
        $data->btn_text = !empty($request->btn_text) ? $request->btn_text : '';
        $data->btn_link = !empty($request->btn_link) ? $request->btn_link : '';
        $data->area_desc = !empty($request->area_desc) ? $request->area_desc : '';
        // image
        if(!empty($request['image'])){
            // image, folder name only
            $data->image = imageUpload($request['image'], 'tools');
        }
        $data->save();
       //dd($data);
       
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Tools & Feature Content.', 'error', true, true);
        }
        return $this->responseRedirectBack('Tools & Feature Content has been updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $home= Tool::where('id',$id)->get();
        $data = $home[0];
        $this->setPageTitle('Tools & Feature Content Details', 'Tools & Feature Content Details : ' . $data->title);
        return view('admin.tool.details', compact('data'));
    }
}
