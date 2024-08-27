<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\ProductRemoveTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::latest()->select('slug','name','image','category_id','total_quantity')->paginate(10);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier=Supplier::all();
        $color=Color::all();
        $brand=Brand::all();
        $category=Category::all();
        return view('admin.product.create',compact('supplier','color','brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //return $request->all();
        $request->validate([
            'name'=>"required|string",
            'description'=>"required|string",
            'total_quantity'=>"required|integer",
            'buy_price'=>"required|integer",
            'sale_price'=>"required|integer",
            'discounted_price'=>"required|integer",
            'supplier_slug'=>"required|string",
            'category_slug'=>"required|string",
            'brand_slug'=>"required|string",
            'color_slug'=>"required",
            'image'=>"required|mimes:jpg,png,jpeg,webp|max:3072",
        ]);




        //image upload
        $image=$request->file('image');
        $image_name=uniqid().$image->getClientOriginalName();
        $image->move(public_path('/images'),$image_name);

        //product store
        $category=Category::where('slug',$request->category_slug)->first();
        if(!$category){
            return redirect()->back()->with('error','Category Not Found!');
        }
        $brand=Brand::where('slug',$request->brand_slug)->first();
        if(!$brand){
            return redirect()->back()->with('error','Brand Not Found!');
        }
        $supplier=Supplier::where('id',$request->supplier_slug)->first();
        if(!$supplier){
            return redirect()->back()->with('error','Supplier Not Found!');
        }

        $colors=[];
        foreach($request->color_slug as $c){
            $color=Color::where('slug',$c)->first();
            $colors[]=$color->id;
        }

        if(!$colors){
            return redirect()->back()->with('error','Color Not Found!');
        }



        $product=Product::create([
            'category_id'=>$category->id,
            'supplier_id'=>$supplier->id,
            'brand_id'=>$brand->id,
            'slug'=>uniqid() . Str::slug($request->name),
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$image_name,
            'discount_price'=>$request->discounted_price,
            'sale_price'=>$request->sale_price,
            'buy_price'=>$request->buy_price,
            'total_quantity'=>$request->total_quantity,
            'view_count'=>0,
            'like_count'=>0,
        ]);

        //add transaction
        ProductAddTransaction::create([
            'product_id'=>$product->id,
            'supplier_id'=>$supplier->id,
            'total_quantity'=>$request->total_quantity,
        ]);

        //sync to product_color
        $p=Product::find($product->id);
        $p->color()->sync($colors);



        return redirect()->back()->with('success','Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier=Supplier::all();
        $color=Color::all();
        $brand=Brand::all();
        $category=Category::all();
        $p=Product::where('slug',$id)
        ->with('supplier','color','brand','category')
        ->first();
        if(!$p){
            return redirect()->back()->with('error','Product Not Found');
        }
        return view('admin.product.edit',compact('supplier','color','brand','category','p'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $find_product= Product::where('slug',$id);

        if(!$find_product->first()){
            return redirect()->back()->with('error','Product Not Found');
        }
        $product_id=$find_product->first()->id;
        //image
        if($file=$request->file('image'))
        {
            $file_name=uniqid().$file->getClientOriginalName();
            $file->move(public_path('/images'),$file_name);
        }
        else{
            $file_name=$find_product->first()->image;
        }


        $category=Category::where('slug',$request->category_slug)->first();
        if(!$category){
            return redirect()->back()->with('error','Category Not Found!');
        }
        $brand=Brand::where('slug',$request->brand_slug)->first();
        if(!$brand){
            return redirect()->back()->with('error','Brand Not Found!');
        }
        $supplier=Supplier::where('id',$request->supplier_slug)->first();
        if(!$supplier){
            return redirect()->back()->with('error','Supplier Not Found!');
        }

        $colors=[];
        foreach($request->color_slug as $c){
            $color=Color::where('slug',$c)->first();
            if(!$color){
                return redirect()->back()->with('error','Color Not Found!');
            }
            $colors[]=$color->id;
        }

        $slug=uniqid().Str::slug($request->name);
        $find_product->update([
            'category_id'=>$category->id,
            'supplier_id'=>$supplier->id,
            'brand_id'=>$brand->id,
            'slug'=>$slug,
            'name'=>$request->name,
            'image'=>$file_name,
            'discount_price'=>$request->discounted_price,
            'sale_price'=>$request->sale_price,
            'buy_price'=>$request->buy_price,
            'total_quantity'=>$request->total_quantity,
            'view_count'=>0,
            'like_count'=>0,
            'description'=>$request->description,
        ]);

        $product=Product::find($product_id);
        $product->color()->sync($colors);
        return redirect(route('product.edit',$slug))->with('success','Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //find product
        $p=Product::where('slug',$id);
        if(!$p->first()){
            return redirect()->back()->with('error','Product Not Found!');
        }
        //remove image
        File::delete(public_path('images/'.$p->first()->image));
        //remove synced items
        Product::find($p->first()->id)->color()->sync([]);
        //delete product
        $p->delete();
        return redirect()->back()->with('success','Product Deleted');
    }
    public function imageUpload()
    {
        $file= request()->file('image');
        $file_name=uniqid().$file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);
        return asset('/images/'.$file_name);
    }

    public function createProductAdd($slug){
        $product=Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        $supplier=Supplier::all();
        return view('admin.product.create-product-add',compact('product','supplier'));
    }

    public function storeProductAdd(Request $request, $slug)
    {
        $product=Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        //store to transaction
        ProductAddTransaction::create([
            'product_id'=>$product->id,
            'supplier_id'=>$request->supplier_id,
            'total_quantity'=>$request->total_quantity,
            'description'=>$request->description
        ]);
        //update quantity
        $product->update([
            'total_quantity'=>DB::raw('total_quantity+'.$request->total_quantity)
        ]);
        return redirect()->back()->with('success',$request->total_quantity.' added.');
    }

    public function productAddTransaction(){
        $transactions=ProductAddTransaction::with('product')->paginate(10);
        //return $transactions;
        return view('admin.product.add-transaction',compact('transactions'));
    }

    public function productRemove($slug)
    {
        $product=Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        $supplier=Supplier::all();
        return view('admin.product.product-remove',compact('product','supplier'));
    }

    public function storeProductRemove(Request $request, $slug)
    {
        $product=Product::where('slug',$slug)->first();
        if(!$product){
            return redirect()->back()->with('error','Product Not Found');
        }
        //store to transaction
        ProductRemoveTransaction::create([
            'product_id'=>$product->id,
            'supplier_id'=>$request->supplier_id,
            'total_quantity'=>$request->total_quantity,
            'description'=>$request->description
        ]);
        //update quantity
        $product->update([
            'total_quantity'=>DB::raw('total_quantity-'.$request->total_quantity)
        ]);
        return redirect()->back()->with('success',$request->total_quantity.' removed.');
    }

    public function productRemoveTransaction(){
        $transactions=ProductRemoveTransaction::with('product')->paginate(10);
        //return $transactions;
        return view('admin.product.remove-transaction',compact('transactions'));
    }
}
