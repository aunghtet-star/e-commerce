<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Productcart;
use App\Models\Productorder;
use Illuminate\Http\Request;

class CartApi extends Controller
{
    public function addToCart(Request $request, $slug)
    {
        $product=Product::where('slug',$slug)->first();
        if(!$product){
            return response()->json([
                'message'=>false,
                'data'=>'product_not_found'
            ]);
        }
        $findInCart=Productcart::where('user_id',$request->user_id)->where('product_id',$product->id)->first();
        if($findInCart){
            $total_quantity=$findInCart->total_quantity+1;
            $findInCart->update([
                'total_quantity'=>$total_quantity,
            ]);
        }else{
            Productcart::create([
                'product_id'=>$product->id,
                'user_id'=>request()->user_id,
                'total_quantity'=>1,
            ]);
        }

        $cart_count=Productcart::where('user_id',request()->user_id)->count();
        return response()->json([
            'message'=>true,
            'data'=>$cart_count,
        ]);
    }

    public function getCart()
    {
        $user_id=request()->user_id;
        $cart=Productcart::where('user_id',$user_id)->with('product')
        ->get();
        return response()->json([
            'message'=>true,
            'data'=>$cart,
        ]);
    }

    public function updateQty(){
        $cart_id=request()->cart_id;
        $qty=request()->total_qty;

        Productcart::where('id',$cart_id)->update([
            'total_quantity'=>$qty
        ]);
        return response()->json([
            'message'=>true,
            'data'=>null
        ]);
    }

    public function removeCart(){
        $cart_id=request()->cart_id;

        Productcart::where('id',$cart_id)->delete();
        return response()->json([
            'message'=>true,
            'data'=>null
        ]);
    }

    public function checkout(){
        $user_id=request()->user_id;
        $carts=Productcart::where('user_id',$user_id)->get();

        foreach($carts as $cart){
            Productorder::create([
                'user_id'=>$cart->user_id,
                'product_id'=>$cart->product_id,
                'total_quantity'=>$cart->total_quantity,

            ]);
        }
        Productcart::where('user_id',$user_id)->delete();
        return response()->json([
            'message'=>true,
            'data'=>null
        ]);

    }

    public function order()
    {
        $user_id=request()->user_id;
        $order=Productorder::where('user_id',$user_id)
        ->with('product')
        ->paginate(5);
        return response()->json([
            'message'=>true,
            'data'=>$order
        ]);
    }
}
