<?php
namespace App\Repositories;

use App\Contracts\TemplateTypeContract;
use Illuminate\Support\Str;
use App\Models\TemplateType;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class TemplateTypeRepository
 *
 * @package \App\Repositories
 */
class TemplateTypeRepository extends BaseRepository implements TemplateTypeContract
{
    use UploadAble;

    /**
     * TemplateTypeRepository constructor.
     * @param TemplateType $model
     */
    public function __construct(TemplateType $model)
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
    public function listType(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTypeById(int $id)
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
    public function createType(array $params)
    {
        try {

            $collection = collect($params);

            $type = new Templatetype;
            $type->title = $collection['title'];
            $type->save();
            return $type;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateType(array $params)
    {
        $type = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $type->title = $collection['title'];
        $type->save();
        return $type;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteType($id)
    {
        $type = $this->findOneOrFail($id);
        $type->delete();
        return $type;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTypeStatus(array $params){
        $type = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $type->status = $collection['check_status'];
        $type->save();

        return $type;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsType($id)
    {
        $type = TemplateType::where('id',$id)->get();

        return $type;
    }

     /**
     * @return mixed
     */
    public function getSearchType(string $term)
    {
        return TemplateType::where([['title', 'LIKE', '%' . $term . '%']])

        ->paginate(35);
    }
}
