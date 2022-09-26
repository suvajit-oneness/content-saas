<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventType;
use App\Models\Event;
class EventController extends Controller
{
    public function event(Request $request)
    {
        $cat=EventType::where('status',1)->orderby('title')->get();
        $event=Event::where('status',1)->orderby('title')->get();
        return view('front.event.index',compact('cat','event'));
    }
    public function eventdetails(Request $request,$slug)
    {
        $cat=EventType::where('status',1)->orderby('title')->get();
        $events=Event::where('slug',$slug)->orderby('title')->get();
        $event=$events[0];
        $latestevents=Event::where('slug','!=',$slug)->orderby('title')->get();
        return view('front.event.details',compact('cat','event','latestevents'));
    }
}
