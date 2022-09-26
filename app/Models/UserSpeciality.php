<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSpeciality extends Model
{
    public function specialityDetails() {
        return $this->belongsTo('App\Models\Speciality', 'speciality_id', 'id');
    }
}
