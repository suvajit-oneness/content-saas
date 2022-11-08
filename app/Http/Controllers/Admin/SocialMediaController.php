<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends BaseController
{
    public function index(Request $request)
    {
        $this->setPageTitle('Social Media Master', 'All social media!');

        $social_media = SocialMedia::paginate(15);
        if(!empty($request->term))
        {
            $social_media = SocialMedia::where('name','like','%'.$request->term.'%')->paginate(15);
        }
        return view('admin.social-media.index',compact('social_media'));
    }

    public function create()
    {
        $this->setPageTitle('Social Media Master', 'Add Social Media!');
        return view('admin.social-media.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'icon' => 'required',
        ]);

        $params = $request->except('_token');

        $social_media = new SocialMedia();
        
        $social_media->name = $params['name'];
        $social_media->icon = $params['icon'];

        $social_media->status = 1;

        if (!$social_media->save()) {
            return $this->responseRedirectBack('Error occurred while adding new Social Media.', 'error', true, true);
        }

        return $this->responseRedirect('admin.socialmedia.master.index', 'Social media has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit($id)
    {
        $social_media = SocialMedia::find($id);

        $this->setPageTitle('Social Media Master', 'Edit SocialMedia: '.$social_media->name);

        return view('admin.social-media.edit', compact('social_media'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'icon' => 'required'
        ]);

        $params = $request->except('_token');

        $social_media = SocialMedia::find($request->id);
        
        $social_media->name = $request->name;
        $social_media->icon = $request->icon;

        if (!$social_media->save()) {
            return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
        }

        return $this->responseRedirectBack('Social media has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = SocialMedia::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.socialmedia.master.index', 'Social media has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {
        $social_media = SocialMedia::find($request->id);
        $social_media->status = $request->check_status;

        if ($social_media->save()) {
            return response()->json(array('message' => 'Social media status has been successfully updated'));
        }
    }
}
