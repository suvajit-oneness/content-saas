<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\ClientContract;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\BaseController;
use App\Models\Currency;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class ClientController extends BaseController
{
     /**
     * @var ClientContract
     */
    protected $ClientRepository;


    /**
     * ClientController constructor.
     * @param ClientContract $clientRepository
     */
    public function __construct(ClientContract $ClientRepository)
    {
        $this->ClientRepository = $ClientRepository;
    }
    public function index(Request $request)
    {
        $this->setPageTitle('Client', ' Client');
        $data = (object)[];
        $user_id = auth()->guard('web')->user()->id;
        $data->clients = Client::where('user_id', $user_id)->get();
       // $category=ArticleCategory::orderby('title')->get();
        return view('front.portfolio.client.index',compact('data'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('client', 'Create client');
        $currencies = Currency::all();
        $charges_limit = DB::table('charges_limit')->get();
        return view('front.portfolio.client.create',compact('currencies','charges_limit'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required',
            'occupation' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:50'
        ]);
        $params = $request->except('_token');

        $client = $this->ClientRepository->createClient($params);

        if (!$client) {
            return $this->responseRedirectBack('Error occurred while creating client.', 'error', true, true);
        }
        return redirect()->back()->with('success', 'client has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $client = $this->ClientRepository->findClientById($id);
        $currencies = Currency::all();
        $charges_limit = DB::table('charges_limit')->get();

        $this->setPageTitle('client', 'Edit client : ' . $client->occupation);
        return view('front.portfolio.client.edit', compact('client','currencies','charges_limit'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required',
            'occupation' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:50'
        ]);
        $params = $request->except('_token');
        $client = $this->ClientRepository->updateClient($params);

        if (!$client) {
            return $this->responseRedirectBack('Error occurred while updating client.', 'error', true, true);
        }
        // return $this->responseRedirectBack('client has been updated successfully', 'success', false, false);
        return redirect()->back()->with('success', 'Client has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $client = $this->ClientRepository->deleteClient($id);

        if (!$client) {
            return $this->responseRedirectBack('Error occurred while deleting client.', 'error', true, true);
        }
        return redirect()->back()->with('success','client field has been deleted successfully', 'success', false, false);
    }
}
