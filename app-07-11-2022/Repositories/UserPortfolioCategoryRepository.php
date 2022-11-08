<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\UserCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\UserPortfolioCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Auth;
/**
 * Class UserPortfolioCategoryRepository
 *
 * @package \App\Repositories
 */
class UserPortfolioCategoryRepository extends BaseRepository implements UserPortfolioCategoryContract
{
    use UploadAble;

    /**
     * UserPortfolioCategoryRepository constructor.
     * @param UserCategory $model
     */
    public function __construct(UserCategory $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findUserPortfolioCategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Blogcategory|mixed
     */
    public function createUserPortfolioCategory(array $params)
    {
        try {
            $collection = collect($params);
            $cat = new UserCategory();
            $cat->user_id = Auth::guard('web')->user()->id ?? '';
            $cat->name = $collection['name'] ?? '';
            $cat->position = $collection['position'] ?? '';
            if(!empty($params['icon'])){
                $profile_image = $collection['icon'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("uploads/user/categories/",$imageName);
                $uploadedImage = $imageName;
                $cat->icon = $uploadedImage;
                }
            $cat->save();

            return $cat;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUserPortfolioCategory(array $params)
    {
        $cat = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $cat->user_id = Auth::guard('web')->user()->id ?? '';
            $cat->name = $collection['name'] ?? '';
            $cat->position = $collection['position'] ?? '';
            if(!empty($params['icon'])){
                $profile_image = $collection['icon'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("uploads/user/categories/",$imageName);
                $uploadedImage = $imageName;
                $cat->icon = $uploadedImage;
                }
        $cat->save();

        return $cat;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteUserPortfolioCategory($id)
    {
        $cat = $this->findOneOrFail($id);
        $cat->delete();
        return $cat;
    }
}
