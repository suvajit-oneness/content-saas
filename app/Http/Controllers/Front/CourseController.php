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
    public function course(Request $request)
    {
        if (auth()->guard('web')->check()) {
            if (!empty($request->category_id) || !empty($request->language)||!empty($request->is_paid)){
                $category = $request->category_id;
                $language = $request->language;
                $price = $request->is_paid;
               // dd($price);
                DB::enableQueryLog();

                $course = Course::where('status', 1)
                ->when($category, function ($query, $category) {
                    return $query->where('category_id', 'like', '%'.$category.'%');
                })
                ->when($language, function($query, $language) {
                    return $query->where('language', $language);
                })
                ->when($price, function($query, $price) {
                    return $query->where('is_paid',$price);
                })

                ->paginate(12);

                // dd(DB::getQueryLog());

                // dd($request->all(), $job);
            } else {

            $course=Course::where('status',1)->orderby('title')->get();
            }
            $cat=CourseCategory::where('status',1)->orderby('title')->get();
            $languages = Language::orderBy('name')->get();
            return view('front.course.index',compact('cat','course','languages'));
        } else {
            return redirect()->route('front.user.login');
        }
    }

    public function coursedetails(Request $request,$slug)
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
        $review=CourseReview::where('course_id',$course->id)->with('user')->get();
       // dd($review);
        $order = OrderProduct::where('course_id', $course->id)->with('order')->get();

        return view('front.course.details',compact('cat','course','topic','module', 'lessons','review','order'));
    }
    

}
