<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachment;
use App\Models\Invoices;
use App\Models\invoices_details;
use App\Models\Products;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices =Invoices::all();
        return view("invoices.invoices",compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections=Sections::all();
        $products=Products::all();
        return view("invoices.add_invoice",compact("sections","products"));
    }
    /**
     * get products by section_id .
     */
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'due_date'=>$request->due_date,
            'product'=>$request->product,
            'section_id'=>$request->section,
            'amount_collection'=>$request->amount_collection,
            'amount_Commission'=>$request->amount_Commission,
            'discount'=>$request->discount,
            'value_VAT'=>$request->value_VAT,
            'rate_VAT'=>$request->rate_VAT,
            'total'=>$request->total,
            'status'=>'غير مدفوعة',
            'value_Status'=>2,
            'note'=>$request->note,
           ]);

           $invoice_id=invoices::latest()->first()->id;
             invoices_details::create([
            'invoice_id'=>$invoice_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->section,
            'status'=>'غير مدفوعة',
            'value_Status'=>2,
            'note'=>$request->note,
            'user'=>(Auth::user()->name)
           ]);

           if ($request->hasFile('pic')) {
            $invoice_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            invoice_attachment::create([
                'invoice_number'=>$request->invoice_number,
                'file_name'=>$file_name,
                'created_by'=>(Auth::user()->name),
                'attach_invoiceID'=>$invoice_id,
            ]);
            //$invoice_number = $request->invoice_number;
            // $attachments = new invoice_attachment();
            // $attachments->file_name = $file_name;
            // $attachments->invoice_number = $invoice_number;
            // $attachments->created_by = Auth::user()->name;
            // $attachments->id_invoices = $invoice_id;
            // $attachments->save();
    
            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $request->invoice_number), $imageName);
        }


           session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
           return back();
           //return redirect("invoices");
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice=Invoices::where('id',$id)->first();
        $details=invoices_details::where('invoice_id',$id)->get();
        $attachments=invoice_attachment::where('attach_invoiceID',$id)->get();
        return view('invoices.invoice_details',compact('invoice','details','attachments'));
        //return $invoice;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoices)
    {
        //
    }


}
