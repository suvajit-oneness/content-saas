<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    

    public function course() {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
    public function topic() {
        return $this->hasMany('App\Models\CourseTopic', 'module_id', 'id');
    }

    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('course_modules')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('course_modules')->insert($data);
           array_push($successArr, $data['title']);
            $count++;
        } else {
            array_push($failureArr, $data['title']);
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
