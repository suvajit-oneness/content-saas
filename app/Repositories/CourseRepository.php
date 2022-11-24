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
     * @return Course|mixed
     */
    public function createCourse(array $params)
    {
        try {

            $collection = collect($params);

            $course = new Course;
            $course->course_name = $collection['course_name'] ?? '';
            $slug = Str::slug($collection['course_name'], '-');
            $slugExistCount = Course::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $course->slug = $slug;
            $course->short_description = $collection['short_description'] ?? '';
            $course->description = $collection['description'] ?? '';
            $course->company_name = $collection['company_name'] ?? '';
            $course->company_description = $collection['company_description'] ?? '';
            $course->author_name = $collection['author_name'] ?? '';
            $course->author_description = $collection['author_description'] ?? '';
            $course->category_id = $collection['category_id'] ?? '';
            $course->target = $collection['target'] ?? '';
            $course->requirements = $collection['requirements'] ?? '';
            $course->language = $collection['language'] ?? '';
            $course->type = $collection['type'] ?? '';
            $course->price = $collection['price'] ?? '';
            $course->offer_price = $collection['offer_price'] ?? '';
            if(!empty($params['image'])){
                $profile_image = $collection['image'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("course/",$imageName);
                $uploadedImage = $imageName;
                $course->image = $uploadedImage;
                }
            if(!empty($params['author_image'])){
            $profile_image = $collection['author_image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("course/",$imageName);
            $uploadedImage = $imageName;
            $course->author_image = $uploadedImage;
            }
            $course->save();
            return $course;

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
        $course = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $course->course_name = $collection['course_name'] ?? '';
        if($course->course_name != $collection['course_name']) {
            $slug = Str::slug($collection['course_name'], '-');
            $slugExistCount = Course::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $course->slug = $slug;
            }
            $course->short_description = $collection['short_description'] ?? '';
            $course->description = $collection['description'] ?? '';
            $course->company_name = $collection['company_name'] ?? '';
            $course->company_description = $collection['company_description'] ?? '';
            $course->author_name = $collection['author_name'] ?? '';
            $course->author_description = $collection['author_description'] ?? '';
            $course->category_id = $collection['category_id'] ?? '';
            $course->target = $collection['target'] ?? '';
            $course->requirements = $collection['requirements'] ?? '';
            $course->language = $collection['language'] ?? '';
            $course->type = $collection['type'] ?? '';
            $course->price = $collection['price'] ?? '';
            $course->offer_price = $collection['offer_price'] ?? '';
        if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("course/",$imageName);
            $uploadedImage = $imageName;
            $course->author_image = $uploadedImage;
        }
        if(!empty($params['author_image'])){
            $profile_image = $collection['author_image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("course/",$imageName);
            $uploadedImage = $imageName;
            $course->author_image = $uploadedImage;
            }
        $course->save();

        return $course;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCourse($id)
    {
        $course = $this->findOneOrFail($id);
        $course->delete();
        return $course;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCourseStatus(array $params){
        $course = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $course->status = $collection['check_status'];
        $course->save();

        return $course;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsCourse($id)
    {
        $courses = Course::where('id',$id)->get();

        return $courses;
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
            $course = Course::when($category, function($query) use ($category){
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

        return $course;
    }

}
