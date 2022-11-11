<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\PlansPage;
use Illuminate\Http\Request;

class PlansPricePageController extends BaseController
{
    public function index(Request $request){
        $plans_page = PlansPage::all();
        $this->setPageTitle('Plans and Pricing page content', 'Plans and Pricing page html content!');
        return view('admin.planspricepage.index',compact('plans_page'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $plans_page= PlansPage::findOrfail($id);
        $this->setPageTitle('Plans and Pricing page content', 'Plans and Pricing page content');
        return view('admin.planspricepage.edit', compact('plans_page'));
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
            'header_top' => 'required',
            'header_bottom' => 'required',
            'middle_section_content_image' => 'nullable|mimes:jpg,png,jpeg',
            'middle_section_content_description' => 'required',
        ]);
       
        $plans_page = PlansPage::find($request->id);
        $plans_page->header_top = $request->header_top;
        $plans_page->header_bottom = $request->header_bottom;
        if($request->middle_section_content_image){
            $plans_page->middle_section_content_image = imageUpload($request->middle_section_content_image,'plans');
        }
        $plans_page->middle_section_content_description = $request->middle_section_content_description;

        if (!$plans_page->save()) {
            return $this->responseRedirectBack('Error occurred while updating Home Page.', 'error', true, true);
        }
        return $this->responseRedirectBack('Page has been updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $plans_page= PlansPage::findOrfail($id);
        $this->setPageTitle('Plans and Pricing page content','Plans and Pricing page content');
        return view('admin.planspricepage.details', compact('plans_page'));
    }
}
