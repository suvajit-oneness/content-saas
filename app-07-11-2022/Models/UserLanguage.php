<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    public function languageDetails() {
        return $this->belongsTo('App\Models\Language', 'language_id', 'id');
    }
}
