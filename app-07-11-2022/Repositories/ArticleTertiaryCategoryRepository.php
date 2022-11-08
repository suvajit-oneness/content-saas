<?php
namespace App\Repositories;

use App\Models\ArticleSubCategory;
use App\Models\ArticleTertiaryCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ArticleTertiaryCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
/**
 * Class ArticleTertiaryCategoryRepository
 *
 * @package \App\Repositories
 */
class ArticleTertiaryCategoryRepository extends BaseRepository implements ArticleTertiaryCategoryContract
{
    use UploadAble;

    /**
     * ArticleTertiaryCategoryRepository constructor.
     * @param ArticleTertiaryCategory $model
     */
    public function __construct(ArticleTertiaryCategory $model)
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
    public function listTertiarycategory(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTertiarycategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return State|mixed
     */
    public function createTertiarycategory(array $params)
    {
        try {

            $collection = collect($params);

            $subcat = new ArticleTertiaryCategory;
            $subcat->title = $collection['title'];
            $subcat->sub_category_id = $collection['sub_category_id'];

            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = ArticleTertiaryCategory::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $subcat->slug = $slug;


            $subcat->save();

            return $subcat;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTertiarycategory(array $params)
    {
        $subcat = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $subcat->title = $collection['title'];
        $subcat->sub_category_id = $collection['sub_category_id'];
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = ArticleTertiaryCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $subcat->slug = $slug;
        // $profile_image = $collection['image'];
        // $imageName = time().".".$profile_image->getClientOriginalName();
        // $profile_image->move("categories/",$imageName);
        // $uploadedImage = $imageName;
        // $category->image = $uploadedImage;

        $subcat->save();

        return $subcat;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteTertiarycategory($id)
    {
        $subcat = $this->findOneOrFail($id);
        $subcat->delete();
        return $subcat;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTertiarycategoryStatus(array $params){
        $subcat = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $subcat->status = $collection['check_status'];
        $subcat->save();

        return $subcat;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsTertiarycategory($id)
    {
        $categories = ArticleTertiaryCategory::where('id',$id)->get();

        return $categories;
    }

public function getSubCategory(){
    return ArticleSubCategory::all();
}

        // csv upload
    /**
     * @return mixed
     */
    public function getSearchTertiarycategory(string $term)
    {
        return ArticleTertiaryCategory::where([['title', 'LIKE', '%' . $term . '%']])

        ->get();
    }
    }



