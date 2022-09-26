<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseModule;
use App\Models\CourseTopic;
use App\Models\EventType;
use App\Models\Event;
class FrontController extends Controller
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
    public function event(Request $request)
    {

        $cat=EventType::where('status',1)->orderby('title')->get();
        $event=Event::where('status',1)->orderby('title')->get();
        return view('front.event.index',compact('cat','event'));
    }
    public function eventdetails(Request $request,$slug)
    {
        $cat=EventType::where('status',1)->orderby('title')->get();
        $events=Event::where('slug',$slug)->orderby('title')->get();
        $event=$events[0];
        $latestevents=Event::where('slug','!=',$slug)->orderby('title')->get();
        return view('front.event.details',compact('cat','event','latestevents'));
    }
    public function course(Request $request)
    {

        $cat=CourseCategory::where('status',1)->orderby('title')->get();
        $course=Course::where('status',1)->orderby('course_name')->get();
        return view('front.course.index',compact('cat','course'));
    }
    public function coursedetails(Request $request,$slug)
    {
        $cat=CourseCategory::where('status',1)->orderby('title')->get();
        $blog=Course::where('slug',$slug)->orderby('course_name')->get();
        $course=$blog[0];
        $topic=CourseTopic::where('course_id',$course->id)->orderby('topic')->get();
        $module=CourseModule::where('course_id',$course->id)->orderby('title')->get();
        //dd($module);
        return view('front.course.details',compact('cat','course','topic','module'));
    }

}
