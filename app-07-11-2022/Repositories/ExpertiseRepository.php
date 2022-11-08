<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\UserSpeciality;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ExpertiseContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class ExpertiseRepository
 *
 * @package \App\Repositories
 */
class ExpertiseRepository extends BaseRepository implements ExpertiseContract
{
    use UploadAble;

    /**
     * ExpertiseRepository constructor.
     * @param UserSpeciality $model
     */
    public function __construct(UserSpeciality $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findExpertiseById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Speciality|mixed
     */
    public function createExpertise(array $params)
    {
        try {
            $collection = collect($params);
            $expertise = new UserSpeciality();
            $expertise->user_id = Auth::guard('web')->user()->id ?? '';
            $expertise->speciality_id = $collection['speciality_id'] ?? '';
            $expertise->description = $collection['description'] ?? '';
            $expertise->save();

            return $expertise;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateExpertise(array $params)
    {
        $expertise = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $expertise->user_id = Auth::guard('web')->user()->id ?? '';
        $expertise->speciality_id = $collection['speciality_id'] ?? '';
        $expertise->description = $collection['description'] ?? '';
        $expertise->save();

        return $expertise;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteExpertise($id)
    {
        $expertise = $this->findOneOrFail($id);
        $expertise->delete();
        return $expertise;
    }
}
