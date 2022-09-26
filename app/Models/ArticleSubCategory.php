<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ArticleSubCategory extends Model
{
    protected $table = 'article_subcategories';
    protected $fillable = [
        'title','slug', 'category_id', 'status'
    ];


    public function category() {
        return $this->belongsTo('App\Models\ArticleCategory', 'category_id', 'id');
    }

    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('article_subcategories')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('article_subcategories')->insert($data);
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
   /* public static function insertData($data) {
        $value = DB::table('article_subcategories')->where('title', $data['title'])->where('slug', $data['slug'])->get();
        if($value->count() == 0) {
           DB::table('article_subcategories')->insert($data);
        }
    }*/
}
