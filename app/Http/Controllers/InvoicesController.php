<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index()
    {
        return view('admin.sale.sale');
    }
}
