<?php
namespace App\Repositories;

use App\Models\CourseTopic;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CourseTopicContract;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CourseTopicRepository
 *
 * @package \App\Repositories
 */
class CourseTopicRepository extends BaseRepository implements CourseTopicContract
{
    use UploadAble;

    /**
     * CourseTopicRepository constructor.
     * @param CourseTopic $model
     */
    public function __construct(CourseTopic $model)
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
    public function listTopic(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTopicById(int $id)
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
    public function createTopic(array $params)
    {
        try {

            $collection = collect($params);

            $topic = new CourseTopic;
            $topic->topic = $collection['topic'] ?? '';
            $slug = Str::slug($collection['topic'], '-');
            $slugExistCount = CourseTopic::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $topic->slug = $slug;
            $topic->course_id = $collection['course_id'] ?? '';
            $topic->module_id = $collection['module_id'] ?? '';
            $topic->save();
            return $topic;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTopic(array $params)
    {
        $topic = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $topic->topic = $collection['topic'] ?? '';
        if($topic->topic != $collection['topic']) {
            $slug = Str::slug($collection['topic'], '-');
            $slugExistCount = CourseTopic::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $topic->slug = $slug;
            }
            $topic->course_id = $collection['course_id'] ?? '';
            $topic->module_id = $collection['module_id'] ?? '';
            $topic->save();

        return $topic;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteTopic($id)
    {
        $topic = $this->findOneOrFail($id);
        $topic->delete();
        return $topic;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTopicStatus(array $params){
        $topic = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $topic->status = $collection['check_status'];
        $topic->save();

        return $topic;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsTopic($id)
    {
        $topic = CourseTopic::where('id',$id)->get();

        return $topic;
    }


    /**
     * @param $pinCode
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function getSearchTopic(string $term){
            return CourseTopic::where([['topic', 'LIKE', '%' . $term . '%']])->paginate(25);
    }

}
