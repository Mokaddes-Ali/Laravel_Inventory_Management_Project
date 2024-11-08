<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Product extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'invoice_id',  // Add invoice_id here
        'product_id',
        'qty',
        'sale_price',
        'subtotal',
        'creator',
    ];
}
