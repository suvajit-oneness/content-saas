<?php

namespace App\Http\Controllers\Front\Portfolio;

use App\Http\Controllers\Controller;
use App\Contracts\ClientContract;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('client', 'Create client');
        return view('front.portfolio.client.create');
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
            'occupation' => 'required|string|min:1',

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

        $this->setPageTitle('client', 'Edit client : ' . $client->occupation);
        return view('front.portfolio.client.edit', compact('client'));
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
            'occupation' => 'required|string|min:1',

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
