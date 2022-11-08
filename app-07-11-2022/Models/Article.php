<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Article extends Model
{
    protected $fillable = [
        'title', 'slug','article_category_id','article_sub_category_id','image','content','meta_title','meta_key','meta_description','status'
    ];

    public function category() {
        return $this->belongsTo('App\Models\ArticleCategory', 'article_category_id', 'id');
    }
    public function subcategory() {
        return $this->belongsTo('App\Models\ArticleSubCategory', 'article_sub_category_id', 'id');
    }
    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('articles')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('articles')->insert($data);
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
