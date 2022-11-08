<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Session;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Home;
class HomeController extends BaseController
{
    public function index(Request $request){
        $home= Home::all();
        $this->setPageTitle('Home Top Section', 'Home Top Section');
        return view('admin.home.index',compact('home'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $home= Home::findOrfail($id);
        $this->setPageTitle('Home Top Section', 'Edit Home Top Section : ' . $home->title);
        return view('admin.home.edit', compact('home'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',

        ]);

        $data = Home::findOrFail($request->id);
        $data->title = !empty($request->title) ? $request->title : '';
        $data->short_desc = !empty($request->short_desc) ? $request->short_desc : '';
        $data->btn_text = !empty($request->btn_text) ? $request->btn_text : '';
        $data->btn_link = !empty($request->btn_link) ? $request->btn_link : '';
        $data->btn_desc = !empty($request->btn_desc) ? $request->btn_desc : '';
        // image
        if(!empty($params['video_image'])){
            // image, folder name only
            $data->video_image = imageUpload($params['video_image'], 'home');
        }
        if(!empty($params['video'])){
            // image, folder name only
            $data->video = imageUpload($params['video'], 'home');
        }
        
        $data->video_desc = !empty($request->video_desc) ? $request->video_desc : '';
        if(!empty($params['video'])){
            // image, folder name only
            $data->video = imageUpload($params['video'], 'home');
        }
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';
        $data->parent_category = !empty($request->title) ? $request->title : '';


        if (!$market) {
            return $this->responseRedirectBack('Error occurred while updating Market market.', 'error', true, true);
        }
        return $this->responseRedirectBack('Market market has been updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $home= Home::where('id',$id)->get();
        $data = $home[0];
        $this->setPageTitle('Home Top Section Details', 'Home Top Section Details : ' . $data->title);
        return view('admin.home.details', compact('data'));
    }

}
