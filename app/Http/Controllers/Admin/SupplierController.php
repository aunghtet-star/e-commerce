<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier=Supplier::latest()->paginate(5);
        return view('admin.supplier.index',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string",
        ]);
        //dd(Str::slug($request->name).uniqid());

        Supplier::create([
            'slug'=>Str::slug($request->name).'-'.uniqid(),
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Supplier added successfully.');
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
        $cat=Supplier::where('slug',$id)->first();
        if(!$cat){
            return redirect()->back()-with('error','Supplier not found!');
        }
        return view('admin.supplier.edit',compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string",
        ]);
        $cat=Supplier::where('slug',$id)->first();
        if(!$cat){
            return redirect()->back()-with('error','Supplier not found!');
        }
        Supplier::where('slug',$id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Supplier Name Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cat=Supplier::where('slug',$id);
        if(!$cat->first()){
            return redirect()->back()-with('error','Supplier not found!');
        }
        $cat->delete();
        return redirect()->back()->with('Supplier Removed Successfullys.');
    }
}
