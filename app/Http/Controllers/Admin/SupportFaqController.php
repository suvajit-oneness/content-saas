<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\SupportFaqContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\SupportFaq;
use App\Models\SupportFaqCategory;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class SupportFaqController extends BaseController
{
    /**
     * @var SupportFaqContract
     */
    protected $SupportFaqRepository;


    /**
     * SupportFaqController constructor.
     * @param SupportFaqContract $SupportFaqRepository
     */
    public function __construct(SupportFaqContract $SupportFaqRepository)
    {
        $this->SupportFaqRepository = $SupportFaqRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $faq = $this->SupportFaqRepository->getSearchSupportFaq($request->term);
        } else {
            $faq = SupportFaq::paginate(25);
        }
        $this->setPageTitle('support faq', 'List of all support faq');
        return view('admin.support.faq.index', compact('faq'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('support faq', 'Create support faq');
        $categories = SupportFaqCategory::paginate(25);
        return view('admin.support.faq.create',compact('categories'));
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

        $faq = $this->SupportFaqRepository->createSupportFaq($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while creating support faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.faq.index', 'support faq has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetfaq = $this->SupportFaqRepository->findSupportFaqById($id);
        $categories = SupportFaqCategory::paginate(25);
        $this->setPageTitle('support faq', 'Edit support faq : ' . $targetfaq->title);
        return view('admin.support.faq.edit', compact('targetfaq','categories'));
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
        $faq = $this->SupportFaqRepository->updateSupportFaq($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while updating support faq.', 'error', true, true);
        }
        return $this->responseRedirectBack('support faq has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = $this->SupportFaqRepository->deleteSupportFaq($id);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while deleting support faq.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.faq.index', 'support faq has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $faq = $this->SupportFaqRepository->updateSupportFaqStatus($params);

        if ($faq) {
            return response()->json(array('message' => 'support faq status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $faq = $this->SupportFaqRepository->detailsSupportFaq($id);
        $faq = $faq[0];

        $this->setPageTitle('support faq Details', 'support faq Details : ' . $faq->title);
        return view('admin.support.faq.details', compact('faq'));
    }
}
