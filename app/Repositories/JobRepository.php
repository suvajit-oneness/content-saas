<?php
namespace App\Repositories;

use App\Models\Job;
use App\Models\Userjob;
use Illuminate\Support\Str;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\JobContract;
use App\Models\ApplyJob;
use App\Models\JobCategory;
use App\Models\JobTag;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class JobRepository
 *
 * @package \App\Repositories
 */
class JobRepository extends BaseRepository implements JobContract
{
    use UploadAble;

    /**
     * JobRepository constructor.
     * @param Job $model
     */
    public function __construct(Job $model)
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
    public function listJob(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findJobById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return job|mixed
     */
    public function createJob(array $params)
    {
        try {

            $collection = collect($params);
            $job = new Job;
            $job->category_id = $collection['category_id'] ?? '';
            $job->title = $collection['title'] ?? '';
            // slug
            $job->slug = slugGenerate($collection['title'], 'jobs');
            if($params['employment_type'] == 'other'){
            $job->employment_type = $collection['other_employment_type'] ?? '';
            }
            else{
            $job->employment_type = $collection['employment_type'] ?? '';
            }
            $job->address = $collection['address'] ?? '';
            $job->postcode = $collection['postcode'] ?? '';
            $job->city = $collection['city'] ?? '';
            $job->state = $collection['state'] ?? '';
            $job->country = $collection['country'] ?? '';
            if(!empty($params['image'])){
                // image, folder name only
                $job->image = imageUpload($params['image'], 'job');
            }
            $job->skill = $collection['skill'] ?? '';
            $job->experience = $collection['experience'] ?? '';
            $job->scope = $collection['scope'] ?? '';
            $job->source = $collection['source'] ?? '';
            $job->salary = $collection['salary'] ?? '';
            $job->payment = $collection['payment'] ?? '';
            $job->start_date = $collection['start_date'] ?? '';
            $job->end_date = $collection['end_date'] ?? '';
            $job->description = $collection['description'] ?? '';
            $job->tag = $collection['tag'] ?? '';
            $job->save();
            foreach (explode(',',$params['tag']) as $value) {
                $blogTag=new JobTag();
                $blogTag->job_id = $job->id ?? '';
                $blogTag->title = $value ?? '';
                $slug = Str::slug($value, '-');
                $slugExistCount = JobTag::where('title', $collection['tag'])->count();
                if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
                $blogTag->slug = $slug;
                $blogTag->save();
                }
            return $job;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateJob(array $params)
    {
        $job = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $job->category_id = $collection['category_id'] ?? '';
        $job->title = $collection['title'] ?? '';
        // slug
        $job->slug = slugGenerate($collection['title'], 'jobs');
        if($params['employment_type'] == 'other'){
        $job->employment_type = $collection['other_employment_type'] ?? '';
        }
        else{
        $job->employment_type = $collection['employment_type'] ?? '';
        }
        $job->address = $collection['address'] ?? '';
        $job->postcode = $collection['postcode'] ?? '';
        $job->city = $collection['city'] ?? '';
        $job->state = $collection['state'] ?? '';
        $job->country = $collection['country'] ?? '';
        if(!empty($params['image'])){
            // image, folder name only
            $job->image = imageUpload($params['image'], 'job');
        }
        $job->skill = $collection['skill'] ?? '';
            $job->experience = $collection['experience'] ?? '';
            $job->scope = $collection['scope'] ?? '';
        $job->source = $collection['source'] ?? '';
        $job->salary = $collection['salary'] ?? '';
        $job->payment = $collection['payment'] ?? '';
        $job->start_date = $collection['start_date'] ?? '';
        $job->end_date = $collection['end_date'] ?? '';
        $job->description = $collection['description'] ?? '';
       // $job->tag = $collection['tag'] ?? '';
            $job->save();
            foreach (explode(',',$params['tag']) as $value) {
                $blogTag=new JobTag();
                $blogTag->job_id = $job->id ?? '';
                $blogTag->title = $value ?? '';
                $slug = Str::slug($value, '-');
                $slugExistCount = JobTag::where('title', $collection['tag'])->count();
                if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
                $blogTag->slug = $slug;
                $blogTag->save();
                }
        return $job;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteJob($id)
    {
        $job = $this->findOneOrFail($id);
        $job->delete();
        return $job;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateJobStatus(array $params){
        $job = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $job->status = $collection['check_status'];
        $job->save();

        return $job;
    }
    public function updateJobfeatureStatus(array $params){
        $job = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $job->featured_flag = $collection['check_status'];
        $job->save();

        return $job;
    }
    public function updateJobbegineerfriendlyStatus(array $params){
        $job = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $job->beginner_friendly = $collection['check_status'];
        $job->save();

        return $job;
    }

     /**
     * @param $id
     * @return mixed
     */
    public function detailsJob($id)
    {
        $job = Job::where('id',$id)->get();

        return $job;
    }
     /**
     *
     * @return mixed
     */
    public function listCategory(){
        $job= JobCategory::orderby('title')->where('status',1)->get();

        return $job;
    }

    /**
     * @param $pinCode
     * @return mixed
     */
    public function getTrendingjobByPinCode($pinCode){
        $job = Job::with('category')->where('pin',$pinCode)->take(3)->get();

        return $job;
    }

    /**
     * @param $pinCode
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function searchJobData($term){
         return Job::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);


    }

    /**
     * @param $categoryId
     * @param $keyword
     * @param $price
     * @param $type
     * @param $location
     * @return mixed
     */
    public function searchJobfrontData($categoryId,$keyword,$location,$type,$salary){
        $job = Job::when($categoryId, function($query) use ($categoryId){
                        $query->where('category', 'like' , '%' . $categoryId .'%');
                    })
                    ->when($keyword, function($query) use ($keyword){
                        $query->where('title','like' , '%' . $keyword .'%');
                    })
                    ->when($location, function($query) use ($location){
                        $query->where('location', 'like', '%' . $location .'%');
                    })
                    ->when($type, function($query) use ($type){
                        $query->where('type', 'like', '%' . $type .'%');
                    })
                    ->when($salary, function($query) use ($salary){
                        $query->where('salary', 'like', '%' . $salary .'%');
                    })
                    ->paginate(15);

    return $job;
}
        public function applyjob(array $params){
            try {

                $collection = collect($params);

                $item = new ApplyJob();
                $item->user_id = auth()->guard('web')->user()->id;
                $item->job_id = $collection['job_id'];
                if(!empty($params['cv'])){
                    $item->cv = imageUpload($params['cv'], 'jobresume');
                    }
               // $item->cv = $collection['cv'];
                $item->save();
                return $item;
            } catch (QueryException $exception) {
                throw new InvalidArgumentException($exception->getMessage());
            }
        }

}
