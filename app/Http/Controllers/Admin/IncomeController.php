<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $income=Income::latest()->paginate(10);
        $todayIncome=Income::whereDay('created_at',date('d'))->sum('amount');
        return view('admin.income.index', compact('income','todayIncome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.income.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>"required|string",
            'amount'=>"required|integer",
            'description'=>"required|string",
        ]);
        Income::create([
            'title'=>$request->title,
            'amount'=>$request->amount,
            'description'=>$request->description,
        ]);
        return redirect()->back()->with('success','Income Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
