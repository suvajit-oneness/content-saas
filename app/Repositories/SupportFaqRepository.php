<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\MarketBanner;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\SupportFaqContract;
use App\Models\SupportFaq;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class SupportFaqRepository
 *
 * @package \App\Repositories
 */
class SupportFaqRepository extends BaseRepository implements SupportFaqContract
{
    use UploadAble;

    /**
     * SupportFaqRepository constructor.
     * @param SupportFaq $model
     */
    public function __construct(SupportFaq $model)
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
    public function listSupportFaq(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findSupportFaqById(int $id)
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
    public function createSupportFaq(array $params)
    {
        try {

            $collection = collect($params);
            $supportfaq = new SupportFaq();
            $supportfaq->cat_id = $collection['cat_id'];
            $supportfaq->question = $collection['question'];
            $supportfaq->answer = $collection['answer'];
            $supportfaq->save();

            return $supportfaq;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportFaq(array $params)
    {
        $supportfaq = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $supportfaq->cat_id = $collection['cat_id'];
        $supportfaq->question = $collection['question'];
        $supportfaq->answer = $collection['answer'];
        $supportfaq->save();

        return $supportfaq;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteSupportFaq($id)
    {
        $supportfaq = $this->findOneOrFail($id);
        $supportfaq->delete();
        return $supportfaq;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateSupportFaqStatus(array $params){
        $supportfaq = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $supportfaq->status = $collection['check_status'];
        $supportfaq->save();

        return $supportfaq;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsSupportFaq($id)
    {
        $supportfaq = SupportFaq::where('id',$id)->get();

        return $supportfaq;
    }
    public function getSearchSupportFaq(string $term)
    {
        return SupportFaq::where([['question', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
