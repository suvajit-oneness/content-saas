<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\MarketBanner;
use App\Models\MarketCategory;
use App\Models\MarketFaq;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $cat=MarketCategory::where('status',1)->get();
        $market=Market::all();
        $faq=MarketFaq::all();
        $banner=MarketBanner::all();
        return view('front.market.index',compact('cat','market','faq','banner'));
    }
}
