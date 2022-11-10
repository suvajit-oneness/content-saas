<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\PlansPriceCategory;
use App\Models\PlansWithPrice;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(Request $request)
    {

        $currencies = Currency::orderBy('currency','DESC')->get();
        $plans_with_price = PlansWithPrice::where('currency_id',$currencies[0]->id)->orderBy('price')->with('planDet','currencyDet')->get();
        
        if(!empty($request->currency)){
            $plans_with_price = PlansWithPrice::where('currency_id',$request->currency)->orderBy('price')->with('planDet','currencyDet')->get();
        }

        return view('front.price.index',compact('plans_with_price','currencies'));
    }
}
