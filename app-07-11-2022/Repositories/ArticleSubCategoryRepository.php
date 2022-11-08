<?php
namespace App\Repositories;

use App\Contracts\ArticleSubCategoryContract;
use Illuminate\Support\Str;
use App\Models\ArticleCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Models\ArticleSubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class ArticleSubCategoryRepository
 *
 * @package \App\Repositories
 */
class ArticleSubCategoryRepository extends BaseRepository implements ArticleSubCategoryContract
{
    use UploadAble;

    /**
     * SubCategoryRepository constructor.
     * @param ArticleSubCategory $model
     */
    public function __construct(ArticleSubCategory $model)
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
    public function listSubCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSubCategoryById(int $id)
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
    public function createSubCategory(array $params)
    {
        try {

            $collection = collect($params);

            $subcategory = new ArticleSubCategory;
            $subcategory->title = $collection['title'];
            $subcategory->category_id = $collection['category_id'];
            $subcategory->description = $collection['description'];
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = ArticleSubCategory::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $subcategory->slug = $slug;
            $subcategory->save();
            return $subcategory;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSubCategory(array $params)
    {
        $subcategory = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $subcategory->title = $collection['title'];
        $subcategory->category_id = $collection['category_id'];
        $subcategory->description = $collection['description'];
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = ArticleSubCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $subcategory->slug = $slug;
        $subcategory->save();

        return $subcategory;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSubCategory($id)
    {
        $subcategory = $this->findOneOrFail($id);
        $subcategory->delete();
        return $subcategory;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatesubCategoryStatus(array $params){
        $subcategory = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $subcategory->status = $collection['check_status'];
        $subcategory->save();

        return $subcategory;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsSubCategory($id)
    {
        $subcategories = ArticleSubCategory::where('id',$id)->get();

        return $subcategories;
    }

    public function listCategory(){
        return ArticleCategory::all();
    }

     /**
     * @return mixed
     */
    public function getSearchSubcategory(string $term)
    {
        return ArticleSubCategory::where([['title', 'LIKE', '%' . $term . '%']])

        ->paginate(35);
    }
}
