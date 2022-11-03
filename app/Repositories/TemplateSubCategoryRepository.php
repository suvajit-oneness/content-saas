<?php
namespace App\Repositories;

use App\Contracts\TemplateSubCategoryContract;
use Illuminate\Support\Str;
use App\Models\TemplateCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Models\TemplateSubCategory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class TemplateSubCategoryRepository
 *
 * @package \App\Repositories
 */
class TemplateSubCategoryRepository extends BaseRepository implements TemplateSubCategoryContract
{
    use UploadAble;

    /**
     * SubCategoryRepository constructor.
     * @param TemplateSubCategory $model
     */
    public function __construct(TemplateSubCategory $model)
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

            $subcategory = new TemplateSubCategory;
            $subcategory->title = $collection['title'];
            $subcategory->cat_id = $collection['cat_id'];
            $subcategory->description = $collection['description'];
            $subcategory->slug = slugGenerate($collection['title'], 'template_sub_categories');
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
        $subcategory->cat_id = $collection['cat_id'];
        $subcategory->description = $collection['description'];
        if($subcategory->title != $collection['title']) {
            $subcategory->slug = slugGenerate($collection['title'], 'template_sub_categories');
        }
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
        $subcategories = TemplateSubCategory::where('id',$id)->get();

        return $subcategories;
    }

    public function listCategory(){
        return TemplateCategory::all();
    }

     /**
     * @return mixed
     */
    public function getSearchSubcategory(string $term)
    {
        return TemplateSubCategory::where([['title', 'LIKE', '%' . $term . '%']])

        ->paginate(35);
    }
}
