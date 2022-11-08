<?php
namespace App\Repositories;

use App\Models\CourseTopic;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CourseSlideContract;
use App\Models\CourseSlide;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CourseSlideRepository
 *
 * @package \App\Repositories
 */
class CourseSlideRepository extends BaseRepository implements CourseSlideContract
{
    use UploadAble;

    /**
     * CourseSlideRepository constructor.
     * @param CourseSlide $model
     */
    public function __construct(CourseSlide $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }



    /**
     * @param array $params
     * @return Event|mixed
     */
    public function createSlide(array $params)
    {
        try {

            $collection = collect($params);

            $topic = new CourseSlide;
            $topic->slide_content = $collection['slide_content'] ?? '';
            $topic->topic_id = $collection['topic_id'] ?? '';
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
    public function updateSlide(array $params)
    {
        $topic = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $topic->slide_content = $collection['slide_content'] ?? '';
        $topic->topic_id = $collection['topic_id'] ?? '';
            $topic->save();

        return $topic;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSlide($id)
    {
        $topic = $this->findOneOrFail($id);
        $topic->delete();
        return $topic;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSlideStatus(array $params){
        $topic = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $topic->status = $collection['check_status'];
        $topic->save();

        return $topic;
    }

     


}
