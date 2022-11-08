<?php
namespace App\Repositories;

use App\Models\SupportFaqCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SupportFaqCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SupportFaqCategoryRepository
 *
 * @package \App\Repositories
 */
class SupportFaqCategoryRepository extends BaseRepository implements SupportFaqCategoryContract
{
    use UploadAble;

    /**
     * SupportFaqCategoryRepository constructor.
     * @param SupportFaqCategory $model
     */
    public function __construct(SupportFaqCategory $model)
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
    public function listSupportFaqCategory(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSupportFaqCategoryById(int $id)
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
    public function createSupportFaqCategory(array $params)
    {
        try {

            $collection = collect($params);
            $supportfaqCat = new SupportFaqCategory;
            $supportfaqCat->title = $collection['title'];
            $supportfaqCat->save();
            return $supportfaqCat;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportFaqCategory(array $params)
    {
        $supportfaqCat = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $supportfaqCat->title = $collection['title'];
        $supportfaqCat->save();

        return $supportfaqCat;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSupportFaqCategory($id)
    {
        $supportfaqCat = $this->findOneOrFail($id);
        $supportfaqCat->delete();
        return $supportfaqCat;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportFaqCategoryStatus(array $params){
        $supportfaqCat = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $supportfaqCat->status = $collection['check_status'];
        $supportfaqCat->save();

        return $supportfaqCat;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsSupportFaqCategory($id)
    {
        $supportfaqCat = SupportFaqCategory::where('id',$id)->get();
        return $supportfaqCat;
    }

    public function getSearchSupportFaqCategory(string $term)
    {
        return SupportFaqCategory::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
