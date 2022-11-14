<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $table='event_users';
    public function event() {
        return $this->belongsTo('App\Models\Event', 'event_id', 'id');
    }

}
