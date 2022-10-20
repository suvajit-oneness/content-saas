<?php
namespace App\Repositories;

use App\Models\Event;
use App\Models\Userevent;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\EventContract;
use App\Models\EventType;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class EventRepository
 *
 * @package \App\Repositories
 */
class EventRepository extends BaseRepository implements EventContract
{
    use UploadAble;

    /**
     * EventRepository constructor.
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listEvents(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findEventById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Event|mixed
     */
    public function createEvent(array $params)
    {
        try {

            $collection = collect($params);

            $event = new Event;
            $event->category = $collection['category'] ?? '';
            $event->title = $collection['title'] ?? '';

            // $slug = Str::slug($collection['title'], '-');
            // $slugExistCount = Event::where('slug', $slug)->count();
            // if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            // $event->slug = $slug;

            // slug
            $event->slug = slugGenerate($collection['title'], 'events');

            $event->host = $collection['host'] ?? '';
            $event->type = $collection['type'] ?? '';
            $event->start_date = $collection['start_date'] ?? '';
            $event->start_time = $collection['start_time'] ?? '';
            $event->end_date = $collection['end_date'] ?? '';
            $event->end_time = $collection['end_time'] ?? '';
            $event->online_link = $collection['online_link'] ?? '';
            $event->description = $collection['description'] ?? '';
            $event->event_link = $collection['event_link'] ?? '';
            $event->event_cost = $collection['event_cost'] ?? '';
            $event->location = $collection['location'] ?? '';
            $event->contact_phone = $collection['contact_phone'] ?? '';
            $event->is_paid = $collection['is_paid'] ?? '';
            $event->is_recurring = $collection['is_recurring'] ?? '';
            $event->skim = $collection['skim'] ?? '';
            $event->no_of_followers = 0;

            if(!empty($params['image'])){
                // image, folder name only
                $event->image = imageUpload($params['image'], 'event');
            }

            /*
            if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("events/",$imageName);
            $uploadedImage = $imageName;
            $event->image = $uploadedImage;
            }
            */

            $event->save();
            return $event;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEvent(array $params)
    {
        $event = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $event->title = $collection['title'] ?? '';
        if($event->title != $collection['title']) {
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = Event::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $event->slug = $slug;
            }
        $event->event_type = $collection['event_type'] ?? '';
        $event->event_host = $collection['event_host'] ?? '';
        $event->start_date = $collection['start_date'] ?? '';
        $event->start_time = $collection['start_time'] ?? '';
        $event->end_date = $collection['end_date'] ?? '';
        $event->end_time = $collection['end_time'] ?? '';
        $event->content_type = $collection['content_type'] ?? '';
        $event->online_link = $collection['online_link'] ?? '';
        $event->description = $collection['description'] ?? '';
        $event->event_link = $collection['event_link'] ?? '';
        $event->event_cost = $collection['event_cost'] ?? '';
        $event->location = $collection['location'] ?? '';
        $event->contact_phone = $collection['contact_phone'] ?? '';
        $event->is_paid = $collection['is_paid'] ?? '';
        $event->is_recurring = $collection['is_recurring'] ?? '';
        $event->no_of_followers = 0;
        if(!empty($params['image'])){
        $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("events/",$imageName);
            $uploadedImage = $imageName;
            $event->image = $uploadedImage;
        }
        $event->save();

        return $event;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteEvent($id)
    {
        $event = $this->findOneOrFail($id);
        $event->delete();
        return $event;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEventStatus(array $params){
        $event = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $event->status = $collection['check_status'];
        $event->save();

        return $event;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsEvent($id)
    {
        $events = Event::where('id',$id)->get();

        return $events;
    }
     /**
     *
     * @return mixed
     */
    public function listCategory(){
        return EventType::orderby('title')->where('status',1)->get();
    }

    /**
     * @param $pinCode
     * @return mixed
     */
    public function getTrendingEventsByPinCode($pinCode){
        $events = Event::with('category')->where('pin',$pinCode)->take(3)->get();

        return $events;
    }

    /**
     * @param $pinCode
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function searchEventsData($from,$to,$type,$keyword){
            $events = Event::when($to, function($query) use ($to){
                            $query->where('start_date', 'like' , '%' . $to .'%');
                        })
                        ->when($type, function($query) use ($type){
                            $query->where('event_type', '=', $type);
                        })
                        ->when($keyword, function($query) use ($keyword){
                            $query->where('title', 'like', '%' . $keyword .'%');
                        })
                        ->orWhereBetween('start_date', [$from, $to])
                        ->paginate(25);

        return $events;
    }

}
