<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Currency;
use App\Models\PlansAndPricing;
use App\Models\PlansPriceCategory;
use App\Models\PlansWithPrice;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Current;

class PlansPriceController extends BaseController
{
    public function index(Request $request)
    {
        if (!empty($request->term))
            $all_plans = PlansAndPricing::where('currency', 'like', '%' . $request->term . '%')->paginate(25);
        else
            $all_plans = PlansAndPricing::paginate(25);

        $this->setPageTitle('Plans and Pricing', 'All details');

        return view('admin.planspricing.index', compact('all_plans'));
    }

    public function create()
    {
        $this->setPageTitle('Plans and Pricing', 'Create New');
        return view('admin.planspricing.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'icon' => 'required|file|mimes:jpg,jpeg,png',
            'name' => 'required|max:199',
            'description' => 'required',
            'button_text' => 'required',
            'benifits' => 'required',
        ]);

        $plan = new PlansAndPricing();

        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->button_text = $request->button_text;
        $plan->benifits = $request->benifits;
        $plan->icon = imageUpload($request->icon,'plans');

        if (!$plan->save()) {
            return $this->responseRedirectBack('Error occurred while creating course.', 'error', true, true);
        }

        // $route = ('admin.plans.management.edit',$plan->id)
        return $this->responseRedirect('admin.plans.management.edit', 'Plans added successfully, Add currency!', 'success', false, false, ['id' => $plan->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $plans = PlansAndPricing::find($id);
        $plans_cat = Currency::orderBy('currency')->get();
        $plans_with_price = PlansWithPrice::where('plan_id',$id)->with('currencyDet','planDet')->get();
        $this->setPageTitle('Plans and Pricing', 'Edit details');
        return view('admin.planspricing.edit',compact('plans','plans_cat','plans_with_price'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
    */

    public function update(Request $request)
    {
        $this->validate($request, [
            'icon' => 'nullable|file|mimes:jpg,jpeg,png',
            'name' => 'required|max:199',
            'description' => 'required',
            'button_text' => 'required',
            'benifits' => 'required',
        ]);

        $plan = PlansAndPricing::find($request->id);

        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->button_text = $request->button_text;
        $plan->benifits = $request->benifits;

        if(!empty($request->icon)){
            $plan->icon = imageUpload($request->icon,'plans');
        }
        
        if(!$plan->save()){
            return $this->responseRedirectBack('Error occured', 'error', true, true);    
        }

        return $this->responseRedirectBack('Plans updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deleted = PlansAndPricing::find($id)->delete();

        if (!$deleted) {
            return $this->responseRedirectBack('Error occurred while deleting', 'error', true, true);
        }
        return $this->responseRedirect('admin.plans.management.index', 'Plan has been deleted successfully', 'success', false, false);
    }

    public function details($id)
    {
        $plans = PlansAndPricing::find($id);
        $plans_with_price = PlansWithPrice::where('plan_id',$id)->get();
        $this->setPageTitle('Plans and Pricing', 'Details');
        return view('admin.planspricing.details',compact('plans','plans_with_price'));
    }

    public function updateStatus(Request $request)
    {
        $updated = PlansAndPricing::where('id',$request->id)->update(['recomended'=>$request->check_status]);

        if($updated){
            return response()->json(array('message' => 'Status has been successfully updated'));
        }else{
            return false;
        }
    }

    public function updatePricing(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'currency_id'=>'required',
            'price'=>'required',
            'price_limit'=>'required',
        ]);

        $plans_with_price = PlansWithPrice::where(['plan_id'=>$request->id,'currency_id'=>$request->currency_id])->get();

        if(count($plans_with_price) > 0){
            $updated = PlansWithPrice::where(['plan_id'=>$request->id,'currency_id'=>$request->currency_id])->update([
                'price'=>$request->price,
                'price_limit'=>$request->price_limit,
            ]);

            if(!$updated){
                return $this->responseRedirectBack('Error occoured', 'error', true, true);
            }else{
                return $this->responseRedirectBack('Currency price updated!', 'success', false, false);
            }
        }else{
            $save = PlansWithPrice::insert([
                'plan_id'=>$request->id,
                'currency_id'=>$request->currency_id,
                'price'=>$request->price,
                'price_limit'=>$request->price_limit,
            ]);

            if($save){
                return $this->responseRedirectBack('Currency added!', 'success', false, false);
            }else{
                return $this->responseRedirectBack('Error occoured', 'error', true, true);
            }
        }
    }

    public function deletePricing($id)
    {
        $plan_id = PlansWithPrice::find($id)->plan_id;
        $delete = PlansWithPrice::find($id)->delete();
        if($delete){
            return $this->responseRedirect('admin.plans.management.edit', 'Price Deleted successfully!', 'success', false, false, ['id' => $plan_id]);
        }
        else{
            return $this->responseRedirectBack('Error occoured', 'error', true, true);
        }
    }
}
