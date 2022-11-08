<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\TemplateSubCategoryContract;
use Illuminate\Http\Request;
use App\Models\ArticleSubCategory;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticleSubcategoryExport;
use App\Models\TemplateSubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class TemplateSubCategoryController extends BaseController
{
    /**
     * @var TemplateSubCategoryContract
     */
    protected $TemplateSubCategoryRepository;


    /**
     * TemplateSubCategoryController constructor.
     * @param TemplateSubCategoryContract $TemplateSubCategoryRepository
     */
    public function __construct(TemplateSubCategoryContract $TemplateSubCategoryRepository)
    {
        $this->TemplateSubCategoryRepository = $TemplateSubCategoryRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {

        if (!empty($request->term)) {
             $subcategories = $this->TemplateSubCategoryRepository->getSearchSubcategory($request->term);
         } else {
           $subcategories = TemplateSubCategory::orderby('title')->paginate(35);
         }
        $categories = $this->TemplateSubCategoryRepository->listCategory();
        $this->setPageTitle('Template Sub Category', 'List of all template sub categories');
        return view('admin.template.subcategory.index', compact('subcategories','categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Template Sub Category', 'Create Template Subcategory');
        $categories = $this->TemplateSubCategoryRepository->listCategory();

        return view('admin.template.subcategory.create',compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'cat_id'      =>  'required',
        ]);
        $params = $request->except('_token');

        $targetsubCategory = $this->TemplateSubCategoryRepository->createSubCategory($params);

        if (!$targetsubCategory) {
            return $this->responseRedirectBack('Error occurred while creating  sub category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.subcategory.index', ' SubCategory has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetsubCategory = $this->TemplateSubCategoryRepository->findSubCategoryById($id);
        $categories = $this->TemplateSubCategoryRepository->listCategory();
        $this->setPageTitle('Template Sub Category', 'Edit Sub Category : '.$targetsubCategory->title);
        return view('admin.template.subcategory.edit', compact('targetsubCategory','categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
       // dd($request->all());
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'cat_id'      =>  'required',
        ]);
        $params = $request->except('_token');
        $subcategory = $this->TemplateSubCategoryRepository->updateSubCategory($params);

        if (!$subcategory) {
            return $this->responseRedirectBack('Error occurred while updating  sub category.', 'error', true, true);
        }
        return $this->responseRedirectBack('SubCategory has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $subcategory = $this->TemplateSubCategoryRepository->deleteSubCategory($id);

        if (!$subcategory) {
            return $this->responseRedirectBack('Error occurred while deleting  sub category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.subcategory.index', ' sub Category has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $subcategory = $this->TemplateSubCategoryRepository->updatesubCategoryStatus($params);

        if ($subcategory) {
            return response()->json(array('message'=>'SubCategory status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->TemplateSubCategoryRepository->detailsSubCategory($id);
        $subcategory = $categories[0];
        $this->setPageTitle('SubCategory', 'Sub Category Details : '.$subcategory->title);
        return view('admin.template.subcategory.details', compact('subcategory'));
    }
}


