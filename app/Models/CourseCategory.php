<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = [
        'title', 'content','status'
    ];


    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('course_categories')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('course_categories')->insert($data);
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
    public function productDetails() {
        return $this->hasMany('App\Models\Course', 'category_id', 'id');
    }
}
