<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseModule;
use App\Models\CourseTopic;
class CourseController extends Controller
{
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
        return view('front.course.details',compact('cat','course','topic','module'));
    }
}
