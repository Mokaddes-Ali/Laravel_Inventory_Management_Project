<?php

namespace App\Http\Controllers;

use App\Models\Brands;
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
        $brands = Brands::all();
        $customers = Customer::all();
        return view('admin.dashboard.index', compact('invoices', 'products', 'categories', 'brands', 'customers'));
    }

}
