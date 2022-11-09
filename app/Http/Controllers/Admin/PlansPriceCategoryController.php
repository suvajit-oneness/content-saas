<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\PlansPriceCategory;
use Illuminate\Http\Request;

class PlansPriceCategoryController extends BaseController
{
    public function index(Request $request)
    {
        if (!empty($request->term))
            $plans_price_category = PlansPriceCategory::where('currency', 'like', '%' . $request->term . '%')->paginate(25);
        else
            $plans_price_category = PlansPriceCategory::paginate(25);

        $this->setPageTitle('Plans and Pricing Currencies', 'All details');

        return view('admin.planspricingcategory.index', compact('plans_price_category'));
    }

    public function create()
    {
        $this->setPageTitle('Plans and Pricing Currencies', 'Create New');
        return view('admin.planspricingcategory.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'currency' => 'required|max:191',
            'currency_symbol' => 'required',
        ]);

        $plans_price_category = new PlansPriceCategory();
        
        $plans_price_category->currency = $request->currency;
        $plans_price_category->currency_symbol = $request->currency_symbol;

        if (!$plans_price_category->save()) {
            return $this->responseRedirectBack('Error occurred while creating course.', 'error', true, true);
        }

        return $this->responseRedirect('admin.plans.category.index', 'Category added successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $plans_price_category = PlansPriceCategory::find($id);
        $this->setPageTitle('Plans and Pricing Currencies', 'Edit details');
        return view('admin.planspricingcategory.edit',compact('plans_price_category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'currency' => 'required|max:191',
            'currency_symbol' => 'required',
        ]);

        $plans_price_category = PlansPriceCategory::find($request->id);

        $plans_price_category->currency = $request->currency;
        $plans_price_category->currency_symbol = $request->currency_symbol;
        
        if(!$plans_price_category->save()){
            return $this->responseRedirectBack('Error occured', 'error', true, true);    
        }

        return $this->responseRedirectBack('Category updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = PlansPriceCategory::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.plans.category.index', 'Category has been deleted successfully', 'success', false, false);
    }
}
