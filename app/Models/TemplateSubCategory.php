<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateSubCategory extends Model
{
    protected $table='template_sub_categories';
    public function category() {
        return $this->belongsTo('App\Models\TemplateCategory', 'cat_id', 'id');
    }
}
