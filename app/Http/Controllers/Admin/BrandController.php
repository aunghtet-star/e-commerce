<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand=Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string",
        ]);


        Brand::create([
            'slug'=>Str::slug($request->name).'-'.uniqid(),
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Brand added successfully.');
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
        $br=Brand::where('slug',$id)->first();
        if(!$br){
            return redirect()->back()-with('error','Brand not found!');
        }
        return view('admin.brand.edit',compact('br'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string",
        ]);
        $br=Brand::where('slug',$id)->first();
        if(!$br){
            return redirect()->back()-with('error','Brand not found!');
        }
        Brand::where('slug',$id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Brand Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $br=Brand::where('slug',$id);
        if(!$br->first()){
            return redirect()->back()-with('error','Brand not found!');
        }
        $br->delete();
        return redirect()->back()->with('Brand Deleted.');
    }
}
