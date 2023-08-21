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
        $data =Sections::all();
        return view("sections.sections",compact('data'));
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
        //php artisan make:request StorePostRequest can be used also 
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:50',
            'description' => 'required',
        ],[  //can be changed in lang folder after installing it 
            'section_name.required' => 'برجي إدخال إسم القسم',
            'section_name.unique' => 'إسم القسم مسجل مسبفاً',
            'description.required' => 'يرجي كتابة الوصف',
        ]);

        // $exists =Sections::where('section_name',$request->section_name)->exists();
        // if($exists){
        //     session()->flash('Error','القسم مسجل مسبقا');
        //     return redirect('sections');
        // }else{
            Sections::create([
                "section_name"=>$request->section_name,
                "description"=>$request->description,
                "created_by"=>(Auth::user()->name),
            ]);

            // session()->flash('Add','تم التسجيل  بنجاح');
            return redirect('sections');
        // }

        
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
    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request,[
            'section_name' => 'required|max:50|unique:sections,section_name,'.$id,
            // 'description' => 'required',
        ],[  //can be changed in lang folder after installing it 
            'section_name.required' => 'برجي إدخال إسم القسم',
            'section_name.unique' => 'إسم القسم مسجل مسبفاً',
            'description.required' => 'يرجي كتابة الوصف',
        ]);
        $section =Sections::find($id)->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
        ]);
        
         session()->flash('Edit','edit done successfully');

        return redirect('sections'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id =$request->id;
        //Sections::findorFail(1)->delete();
        if((Sections::find($id)!=null)){
            Sections::destroy($id);
            session()->flash('Delete','Deleted successfully');
        }

        return redirect()->route('sections.index');
    }
}
