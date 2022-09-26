<?php
namespace App\Repositories;

use App\Contracts\EventTypeContract;
use Illuminate\Support\Str;
use App\Models\EventType;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Models\ArticleSubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class EventTypeRepository
 *
 * @package \App\Repositories
 */
class EventTypeRepository extends BaseRepository implements EventTypeContract
{
    use UploadAble;

    /**
     * SubCategoryRepository constructor.
     * @param EventType $model
     */
    public function __construct(EventType $model)
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
    public function listEventtype(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findEventtypeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Blogcategory|mixed
     */
    public function createEventtype(array $params)
    {
        try {

            $collection = collect($params);

            $subcategory = new EventType;
            $subcategory->title = $collection['title'];
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = EventType::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $subcategory->slug = $slug;
            $subcategory->save();
            return $subcategory;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEventtype(array $params)
    {
        $subcategory = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $subcategory->title = $collection['title'];
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = EventType::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $subcategory->slug = $slug;
        $subcategory->save();

        return $subcategory;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteEventtype($id)
    {
        $subcategory = $this->findOneOrFail($id);
        $subcategory->delete();
        return $subcategory;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEventtypeStatus(array $params){
        $subcategory = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $subcategory->status = $collection['check_status'];
        $subcategory->save();

        return $subcategory;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsEventtype($id)
    {
        $subcategories = EventType::where('id',$id)->get();

        return $subcategories;
    }

     /**
     * @return mixed
     */
    public function getSearchEventtype(string $term)
    {
        return EventType::where([['title', 'LIKE', '%' . $term . '%']])

        ->paginate(25);
    }
}
