<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\PlansPage;
use Illuminate\Http\Request;

class MarketPlacePageController extends BaseController
{
    public function index(Request $request){
        $plans_page = PlansPage::all();
        $this->setPageTitle('Plans page content', 'Plans page html content!');
        return view('admin.marketplace.pagecontent.index',compact('plans_page'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $plans_page= PlansPage::findOrfail($id);
        $this->setPageTitle('Plans page content', 'Plans page content');
        return view('admin.marketplace.pagecontent.edit', compact('plans_page'));
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
            'header' => 'required',
            'header_bold' => 'required',
            'header_short_description' => 'required',
            'header_side_image' => 'nullable|file|mimes:jpeg,jpg,png',
        ]);
       
        $plans_page = PlansPage::find($request->id);
        $plans_page->header = $request->header;
        $plans_page->header_bold = $request->header_bold;
        $plans_page->header_short_description = $request->header_short_description;
        if($request->header_side_image){
            $plans_page->header_side_image = imageUpload($request->header_side_image, 'marketplace-page');
        }

        if (!$plans_page->save()) {
            return $this->responseRedirectBack('Error occurred while updating Home Page.', 'error', true, true);
        }
        return $this->responseRedirectBack('Page has been updated successfully', 'success', false, false);
    }
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    // public function details($id)
    // {
    //     $plans_page= PlansPage::findOrfail($id);
    //     $this->setPageTitle('Plans page content','Plans page content');
    //     return view('admin.marketplace.pagecontent.details', compact('article_page'));
    // }
}
