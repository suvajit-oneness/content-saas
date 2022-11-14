<?php
namespace App\Repositories;

use App\Models\User;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\UserContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\Models\UserSocialMedia;
use Illuminate\Support\Facades\Auth;
/**
 * Class UserRepository
 *
 * @package \App\Repositories
 */
class UserRepository extends BaseRepository implements UserContract
{
    use UploadAble;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
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
    public function listUsers(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

     /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findUserById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

     /**
     * @param array $params
     * @return User|mixed
     */
    public function createUser(array $params)
    {
        try {

            $collection = collect($params);

            $user = new User;
            $user->name = $collection['name'];
            $user->email = $collection['email'];
            $user->password = bcrypt($collection['password']);
            $user->mobile = $collection['mobile'];
            $user->otp = 1234;
            $user->country = '';
            $user->city = '';
            $user->address = '';
            $user->is_verified = 1;
            $user->status = 1;
            $user->is_deleted = 0;

            $user->save();

            return $user;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function updateUser(array $params){
        $user = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $user->name = $collection['name'];
        $user->mobile = $collection['mobile'];
        $user->country = $collection['country'];
        $user->city = $collection['city'];
        $user->address = $collection['address'];

        $user->save();

        return $user;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getUserDetails(int $id)
    {
        try {
          //  $user =  User::with('loops')->where('id',$id)->get();
          $user =  User::where('id',$id)->get();
            //return $this->findOneOrFail($id);

            return $user;

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }
     /**
     * @return mixed
     */
    public function getSearchUser(string $term)
    {
        return User::where([['name', 'LIKE', '%' . $term . '%']])
        ->orWhere('mobile', 'LIKE', '%' . $term . '%')
        ->orWhere('email', 'LIKE', '%' . $term . '%')
        ->orWhere('address', 'LIKE', '%' . $term . '%')
        ->get();
    }
    /**
     * @param array $params
     * @return mixed
     */
    public function blockUser($id,$is_block){
        $user = $this->findUserById($id);
        $user->is_block = $is_block;
        $user->save();

        return $user;
    }
    /**
     * @param array $params
     * @return mixed
     */
    public function verify($id,$is_verified){
        $user = $this->findUserById($id);
        $user->is_verified = $is_verified;
        $user->save();

        return $user;
    }

     /**
     * @param array $params
     * @return mixed
     */
    public function updateUserStatus(array $params){
        $user = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        if($params['change'] == 'status')
            $user->status = $collection['check_status'];
        else
            $user->is_recomended = $collection['check_status'];
        $user->save();

        return $user;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteUser($id)
    {
        $user = $this->findOneOrFail($id);
        $user->delete();
        return $user;
    }

    public function userprofile(array $params){
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
        if(!empty($params['image'])){
            $profile_image = $collection['image'] ?? '';
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/user/",$imageName);
            $uploadedImage = $imageName;
            $user->image = $uploadedImage;
            }
        if(!empty($params['intro_video'])){
            $profile_image = $collection['intro_video'] ?? '';
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/uservideo/",$imageName);
            $uploadedImage = $imageName;
            $user->intro_video = $uploadedImage;
            }
        $user->save();
        foreach ($params['social_media_id'] as $value) {
        $usersociallink=new UserSocialMedia();
        $usersociallink->user_id = Auth::guard('web')->user()->id ?? '';
        $usersociallink->social_media_id = $value ?? '';
        $usersociallink->link =  $collection['link'] ?? '';
        $usersociallink->save();
        }
        return $user;
    }
}
