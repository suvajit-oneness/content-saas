<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\MarketCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\MarketCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class MarketCategoryRepository
 *
 * @package \App\Repositories
 */
class MarketCategoryRepository extends BaseRepository implements MarketCategoryContract
{
    use UploadAble;

    /**
     * MarketCategoryRepository constructor.
     * @param MarketCategory $model
     */
    public function __construct(MarketCategory $model)
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
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCategoryById(int $id)
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
    public function createCategory(array $params)
    {
        try {

            $collection = collect($params);

            $category = new MarketCategory;
            $category->title = $collection['title'];
            $category->category_description_heading = $collection['category_description_heading'];
            $category->category_description = $collection['category_description'];
            $category->category_description_btn = $collection['category_description_btn'];
            $category->category_description_btn_link = $collection['category_description_btn_link'];
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = MarketCategory::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $category->slug = $slug;
            if(!empty($params['image'])){
                $category->image = imageUpload($params['image'], 'marketcategories');
            }
            if(!empty($params['category_description_image'])){
                $category->image = imageUpload($params['image'], 'marketcategoriescontent');
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
    public function updateCategory(array $params)
    {
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $category->title = $collection['title'];
        $category->category_description_heading = $collection['category_description_heading'];
        $category->category_description = $collection['category_description'];
        $category->category_description_btn = $collection['category_description_btn'];
        $category->category_description_btn_link = $collection['category_description_btn_link'];
        if($category->title != $collection['title']) {
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = MarketCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->slug = $slug;
        }
        if(!empty($params['image'])){
            $category->image = imageUpload($params['image'], 'marketcategories');
        }
        if(!empty($params['category_description_image'])){
            $category->image = imageUpload($params['image'], 'marketcategoriescontent');
            }
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCategory($id)
    {
        $category = $this->findOneOrFail($id);
        $category->delete();
        return $category;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategoryStatus(array $params){
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
    public function detailsCategory($id)
    {
        $categories = MarketCategory::where('id',$id)->get();

        return $categories;
    }
    public function getSearchCategories(string $term)
    {
        return MarketCategory::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
