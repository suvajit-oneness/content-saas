<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\MarketBanner;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\MarketBannerContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class MarketBannerRepository
 *
 * @package \App\Repositories
 */
class MarketBannerRepository extends BaseRepository implements MarketBannerContract
{
    use UploadAble;

    /**
     * MarketCategoryRepository constructor.
     * @param MarketBanner $model
     */
    public function __construct(MarketBanner $model)
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
    public function listMarketBanner(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findMarketBannerById(int $id)
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
    public function createMarketBanner(array $params)
    {
        try {

            $collection = collect($params);

            $category = new MarketBanner;
            $category->content_heading = $collection['content_heading'];
            $category->content = $collection['content'];
            $category->content_btn = $collection['content_btn'];
            $category->content_btn_link = $collection['content_btn_link'];
            if(!empty($params['image'])){
                $category->image = imageUpload($params['image'], 'marketbanner');
            }
            $category->save();

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketBanner(array $params)
    {
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $category->content_heading = $collection['content_heading'];
        $category->content = $collection['content'];
        $category->content_btn = $collection['content_btn'];
        $category->content_btn_link = $collection['content_btn_link'];
        if(!empty($params['image'])){
            $category->image = imageUpload($params['image'], 'marketbanner');
        }
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteMarketBanner($id)
    {
        $category = $this->findOneOrFail($id);
        $category->delete();
        return $category;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketBannerStatus(array $params){
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $category->status = $collection['check_status'];
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsMarketBanner($id)
    {
        $categories = MarketBanner::where('id',$id)->get();

        return $categories;
    }
    public function getSearchMarketBanner(string $term)
    {
        return MarketBanner::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
