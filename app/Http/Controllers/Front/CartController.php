<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Contracts\CartContract;
use Illuminate\Http\Request;
use App\Models\CourseModule;
use App\Http\Controllers\BaseController;
use DB;
class CartController extends BaseController
{
    
    /**
     * @var CartContract
     */
    protected $CartRepository;


    /**
     * CartController constructor.
     * @param CartContract $CartRepository
     */
    public function __construct(CartContract $CartRepository)
    {
        $this->CartRepository = $CartRepository;
    }
    public function index(Request $request)
    {
        $data = $this->CartRepository->viewByIp();

        if ($data) {
            return view('front.cart.index', compact('data'));
        } else {
            return view('front.404');
        }
    }
     public function add(Request $request) 
    {
        // dd($request->all());

        $request->validate([
            "course_id" => "required",
            "course_name" => "required|string|max:255",
            "course_image" => "required|string|max:255",
            "course_slug" => "required|string|max:255",
            "price" => "required|string",
            
        ]);
        $params = $request->except('_token');

        $cartStore = $this->CartRepository->addToCart($params);
        $type = $request->purchase_type ?? 'course';

        if ($cartStore) {
             return redirect()->back()->with('success', $type . ' added to cart successfully!');
            
        } else {
        	return redirect()->back()->with('failure', 'Something happened');
          
        }
    }

    public function delete($id)
    {
        $data = $this->CartRepository->delete($id);

        if ($data) {
            return redirect()->route('front.cart')->with('success', 'Course removed from cart');
        } else {
            return redirect()->route('front.cart')->with('failure', 'Something happened');
        }
    }
}
