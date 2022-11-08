<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketFaqContract;
use Illuminate\Http\Request;
use App\Models\MarketFaq;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class MarketFaqController extends BaseController
{
    /**
     * @var MarketfaqContract
     */
    protected $MarketFaqRepository;


    /**
     * MarketfaqController constructor.
     * @param MarketfaqContract $MarketFaqRepository
     */
    public function __construct(MarketFaqContract $MarketFaqRepository)
    {
        $this->MarketFaqRepository = $MarketFaqRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $categories = $this->MarketFaqRepository->getSearchMarketfaq($request->term);
        } else {
            $categories = MarketFaq::paginate(25);
        }
        $this->setPageTitle('Market faq', 'List of all Market categories');
        return view('admin.market.faq.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Market faq', 'Create Market faq');
        return view('admin.market.faq.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question'      =>  'required',

        ]);
        $params = $request->except('_token');

        $faq = $this->MarketFaqRepository->createMarketfaq($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while creating Market faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.faq.index', 'Market faq has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetfaq = $this->MarketFaqRepository->findMarketfaqById($id);

        $this->setPageTitle('Market faq', 'Edit Market faq : ' . $targetfaq->title);
        return view('admin.market.faq.edit', compact('targetfaq'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'question'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $faq = $this->MarketFaqRepository->updateMarketfaq($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while updating Market faq.', 'error', true, true);
        }
        return $this->responseRedirectBack('Market faq has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = $this->MarketFaqRepository->deleteMarketfaq($id);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while deleting Market faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.faq.index', 'Market faq has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $faq = $this->MarketFaqRepository->updateMarketfaqStatus($params);

        if ($faq) {
            return response()->json(array('message' => 'Market faq status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->MarketFaqRepository->detailsMarketfaq($id);
        $faq = $categories[0];

        $this->setPageTitle('Market faq Details', 'Market faq Details : ' . $faq->title);
        return view('admin.market.faq.details', compact('faq'));
    }
}
