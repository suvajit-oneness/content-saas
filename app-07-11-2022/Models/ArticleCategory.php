<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticleCategory extends Model
{
    protected $fillable = [
        'title', 'description','status'
    ];


    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('article_categories')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('article_categories')->insert($data);
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
    public function blogDetails() {
        return $this->hasMany('App\Models\Article', 'article_category_id', 'id');
    }
}
