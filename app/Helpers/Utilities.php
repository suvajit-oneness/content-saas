<?php
// use App\Models\Notification;

use App\Models\Course;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\Order;
use App\Models\JobUser;
use App\Models\OrderProduct;
use App\Models\PlansAndPricing;
use App\Models\NotInterestedJob;
use App\Models\ReportJob;
use App\Models\PlansWithPrice;
use App\Models\ProjectTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stripe\Plan;

if (!function_exists('sidebar_open')) {
    function sidebar_open($routes = []) {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? 'active' : '';
    }
}

if (!function_exists('randomGenerator')) {
    function randomGenerator() {
        return uniqid().''.date('y-m-d-h-i-s');
    }
}

if (!function_exists('imageUpload')) {
    function imageUpload($image, $folder = 'image') {
        $imageName = randomGenerator();
        $imageExtension = $image->getClientOriginalExtension();
        $uploadPath = 'uploads/'.$folder.'/';

        $image->move(public_path($uploadPath), $imageName.'.'.$imageExtension);
        $imagePath = $uploadPath.$imageName.'.'.$imageExtension;
        return $imagePath;
    }
}

if (!function_exists('jobTagsHtml')) {
    function jobTagsHtml($job_id) {
        $tags = \App\Models\JobTag::where('job_id', $job_id)->orderby('title')->get();

        if (count($tags) > 0) {
            $content = '
            <div class="content-mid">
                <ul class="list-unstyled p-0 m-0">';

                foreach($tags as $tag) {
                    $content .= '<li>'.ucwords($tag->title).'</li>';
                }
                    // @foreach ($tag as $tagKey => $tagVal)
                    //     <li>{{ ucwords($tagVal->title) }} </li>
                    // @endforeach
                $content .= '</ul>
            </div>';

            return $content;
        } else {
            return false;
        }
    }
}
//portfolio tag
if (!function_exists('portfolioTagsHtml')) {
    function portfolioTagsHtml($id) {
        $tag = \App\Models\Portfolio::where('id', $id)->orderby('title')->first();
        //dd($tag);
        if (!empty($tag->tags)) {
            $content = '
            <div class="content-mid">
                <ul class="list-unstyled p-0 m-0">';

                foreach(explode(',', $tag->tags) as $tagKey => $tagVal) {
                    $content .= '<li>'.ucwords($tagVal).'</li>';
                }
                
                $content .= '</ul>
            </div>';

            return $content;
        } else {
            return false;
        }
    }
}
if (!function_exists('imageResizeAndSave')) {
    function imageResizeAndSave($imageUrl, $type = 'categories', $filename)
    {
        if (!empty($imageUrl)) {

            //save 60x60 image
            \Storage::disk('public')->makeDirectory($type.'/60x60');
            $path60X60     = storage_path('app/public/'.$type.'/60x60/'.$filename);
            $canvas = \Image::canvas(60, 60);
            $image = \Image::make($imageUrl)->resize(60, 60,
                    function($constraint) {
                        $constraint->aspectRatio();
                    });
            $canvas->insert($image, 'center');
            $canvas->save($path60X60, 70);

            //save 350X350 image
            \Storage::disk('public')->makeDirectory($type.'/350x350');
            $path350X350     = storage_path('app/public/'.$type.'/350x350/'.$filename);
            $canvas = \Image::canvas(350, 350);
            $image = \Image::make($imageUrl)->resize(350, 350,
                    function($constraint) {
                        $constraint->aspectRatio();
                    });
            $canvas->insert($image, 'center');
            $canvas->save($path350X350, 75);

            return $filename;
        } else { return false; }
    }
}

if (!function_exists('languageKnown')) {
    function languageKnown($lang_id) {
        $chk = \App\Models\UserLanguage::where('user_id', auth()->guard()->user()->id)->where('language_id', $lang_id)->first();

        if (!empty($chk)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('userSocialMediaLink')) {
    function userSocialMediaLink($socialMediaId) {
        $chk = \App\Models\UserSocialMedia::select('link')->where('user_id', auth()->guard()->user()->id)->where('social_media_id', $socialMediaId)->first();

        if (!empty($chk)) {
            return $chk->link;
        } else {
            return false;
        }
    }
}

if (!function_exists('slugGenerate')) {
    function slugGenerate($title, $table) {
        $slug = Str::slug($title, '-');
        $slugExistCount = DB::table($table)->where('title', $title)->count();
        if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);
        return $slug;
    }
}

/*
function sendNotification($sender, $receiver, $type, $route, $title, $body='')
{
    $noti = new Notification();
    $noti->sender = $sender;
    $noti->receiver = $receiver;
    $noti->type = $type;
    $noti->route = $route;
    $noti->title = $title;
    $noti->description = $body;
    $noti->read_flag = 0;
    $noti->save();
}
*/

function countTotalHours($courseid)
{
    $totalhrs = 0;
    $lessons = App\Models\CourseLesson::where('course_id', $courseid)->get();
    foreach($lessons as $l){
        $eachtopic = App\Models\LessonTopic::where('lesson_id', $l->lesson_id)->get();
        foreach ($eachtopic as $key => $value) {
            $top = App\Models\Topic::find($value->topic_id);
            $totalhrs += $top->video_length;
        }
    }
    return $totalhrs . ' hours';
}

function totalLessonsAndTopics($courseid)
{
    $lessons= App\Models\CourseLesson::where('course_id', $courseid)->with('lesson')->get();
    $all_topics = [];
    $total_downloadable_contents = 0;
    $topic_count = 0;
    $each_lesson_length = [];
    foreach ($lessons as $l) {
        $topic = App\Models\LessonTopic::where('lesson_id', $l->lesson_id)->with('topic')->get();
        array_push($all_topics, $topic);
        $topic_count += count($topic);
        foreach($topic as $t){
            if($t->topic->video_downloadable == 1){
                $total_downloadable_contents += 1;
            }
        }
    }
    $data['lesson_count'] = count($lessons);
    $data['lessons'] = $lessons;
    $data['topic_count'] = $topic_count;
    $data['topics'] = $all_topics;
    $data['total_downloadable_contents'] = $total_downloadable_contents;

    return (object)$data;
}
//task comment count

function totalComments($taskid)
{
    $comment= App\Models\TaskComment::where('task_id', $taskid)->with('task')->get();
    $all_topics = [];
    $data['comment_count'] = count($comment);
    return (object)$data;
}
function taskComments($taskid)
{
    $comment= App\Models\TaskComment::where('task_id', $taskid)->with('task')->get();
    $all_topics = [];
    $data['comment_count'] = count($comment);
    $data['comments'] = $comment;
    return (object)$data;

}
function getProductSlug($id)
{
    return Course::find($id);
}

function getSubscriptionDetails($id)
{
    return PlansAndPricing::find($id);
}

function getDealDetails($id)
{
    return Deal::find($id);
}

function FetchIfOrderContainsCourse($order_id)
{
    $order_content = OrderProduct::where('order_id',$order_id)->where('type',1)->get();
    if(count($order_content) > 0)
        return $order_content;
    else
        return false;
}

function CheckIfUserBoughtTheCourse($courseid, $user_id){
    $orders = Order::where('user_id', $user_id)->with('orderProducts')->get();
    $my_courses = [];
    foreach ($orders as $o){
        foreach($o->orderProducts as $op){
            if($op->type == 1){
                array_push($my_courses, $op->course_id);
            }
        }
    }

    if(in_array($courseid, $my_courses))
        return true;
    else
        return false;

}

function CheckIfUserBoughtTheSubscription($courseid, $user_id){
    $orders = Order::where('user_id', $user_id)->with('orderProducts')->get();
    $my_courses = [];
    foreach ($orders as $o){
        foreach($o->orderProducts as $op){
            if($op->type == 4){
                array_push($my_courses, $op->course_id);
            }
        }
    }

    if(in_array($courseid, $my_courses)){
        return true;
    }
    else
        return false;

}

function CheckIfUserBoughtAnySubscription()
{
    if(Auth::guard('web')->user()->subscription_id == null){
        return false;
    }
    else {
        return Auth::guard('web')->user()->subscription_id;
    }
}

function CheckIfContentIsUnderSubscription($content_id, $content_table)
{
    if(CheckIfUserBoughtAnySubscription() != false){
        $planprice = PlansWithPrice::where('plan_id',CheckIfUserBoughtAnySubscription())->first()->price;
        $plans_ids = PlansWithPrice::where('price','<=',$planprice)->groupBy('plan_id')->get('plan_id');
        $plan_ids_arr = [];
        foreach($plans_ids as $item){
            array_push($plan_ids_arr,$item->plan_id);
        }
        $content = DB::table($content_table)->where('id',$content_id)->whereIn('subscription_status',$plan_ids_arr)->get();
    }else{
        $plan = PlansAndPricing::where('name','like','%free%')->first()->id;
        $content = DB::table($content_table)->where('id',$content_id)->where('subscription_status',$plan)->get();
    }

    if(count($content) > 0){
        return true;
    }else{
        return false;
    }
}

function CheckIfUserBoughtTheDeal($courseid, $user_id){
    $orders = Order::where('user_id', $user_id)->with('orderProducts')->get();
    $my_courses = [];
    foreach ($orders as $o){
        foreach($o->orderProducts as $op){
            if($op->type == 5){
                array_push($my_courses, $op->course_id);
            }
        }
    }

    if(in_array($courseid, $my_courses)){
        return true;
    }
    else
        return false;

}

function getChargesLimits()
{
    return DB::table('charges_limit')->get();
}


function getCureencyList()
{
    return Currency::all();
}

function CompletedTasks($project_id)
{
    return count(ProjectTask::where('project_id',$project_id)->where('deleted_at',null)->where('status','like','%completed%')->get());
}

// show saved jobs only
if(!function_exists('savedJobs')) {
    function savedJobs($job_id) {
        $jobUser = JobUser::where('user_id', auth()->guard('web')->user()->id)
        ->where('job_id', $job_id)
        ->first();

        if (!empty($jobUser)) {
            return true;
        } else {
            return false;
        }
    }
}

//not interest job

if(!function_exists('interestJobs')) {
    function interestJobs($job_id) {
        $jobUser = NotInterestedJob::where('user_id', auth()->guard('web')->user()->id)
        ->where('job_id', $job_id)
        ->first();

        if (!empty($jobUser)) {
            return true;
        } else {
            return false;
        }
    }
}
//report job
if(!function_exists('reportJobs')) {
    function reportJobs($job_id) {
        $jobUser = ReportJob::where('user_id', auth()->guard('web')->user()->id)
        ->where('job_id', $job_id)
        ->first();

        if (!empty($jobUser)) {
            return true;
        } else {
            return false;
        }
    }
}
// do not remove - used in portfolio feedback
// if(!function_exists('RatingHtml')) {
function RatingHtml($rating = null) {
    // return $rating;
    if ($rating == 0) {
        $resp = '<p>No ratings available</p>';
    } elseif ($rating == 1) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa-solid fa-star "></i>
            <i class="fa-regular fa-star "></i>
            <i class="fa-regular fa-star "></i>
            <i class="fa-regular fa-star "></i>
            <i class="fa-regular fa-star "></i>
        </div>
        ';
    } elseif ($rating > 1 && $rating < 2) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa fa-star checked"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        ';
    } elseif ($rating == 2) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        ';
    } elseif ($rating > 2 && $rating < 3) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        ';
    } elseif ($rating == 3) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa-solid fa-star "></i>
            <i class="fa-solid fa-star "></i>
            <i class="fa-solid fa-star "></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        ';
    } elseif ($rating > 3 && $rating < 4) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa-solid fa-star "></i>
            <i class="fa-solid fa-star "></i>
            <i class="fa-solid fa-star "></i>
            <i class="fa fa-star-half-alt "></i>
            <i class="fa-regular fa-star "></i>
        </div>
        ';
    } elseif ($rating == 4) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small> 
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa-regular fa-star"></i>
        </div>
        ';
    } elseif ($rating > 4 && $rating < 5) {
        $resp = '
        <div class="rating-list-stars d-flex">
            <small>'.$rating.'</small>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star checked"></i>
            <i class="fa fa-star-half-alt"></i>
            
        </div>
        ';
    } else {
        $resp = false;
    }

    return $resp;
}
//after purchase course count user

function totalUser($courseid)
{
    $order= App\Models\OrderProduct::where('course_id', $courseid)->with('order')->get();
   // dd($order);
   $user_count=0;
    foreach ($order as $l) {
        $users = App\Models\order::where('order_no', $l->order_id)->get();
        dd($users);
        //array_push($all_topics, $users);
        $user_count += count($users);
        //dd($user_count);
        
    }
    $data['user_count'] = $user_count;
    return (object)$data;
}

// }
