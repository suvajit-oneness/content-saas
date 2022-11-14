<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealCategory;
use App\Models\DealPage;
use App\Models\Market;
use App\Models\MarketBanner;
use App\Models\MarketCategory;
use App\Models\MarketFaq;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->guard('web')->check()) {
        $deal_category = DealCategory::all();
        $deal = Deal::where('status',1);
        if(!empty($request->category)){
            $cat_id = DealCategory::where('slug',$request->category)->first()->id;
            $deal = $deal->where('category',$cat_id);
        }

        if(!empty($request->search)){
            $deal = $deal->where('title','like','%'.$request->search.'%');
        }

        $deal = $deal->get();

        $deal_page_content = DealPage::all()[0];

        return view('front.deals.index',compact('deal_category','deal','deal_page_content'));
    } else {
        return redirect()->route('front.user.login');
    }
    }
}
