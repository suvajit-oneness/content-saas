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
use App\Models\CourseReview;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\SaveTopic;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserCourseController extends Controller
{
     //** purchase course view **//
    public function index()
    {
        $course = Order::where('user_id', auth()->guard('web')->user()->id)->orderby('id','desc')->with('orderProducts')->get();
        return view('front.user.course.index', compact('course'));
    }
     //** Course Details **//
    public function details($slug)
    {
        $data=Course::where('slug',$slug)->orderby('title')->get();
        $course=$data[0];
        $topics = [];
        $lessons = CourseLesson::where('course_id', $course->id)->get();
        foreach($lessons as $l){
            array_push($topics, LessonTopic::where('lesson_id', $l->id)->get());
        }
        $topic = (object)$topics;
        return view('front.user.course.details', compact('course','topic', 'lessons'));
    }
     //** Topic Details **//
    public function topicDetails(Request $request,$slug,$Lessonslug,$Topicslug)
    {
        $courseData=Course::where('slug',$slug)->orderby('title')->first();
        $data=Lesson::where('slug',$Lessonslug)->orderby('title')->get();
        $course=$data[0];
        $topics = [];
        $lessons = CourseLesson::where('course_id', $course->id)->get();
        $topic= Topic::where('slug', $Topicslug)->first();
        return view('front.user.course.topicDetails',compact('courseData','course','topic','request'));
    }
    //** Store Review **//
    public function store(Request $request){
        $review=new CourseReview();
        $review->course_id = $request->course_id ?? '';
        $review->topic_id = $request->topic_id ?? '';
        $review->rating = $request->rating ?? '';
        $review->review = $request->review;
        $review->user_id = auth()->guard('web')->user()->id;
        $review->save();
        return redirect()->back()->with('success', 'Comment added successfully');
    }
    
    public function savetopicAndSetCounter(Request $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        $viewed = SaveTopic::where('id',$request->current_counter_id)->where('is_view',1)->get();
        if(count($viewed)<=0){
            $saved = SaveTopic::where('id',$request->current_counter_id)->update(['is_view'=>1]);
            $message = "New Topic Completed!";
        }else{
            $message = "Next topic loaded!";
        }
        $remove_previous_counter = SaveTopic::where('user_id',$user_id)->where('course_id',$request->course_id)->update(['counter'=>0]); 
        $counter_on = SaveTopic::where('id',$request->id)->update(['counter'=>1]);
        
        return response()->json(['status' => 200, 'message' => $message]);

    }

    public function loadIndividualTopic(Request $request)
    {
        $user_id = Auth::guard('web')->user()->id;
        $viewed = SaveTopic::where('user_id',$user_id)->where('course_id',$request->course_id)->where('lesson_id',$request->lesson_id)->where('topic_id',$request->topic_id)->where('is_view',1)->count();
        SaveTopic::where('user_id',$user_id)->where('course_id',$request->course_id)->update(['counter'=>0]);
        
        if($viewed <= 0){
            SaveTopic::where('user_id',$user_id)->where('course_id',$request->course_id)->where('lesson_id',$request->lesson_id)->where('topic_id',$request->topic_id)->update(['is_view'=>1,'counter'=>1]);
            $message = "New Topic Completed!";
        }else{
            SaveTopic::where('user_id',$user_id)->where('course_id',$request->course_id)->where('lesson_id',$request->lesson_id)->where('topic_id',$request->topic_id)->update(['counter'=>1]);
            $message = "Next topic loaded!";
        }

        return response()->json(['status' => 200, 'message' => $message]);
    }
}
