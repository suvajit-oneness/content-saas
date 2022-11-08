<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ArticleTertiaryCategory extends Model
{
    protected $fillable = [
        'title', 'slug', 'sub_category_id', 'status'
    ];

    public function subcategory() {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }

    public static function insertData($data) {
        $value = DB::table('article_tertiary_categories')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('article_tertiary_categories')->insert($data);
        }
    }
}
