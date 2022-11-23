<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class OrderProduct extends Model
{
    public function courseName()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id', '=');
    }
    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
}
