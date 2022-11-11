<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model {

    protected $table = 'project_tasks';

    public function statusDetail()
    {
        return $this->belongsTo('\App\Models\ProjectStatus', 'status', 'slug');
    }

    public function projectDetail()
    {
        return $this->belongsTo('\App\Models\Project', 'project_id', 'id');
    }
}
