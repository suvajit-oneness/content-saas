<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\Article;
class ArticleController extends Controller
{
    public function article(Request $request)
    {
        $cat=ArticleCategory::where('status',1)->orderby('title')->get();
        $blog=Article::where('status',1)->orderby('title')->get();
        return view('front.blog.index',compact('cat','blog'));
    }
    public function articledetails(Request $request,$slug)
    {
        $cat=ArticleCategory::where('status',1)->orderby('title')->get();
        $blogs=Article::where('slug',$slug)->orderby('title')->get();
        $blog=$blogs[0];
        $latestblogs=Article::where('slug','!=',$slug)->orderby('title')->get();
        return view('front.blog.details',compact('cat','blog','latestblogs'));
    }
}
