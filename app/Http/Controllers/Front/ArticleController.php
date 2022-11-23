<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\Article;
use App\Models\ArticlePage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $cat=ArticleCategory::where('status',1)->orderby('title')->get();
        if($request->category){
            $cat_id = ArticleCategory::where('slug',$request->category)->first()->id;
            $blogs=Article::where('status',1)->where('article_category_id','like','%'.$cat_id.'%')->orderby('title')->paginate(1);
        }else{
            $blogs=Article::where('status',1)->where('article_category_id','like','%'.$cat[0]->id.'%')->orderby('title')->paginate(1);
        }
        $article_page_content = ArticlePage::all()[0];
        return view('front.blog.index',compact('cat','blogs','article_page_content'));
    }
    public function details(Request $request,$slug)
    {
        $cat=ArticleCategory::where('status',1)->orderby('title')->get();
        $blogs=Article::where('slug',$slug)->orderby('title')->get();
        $blog=$blogs[0];
        $latestblogs=Article::where('slug','!=',$slug)->orderby('title')->get();
        return view('front.blog.details',compact('cat','blog','latestblogs'));
    }
}
