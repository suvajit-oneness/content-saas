<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MarketPlaceController extends Controller
{
    public function index(Request $request)
    {
        $writers = User::where('is_deleted',0);
        $master_categories = [];
        $all_writers = User::all();
        foreach ($all_writers as $key => $value) {
            foreach (explode(',',$value->categories) as $key => $data) {
                if(!in_array($data,$master_categories)){
                    array_push($master_categories,$data);
                }
            }
        }

        if(!empty($request->category)){
            $writers = $writers->where('categories','like','%'.$request->category.'%');
        }

        if(!empty($request->name)){
            $writers = $writers->where('first_name','like','%'.$request->name.'%');
        }
        
        $writers = $writers->paginate(9);

        return view('front.marketplace.index',compact('writers','master_categories', 'all_writers'));
    }
}
