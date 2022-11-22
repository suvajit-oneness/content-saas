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
        // $topic=LessonTopic::where('course_id',$course->id)->orderby('topic')->get();
        $topic = (object)$topics;
        //$lessonDetails=Lesson::where('slug',$Lessonslug)->orderby('title')->first();

        //dd($topic);
       // $topic= LessonTopic::where('lesson_id', $lessonDetails->id)->with('topic')->get();
        return view('front.user.course.details', compact('course','topic', 'lessons'));
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
        $nextTopic=LessonTopic::where('lesson_id',$course->id)->where('topic_id',$topic->id)->with('topic')->get();
        //dd($nextTopic);
        $positon=($nextTopic[0]->position)+1;
        //dd($positon);
        $previousPosition=($nextTopic[0]->position)-1;
        //dd($previousPosition);
        if($previousPosition=='0'){
         $topicpreviousLesson=LessonTopic::where('lesson_id',$course->id)->where('topic_id',$topic->id)->first();
        }
        else{
            $topicpreviousLesson=LessonTopic::where('lesson_id',$course->id)->where('position',$previousPosition)->first();
            //dd($topicpreviousLesson);
        }
       if(count($nextTopic) == $nextTopic[0]->position){
        $topicLesson=LessonTopic::where('lesson_id',$course->id)->where('position',$positon)->first();
       }
       else{
         $topicLesson=LessonTopic::where('lesson_id',$course->id)->where('topic_id',$topic->id)->first();
       }

        return view('front.user.course.topicDetails',compact('courseData','course','topic','request','topicLesson','topicpreviousLesson'));
    }
    public function store(Request $request){
        $review=new CourseReview();

        $review->course_id = $request->course_id ?? '';
        $review->topic_id = $request->topic_id ?? '';
        $review->rating = $request->rating ?? '';
        $review->review = $request->review;
        $review->user_id = auth()->guard('web')->user()->id;

        $review->save();
        // $status = new ProjectStatus();
        // $status->title = $project->status ?? '';
        // $status->slug = slugGenerate($project->status, 'project_statuses');
        // $status->icon = '<i class="fas fa-check"></i>';
        // $status->created_by = auth()->guard('web')->user()->id ?? '';
        // $status->position = count($status->position)+1 ?? '';
        // $status->save();

        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
