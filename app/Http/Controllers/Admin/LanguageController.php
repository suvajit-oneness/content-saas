<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends BaseController
{
    public function index(Request $request)
    {
        $this->setPageTitle('Language Master', 'All Languages!');
        $languages = Language::paginate(15);

        if(!empty($request->term)){
            $languages = Language::where('name','%'.$request->term.'%')->paginate(15);
        }

        return view('admin.language.index',compact('languages'));
    }

    public function create()
    {
        $this->setPageTitle('Language Master', 'Add new language!');
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
        ]);

        $params = $request->except('_token');

        $language = new Language();
        
        $language->name = $params['name'];

        $language->status = 1;

        if (!$language->save()) {
            return $this->responseRedirectBack('Error occurred while adding new language.', 'error', true, true);
        }

        return $this->responseRedirect('admin.language.master.index', 'Language has been added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit($id)
    {
        $language = Language::find($id);

        $this->setPageTitle('Language Master', 'Edit language: '.$language->name);

        return view('admin.language.edit', compact('language'));
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
        ]);

        $params = $request->except('_token');

        $language = Language::find($request->id);
        
        $language->name = $request->name;

        if (!$language->save()) {
            return $this->responseRedirectBack('Error occurred while updating.', 'error', true, true);
        }

        return $this->responseRedirectBack('Language has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = Language::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.language.master.index', 'Language has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        // dd($request->all());

        $deal = Language::find($request->id);
        $deal->status = $request->check_status;

        if ($deal->save()) {
            return response()->json(array('message' => 'Language status has been successfully updated'));
        }
    }
}
