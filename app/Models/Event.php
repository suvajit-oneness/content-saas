<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function category() {
        return $this->belongsTo('App\Models\EventType', 'event_type', 'id');
    }
}
