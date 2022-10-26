<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\DealCategory;
use App\Models\Market;
use App\Models\MarketBanner;
use App\Models\MarketCategory;
use App\Models\MarketFaq;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(Request $request)
    {
        $deal_category = DealCategory::all();
        $deal = Deal::all();
        return view('front.deals.index',compact('deal_category','deal'));
    }
}
