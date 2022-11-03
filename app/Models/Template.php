<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Template extends Model
{
    protected $table='templates';

    public function categoryDetails() {
        return $this->belongsTo('App\Models\TemplateCategory', 'cat_id', 'id');
    }
    public function subcategory() {
        return $this->belongsTo('App\Models\TemplateSubCategory', 'sub_cat_id', 'id');
    }
    public function type() {
        return $this->belongsTo('App\Models\TemplateType', 'type', 'id');
    }
}
