<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $invoices = Invoice::all();
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $customers = Customer::all();
        $totalPaidAmount = Invoice::sum('paid');
        $totalDueAmount = Invoice::sum('due');
        $totalVat = Invoice::sum('vat');
        // $totalDiscount = Invoice::sum('discount');
        // $totalIncome = Invoice::sum('total');

        return view('admin.dashboard.index',
         compact('invoices', 'products', 'categories',
         'brands', 'customers','totalPaidAmount',
        'totalDueAmount', 'totalVat'));
    }

}
