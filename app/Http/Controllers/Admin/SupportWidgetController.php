<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\SupportWidgetContract;
use Illuminate\Http\Request;
use App\Models\Support;
use App\Http\Controllers\BaseController;
use App\Models\SupportWidget;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class SupportWidgetController extends BaseController
{
    /**
     * @var SupportWidgetContract
     */
    protected $SupportWidgetRepository;


    /**
     * SupportWidgetController constructor.
     * @param SupportWidgetContract $SupportWidgetRepository
     */
    public function __construct(SupportWidgetContract $SupportWidgetRepository)
    {
        $this->SupportWidgetRepository = $SupportWidgetRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $support = $this->SupportWidgetRepository->getSearchSupportFaqCategory($request->term);
        } else {
            $support = SupportWidget::orderby('title')->get();
        }
        $this->setPageTitle('Support Widget', 'List of all Support widget');
        return view('admin.support.widget.index', compact('support'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Support widget', 'Create Support widget');
        return view('admin.support.widget.create');
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

        $support = $this->SupportWidgetRepository->createSupportWidget($params);

        if (!$support) {
            return $this->responseRedirectBack('Error occurred while creating Support widget.', 'error', true, true);
        }
        return $this->responseRedirect('admin.support.widget.index', 'Support widget has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetsupport = $this->SupportWidgetRepository->findSupportWidgetById($id);

        $this->setPageTitle('Support widget', 'Edit Support  widget: ' . $targetsupport->title);
        return view('admin.support.widget.edit', compact('targetsupport'));
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
        $support = $this->SupportWidgetRepository->updateSupportWidget($params);

        if (!$support) {
            return $this->responseRedirectBack('Error occurred while updating Support widget .', 'error', true, true);
        }
        return $this->responseRedirectBack('Support widget has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $support = $this->SupportWidgetRepository->deleteSupportWidget($id);

        if (!$support) {
            return $this->responseRedirectBack('Error occurred while deleting Support widget.', 'error', true, true);
        }
        return $this->responseRedirect('admin.widget.index', 'Support  widget has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $support = $this->SupportWidgetRepository->updateSupportWidgetStatus($params);

        if ($support) {
            return response()->json(array('message' => 'Support widget status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $support = $this->SupportWidgetRepository->detailsSupportWidget($id);
        $support = $support[0];

        $this->setPageTitle('Support  widget Details', 'Support widget Details : ' . $support->title);
        return view('admin.support.widget.details', compact('support'));
    }
}
