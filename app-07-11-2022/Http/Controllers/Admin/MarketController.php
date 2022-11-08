<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketContract;
use Illuminate\Http\Request;
use App\Models\Market;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class MarketController extends BaseController
{
    /**
     * @var MarketContract
     */
    protected $MarketRepository;


    /**
     * MarketmarketController constructor.
     * @param MarketmarketContract $MarketRepository
     */
    public function __construct(MarketContract $MarketRepository)
    {
        $this->MarketRepository = $MarketRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $categories = $this->MarketRepository->getSearchMarket($request->term);
        } else {
            $categories = Market::orderby('title')->get();
        }
        $this->setPageTitle('Market market', 'List of all Market categories');
        return view('admin.market.market.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Market market', 'Create Market market');
        return view('admin.market.market.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required',

        ]);
        $params = $request->except('_token');

        $market = $this->MarketRepository->createMarket($params);

        if (!$market) {
            return $this->responseRedirectBack('Error occurred while creating Market market.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.index', 'Market market has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetmarket = $this->MarketRepository->findMarketById($id);

        $this->setPageTitle('Market market', 'Edit Market market : ' . $targetmarket->title);
        return view('admin.market.market.edit', compact('targetmarket'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $market = $this->MarketRepository->updateMarket($params);

        if (!$market) {
            return $this->responseRedirectBack('Error occurred while updating Market market.', 'error', true, true);
        }
        return $this->responseRedirectBack('Market market has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $market = $this->MarketRepository->deleteMarket($id);

        if (!$market) {
            return $this->responseRedirectBack('Error occurred while deleting Market market.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.index', 'Market market has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $market = $this->MarketRepository->updateMarketStatus($params);

        if ($market) {
            return response()->json(array('message' => 'Market market status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->MarketRepository->detailsMarket($id);
        $market = $categories[0];

        $this->setPageTitle('Market market Details', 'Market market Details : ' . $market->title);
        return view('admin.market.market.details', compact('market'));
    }
}
