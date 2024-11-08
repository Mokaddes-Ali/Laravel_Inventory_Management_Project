<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Invoice_Product;

class InvoiceController extends Controller
{

  public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->with('products', 'customer')->get();
        return view('admin.sale.index', compact('invoices'));
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
}
