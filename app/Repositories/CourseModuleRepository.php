<?php
namespace App\Repositories;

use App\Models\CourseModule;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CourseModuleContract;
use App\Models\Course;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CourseModuleRepository
 *
 * @package \App\Repositories
 */
class CourseModuleRepository extends BaseRepository implements CourseModuleContract
{
    use UploadAble;

    /**
     * CourseModuleRepository constructor.
     * @param CourseModule $model
     */
    public function __construct(CourseModule $model)
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
    public function listModule(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findModuleById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Event|mixed
     */
    public function createModule(array $params)
    {
        try {

            $collection = collect($params);

            $module = new CourseModule;
            $module->title = $collection['title'] ?? '';
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = CourseModule::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $module->slug = $slug;
            $module->description = $collection['description'] ?? '';
            $module->course_id = $collection['course_id'] ?? '';
            $module->save();
            return $module;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateModule(array $params)
    {
        $module = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $module->title = $collection['title'] ?? '';
        if($module->title != $collection['title']) {
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = CourseModule::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $module->slug = $slug;
            }
            $module->description = $collection['description'] ?? '';
            $module->course_id = $collection['course_id'] ?? '';
            $module->save();

        return $module;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteModule($id)
    {
        $module = $this->findOneOrFail($id);
        $module->delete();
        return $module;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateModuleStatus(array $params){
        $module = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $module->status = $collection['check_status'];
        $module->save();

        return $module;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsModule($id)
    {
        $module = CourseModule::where('id',$id)->get();

        return $module;
    }
     /**
     *
     * @return mixed
     */
    public function listCategory(){
        return CourseCategory::orderby('title')->where('status',1)->get();
    }


    /**
     * @param $pinCode
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function getSearchModule(string $term){
            return CourseModule::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }

}
