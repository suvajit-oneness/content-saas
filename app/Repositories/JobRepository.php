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

            $job = new Job();
            
            $job->category_id = $collection['category_id'] ?? '';
            $job->title = $collection['title'] ?? '';
            // slug
            $job->slug = slugGenerate($collection['title'], 'jobs');

            $job->short_description = $collection['short_description'] ?? '';
            $job->description = $collection['description'] ?? '';

            if($params['employment_type'] == 'other'){
                $job->employment_type = $collection['other_employment_type'] ?? '';
            }
            else{
                $job->employment_type = $collection['employment_type'] ?? '';
            }

            $job->skill = $collection['skill'] ?? '';
            $job->responsibility = $collection['responsibility'] ?? '';
            $job->benifits = $collection['benifits'] ?? '';
            $job->experience = $collection['experience'] ?? '';
            $job->notice_period = $collection['notice_period'] ?? '';
            $job->scope = $collection['scope'] ?? '';

            $job->address = $collection['address'] ?? '';
            $job->postcode = $collection['postcode'] ?? '';
            $job->city = $collection['city'] ?? '';
            $job->state = $collection['state'] ?? '';
            $job->country = $collection['country'] ?? '';

            $job->source = $collection['source'] ?? '';
            $job->salary = $collection['salary'] ?? '';
            $job->payment = $collection['payment'] ?? '';

            $job->start_date = $collection['start_date'] ?? '';
            $job->end_date = $collection['end_date'] ?? '';

            $job->schedule = $collection['schedule'] ?? '';
            $job->company_name = $collection['company_name'] ?? '';
            $job->contact_number = $collection['contact_number'] ?? '';
            $job->contact_information = $collection['contact_information'] ?? '';
            $job->company_website = $collection['company_website'] ?? '';
            $job->company_desc = $collection['company_desc'] ?? '';

            // dd($job);

            $job->save();

            foreach (explode(',',$params['tag']) as $value) {
                if($value != ''){
                    $blogTag=new JobTag();
                    $blogTag->job_id = $job->id ?? '';
                    $blogTag->title = $value ?? '';
                    $blogTag->slug = slugGenerate($value, 'job_tags');
                    $blogTag->save();
                }
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

        $collection = collect($params);

        $job->category_id = $collection['category_id'] ?? '';
        
        if($job->title != $collection['title']){
            
            $job->title = $collection['title'] ?? '';
            // slug
            $job->slug = slugGenerate($collection['title'], 'jobs');
        }

        $job->short_description = $collection['short_description'] ?? '';
        $job->description = $collection['description'] ?? '';

        if($params['employment_type'] == 'other'){
            $job->employment_type = $collection['other_employment_type'] ?? '';
        }
        else{
            $job->employment_type = $collection['employment_type'] ?? '';
        }

        $job->skill = $collection['skill'] ?? '';
        $job->responsibility = $collection['responsibility'] ?? '';
        $job->benifits = $collection['benifits'] ?? '';
        $job->experience = $collection['experience'] ?? '';
        $job->notice_period = $collection['notice_period'] ?? '';
        $job->scope = $collection['scope'] ?? '';

        $job->address = $collection['address'] ?? '';
        $job->postcode = $collection['postcode'] ?? '';
        $job->city = $collection['city'] ?? '';
        $job->state = $collection['state'] ?? '';
        $job->country = $collection['country'] ?? '';

        $job->source = $collection['source'] ?? '';
        $job->salary = $collection['salary'] ?? '';
        $job->payment = $collection['payment'] ?? '';

        $job->start_date = $collection['start_date'] ?? '';
        $job->end_date = $collection['end_date'] ?? '';

        $job->schedule = $collection['schedule'] ?? '';
        $job->company_name = $collection['company_name'] ?? '';
        $job->contact_number = $collection['contact_number'] ?? '';
        $job->contact_information = $collection['contact_information'] ?? '';
        $job->company_website = $collection['company_website'] ?? '';
        $job->company_desc = $collection['company_desc'] ?? '';
        
        $job->save();

        if($params['tag'] != ''){
            JobTag::where('job_id',$params['id'])->delete();
            foreach (explode(',',$params['tag']) as $value) {
                if($value != ''){
                    $blogTag = new JobTag();
                    $blogTag->job_id = $params['id'] ?? '';
                    $blogTag->title = $value ?? '';
                    $blogTag->slug = slugGenerate($value, 'job_tags');
                    $blogTag->save();
                }
            }
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
    //search job in front
    public function searchJobfrontData($keyword,$employment_type,$address,$salary,$source,$featured_flag,$beginner_friendly){
        $job = Job::when($keyword, function($query) use ($keyword){
                        $query->where('title', 'like' , '%' . $keyword .'%');
                    })
                    ->when($employment_type, function($query) use ($employment_type){
                        $query->where('employment_type','like' , '%' . $employment_type .'%');
                    })
                    ->when($address, function($query) use ($address){
                        $query->where('address', 'like', '%' . $address .'%');
                    })
                    ->when($salary, function($query) use ($salary){
                        $query->where('salary', 'like', '%' . $salary .'%');
                    })
                    ->when($source, function($query) use ($source){
                        $query->where('source', 'like', '%' . $source .'%');
                    })
                    ->when($featured_flag, function($query) use ($featured_flag){
                        $query->where('featured_flag', 'like', '%' . $featured_flag .'%');
                    })
                    ->when($beginner_friendly, function($query) use ($beginner_friendly){
                        $query->where('beginner_friendly', 'like', '%' . $beginner_friendly .'%');
                    })
                    ->paginate(15);

    return $job;
}

    public function applyjob(array $params){
        try {
            $collection = collect($params);

            $item = new ApplyJob();

            $item->job_id = $collection['job_id'];
            $item->user_id = auth()->guard('web')->user()->id;
            $item->name = $collection['name'];
            $item->email = $collection['email'];
            $item->mobile = $collection['mobile'];

            if(!empty($params['cv'])){
                $item->cv = imageUpload($params['cv'], 'resume');
            }
            $item->save();

            return $item;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

}
