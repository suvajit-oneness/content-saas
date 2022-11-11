<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $table = 'projects';

    public function statusDetail()
    {
        return $this->belongsTo('\App\Models\ProjectStatus', 'status', 'slug');
    }

    public function taskDetail()
    {
        return $this->hasMany('\App\Models\ProjectTask', 'project_id', 'id');
    }
}
