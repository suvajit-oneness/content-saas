<?php
// use App\Models\Notification;

use App\Models\Course;
use App\Models\Order;
use App\Models\JobUser;
use Illuminate\Support\Str;

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

function getProductSlug($id)
{
    return Course::find($id);
}

function CheckIfUserBoughtTheCourse($courseid, $user_id){
    $orders = Order::where('user_id', $user_id)->with('orderProducts')->get();
    $my_courses = [];
    foreach ($orders as $o){
        foreach($o->orderProducts as $op){
            array_push($my_courses, $op->course_id);
        }
    }

    if(in_array($courseid, $my_courses))
        return true;
    else
        return false;

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

// do not remove - used in portfolio feedback
if(!function_exists('RatingHtml')) {
    function RatingHtml($rating = null) {
        if ($rating == 0) {
            $resp = '<p>No ratings available</p>';
        } elseif ($rating == 1) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Rating</small>
            </p>
            ';
        } elseif ($rating > 1 && $rating < 2) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fas fa-star-half-alt" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating == 2) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating > 2 && $rating < 3) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fas fa-star-half-alt" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating == 3) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating > 3 && $rating < 4) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star-half-alt" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating == 4) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa-regular fa-star" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } elseif ($rating > 4 && $rating < 5) {
            $resp = '
            <p class="review">
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star checked" style="color:#FFA701"></span>
                <span class="fa fa-star-half-alt" style="color:#FFA701"></span>
                <small>'.$rating.' Ratings</small>
            </p>
            ';
        } else {
            return false;
        }
    }
}