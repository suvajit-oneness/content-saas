<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Feedback;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\FeedbackContract;
use App\Feedback as AppFeedback;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class FeedbackRepository
 *
 * @package \App\Repositories
 */
class FeedbackRepository extends BaseRepository implements FeedbackContract
{
    use UploadAble;

    /**
     * FeedbackRepository constructor.
     * @param Feedback $model
     */
    public function __construct(Feedback $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findFeedbackById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Education|mixed
     */
    public function createFeedback(array $params)
    {
        try {
            $collection = collect($params);
            $education = new Feedback();
            $education->user_id = Auth::guard('web')->user()->id ?? '';
            $education->date_from = $collection['date_from'] ?? '';
            $education->date_to = $collection['date_to'] ?? '';
            $education->title = $collection['title'] ?? '';
            $education->rating = $collection['rating'] ?? '';
            $education->review = $collection['review'] ?? '';
            $education->description = $collection['description'] ?? '';
            $education->save();

            return $education;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFeedback(array $params)
    {
        $education = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $education->user_id = Auth::guard('web')->user()->id ?? '';
        $education->date_from = $collection['date_from'] ?? '';
        $education->date_to = $collection['date_to'] ?? '';
        $education->title = $collection['title'] ?? '';
        $education->rating = $collection['rating'] ?? '';
        $education->review = $collection['review'] ?? '';
        $education->description = $collection['description'] ?? '';
        $education->save();

        return $education;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFeedback($id)
    {
        $education = $this->findOneOrFail($id);
        $education->delete();
        return $education;
    }
}
