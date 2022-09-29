<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\SupportContract;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class SupportController extends BaseController
{
    /**
     * @var SupportContract
     */
    protected $MarketRepository;


    /**
     * SupportController constructor.
     * @param SupportContract $SupportRepository
     */
    public function __construct(SupportContract $SupportRepository)
    {
        $this->SupportRepository = $SupportRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $support = $this->SupportRepository->getSearchMarket($request->term);
        } else {
            $support = Support::orderby('title')->get();
        }
        $this->setPageTitle('Support', 'List of all Support');
        return view('admin.support.support.index', compact('support'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Support', 'Create Support');
        return view('admin.support.support.create');
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

        $support = $this->SupportRepository->createSupport($params);

        if (!$support) {
            return $this->responseRedirectBack('Error occurred while creating Support.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.index', 'Support has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetsupport = $this->SupportRepository->findSupportById($id);

        $this->setPageTitle('Support', 'Edit Support  : ' . $targetsupport->title);
        return view('admin.support.support.edit', compact('targetsupport'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'title'      =>  'required|max:191',

        ]);
        $params = $request->except('_token');
        $support = $this->SupportRepository->updateSupport($params);

        if (!$support) {
            return $this->responseRedirectBack('Error occurred while updating Support .', 'error', true, true);
        }
        return $this->responseRedirectBack('Support has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $support = $this->SupportRepository->deleteSupport($id);

        if (!$support) {
            return $this->responseRedirectBack('Error occurred while deleting Support.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.index', 'Support  has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $support = $this->SupportRepository->updateSupportStatus($params);

        if ($support) {
            return response()->json(array('message' => 'Support support status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $support = $this->SupportRepository->detailsSupport($id);
        $support = $support[0];

        $this->setPageTitle('Support  Details', 'Support Details : ' . $support->title);
        return view('admin.support.support.details', compact('support'));
    }
}
