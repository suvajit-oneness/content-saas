<?php
namespace App\Repositories;

use App\Models\SupportWidget;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SupportWidgetContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SupportWidgetRepository
 *
 * @package \App\Repositories
 */
class SupportWidgetRepository extends BaseRepository implements SupportWidgetContract
{
    use UploadAble;

    /**
     * SupportWidgetRepository constructor.
     * @param SupportWidget $model
     */
    public function __construct(SupportWidget $model)
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
    public function listSupportWidget(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSupportWidgetById(int $id)
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
    public function createSupportWidget(array $params)
    {
        try {

            $collection = collect($params);
            $supportWidget = new SupportWidget();
            $supportWidget->title = $collection['title'];
            $supportWidget->description = $collection['description'];
            if(!empty($params['image'])){
                // image, folder name only
                $supportWidget->image = imageUpload($params['image'], 'supportwidgeticon');
            }
            $supportWidget->save();
            return $supportWidget;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportWidget(array $params)
    {
        $supportWidget = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $supportWidget->title = $collection['title'];
        $supportWidget->description = $collection['description'];
        if(!empty($params['image'])){
            // image, folder name only
            $supportWidget->image = imageUpload($params['image'], 'supportwidgeticon');
        }
        $supportWidget->save();

        return $supportWidget;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSupportWidget($id)
    {
        $supportWidget = $this->findOneOrFail($id);
        $supportWidget->delete();
        return $supportWidget;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportWidgetStatus(array $params){
        $supportWidget = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $supportWidget->status = $collection['check_status'];
        $supportWidget->save();

        return $supportWidget;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsSupportWidget($id)
    {
        $supportWidget = SupportWidget::where('id',$id)->get();
        return $supportWidget;
    }

    public function getSearchSupportFaqCategory(string $term)
    {
        return SupportWidget::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
