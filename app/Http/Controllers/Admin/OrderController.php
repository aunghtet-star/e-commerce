<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productorder;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all(){
        $order=Productorder::with('user','product');
        if(request()->status){
            $status=request()->status;
            $order->where('status',$status);
        }
        $order=$order->latest()->paginate(10);
        return view('admin.order.all',compact('order'));

    }
    public function changeOrderStatus(Request $request)
    {
        $id=$request->id;
        $status=$request->status;
        $product_order=Productorder::where('id',$id);
        $product_order->update([
            'status'=>$status,
        ]);
        Product::where('id',$product_order->first()->product_id)->update([
            'total_quantity'=>DB::raw('total_quantity-1')
        ]);
        return redirect('/admin/order')->with('success','Order Status Changed');
    }
}
