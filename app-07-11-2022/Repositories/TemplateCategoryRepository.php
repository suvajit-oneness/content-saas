<?php
namespace App\Repositories;

use App\Models\TemplateCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\TemplateCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class TemplateCategoryRepository
 *
 * @package \App\Repositories
 */
class TemplateCategoryRepository extends BaseRepository implements TemplateCategoryContract
{
    use UploadAble;

    /**
     * TemplateCategoryRepository constructor.
     * @param TemplateCategory $model
     */
    public function __construct(TemplateCategory $model)
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
     * @return Category|mixed
     */
    public function createCategory(array $params)
    {
        try {

            $collection = collect($params);
            $category = new TemplateCategory;
            $category->title = $collection['title'];
             // slug
            $category->slug = slugGenerate($collection['title'], 'template_categories');
            $category->description = $collection['description'];
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
        if($category->title != $collection['title']) {
             $category->slug = slugGenerate($collection['title'], 'template_categories');
         }
        $category->description = $collection['description'];
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
    public function updateCatStatus(array $params){
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
        $categories = TemplateCategory::where('id',$id)->get();

        return $categories;
    }

    public function getSearchCategories(string $term)
    {
        return TemplateCategory::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
