<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\TemplateContract;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CoursetemplateExport;
use Illuminate\Support\Facades\Session as FacadesSession;
class TemplateController extends BaseController
{
    /**
     * @var TemplateContract
     */
    protected $TemplateRepository;


    /**
     * TemplateController constructor.
     * @param TemplateContract $TemplateRepository
     */
    public function __construct(TemplateContract $TemplateRepository)
    {
        $this->TemplateRepository = $TemplateRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $template = $this->TemplateRepository->getSearchTemplate($request->term);
        } else {
            $template = Template::orderby('title')->paginate(25);
        }
        $this->setPageTitle('Template', 'List of all Template');
        return view('admin.template.template.index', compact('template'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('template', 'Create template');
        $categories = $this->TemplateRepository->listCategory();
        $subcategories = $this->TemplateRepository->listSubCategory();
        $type = $this->TemplateRepository->listType();
        return view('admin.template.template.create',compact('categories','subcategories','type'));
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
            'file'      =>  'required',

        ]);
        $params = $request->except('_token');

        $template = $this->TemplateRepository->createTemplate($params);

        if (!$template) {
            return $this->responseRedirectBack('Error occurred while creating template.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.index', 'Format has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targettemplate = $this->TemplateRepository->findTemplateById($id);
        $categories = $this->TemplateRepository->listCategory();
        $subcategories = $this->TemplateRepository->listSubCategory();
        $type = $this->TemplateRepository->listType();
        $this->setPageTitle('template', 'Edit template : '.$targettemplate->title);
        return view('admin.template.template.edit', compact('targettemplate','categories','subcategories','type'));
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
            'file'      =>  'nullable',
        ]);
        $params = $request->except('_token');
        $template = $this->TemplateRepository->updateTemplate($params);
        if (!$template) {
            return $this->responseRedirectBack('Error occurred while updating Template.', 'error', true, true);
        }
        return $this->responseRedirectBack('Template has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $template = $this->TemplateRepository->deleteTemplate($id);

        if (!$template) {
            return $this->responseRedirectBack('Error occurred while deleting Template.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.index', 'template has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $template = $this->TemplateRepository->updateTemplateStatus($params);
        if ($template) {
            return response()->json(array('message'=>'Template status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $template = $this->TemplateRepository->detailsTemplate($id);
        $template = $template[0];
        $this->setPageTitle('Template', 'Template Details : '.$template->title);
        return view('admin.template.template.details', compact('template'));
    }
}

