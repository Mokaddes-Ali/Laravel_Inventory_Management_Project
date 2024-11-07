<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function saleIndex()
    {
        return view('admin.sale.sale');
    }
}
