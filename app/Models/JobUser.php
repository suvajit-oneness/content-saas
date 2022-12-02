<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobUser extends Model
{
    protected $table = 'job_users';
    public function job() {
        return $this->belongsTo('App\Models\Job', 'job_id', 'id');
    }
    public function users() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
