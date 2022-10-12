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

    public function orderProducts() {
        return $this->hasMany('App\Models\OrderProduct', 'order_id', 'order_no');
    }
}
