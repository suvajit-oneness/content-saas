<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{


    public function category() {
        return $this->belongsTo('App\Models\CourseCategory', 'category_id', 'id');
    }
   
    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('courses')->where('course_name', $data['course_name'])->get();
        if($value->count() == 0) {
           DB::table('courses')->insert($data);
           array_push($successArr, $data['course_name']);
            $count++;
        } else {
            array_push($failureArr, $data['course_name']);
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
