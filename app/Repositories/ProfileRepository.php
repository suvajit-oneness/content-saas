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
        $user->worked_for = $collection['worked_for'] ?? '';
        $user->categories = $collection['categories'] ?? '';

        if(!empty($params['image'])) {
            // image, folder name only
            $user->image = imageUpload($params['image'], 'user');

            // $profile_image = $collection['image'] ?? '';
            // $imageName = mt_rand().'-'.time().".".$profile_image->getClientOriginalExtension();
            // $profile_image->move("uploads/user/",$imageName);
            // $uploadedImage = $imageName;
            // $user->image = $uploadedImage;
        }

        if(!empty($params['banner_image'])){
            // image, folder name only
            $user->banner_image = imageUpload($params['banner_image'], 'user-banner');

            // $profile_image = $collection['banner_image'] ?? '';
            // $imageName = mt_rand().'-'.time().".".$profile_image->getClientOriginalExtension();
            // $profile_image->move("uploads/user/",$imageName);
            // $uploadedImage = $imageName;
            // $user->banner_image = $uploadedImage;
        }

        $user->save();

        // if social media link found
        if ( isset($params['link']) && count($params['link']) > 0) {
            $chk = UserSocialMedia::where('user_id', Auth::guard('web')->user()->id)->delete();

            foreach($params['social_media_id'] as $key => $media) {
                if (!empty($params['link'][$key])) {
                    $userlanguage = new UserSocialMedia();
                    $userlanguage->user_id = Auth::guard('web')->user()->id;
                    $userlanguage->social_media_id = $media;
                    $userlanguage->link = $params['link'][$key];
                    $userlanguage->save();
                }
            }
        }

        // if languages found
        if ( isset($params['language_id']) && count($params['language_id']) > 0) {
            $chk = UserLanguage::where('user_id', Auth::guard('web')->user()->id)->delete();

            foreach ($params['language_id'] as $value) {
                $userlanguage = new UserLanguage();
                $userlanguage->user_id = Auth::guard('web')->user()->id;
                $userlanguage->language_id = $value;
                $userlanguage->save();
            }
        }

        // if no languages selected
        if ( empty($params['language_id'])) {
            $chk = UserLanguage::where('user_id', Auth::guard('web')->user()->id)->delete();
        }

        return $user;
    }

}
