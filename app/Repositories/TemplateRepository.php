<?php
namespace App\Repositories;

use App\Contracts\TemplateContract;
use Illuminate\Support\Str;
use App\Models\Template;
use App\Models\TemplateCategory;
use App\Models\TemplateSubCategory;
use App\Models\TemplateType;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

/**
 * Class TemplateRepository
 *
 * @package \App\Repositories
 */
class TemplateRepository extends BaseRepository implements TemplateContract
{
    use UploadAble;

    /**
     * TemplateRepository constructor.
     * @param Template $model
     */
    public function __construct(Template $model)
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
    public function listTemplate(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTemplateById(int $id)
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
    public function createTemplate(array $params)
    {
        try {

            $collection = collect($params);

            $template = new Template;
            $template->title = $collection['title'];
            $template->cat_id = $collection['cat_id'];
            $template->sub_cat_id = $collection['sub_cat_id'];
            $template->type = $collection['type'];
            if(!empty($params['file'])){
                // image, folder name only
                $template->file = imageUpload($params['file'], 'template');
            }
            if(!empty($params['image'])){
                // file, folder name only
                $template->image = imageUpload($params['image'], 'template');
            }
            $template->save();
            return $template;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTemplate(array $params)
    {
        $template = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $template->title = $collection['title'];
        $template->cat_id = $collection['cat_id'];
        $template->sub_cat_id = $collection['sub_cat_id'];
        $template->type = $collection['type'];
        if(!empty($params['file'])){
            // file, folder name only
            $template->file = imageUpload($params['file'], 'template');
        }
        if(!empty($params['image'])){
            // file, folder name only
            $template->image = imageUpload($params['image'], 'template');
        }
        $template->save();
        return $template;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteTemplate($id)
    {
        $template = $this->findOneOrFail($id);
        $template->delete();
        return $template;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTemplateStatus(array $params){
        $template = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $template->status = $collection['check_status'];
        $template->save();

        return $template;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsTemplate($id)
    {
        $template = Template::where('id',$id)->get();

        return $template;
    }
    /**
     * @param
     * @return mixed
     */
    public function listCategory()
    {
       $template =TemplateCategory::where('status',1)->get();
       return $template;
    }
    /**
     * @param
     * @return mixed
     */
    public function listSubcategory()
    {
       $template =TemplateSubCategory::where('status',1)->get();
       return $template;
    }
    /**
     * @param
     * @return mixed
     */
    public function listType()
    {
       $template =TemplateType::all();
       return $template;
    }

     /**
     * @return mixed
     */
    public function getSearchTemplate(string $term)
    {
        return Template::where([['title', 'LIKE', '%' . $term . '%']])->paginate(35);
    }

    public function searchTemplatefrontData($keyword, $category, $subcategory, $type) {
        DB::enableQueryLog();

        $template = Template::when($category, function($query) use ($category){
            $query->where('cat_id', 'like' , '%' . $category .'%');
        })
        ->when($keyword, function($query) use ($keyword){
            $query->where('title', 'like', '%' . $keyword .'%');
        })
        ->when($subcategory, function($query) use ($subcategory){
            $query->where('sub_cat_id','like' , '%' . $subcategory .'%');
        })
        ->when($type, function($query) use ($type){
            $query->where('type', 'like', '%' . $type .'%');
        })
        ->paginate(10);

        // dd(DB::getQueryLog());

        return $template;
    }
}
