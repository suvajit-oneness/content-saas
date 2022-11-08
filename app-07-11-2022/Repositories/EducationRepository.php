<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Education;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\EducationContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class EducationRepository
 *
 * @package \App\Repositories
 */
class EducationRepository extends BaseRepository implements EducationContract
{
    use UploadAble;

    /**
     * EducationRepository constructor.
     * @param Education $model
     */
    public function __construct(Education $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findEducationById(int $id)
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
    public function createEducation(array $params)
    {
        try {
            $collection = collect($params);
            $education = new Education();
            $education->user_id = Auth::guard('web')->user()->id ?? '';
            $education->degree = $collection['degree'] ?? '';
            $education->college_name = $collection['college_name'] ?? '';
            $education->year_from = $collection['year_from'] ?? '';
            $education->year_to = $collection['year_to'] ?? '';
            $education->position = $collection['position'] ?? '';
            $education->score = $collection['score'] ?? '';
            $education->email_id = $collection['email_id'] ?? '';
            $education->short_desc = $collection['short_desc'] ?? '';
            $education->long_desc = $collection['long_desc'] ?? '';
            $education->link = $collection['link'] ?? '';
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
    public function updateEducation(array $params)
    {
        $education = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $education->user_id = Auth::guard('web')->user()->id ?? '';
        $education->degree = $collection['degree'] ?? '';
        $education->college_name = $collection['college_name'] ?? '';
        $education->year_from = $collection['year_from'] ?? '';
        $education->year_to = $collection['year_to'] ?? '';
        $education->position = $collection['position'] ?? '';
        $education->score = $collection['score'] ?? '';
        $education->email_id = $collection['email_id'] ?? '';
        $education->short_desc = $collection['short_desc'] ?? '';
        $education->long_desc = $collection['long_desc'] ?? '';
        $education->link = $collection['link'] ?? '';
        $education->save();

        return $education;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteEducation($id)
    {
        $education = $this->findOneOrFail($id);
        $education->delete();
        return $education;
    }
}
