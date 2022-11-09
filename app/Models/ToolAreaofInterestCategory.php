<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToolAreaofInterestCategory extends Model
{
    public function itemDetails() {
        return $this->hasMany('App\Models\ToolAreaofInterest', 'cat_id', 'id');
    }
}
