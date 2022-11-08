<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\MarketCategoryContract;
use Illuminate\Http\Request;
use App\Models\MarketCategory;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use DB;
use Illuminate\Support\Facades\Session as FacadesSession;
class MarketCategoryController extends BaseController
{
    /**
     * @var MarketCategoryContract
     */
    protected $MarketCategoryRepository;


    /**
     * CategoryManagementController constructor.
     * @param MarketCategoryContract $MarketCategoryRepository
     */
    public function __construct(MarketCategoryContract $MarketCategoryRepository)
    {
        $this->MarketCategoryRepository = $MarketCategoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        if (!empty($request->term)) {
            $categories = $this->MarketCategoryRepository->getSearchCategories($request->term);
        } else {
            $categories = MarketCategory::orderby('title')->paginate(25);
        }
        $this->setPageTitle('Market Category', 'List of all Market categories');
        return view('admin.market.category.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Market Category', 'Create Market category');
        return view('admin.market.category.create');
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

        $category = $this->MarketCategoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating Market category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.category.index', 'Market Category has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCategory = $this->MarketCategoryRepository->findCategoryById($id);

        $this->setPageTitle('Market Category', 'Edit Market Category : ' . $targetCategory->title);
        return view('admin.market.category.edit', compact('targetCategory'));
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
        $category = $this->MarketCategoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating Market category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Market Category has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->MarketCategoryRepository->deleteCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting Market category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.market.category.index', 'Market Category has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $category = $this->MarketCategoryRepository->updateCategoryStatus($params);

        if ($category) {
            return response()->json(array('message' => 'Market Category status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->MarketCategoryRepository->detailsCategory($id);
        $category = $categories[0];

        $this->setPageTitle('Market Category Details', 'Market Category Details : ' . $category->title);
        return view('admin.market.category.details', compact('category'));
    }
}
