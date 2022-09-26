<?php
namespace App\Repositories;

use App\Models\CourseCategory;
use App\Traits\UploadAble;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Contracts\CourseCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CourseCategoryRepository
 *
 * @package \App\Repositories
 */
class CourseCategoryRepository extends BaseRepository implements CourseCategoryContract
{
    use UploadAble;

    /**
     * CourseCategoryRepository constructor.
     * @param CourseCategory $model
     */
    public function __construct(CourseCategory $model)
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

            $category = new CourseCategory;
            $category->title = $collection['title'];
            $category->content = $collection['content'];
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = CourseCategory::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $category->slug = $slug;
            if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("coursecategories/",$imageName);
            $uploadedImage = $imageName;
            $category->image = $uploadedImage;
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
        $category->content = $collection['content'];
        if($category->title != $collection['title']) {
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = CourseCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->slug = $slug;
        }
        if(!empty($params['image'])){
        $profile_image = $collection['image'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("coursecategories/",$imageName);
        $uploadedImage = $imageName;
        $category->image = $uploadedImage;
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
        $categories = CourseCategory::where('id',$id)->get();

        return $categories;
    }

    public function getSearchCategories(string $term)
    {
        return CourseCategory::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
