<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function eventCategory() {
        return $this->belongsTo('App\Models\EventType', 'category', 'id');
    }
}
