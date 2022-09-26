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
            $client->occupation = $collection['occupation'] ?? '';
            $client->phone_number = $collection['phone_number'] ?? '';
            $client->email_id = $collection['email_id'] ?? '';
            $client->link = $collection['link'] ?? '';
            $client->short_desc = $collection['short_desc'] ?? '';
            $client->long_desc = $collection['long_desc'] ?? '';
            if(!empty($params['image'])){
                $profile_image = $collection['image'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("uploads/client/",$imageName);
                $uploadedImage = $imageName;
                $client->image = $uploadedImage;
                }
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
        $client = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $client->user_id = Auth::guard('web')->user()->id ?? '';
        $client->client_name = $collection['client_name'] ?? '';
        $client->occupation = $collection['occupation'] ?? '';
        $client->phone_number = $collection['phone_number'] ?? '';
        $client->email_id = $collection['email_id'] ?? '';
        $client->link = $collection['link'] ?? '';
        $client->short_desc = $collection['short_desc'] ?? '';
        $client->long_desc = $collection['long_desc'] ?? '';
        if(!empty($params['image'])){
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("uploads/client/",$imageName);
            $uploadedImage = $imageName;
            $client->image = $uploadedImage;
            }
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
