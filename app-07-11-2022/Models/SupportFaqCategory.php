<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportFaqCategory extends Model
{
    public function faqDetails() {
        return $this->hasMany('App\Models\SupportFaq', 'cat_id', 'id');
    }
}
