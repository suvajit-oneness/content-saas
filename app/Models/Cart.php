<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
    
 public function course() {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }
   
}
