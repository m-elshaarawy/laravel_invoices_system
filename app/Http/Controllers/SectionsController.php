<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("sections.sections");
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
        $exists =Sections::where('section_name',$request->section_name)->exists();
        if($exists){
            session()->flash('Error','القسم مسجل مسبقا');
            return redirect('sections');
        }else{
            Sections::create([
                "section_name"=>$request->section_name,
                "description"=>$request->description,
                "created_by"=>(Auth::user()->name),
            ]);

            session()->flash('Add','تم التسجيل  بنجاح');
            return redirect('sections');;
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sections $sections)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sections $sections)
    {
        //
    }
}
