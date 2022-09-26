<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    

    public function users() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
     public function course() {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    
}
