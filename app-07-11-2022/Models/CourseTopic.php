<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTopic extends Model
{

    public function course() {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    public function module() {
        return $this->belongsTo('App\Models\CourseModule', 'module_id', 'id');
    }

    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('course_topics')->where('topic', $data['topic'])->get();
        if($value->count() == 0) {
           DB::table('course_topics')->insert($data);
           array_push($successArr, $data['topic']);
            $count++;
        } else {
            array_push($failureArr, $data['topic']);
        }

        // return $count;

        $resp = [
            "count" => $count,
            "successArr" => $successArr,
            "failureArr" => $failureArr
        ];
        return $resp;
    }
}
