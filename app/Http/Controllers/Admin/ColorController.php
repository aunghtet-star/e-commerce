<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $color=Color::latest()->paginate(5);
        return view('admin.color.index',compact('color'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.color.create');
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

        Color::create([
            'slug'=>Str::slug($request->name).'-'.uniqid(),
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Color added successfully.');
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
        $col=Color::where('slug',$id)->first();
        if(!$col){
            return redirect()->back()-with('error','Color not found!');
        }
        return view('admin.color.edit',compact('col'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string",
        ]);
        $col=Color::where('slug',$id)->first();
        if(!$col){
            return redirect()->back()-with('error','Color not found!');
        }
        Color::where('slug',$id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->back()->with('success','Color Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $col=Color::where('slug',$id);
        if(!$col->first()){
            return redirect()->back()-with('error','Color not found!');
        }
        $col->delete();
        return redirect()->back()->with('Color Deleted.');
    }
}
