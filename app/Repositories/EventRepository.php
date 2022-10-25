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
            // slug
            $event->slug = slugGenerate($collection['title'], 'events');
            if($params['host'] == 'Other'){
            $event->host = $collection['other_host_name'] ?? '';
            }
            else{
            $event->host = $collection['host'] ?? '';
            }
            $event->type = $collection['type'] ?? '';
            if(!empty($params['image'])){
                // image, folder name only
                $event->image = imageUpload($params['image'], 'event');
            }
            $event->address = $collection['address'] ?? '';
            $event->pin = $collection['pin'] ?? '';
            $event->start_date = $collection['start_date'] ?? '';
            $event->start_time = $collection['start_time'] ?? '';
            $event->end_date = $collection['end_date'] ?? '';
            $event->end_time = $collection['end_time'] ?? '';
            $event->description = $collection['description'] ?? '';
            $event->link = $collection['link'] ?? '';
            $event->contact_phone = $collection['contact_phone'] ?? '';
            $event->contact_email = $collection['contact_email'] ?? '';
            $event->cost = $collection['cost'] ?? '';
            $event->recurring = $collection['recurring'] ?? '';
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
        $event->category = $collection['category'] ?? '';
        $event->title = $collection['title'] ?? '';
        if($event->title != $collection['title']) {
           /* $slug = Str::slug($collection['title'], '-');
            $slugExistCount = Event::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $event->slug = $slug;
            }*/
            $event->slug = slugGenerate($collection['title'], 'events');
        }
        if($params['host'] == 'Other'){
            $event->host = $collection['other_host_name'] ?? '';
            }
            else{
            $event->host = $collection['host'] ?? '';
            }
            $event->type = $collection['type'] ?? '';
            if(!empty($params['image'])){
                // image, folder name only
                $event->image = imageUpload($params['image'], 'event');
            }
            $event->address = $collection['address'] ?? '';
            $event->pin = $collection['pin'] ?? '';
            $event->start_date = $collection['start_date'] ?? '';
            $event->start_time = $collection['start_time'] ?? '';
            $event->end_date = $collection['end_date'] ?? '';
            $event->end_time = $collection['end_time'] ?? '';
            $event->description = $collection['description'] ?? '';
            $event->link = $collection['link'] ?? '';
            $event->contact_phone = $collection['contact_phone'] ?? '';
            $event->contact_email = $collection['contact_email'] ?? '';
            $event->cost = $collection['cost'] ?? '';
            $event->recurring = $collection['recurring'] ?? '';
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
                            $query->where('category', '=', $type);
                        })
                        ->when($keyword, function($query) use ($keyword){
                            $query->where('title', 'like', '%' . $keyword .'%')->orWhere('host', 'like', '%' . $keyword .'%')->orWhere('type', 'like', '%' . $keyword .'%');
                        })
                        ->orWhereBetween('start_date', [$from, $to])
                        ->paginate(25);

        return $events;
    }

    /**
     * @param $categoryId
     * @param $keyword
     * @param $price
     * @param $type
     * @param $location
     * @return mixed
     */
    public function searchEventsfrontData($categoryId,$keyword,$price,$type,$location){
        $events = Event::when($categoryId, function($query) use ($categoryId){
                        $query->where('category', 'like' , '%' . $categoryId .'%');
                    })
                    ->when($keyword, function($query) use ($keyword){
                        $query->where('title','like' , '%' . $keyword .'%');
                    })
                    ->when($price, function($query) use ($price){
                        $query->where('cost', 'like', '%' . $price .'%');
                    })
                    ->when($type, function($query) use ($type){
                        $query->where('type', 'like', '%' . $type .'%');
                    })
                    ->when($location, function($query) use ($location){
                        $query->where('address', 'like', '%' . $location .'%');
                    })
                    ->paginate(15);

    return $events;
}


}
