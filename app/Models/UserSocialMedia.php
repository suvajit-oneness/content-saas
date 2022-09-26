<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialMedia extends Model
{
    public function socialMediaDetails() {
        return $this->belongsTo('App\Models\SocialMedia', 'social_media_id', 'id');
    }
}
