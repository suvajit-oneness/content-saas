<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\DealPage;
use Illuminate\Http\Request;

class DealPageController extends BaseController
{
    public function index(Request $request){
        $deal_page = DealPage::all();
        $this->setPageTitle('Deal page content', 'Deal page html content!');
        return view('admin.dealpage.index',compact('deal_page'));
    }

    public function edit($id)
    {
        $deal_page= DealPage::findOrfail($id);
        $this->setPageTitle('Deal page content', 'Deal page content');
        return view('admin.dealpage.edit', compact('deal_page'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'header_left' => 'required',
            'header_right' => 'required',
        ]);
       
        $deal_page = DealPage::find($request->id);
        $deal_page->header_left = $request->header_left;
        $deal_page->header_right = $request->header_right;

        if (!$deal_page->save()) {
            return $this->responseRedirectBack('Error occurred while updating Home Page.', 'error', true, true);
        }
        return $this->responseRedirectBack('Page has been updated successfully', 'success', false, false);
    }
    
    public function details($id)
    {
        $deal_page= DealPage::findOrfail($id);
        $this->setPageTitle('Deal page content','Deal page content');
        return view('admin.dealpage.details', compact('deal_page'));
    }
}
