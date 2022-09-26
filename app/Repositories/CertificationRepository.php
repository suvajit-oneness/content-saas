<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Certificate;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CertificationContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class CertificationRepository
 *
 * @package \App\Repositories
 */
class CertificationRepository extends BaseRepository implements CertificationContract
{
    use UploadAble;

    /**
     * CertificationRepository constructor.
     * @param Certificate $model
     */
    public function __construct(Certificate $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCertificationById(int $id)
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
    public function createCertification(array $params)
    {
        try {
            $collection = collect($params);
            $certificate = new Certificate();
            $certificate->user_id = Auth::guard('web')->user()->id ?? '';
            $certificate->certificate_title = $collection['certificate_title'] ?? '';
            $certificate->certificate_type = $collection['certificate_type'] ?? '';
            $certificate->link = $collection['link'] ?? '';
            $certificate->short_desc = $collection['short_desc'] ?? '';
            $certificate->long_desc = $collection['long_desc'] ?? '';
            if(!empty($params['file'])){
                $profile_image = $collection['file'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("uploads/certificate/",$imageName);
                $uploadedImage = $imageName;
                $certificate->file = $uploadedImage;
                }
            $certificate->save();

            return $certificate;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCertification(array $params)
    {
        $certificate = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $certificate->user_id = Auth::guard('web')->user()->id ?? '';
        $certificate->certificate_title = $collection['certificate_title'] ?? '';
        $certificate->certificate_type = $collection['certificate_type'] ?? '';
        $certificate->link = $collection['link'] ?? '';
        $certificate->short_desc = $collection['short_desc'] ?? '';
        $certificate->long_desc = $collection['long_desc'] ?? '';
        if(!empty($params['file'])){
            $profile_image = $collection['file'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/certificate/",$imageName);
            $uploadedImage = $imageName;
            $certificate->file = $uploadedImage;
            }
        $certificate->save();

        return $certificate;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCertification($id)
    {
        $certificate = $this->findOneOrFail($id);
        $certificate->delete();
        return $certificate;
    }
}
