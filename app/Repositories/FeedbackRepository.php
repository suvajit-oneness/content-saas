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
     * @return feedback|mixed
     */
    public function createFeedback(array $params)
    {
        try {
            $collection = collect($params);
            $feedback = new Feedback();
            $feedback->user_id = Auth::guard('web')->user()->id ?? '';
            $feedback->date_to = $collection['date_to'] ?? '';
            $feedback->title = $collection['title'] ?? '';
            $feedback->rating = $collection['rating'] ?? '';
            $feedback->review = $collection['review'] ?? '';
            $feedback->review_person = $collection['review_person'] ?? '';
            $feedback->save();
            return $feedback;

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
        $feedback = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $feedback->user_id = Auth::guard('web')->user()->id ?? '';
        $feedback->date_to = $collection['date_to'] ?? '';
        $feedback->title = $collection['title'] ?? '';
        $feedback->rating = $collection['rating'] ?? '';
        $feedback->review = $collection['review'] ?? '';
        $feedback->review_person = $collection['review_person'] ?? '';
        $feedback->save();
        return $feedback;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFeedback($id)
    {
        $feedback = $this->findOneOrFail($id);
        $feedback->delete();
        return $feedback;
    }
}
