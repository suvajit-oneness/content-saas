<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\TemplateCategoryContract;
use Illuminate\Http\Request;
use App\Models\TemplateCategory;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourseCategoryExport;
use Illuminate\Support\Facades\Session as FacadesSession;
class TemplateCategoryController extends BaseController
{
    /**
     * @var TemplateCategoryContract
     */
    protected $TemplateCategoryRepository;


    /**
     * CourseCategoryController constructor.
     * @param TemplateCategoryContract $TemplateCategoryRepository
     */
    public function __construct(TemplateCategoryContract $TemplateCategoryRepository)
    {
        $this->TemplateCategoryRepository = $TemplateCategoryRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $categories = $this->TemplateCategoryRepository->getSearchCategories($request->term);
        } else {
            $categories = TemplateCategory::orderby('title')->paginate(25);
        }
        $this->setPageTitle('Category', 'List of all categories');
        return view('admin.template.category.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Category', 'Create category');
        return view('admin.template.category.create');
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

        ]);
        $params = $request->except('_token');

        $category = $this->TemplateCategoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.category.index', 'Category has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCategory = $this->TemplateCategoryRepository->findCategoryById($id);
        $this->setPageTitle('Category', 'Edit Category : '.$targetCategory->title);
        return view('admin.template.category.edit', compact('targetCategory'));
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
        $category = $this->TemplateCategoryRepository->updateCategory($params);
        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->TemplateCategoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.template.category.index', 'Category has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $category = $this->TemplateCategoryRepository->updateCatStatus($params);
        if ($category) {
            return response()->json(array('message'=>'Category status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->TemplateCategoryRepository->detailsCategory($id);
        $category = $categories[0];
        $this->setPageTitle('Category', 'Category Details : '.$category->title);
        return view('admin.template.category.details', compact('category'));
    }
}

