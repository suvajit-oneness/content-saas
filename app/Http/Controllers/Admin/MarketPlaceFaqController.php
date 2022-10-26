<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketFaqContract;
use Illuminate\Http\Request;
use App\Models\MarketFaq;
use App\Http\Controllers\BaseController;
use App\Models\MarketPlaceFaq;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class MarketPlaceFaqController extends BaseController

{
    /**
     * @var MarketfaqContract
     */
    /**
     * MarketfaqController constructor.
     * @param MarketfaqContract $MarketFaqRepository
     */

    // public function __construct(MarketFaqContract $MarketFaqRepository)
    // {
    //     $this->MarketFaqRepository = $MarketFaqRepository;
    // }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $faqs = MarketPlaceFaq::all();
        } else {
            $faqs = MarketPlaceFaq::paginate(15);
        }
        $this->setPageTitle('Market faq', 'List of all Marketplace Faqs');
        return view('admin.marketplace.faq.index', compact('faqs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Marketplace faq', 'Create Marketplace faq');
        return view('admin.marketplace.faq.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'header' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);
        $params = $request->except('_token');
        
        $marketplacefaq = new MarketPlaceFaq();

        $marketplacefaq->header = $params['header'];
        $marketplacefaq->question = $params['question'];
        $marketplacefaq->answer = $params['answer'];


        if (!$marketplacefaq->save()) {
            return $this->responseRedirectBack('Error occurred while creating Market faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.marketplace.faq.index', 'Marketplace faqs has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetfaq = MarketPlaceFaq::find($id);

        $this->setPageTitle('Market faq', 'Edit Market faq : ' . $targetfaq->header);
        return view('admin.marketplace.faq.edit', compact('targetfaq'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'header' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);
        $params = $request->except('_token');
        $marketplacefaq = MarketPlaceFaq::find($request->id);

        $marketplacefaq->header = $params['header'];
        $marketplacefaq->question = $params['question'];
        $marketplacefaq->answer = $params['answer'];


        if (!$marketplacefaq->save()) {
            return $this->responseRedirectBack('Error occurred while updating Market faq.', 'error', true, true);
        }
        return $this->responseRedirectBack('Marketplace faq has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = MarketPlaceFaq::find($id)->delete();

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
        return view('admin.marketplace..faq.details', compact('faq'));
    }
}
