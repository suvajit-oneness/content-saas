<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $orders = new Order();

        if($request->from)
            $orders = $orders->where('created_at', '>=', $request->from);
        
        if($request->to)
            $orders = $orders->where('created_at', '<=', $request->to);
        
        if($request->keyword)
            $orders = $orders->where('order_no', 'like', '%'.$request->keyword.'%');

        $orders = $orders->with('orderProducts', 'users', 'course')->paginate(15);

        $this->setPageTitle('Orders', 'List of all orders');

        return view('admin.order.index', compact('orders'));
    }

    public function details($id)
    {
        $order = Order::with('orderProducts.courseName')->find($id);

        $this->setPageTitle('Order details', 'Order details - ' . $order->order_no);

        return view('admin.order.details', compact('order'));
    }

    public function updateStatus(Request $request)
    {

        // $params = $request->except('_token');

        $order = Order::Where('id',$request->id)->update(['status'=>$request->check_status]);

        if ($order) {
            return response()->json(array('message' => 'Order status has been successfully updated'));
        }
    }
}
