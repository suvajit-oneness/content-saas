<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CartContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Auth;
/**
 * Class ArticleCategoryRepository
 *
 * @package \App\Repositories
 */
class CartRepository  implements CartContract
{
    use UploadAble;

    /**
     * BlogCategoryRepository constructor.
     * @param Cart $model
     */
    public function __construct()
    {
    	$this->ip = $_SERVER['REMOTE_ADDR'];
        
    }


public function addToCart(array $data)
    {
        $collectedData = collect($data);


            /*$cartExists = Cart::where('course_id', $collectedData['course_id'])->where('ip', $this->ip)->first();
            $productImage = $collectedData['course_image'];


        if ($cartExists) {
           
            $cartExists->save();
            // return $cartExists;
        } else {*/
            $newEntry = new Cart;
            if (Auth::guard('web')->user()) {
            $newEntry->user_id = Auth::guard('web')->user()->id;
             }
            $newEntry->course_id = $collectedData['course_id'];
            $newEntry->course_name = $collectedData['course_name'];
             if(!empty($params['course_image'])){
                $profile_image = $collection['course_image'];
                $imageName = time().".".$profile_image->getClientOriginalName();
                $profile_image->move("course/",$imageName);
                $uploadedImage = $imageName;
                $newEntry->course_image = $uploadedImage;
                }
             $newEntry->course_slug = $collectedData['course_slug'];
             $newEntry->author_name = $collectedData['author_name'];
            $newEntry->price = $collectedData['price'];
            $newEntry->ip = $this->ip;
            $newEntry->save();

			/* $cartData = Cart::where('ip', $this->ip)->sum('qty');
            return $cartData; */
        
		$cartData = Cart::where('ip', $this->ip)->sum('qty');
		return $cartData;
    }

    public function viewByIp()
    {
        $data = Cart::where('ip', $this->ip)->get();

            // coupon code usage check
        return $data;
    }


    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete(int $id)
    {
        $data = Cart::destroy($id);
        return $data;
    }


   
}
