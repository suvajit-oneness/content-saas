<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonTopic extends Model
{
    public function topic()
    {
        return $this->belongsTo('App\Models\Topic', 'topic_id', 'id');
    }
    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson', 'lesson_id', 'id');
    }
}
