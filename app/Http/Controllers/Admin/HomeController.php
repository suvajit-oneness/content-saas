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
       //dd($request->all());
        $this->validate($request, [
            'title'      =>  'nullable',

        ]);

        $data = Home::findOrFail($request->id);
        $data->title = !empty($request->title) ? $request->title : '';
        $data->short_desc = !empty($request->short_desc) ? $request->short_desc : '';
        $data->btn_text = !empty($request->btn_text) ? $request->btn_text : '';
        $data->btn_link = !empty($request->btn_link) ? $request->btn_link : '';
        $data->btn_desc = !empty($request->btn_desc) ? $request->btn_desc : '';
        // image
        if(!empty($request['video_image'])){
            // image, folder name only
            $data->video_image = imageUpload($request['video_image'], 'home');
        }
        if(!empty($request['video'])){
            // image, folder name only
            $data->video = imageUpload($request['video'], 'home');
        }
        
        $data->video_desc = !empty($request->video_desc) ? $request->video_desc : '';
        if(!empty($request['section_one_icon'])){
            // image, folder name only
            $data->section_one_icon = imageUpload($request['section_one_icon'], 'home');
        }
        $data->section_one_title = !empty($request->section_one_title) ? $request->section_one_title : '';
        $data->section_one_short_desc = !empty($request->section_one_short_desc) ? $request->section_one_short_desc : '';
        $data->section_one_btn_text = !empty($request->section_one_btn_text) ? $request->section_one_btn_text : '';
        $data->section_one_btn_link = !empty($request->section_one_btn_link) ? $request->section_one_btn_link : '';
        if(!empty($request['section_one_image'])){
            // image, folder name only
            $data->section_one_image = imageUpload($request['section_one_image'], 'home');
        }
        $data->section_two_tag = !empty($request->section_two_tag) ? $request->section_two_tag : '';
        $data->section_two_title = !empty($request->section_two_title) ? $request->section_two_title : '';
        $data->section_two_short_desc = !empty($request->section_two_short_desc) ? $request->section_two_short_desc : '';
        $data->section_two_category = !empty($request->section_two_category) ? $request->section_two_category : '';
        $data->section_two_btn = !empty($request->section_two_btn) ? $request->section_two_btn : '';
        $data->section_two_btn_link = !empty($request->section_two_btn_link) ? $request->section_two_btn_link : '';
        if(!empty($request['section_two_image'])){
            // image, folder name only
            $data->section_two_image = imageUpload($request['section_two_image'], 'home');
        }
        if(!empty($request['section_three_icon'])){
            // image, folder name only
            $data->section_three_icon = imageUpload($request['section_three_icon'], 'home');
        }
       
        $data->section_three_tag = !empty($request->section_three_tag) ? $request->section_three_tag : '';
        $data->section_three_title = !empty($request->section_three_title) ? $request->section_three_title : '';
        $data->section_three_short_desc	 = !empty($request->section_three_short_desc) ? $request->section_three_short_desc : '';
        if(!empty($request['section_three_image'])){
            // image, folder name only
            $data->section_three_image = imageUpload($request['section_three_image'], 'home');
        }
        $data->section_three_btn = !empty($request->section_three_btn) ? $request->section_three_btn : '';
        $data->section_three_btn_link = !empty($request->section_three_btn_link) ? $request->section_three_btn_link : '';
        $data->section_four_tag = !empty($request->section_four_tag) ? $request->section_four_tag : '';
        $data->section_four_title = !empty($request->section_four_title) ? $request->section_four_title : '';
        $data->section_four_short_desc = !empty($request->section_four_short_desc) ? $request->section_four_short_desc : '';
        $data->section_four_btn = !empty($request->section_four_btn) ? $request->section_four_btn : '';
        $data->section_four_btn_link = !empty($request->section_four_btn_link) ? $request->section_four_btn_link : '';
        if(!empty($request['section_four_image'])){
            // image, folder name only
            $data->section_four_image = imageUpload($request['section_four_image'], 'home');
        }
        if(!empty($request['section_five_icon'])){
            // image, folder name only
            $data->section_five_icon = imageUpload($request['section_five_icon'], 'home');
        }
        $data->section_five_tag = !empty($request->section_five_tag) ? $request->section_five_tag : '';
        $data->section_five_title = !empty($request->section_five_title) ? $request->section_five_title : '';
        $data->section_five_short_desc	 = !empty($request->section_five_short_desc	) ? $request->section_five_short_desc	 : '';
        $data->section_five_btn = !empty($request->section_five_btn) ? $request->section_five_btn : '';
        $data->section_five_btn_link = !empty($request->section_five_btn_link) ? $request->section_five_btn_link : '';
        if(!empty($request['section_five_image'])){
            // image, folder name only
            $data->section_five_image = imageUpload($request['section_five_image'], 'home');
        }
        $data->section_six_tag = !empty($request->section_six_tag) ? $request->section_six_tag : '';
        $data->section_six_title = !empty($request->section_six_title) ? $request->section_six_title : '';
        $data->section_six_short_desc = !empty($request->section_six_short_desc) ? $request->section_six_short_desc : '';
        $data->section_six_btn = !empty($request->section_six_btn) ? $request->section_six_btn : '';
        $data->section_six_btn_link = !empty($request->section_six_btn_link) ? $request->section_six_btn_link : '';
        if(!empty($request['section_six_image'])){
            // image, folder name only
            $data->section_six_image = imageUpload($request['section_six_image'], 'home');
        }
        $data->save();
       //dd($data);
       
        if (!$data) {
            return $this->responseRedirectBack('Error occurred while updating Home Page.', 'error', true, true);
        }
        return $this->responseRedirectBack('Home Page has been updated successfully', 'success', false, false);
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
