<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ToolAreaofInterestCategory;

class ToolsInterestCategoryController extends BaseController
{
    public function index(Request $request){
        if (!empty($request->term)) {
        $data = ToolAreaofInterestCategory::where([['title', 'LIKE', '%' . $request->term . '%']])->paginate(25);
        } else {
        $data= ToolAreaofInterestCategory::paginate(25);
        }
        $this->setPageTitle('Category', 'Category');
        return view('admin.tool.interestcat.index',compact('data'));
    }
    public function create(Request $request){
        $this->setPageTitle('Category', 'Category');
        return view('admin.tool.interestcat.create');
    }
    public function store(Request $request)
    {
       //dd($request->all());
        $this->validate($request, [
            'title'      =>  'required',

        ]);
        $data = new ToolAreaofInterestCategory;
        $data->title = !empty($request->title) ? $request->title : '';
        $data->slug = slugGenerate($request['title'], 'tool_areaof_interest_categories');
        $data->save();
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category has been updated successfully', 'success', false, false);
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data= ToolAreaofInterestCategory::findOrfail($id);
        $this->setPageTitle('Category', 'Edit Category : ');
        return view('admin.tool.interestcat.edit', compact('data'));
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

        $data = ToolAreaofInterestCategory::findOrFail($request->id);
        $data->title = !empty($request->title) ? $request->title : '';
        if($data->title != $request['title']) {
        $data->slug = slugGenerate($request['title'], 'tool_areaof_interest_categories');
        }
        $data->save();
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category has been updated successfully', 'success', false, false);
    }
     /**
     * @param $id
     * @return bool|mixed
     */
    public function delete(Request $request,$id)
    {
        $data = ToolAreaofInterestCategory::findOrFail($id);
        $data->delete();
        if (!$data) {
        return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateStatus(Request $request){
        $data = ToolAreaofInterestCategory::findOrFail($request->id);
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
        $home= ToolAreaofInterestCategory::where('id',$id)->get();
        $data = $home[0];
        $this->setPageTitle('Category Details', 'Category Details : ' . $data->title);
        return view('admin.tool.interestcat.details', compact('data'));
    }
}
