<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\ArticlePage;
use Illuminate\Http\Request;

class BlogPageController extends BaseController
{
    public function index(Request $request){
        $article_page = ArticlePage::all();
        $this->setPageTitle('Article page content', 'Article page html content!');
        return view('admin.articlepage.index',compact('article_page'));
    }
     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $article_page= ArticlePage::findOrfail($id);
        $this->setPageTitle('Article page content', 'Article page content');
        return view('admin.articlepage.edit', compact('article_page'));
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
            'header_left' => 'required',
            'header_right' => 'required',
        ]);
       
        $article_page = ArticlePage::find($request->id);
        $article_page->header_left = $request->header_left;
        $article_page->header_right = $request->header_right;

        if (!$article_page->save()) {
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
        $article_page= ArticlePage::findOrfail($id);
        $this->setPageTitle('Article page content','Article page content');
        return view('admin.articlepage.details', compact('article_page'));
    }
}
