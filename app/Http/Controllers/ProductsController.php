<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products =Products::all();
        $sections =Sections::all();
        return view('products.products',compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Product_name' => 'required|max:50',
            'section_id'=> 'required',
            'description' => 'required',
        ],[  //can be changed in lang folder after installing it 
            'Product_name.required' => 'برجي إدخال إسم المنتج',
            'section_id.required' => 'برجاء تحديد القسم ',
            'description.required' => 'يرجي كتابة الوصف',
        ]);
        Products::create([
            "Product_name"=>$request->Product_name,
            "description"=>$request->description,
            "section_id"=>$request->section_id,
        ]);

        session()->flash('Add','تم إضافة المنتج  بنجاح');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
