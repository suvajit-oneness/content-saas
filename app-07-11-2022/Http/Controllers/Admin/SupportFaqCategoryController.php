<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\SupportFaqCategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\SupportFaqCategory;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class SupportFaqCategoryController extends BaseController
{
     /**
     * @var SupportFaqCategoryContract
     */
    protected $SupportFaqCategoryRepository;


    /**
     * SupportFaqCategoryController constructor.
     * @param SupportFaqContract $SupportFaqCategoryRepository
     */
    public function __construct(SupportFaqCategoryContract $SupportFaqCategoryRepository)
    {
        $this->SupportFaqCategoryRepository = $SupportFaqCategoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $faq = $this->SupportFaqCategoryRepository->getSearchSupportFaqCategory($request->term);
        } else {
            $faq = SupportFaqCategory::paginate(25);
        }
        $this->setPageTitle('support faq category', 'List of all support faq category');
        return view('admin.support.faqcategory.index', compact('faq'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('support faq', 'Create support faq');
        return view('admin.support.faqcategory.create');
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

        $faq = $this->SupportFaqCategoryRepository->createSupportFaqCategory($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while creating support faq category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.faq.category.index', 'support faq category has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetfaq = $this->SupportFaqCategoryRepository->findSupportFaqCategoryById($id);

        $this->setPageTitle('support faq', 'Edit support faq category: ' . $targetfaq->title);
        return view('admin.support.faqcategory.edit', compact('targetfaq'));
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
        $faq = $this->SupportFaqCategoryRepository->updateSupportFaqCategory($params);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while updating support faq category .', 'error', true, true);
        }
        return $this->responseRedirectBack('support faq category has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $faq = $this->SupportFaqCategoryRepository->deleteSupportFaqCategory($id);

        if (!$faq) {
            return $this->responseRedirectBack('Error occurred while deleting support faq category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.faq.category.index', 'support faq category has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $faq = $this->SupportFaqCategoryRepository->updateSupportFaqCategoryStatus($params);

        if ($faq) {
            return response()->json(array('message' => 'support faq category status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $faq = $this->SupportFaqCategoryRepository->detailsSupportFaqCategory($id);
        $faq = $faq[0];

        $this->setPageTitle('support faq category Details', 'support faq category Details : ' . $faq->title);
        return view('admin.support.faqcategory.details', compact('faq'));
    }
}
