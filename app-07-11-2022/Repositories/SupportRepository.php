<?php
namespace App\Repositories;

use App\Models\Support;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SupportContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SupportRepository
 *
 * @package \App\Repositories
 */
class SupportRepository extends BaseRepository implements SupportContract
{
    use UploadAble;

    /**
     * SupportRepository constructor.
     * @param Support $model
     */
    public function __construct(Support $model)
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
    public function listSupport(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSupportById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Category|mixed
     */
    public function createSupport(array $params)
    {
        try {

            $collection = collect($params);
            $support = new Support;
            $support->title = $collection['title'];
            $support->description = $collection['description'];
            $support->widget_title = $collection['widget_title'];
            $support->widget_description = $collection['widget_description'];
            $support->save();
            return $support;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupport(array $params)
    {
        $support = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $support->title = $collection['title'];
        $support->description = $collection['description'];
        $support->widget_title = $collection['widget_title'];
        $support->widget_description = $collection['widget_description'];
        $support->faq_title = $collection['faq_title'];
        $support->faq_description = $collection['faq_description'];
        $support->save();

        return $support;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSupport($id)
    {
        $support = $this->findOneOrFail($id);
        $support->delete();
        return $support;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportStatus(array $params){
        $support = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $support->status = $collection['check_status'];
        $support->save();

        return $support;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsSupport($id)
    {
        $support = Support::where('id',$id)->get();
        return $support;
    }

}
