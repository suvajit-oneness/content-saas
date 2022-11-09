<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ToolAreaofInterest;
use App\Models\ToolAreaofInterestCategory;
class ToolsInterestController extends BaseController
{
    public function index(Request $request){
        if (!empty($request->term)) {
        $data = ToolAreaofInterest::where([['title', 'LIKE', '%' . $request->term . '%']])->paginate(25);
        } else {
        $data= ToolAreaofInterest::paginate(25);
        }
        $this->setPageTitle('Area of Interest', 'Area of Interest');
        return view('admin.tool.interest.index',compact('data'));
    }
    public function create(Request $request){
        $categories = ToolAreaofInterestCategory::where('status',1)->get();
        $this->setPageTitle('Area of Interest', 'Area of Interest');
        return view('admin.tool.interest.create',compact('categories'));
    }
    public function store(Request $request)
    {
       //dd($request->all());
        $this->validate($request, [
            'title'      =>  'required',

        ]);
        $data = new ToolAreaofInterest;
        $data->title = !empty($request->title) ? $request->title : '';
        $data->cat_id = !empty($request->cat_id) ? $request->cat_id : '';
        $data->slug = slugGenerate($request['title'], 'tool_areaof_interests');
        $data->description = !empty($request->description) ? $request->description : '';
        if(!empty($request['image'])){
            // image, folder name only
            $data->image = imageUpload($request['image'], 'areaofinterest');
        }
        $data->save();
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Area of Interest.', 'error', true, true);
        }
        return $this->responseRedirectBack('Area of Interest has been updated successfully', 'success', false, false);
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data= ToolAreaofInterest::findOrfail($id);
        $categories = ToolAreaofInterestCategory::where('status',1)->get();
        $this->setPageTitle('Area of Interest', 'Edit Area of Interest : ');
        return view('admin.tool.interest.edit', compact('data','categories'));
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
            'title'      =>  'required',

        ]);

        $data = ToolAreaofInterest::findOrFail($request->id);
        $data->title = !empty($request->title) ? $request->title : '';
        $data->cat_id = !empty($request->cat_id) ? $request->cat_id : '';
        if($data->title != $request['title']) {
        $data->slug = slugGenerate($request['title'], 'tool_areaof_interests');
        }
        $data->description = !empty($request->description) ? $request->description : '';
        if(!empty($request['image'])){
            // image, folder name only
            $data->image = imageUpload($request['image'], 'areaofinterest');
        }
        $data->save();
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Area of Interest.', 'error', true, true);
        }
        return $this->responseRedirectBack('Area of Interest has been updated successfully', 'success', false, false);
    }
     /**
     * @param $id
     * @return bool|mixed
     */
    public function delete(Request $request,$id)
    {
        $data = ToolAreaofInterest::findOrFail($id);
        $data->delete();
        if (!$data) {
        return $this->responseRedirectBack('Error occurred while deleting Area of Interest.', 'error', true, true);
        }
        return $this->responseRedirectBack('Area of Interest has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateStatus(Request $request){
        $data = ToolAreaofInterest::findOrFail($request->id);
        $collection = collect($request)->except('_token');
        $data->status = $request['check_status'];
        $data->save();

        return $data;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function details($id)
    {
        $home= ToolAreaofInterest::where('id',$id)->get();
        $data = $home[0];
        $this->setPageTitle('Area of Interest Details', 'Area of Interest Details : ' . $data->title);
        return view('admin.tool.interest.details', compact('data'));
    }
}
