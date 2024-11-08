<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Invoice_Product;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{

  public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->with('products', 'customer')->get();
        return view('admin.sale.index', compact('invoices'));
    }

    public function salelist($id){
        $invoice = Invoice::with(['products', 'customer']) ->where('id',$id)->first();
        return view('admin.sale.invoice',compact('invoice'));
    }

    // public function index($pid)
    // {
    //     $invoices = Income::where('project_id', $pid)->get();
    //     $data = Project::where('id', $pid)->first();
    //     $setting = Settings::where('status', 0)->firstOrFail();
    //     return view('admin.invoice.index', compact('invoices', 'data', 'setting'));
    // }

    public function pdf($id)
    {

        $invoice = Invoice::with(['products', 'customer']) ->where('id',$id)->first();
        $pdf = Pdf::loadView('admin.sale.pdf',compact('invoice'));

        // $setting = Settings::where('status', 0)->firstOrFail();
        // $pdf = Pdf::loadView('admin.invoice.pdf', compact('invoices', 'data', 'setting'));
        return $pdf->download('invoice.pdf');
    }

    public function saleIndex()
    {
        return view('admin.sale.sale');
    }


    public function submitInvoice(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total' => 'required',
            'paid' => 'required',
            'due' => 'required',
            'vat' => 'nullable',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required',
            'items.*.price' => 'required',
        ]);


        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'total' => $request->total,
            'discount' => 0,
            'vat' => $request->vat ?? 0,
            'payable' => $request->total,
            'paid' => $request->paid,
            'due' => $request->due,
            'creator' => auth()->user()->id,
        ]);


        foreach ($request->items as $item) {
            Invoice_Product::create([
                'invoice_id' => $invoice->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'sale_price' => $item['price'],
                'subtotal' => $item['qty'] * $item['price'],
                'creator' => auth()->user()->id,
            ]);
        }

        return response()->json(['message' => 'Invoice and items saved successfully']);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Invoice_Product::where('invoice_id', $id)->delete();
            Invoice::where('id', $id)->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Invoice and its items were successfully deleted.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'An error occurred while deleting the invoice: ' . $e->getMessage());
        }
    }
}
