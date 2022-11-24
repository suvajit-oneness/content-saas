<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLesson;
use App\Models\CourseModule;
use App\Models\CourseTopic;
use App\Models\LessonTopic;
use App\Models\Language;
use DB;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\CourseReview;
class CourseController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->guard('web')->check()) {
            $course = Course::where('status', 1);
            
            if(!empty($request->category)){
                $category = CourseCategory::where('slug',$request->category)->first()->id;
                $course = $course->where('category_id',$category);
            }
            
            if(!empty($request->language)){
                $language = $request->language;
                $course = $course->where('language','like','%'.$language.'%');
            }
            
            if(!empty($request->type)){
                $price = $request->type == 'free' ? 0 : 1;
                $course = $course->where('is_paid',$price);
            }

            $course = $course->orderby('title')->paginate(12);

            // $review = [];

            // foreach($course as $data){
            //     $review=CourseReview::where('course_id',$data->id)->with('user')->get();
            // }
            $cat=CourseCategory::where('status',1)->orderby('title')->get();
            $languages = Language::orderBy('name')->get();
            return view('front.course.index',compact('cat','course','languages'));
        } else {
            return redirect()->route('front.user.login');
        }
    }

    public function details(Request $request,$slug)
    {
        $cat=CourseCategory::where('status',1)->orderby('title')->get();
        $course=Course::where('slug',$slug)->orderby('title')->with('review')->first();
        $topics = [];
        $lessons = CourseLesson::where('course_id', $course->id)->get();
        foreach($lessons as $l){
            array_push($topics, LessonTopic::where('lesson_id', $l->id)->get());
        }
        // $topic=LessonTopic::where('course_id',$course->id)->orderby('topic')->get();
        $topic = (object)$topics;
        $module=CourseModule::where('course_id',$course->id)->orderby('title')->get();
        $review=CourseReview::where('course_id',$course->id)->get();
       //dd($review);
        $order = OrderProduct::where('course_id', $course->id)->with('order')->get();

        return view('front.course.details',compact('cat','course','topic','module', 'lessons','review','order'));
    }
    

}
