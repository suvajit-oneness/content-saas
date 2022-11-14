<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Order;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CheckoutContract;
use App\Models\OrderProduct;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use DB;
use Auth;
/**
 * Class CheckoutRepository
 *
 * @package \App\Repositories
 */
class CheckoutRepository extends BaseRepository implements CheckoutContract
{
    use UploadAble;

    /**
     * BlogCategoryRepository constructor.
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }
    public function viewCart()
    {
        $data = Cart::where('ip', $this->ip)->get();
        return $data;
    }
    public function create(array $data)
    {
        //dd($data);
        $collectedData = collect($data);

        try {
            // 1 order
            $order_no = "CSP".mt_rand();


            $newEntry = new Order();
            $newEntry->order_no = $order_no;
            $newEntry->user_id = Auth::guard('web')->user()->id ?? 0;
            $newEntry->ip = $this->ip;
            $newEntry->email = $collectedData['email'];
            $newEntry->mobile = $collectedData['mobile'];
            $newEntry->fname = $collectedData['fname'];
            $newEntry->lname = $collectedData['lname'];
           
            $cartData = Cart::where('ip', $this->ip)->get();
            $subtotal = 0;
            foreach($cartData as $cartValue) {

                $newOrderProduct = new OrderProduct();
                $newOrderProduct->order_id = $order_no;
                $newOrderProduct->course_id = $cartValue->course_id;
                $newOrderProduct->price = $cartValue->price;
                $newOrderProduct->type = ($cartValue->purchase_type == 'subscription') ? '4' : ($cartValue->purchase_type == 'deal' ? '5' : '1');
                $newOrderProduct->save();

                $subtotal += ($cartValue->price * $cartValue->qty);
            }

            $newEntry->amount = $subtotal;
            $newEntry->shipping_charges = 0;
            $newEntry->tax_amount = 0;
            $total = (int) $subtotal;
            $newEntry->final_amount = $total;
            $newEntry->save();


            // Remove cart data
            $emptyCart = Cart::where('ip', $this->ip)->delete();

            return $order_no;
        } catch (\Throwable $th) {
            // throw $th;
             //dd($th);
            DB::rollback();
            return false;
        }
    }
}


