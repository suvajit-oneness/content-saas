<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\TemplateTypeContract;
use Illuminate\Http\Request;
use App\Models\TemplateType;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursetypeExport;
use Illuminate\Support\Facades\Session as FacadesSession;
class TemplateTypeController extends BaseController
{
    /**
     * @var TemplateTypeContract
     */
    protected $TemplatetypeRepository;


    /**
     * TemplateTypeController constructor.
     * @param TemplateTypeContract $TemplateTypeRepository
     */
    public function __construct(TemplateTypeContract $TemplateTypeRepository)
    {
        $this->TemplateTypeRepository = $TemplateTypeRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $type = $this->TemplateTypeRepository->getSearchType($request->term);
        } else {
            $type = TemplateType::orderby('title')->paginate(25);
        }
        $this->setPageTitle('Type', 'List of all type');
        return view('admin.template.type.index', compact('type'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('type', 'Create type');
        return view('admin.template.type.create');
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

        $type = $this->TemplateTypeRepository->createType($params);

        if (!$type) {
            return $this->responseRedirectBack('Error occurred while creating type.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.type.index', 'Format has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targettype = $this->TemplateTypeRepository->findTypeById($id);
        $this->setPageTitle('Type', 'Edit Type : '.$targettype->title);
        return view('admin.template.type.edit', compact('targettype'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required',

        ]);
        $params = $request->except('_token');
        $type = $this->TemplateTypeRepository->updateType($params);
        if (!$type) {
            return $this->responseRedirectBack('Error occurred while updating type.', 'error', true, true);
        }
        return $this->responseRedirectBack('Type has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $type = $this->TemplateTypeRepository->deleteType($id);

        if (!$type) {
            return $this->responseRedirectBack('Error occurred while deleting type.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.type.index', 'Type has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $type = $this->TemplateTypeRepository->updateTypeStatus($params);
        if ($type) {
            return response()->json(array('message'=>'Type status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $type = $this->TemplateTypeRepository->detailsType($id);
        $type = $type[0];
        $this->setPageTitle('Type', 'Type Details : '.$type->title);
        return view('admin.template.type.details', compact('type'));
    }
}

