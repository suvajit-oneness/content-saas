<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class FrontController extends Controller
{

    public function privacy(Request $request)
    {
        $data=Setting::where('key','=','privacy')->get();
        return view('front.settings.privacy',compact('data'));
    }
    public function terms(Request $request)
    {

        $data=Setting::where('key','=','terms')->get();
        return view('front.settings.terms',compact('data'));
    }
}
