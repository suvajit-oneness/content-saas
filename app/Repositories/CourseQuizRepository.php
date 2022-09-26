<?php
namespace App\Repositories;

use App\Models\CourseQuiz;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CourseQuizContract;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CourseQuizRepository
 *
 * @package \App\Repositories
 */
class CourseQuizRepository extends BaseRepository implements CourseQuizContract
{
    use UploadAble;

    /**
     * CourseQuizRepository constructor.
     * @param CourseQuiz $model
     */
    public function __construct(CourseQuiz $model)
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
    public function listQuiz(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findQuizById(int $id)
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
    public function createQuiz(array $params)
    {
        try {

            $collection = collect($params);

            $module = new CourseQuiz;
            $module->question = $collection['question'] ?? '';
            $slug = Str::slug($collection['question'], '-');
            $slugExistCount = CourseQuiz::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $module->slug = $slug;
            $module->optionA = $collection['optionA'] ?? '';
            $module->optionB = $collection['optionB'] ?? '';
            $module->optionC = $collection['optionC'] ?? '';
            $module->optionD = $collection['optionD'] ?? '';
            $module->right_answer = $collection['right_answer'] ?? '';
            $module->course_id = $collection['course_id'] ?? '';
            $module->save();
            return $module;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateQuiz(array $params)
    {
        $module = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $module->question = $collection['question'] ?? '';
        if($module->question != $collection['question']) {
            $slug = Str::slug($collection['question'], '-');
            $slugExistCount = CourseQuiz::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $module->slug = $slug;
            }
            $module->optionA = $collection['optionA'] ?? '';
            $module->optionB = $collection['optionB'] ?? '';
            $module->optionC = $collection['optionC'] ?? '';
            $module->optionD = $collection['optionD'] ?? '';
            $module->right_answer = $collection['right_answer'] ?? '';
            $module->course_id = $collection['course_id'] ?? '';
            $module->save();

        return $module;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteQuiz($id)
    {
        $module = $this->findOneOrFail($id);
        $module->delete();
        return $module;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateQuizStatus(array $params){
        $module = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $module->status = $collection['check_status'];
        $module->save();

        return $module;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsQuiz($id)
    {
        $module = CourseQuiz::where('id',$id)->get();

        return $module;
    }



    /**
     * @param $pinCode
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function getSearchQuiz(string $term){
            return CourseQuiz::where([['question', 'LIKE', '%' . $term . '%']])->paginate(25);
    }

}
