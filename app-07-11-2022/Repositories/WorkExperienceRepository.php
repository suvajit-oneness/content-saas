<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Employment;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\WorkExperienceContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Auth;
/**
 * Class WorkExperienceRepository
 *
 * @package \App\Repositories
 */
class WorkExperienceRepository extends BaseRepository implements WorkExperienceContract
{
    use UploadAble;

    /**
     * WorkExperienceRepository constructor.
     * @param Employment $model
     */
    public function __construct(Employment $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findExperienceById(int $id)
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
    public function createExperience(array $params)
    {
        try {
            $collection = collect($params);
            $experience = new Employment();
            $experience->user_id = Auth::guard('web')->user()->id ?? '';
            $experience->occupation = $collection['occupation'] ?? '';
            $experience->company_title = $collection['company_title'] ?? '';
            $experience->year_from = $collection['year_from'] ?? '';
            $experience->year_to = $collection['year_to'] ?? '';
            $experience->short_desc = $collection['short_desc'] ?? '';
            $experience->long_desc = $collection['long_desc'] ?? '';
            $experience->phone_number = $collection['phone_number'] ?? '';
            $experience->email_id = $collection['email_id'] ?? '';
            $experience->owner_name = $collection['owner_name'] ?? '';
            $experience->manager_name = $collection['manager_name'] ?? '';
            $experience->link = $collection['link'] ?? '';
            $experience->save();

            return $experience;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateExperience(array $params)
    {
        $experience = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $experience->user_id = Auth::guard('web')->user()->id ?? '';
        $experience->occupation = $collection['occupation'] ?? '';
        $experience->company_title = $collection['company_title'] ?? '';
        $experience->year_from = $collection['year_from'] ?? '';
        $experience->year_to = $collection['year_to'] ?? '';
        $experience->short_desc = $collection['short_desc'] ?? '';
        $experience->long_desc = $collection['long_desc'] ?? '';
        $experience->phone_number = $collection['phone_number'] ?? '';
        $experience->email_id = $collection['email_id'] ?? '';
        $experience->owner_name = $collection['owner_name'] ?? '';
        $experience->manager_name = $collection['manager_name'] ?? '';
        $experience->link = $collection['link'] ?? '';
        $experience->save();

        return $experience;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteExperience($id)
    {
        $experience = $this->findOneOrFail($id);
        $experience->delete();
        return $experience;
    }
}
