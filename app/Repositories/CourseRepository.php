<?php
namespace App\Repositories;

use App\Models\Course;
use App\Models\Userevent;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CourseContract;
use App\Models\CourseCategory;
use App\Models\EventType;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CourseRepository
 *
 * @package \App\Repositories
 */
class CourseRepository extends BaseRepository implements CourseContract
{
    use UploadAble;

    /**
     * CourseRepository constructor.
     * @param Course $model
     */
    public function __construct(Course $model)
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
    public function listCourse(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCourseById(int $id)
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
    public function createCourse(array $params)
    {
        try {

            $collection = collect($params);

            $event = new Course;
            $event->course_name = $collection['course_name'] ?? '';
            $slug = Str::slug($collection['course_name'], '-');
            $slugExistCount = Course::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $event->slug = $slug;
            $event->short_description = $collection['short_description'] ?? '';
            $event->description = $collection['description'] ?? '';
            $event->company_name = $collection['company_name'] ?? '';
            $event->company_description = $collection['company_description'] ?? '';
            $event->author_name = $collection['author_name'] ?? '';
            $event->author_description = $collection['author_description'] ?? '';
            $event->category_id = $collection['category_id'] ?? '';
            $event->target = $collection['target'] ?? '';
            $event->requirements = $collection['requirements'] ?? '';
            $event->language = $collection['language'] ?? '';
            $event->type = $collection['type'] ?? '';
            $event->price = $collection['price'] ?? '';
            if(!empty($params['image'])){
                $profile_image = $collection['image'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("course/",$imageName);
                $uploadedImage = $imageName;
                $event->image = $uploadedImage;
                }
            if(!empty($params['author_image'])){
            $profile_image = $collection['author_image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("course/",$imageName);
            $uploadedImage = $imageName;
            $event->author_image = $uploadedImage;
            }
            $event->save();
            return $event;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCourse(array $params)
    {
        $event = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $event->course_name = $collection['course_name'] ?? '';
        if($event->course_name != $collection['course_name']) {
            $slug = Str::slug($collection['course_name'], '-');
            $slugExistCount = Course::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $event->slug = $slug;
            }
            $event->short_description = $collection['short_description'] ?? '';
            $event->description = $collection['description'] ?? '';
            $event->company_name = $collection['company_name'] ?? '';
            $event->company_description = $collection['company_description'] ?? '';
            $event->author_name = $collection['author_name'] ?? '';
            $event->author_description = $collection['author_description'] ?? '';
            $event->category_id = $collection['category_id'] ?? '';
            $event->target = $collection['target'] ?? '';
            $event->requirements = $collection['requirements'] ?? '';
            $event->language = $collection['language'] ?? '';
            $event->type = $collection['type'] ?? '';
            $event->price = $collection['price'] ?? '';
        if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("course/",$imageName);
            $uploadedImage = $imageName;
            $event->author_image = $uploadedImage;
        }
        if(!empty($params['author_image'])){
            $profile_image = $collection['author_image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("course/",$imageName);
            $uploadedImage = $imageName;
            $event->author_image = $uploadedImage;
            }
        $event->save();

        return $event;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCourse($id)
    {
        $event = $this->findOneOrFail($id);
        $event->delete();
        return $event;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCourseStatus(array $params){
        $event = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $event->status = $collection['check_status'];
        $event->save();

        return $event;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsCourse($id)
    {
        $events = Course::where('id',$id)->get();

        return $events;
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
    public function searchCoursesData($category,$author,$type,$keyword){
            $events = Course::when($category, function($query) use ($category){
                            $query->where('category_id', 'like' , '%' . $category .'%');
                        })
                        ->when($author, function($query) use ($author){
                            $query->where('author_name', '=', $author);
                        })
                        ->when($type, function($query) use ($type){
                            $query->where('type', 'like', '%' . $type .'%');
                        })
                        ->when($keyword, function($query) use ($keyword){
                            $query->where('course_name', 'like', '%' . $keyword .'%');
                        })
                        ->paginate(25);

        return $events;
    }

}
