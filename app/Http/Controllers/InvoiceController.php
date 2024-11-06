<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['creator', 'editor', 'customer'])->get();
        return view('admin.invoice.create', compact('invoices'));
    }

    public function create()
    {
        return view('admin.invoice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'required|string|max:50',
            'vat' => 'required|string|max:50',
            'payable' => 'required|string|max:50',
            'paid' => 'required|string|max:50',
            'due' => 'required|string|max:50',
            'customer_id' => 'required|exists:customers,id',
        ]);

        Invoice::create([
            'discount' => $request->discount,
            'vat' => $request->vat,
            'payable' => $request->payable,
            'paid' => $request->paid,
            'due' => $request->due,
            'creator' => Auth::id(),
            'customer_id' => $request->customer_id,
        ]);

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.invoice.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'discount' => 'required|string|max:50',
            'vat' => 'required|string|max:50',
            'payable' => 'required|string|max:50',
            'paid' => 'required|string|max:50',
            'due' => 'required|string|max:50',
            'customer_id' => 'required|exists:customers,id',
        ]);

        $invoice->update([
            'discount' => $request->discount,
            'vat' => $request->vat,
            'payable' => $request->payable,
            'paid' => $request->paid,
            'due' => $request->due,
            'editor' => Auth::id(),
            'customer_id' => $request->customer_id,
        ]);

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoice.index')->with('success', 'Invoice deleted successfully.');
    }
}

