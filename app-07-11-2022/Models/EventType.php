<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = [
        'title'
    ];
    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('event_types')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('event_types')->insert($data);
           array_push($successArr, $data['title']);
            $count++;
        } else {
            array_push($failureArr, $data['title']);
        }

        // return $count;

        $resp = [
            "count" => $count,
            "successArr" => $successArr,
            "failureArr" => $failureArr
        ];
        return $resp;
    }
    public function eventDetails() {
        return $this->hasMany('App\Models\Event', 'category', 'id');
    }
}
