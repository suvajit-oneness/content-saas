<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserSocialMedia;
use App\Models\UserLanguage;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProfileContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class TestimonialRepository
 *
 * @package \App\Repositories
 */
class ProfileRepository extends BaseRepository implements ProfileContract
{
    use UploadAble;

    /**
     * TestimonialRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProfile(array $params)
    {
        $user = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $user->first_name = $collection['first_name'] ?? '';
        $user->last_name = $collection['last_name'] ?? '';
        $user->mobile = $collection['mobile'] ?? '';
        $user->country = $collection['country'] ?? '';
        $user->occupation = $collection['occupation'] ?? '';
        $user->short_desc = $collection['short_desc'] ?? '';
        $user->quote_by = $collection['quote_by'] ?? '';
        $user->quote = $collection['quote'] ?? '';
        $user->color_scheme = $collection['color_scheme'] ?? '';
        if(!empty($params['image'])){
            $profile_image = $collection['image'] ?? '';
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/user/",$imageName);
            $uploadedImage = $imageName;
            $user->image = $uploadedImage;
            }
        if(!empty($params['banner_image'])){
            $profile_image = $collection['banner_image'] ?? '';
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/user/",$imageName);
            $uploadedImage = $imageName;
            $user->banner_image = $uploadedImage;
            }
        $user->save();
        foreach ($params['link'] as $value) {
           // foreach ($params['social_media_id'] as $data) {
        $usersociallink=new UserSocialMedia();
        $usersociallink->user_id = Auth::guard('web')->user()->id ?? '';
        $usersociallink->social_media_id = $collection['social_media_id'] ?? '';
        $usersociallink->link =  $value ?? '';
        $usersociallink->save();
        }
      // }
        foreach ($params['language_id'] as $value) {
            $userlanguage=new UserLanguage();
            $userlanguage->user_id = Auth::guard('web')->user()->id ?? '';
            $userlanguage->language_id = $value ?? '';
            $userlanguage->save();
            }
        return $user;
    }

}
