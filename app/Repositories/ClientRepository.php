<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ClientContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
/**
 * Class ClientRepository
 *
 * @package \App\Repositories
 */
class ClientRepository extends BaseRepository implements ClientContract
{
    use UploadAble;

    /**
     * ClientRepository constructor.
     * @param Client $model
     */
    public function __construct(Client $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findClientById(int $id)
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
    public function createClient(array $params)
    {
        try {
            $collection = collect($params);
            $client = new Client();
            $client->user_id = Auth::guard('web')->user()->id ?? '';
            $client->client_name = $collection['client_name'] ?? '';
            if($params['image']){
                $client->image = imageUpload($collection['image'],'clients');
            }
            $client->phone_number = $collection['phone_number'] ?? '';
            $client->email_id = $collection['email_id'] ?? '';
            $client->link = $collection['link'] ?? '';
            $client->company_name = $collection['company_name'] ?? '';
            $client->address = $collection['address'] ?? '';
            $client->city = $collection['city'] ?? '';
            $client->state = $collection['state'] ?? '';
            $client->zip = $collection['zip'] ?? '';
            $client->country = $collection['country'] ?? '';
            $client->vat_no = $collection['vat_no'] ?? '';
            $client->client_group = $collection['client_group'] ?? '';
            $client->currency = $collection['currency'] ?? '';
            $client->rate = $collection['rate'] ?? '';
            $client->commercials = $collection['commercials'] ?? '';
            $client->save();

            return $client;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateClient(array $params)
    {
        $collection = collect($params)->except('_token');

        $client = $this->findOneOrFail($params['id']);
        $client->client_name = $collection['client_name'] ?? '';
        if($params['image']){
            $client->image = imageUpload($collection['image'],'clients');
        }
        $client->phone_number = $collection['phone_number'] ?? '';
        $client->email_id = $collection['email_id'] ?? '';
        $client->link = $collection['link'] ?? '';
        $client->company_name = $collection['company_name'] ?? '';
        $client->address = $collection['address'] ?? '';
        $client->city = $collection['city'] ?? '';
        $client->state = $collection['state'] ?? '';
        $client->zip = $collection['zip'] ?? '';
        $client->country = $collection['country'] ?? '';
        $client->vat_no = $collection['vat_no'] ?? '';
        $client->client_group = $collection['client_group'] ?? '';
        $client->currency = $collection['currency'] ?? '';
        $client->rate = $collection['rate'] ?? '';
        $client->commercials = $collection['commercials'] ?? '';
        $client->save();

        return $client;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteClient($id)
    {
        $client = $this->findOneOrFail($id);
        $client->delete();
        return $client;
    }
}
