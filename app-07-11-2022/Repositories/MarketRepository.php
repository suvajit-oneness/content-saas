<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Market;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\MarketContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class MarketBannerRepository
 *
 * @package \App\Repositories
 */
class MarketRepository extends BaseRepository implements MarketContract
{
    use UploadAble;

    /**
     * MarketCategoryRepository constructor.
     * @param Market $model
     */
    public function __construct(Market $model)
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
    public function listMarket(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findMarketById(int $id)
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
    public function createMarket(array $params)
    {
        try {

            $collection = collect($params);

            $category = new Market;
            $category->title = $collection['title'];
            $category->tag = $collection['tag'];
            $category->short_description = $collection['short_description'];
            $category->market_btn = $collection['market_btn'];
            $category->market_btn_link = $collection['market_btn_link'];
            $category->short_content_heading = $collection['short_content_heading'];
            $category->short_content = $collection['short_content'];
            $category->short_content_btn = $collection['short_content_btn'];
            $category->short_content_btn_link = $collection['short_content_btn_link'];
            $category->sticky_content_heading = $collection['sticky_content_heading'];
            $category->sticky_content = $collection['sticky_content_btn'];
            $category->sticky_content_btn = $collection['sticky_content_btn'];
            $category->sticky_content_btn_link = $collection['sticky_content_btn_link'];
            $category->medium_content_heading = $collection['medium_content_heading'];
            $category->medium_content = $collection['medium_content'];
            $category->faq_heading = $collection['faq_heading'];
            $category->faq_short = $collection['faq_short'];
            $category->blog_heading = $collection['blog_heading'];
            if(!empty($params['image'])){
                $category->image = imageUpload($params['image'], 'market');
            }
            if(!empty($params['faq_banner_image'])){
                $profile_image = $collection['faq_banner_image'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("uploads/market/",$imageName);
                $uploadedImage = $imageName;
                $category->faq_banner_image = $uploadedImage;
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
    public function updateMarket(array $params)
    {
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $category->title = $collection['title'];
            $category->tag = $collection['tag'];
            $category->short_description = $collection['short_description'];
            $category->market_btn = $collection['market_btn'];
            $category->market_btn_link = $collection['market_btn_link'];
            $category->short_content_heading = $collection['short_content_heading'];
            $category->short_content = $collection['short_content'];
            $category->short_content_btn = $collection['short_content_btn'];
            $category->short_content_btn_link = $collection['short_content_btn_link'];
            $category->sticky_content_heading = $collection['sticky_content_heading'];
            $category->sticky_content = $collection['sticky_content_btn'];
            $category->sticky_content_btn = $collection['sticky_content_btn'];
            $category->sticky_content_btn_link = $collection['sticky_content_btn_link'];
            $category->medium_content_heading = $collection['medium_content_heading'];
            $category->medium_content = $collection['medium_content'];
            $category->faq_heading = $collection['faq_heading'];
            $category->faq_short = $collection['faq_short'];
            $category->blog_heading = $collection['blog_heading'];
            if(!empty($params['image'])){
                $category->image = imageUpload($params['image'], 'market');
            }
            if(!empty($params['faq_banner_image'])){
                $category->image = imageUpload($params['image'], 'marketbanner');
                }
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteMarket($id)
    {
        $category = $this->findOneOrFail($id);
        $category->delete();
        return $category;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketStatus(array $params){
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
    public function detailsMarket($id)
    {
        $categories = Market::where('id',$id)->get();

        return $categories;
    }
    public function getSearchMarket(string $term)
    {
        return Market::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
