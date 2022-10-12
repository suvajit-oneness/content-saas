<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Testimonial;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\TestimonialContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class TestimonialRepository
 *
 * @package \App\Repositories
 */
class TestimonialRepository extends BaseRepository implements TestimonialContract
{
    use UploadAble;

    /**
     * TestimonialRepository constructor.
     * @param Testimonial $model
     */
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTestimonialById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Education|mixed
     */
    public function createTestimonial(array $params)
    {
        try {
            $collection = collect($params);
            $testimonial = new Testimonial();
            $testimonial->user_id = Auth::guard('web')->user()->id ?? '';
            $testimonial->client_name = $collection['client_name'] ?? '';
            $testimonial->occupation = $collection['occupation'] ?? '';
            $testimonial->phone_number = $collection['phone_number'] ?? '';
            $testimonial->email_id = $collection['email_id'] ?? '';
            $testimonial->link = $collection['link'] ?? '';
            $testimonial->short_testimonial = $collection['short_testimonial'] ?? '';
            $testimonial->long_testimonial = $collection['long_testimonial'] ?? '';

            if(!empty($params['image'])){
                // image, folder name only
                $testimonial->image = imageUpload($params['image'], 'testimonial');
            }

            // if(!empty($params['image'])){
            //     $profile_image = $collection['image'];
            //     $imageName = time().".".$profile_image->getClientOriginalName();
            //     $profile_image->move("uploads/testimonial/",$imageName);
            //     $uploadedImage = $imageName;
            //     $testimonial->image = $uploadedImage;
            //     }

            $testimonial->save();

            return $testimonial;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTestimonial(array $params)
    {
        // dd($params);

        $testimonial = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $testimonial->user_id = Auth::guard('web')->user()->id ?? '';
            $testimonial->client_name = $collection['client_name'] ?? '';
            $testimonial->occupation = $collection['occupation'] ?? '';
            $testimonial->phone_number = $collection['phone_number'] ?? '';
            $testimonial->email_id = $collection['email_id'] ?? '';
            $testimonial->link = $collection['link'] ?? '';
            $testimonial->short_testimonial = $collection['short_testimonial'] ?? '';
            $testimonial->long_testimonial = $collection['long_testimonial'] ?? '';

            if(!empty($params['image'])){
                // image, folder name only
                $testimonial->image = imageUpload($params['image'], 'testimonial');
            }

            // if(!empty($params['image'])){
            //     $profile_image = $collection['image'];
            //     $imageName = time().".".$profile_image->getClientOriginalName();
            //     $profile_image->move("uploads/testimonial/",$imageName);
            //     $uploadedImage = $imageName;
            //     $testimonial->image = $uploadedImage;
            //     }
        $testimonial->save();

        // dd($testimonial);

        return $testimonial;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteTestimonial($id)
    {
        $testimonial = $this->findOneOrFail($id);
        $testimonial->delete();
        return $testimonial;
    }
}
