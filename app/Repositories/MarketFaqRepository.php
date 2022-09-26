<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\MarketBanner;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\MarketFaqContract;
use App\Models\MarketFaq;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class MarketFaqRepository
 *
 * @package \App\Repositories
 */
class MarketFaqRepository extends BaseRepository implements MarketFaqContract
{
    use UploadAble;

    /**
     * MarketCategoryRepository constructor.
     * @param MarketBanner $model
     */
    public function __construct(MarketFaq $model)
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
    public function listMarketFaq(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findMarketFaqById(int $id)
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
    public function createMarketFaq(array $params)
    {
        try {

            $collection = collect($params);
            $category = new MarketFaq;
            $category->question = $collection['question'];
            $category->answer = $collection['answer'];
            $category->save();

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketFaq(array $params)
    {
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $category->question = $collection['question'];
        $category->answer = $collection['answer'];
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteMarketFaq($id)
    {
        $category = $this->findOneOrFail($id);
        $category->delete();
        return $category;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMarketFaqStatus(array $params){
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $category->status = $collection['check_status'];
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsMarketFaq($id)
    {
        $categories = MarketFaq::where('id',$id)->get();

        return $categories;
    }
    public function getSearchMarketFaq(string $term)
    {
        return MarketFaq::where([['question', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
