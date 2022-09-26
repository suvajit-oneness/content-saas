<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Portfolio;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\PortfolioContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class PortfolioRepository
 *
 * @package \App\Repositories
 */
class PortfolioRepository extends BaseRepository implements PortfolioContract
{
    use UploadAble;

    /**
     * PortfolioRepository constructor.
     * @param Portfolio $model
     */
    public function __construct(Portfolio $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findPortfolioById(int $id)
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
    public function createPortfolio(array $params)
    {
        try {
            $collection = collect($params);
            $portfolio = new Portfolio();
            $portfolio->user_id = Auth::guard('web')->user()->id ?? '';
            $portfolio->category = $collection['category'] ?? '';
            $portfolio->title = $collection['title'] ?? '';
            $portfolio->tags = $collection['tags'] ?? '';
            $portfolio->short_desc = $collection['short_desc'] ?? '';
            $portfolio->long_desc = $collection['long_desc'] ?? '';
            $portfolio->link = $collection['link'] ?? '';
            if(!empty($params['image'])){
                $profile_image = $collection['image'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("uploads/portfolio/",$imageName);
                $uploadedImage = $imageName;
                $portfolio->image = $uploadedImage;
                }
            $portfolio->save();

            return $portfolio;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePortfolio(array $params)
    {
        $portfolio = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $portfolio->user_id = Auth::guard('web')->user()->id ?? '';
        $portfolio->category = $collection['category'] ?? '';
        $portfolio->title = $collection['title'] ?? '';
        $portfolio->tags = $collection['tags'] ?? '';
        $portfolio->short_desc = $collection['short_desc'] ?? '';
        $portfolio->long_desc = $collection['long_desc'] ?? '';
        $portfolio->link = $collection['link'] ?? '';
        if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/portfolio/",$imageName);
            $uploadedImage = $imageName;
            $portfolio->image = $uploadedImage;
            }
        $portfolio->save();

        return $portfolio;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deletePortfolio($id)
    {
        $portfolio = $this->findOneOrFail($id);
        $portfolio->delete();
        return $portfolio;
    }
}
