<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\CourseLesson;
use App\Models\LessonTopic;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserCourseController extends Controller
{
    public function index()
    {
        $course = Order::where('user_id', auth()->guard('web')->user()->id)->orderby('id','desc')->with('orderProducts')->get();
        //dd($course);
        return view('front.user.course.index', compact('course'));
    }
    public function details($slug)
    {
        $data=Course::where('slug',$slug)->orderby('title')->get();
        $course=$data[0];
        $topics = [];
        $lessons = CourseLesson::where('course_id', $course->id)->get();
       
        foreach($lessons as $l){
            array_push($topics, LessonTopic::where('lesson_id', $l->id)->get());
        }
        
        //dd($topic);
        $topic = (object)$topics;
        return view('front.user.course.details', compact('course','topic','lessons'));
    }
    public function lessonDetails(Request $request,$slug,$Lessonslug)
    {
        $courseData=Course::where('slug',$slug)->orderby('title')->first();
        $data=Lesson::where('slug',$Lessonslug)->orderby('title')->get();
        $course=$data[0];
        //dd($course);
        $topics = [];
        $lessons = CourseLesson::where('course_id', $course->id)->get();
        $topic= LessonTopic::where('lesson_id', $course->id)->with('topic')->get();
        //dd($topic);
        return view('front.user.course.lessonDetails', compact('courseData','course','topic','lessons','request'));
    }
    public function topicDetails(Request $request,$slug,$Lessonslug,$Topicslug)
    {
        $courseData=Course::where('slug',$slug)->orderby('title')->first();
        $data=Lesson::where('slug',$Lessonslug)->orderby('title')->get();
        $course=$data[0];
        //dd($course);
        $topics = [];
        $lessons = CourseLesson::where('course_id', $course->id)->get();
        $topic= Topic::where('slug', $Topicslug)->first();
        //dd($topic);
        return view('front.user.course.topicDetails',compact('courseData','course','topic'));
    }
}
