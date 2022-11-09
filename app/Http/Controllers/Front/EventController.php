<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventType;
use App\Models\Event;
use App\Contracts\EventContract;
use App\Models\EventPage;

class EventController extends Controller
{
     /**
     * @var EventContract
     */
    protected $eventRepository;


    /**
     * EventController constructor.
     * @param EventContract $eventRepository
     *
     */
    public function __construct(EventContract $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }
    public function event(Request $request)
    {
       // if (auth()->guard('web')->check()) {
            if (isset($request->code) || isset($request->keyword) || isset($request->price)||isset($request->type) || isset($request->location)){
            $categoryId = (isset($request->code) && $request->code!='')?$request->code:'';

            $keyword = (isset($request->keyword) && $request->keyword!='')? $request->keyword:'';

            $price = (isset($request->price) && $request->price!='')?$request->price:'';

            $type = (isset($request->type) && $request->type!='')?$request->type:'';

            $location = (isset($request->address) && $request->address!='') ? $request->address : '';

            $event = $this->eventRepository->searchEventsfrontData($categoryId,$keyword,$price,$type,$location);
            }
            else{
                $event=Event::where('status',1)->orderby('title')->paginate(15);
            }
            $cat=EventType::where('status',1)->orderby('title')->get();
            $event_page_content = EventPage::all()[0];
            return view('front.event.index',compact('cat','event','event_page_content'));
        /*} else {
            return redirect()->route('front.user.login');
        }*/
    }

    public function eventdetails(Request $request,$slug)
    {
        $cat=EventType::where('status',1)->orderby('title')->get();
        $events=Event::where('slug',$slug)->orderby('title')->get();
        $event=$events[0];
        $latestevents=Event::where('slug','!=',$slug)->orderby('title')->paginate(3);
        return view('front.event.details',compact('cat','event','latestevents'));
    }
}
