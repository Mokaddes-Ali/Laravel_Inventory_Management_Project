<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
// Specify the fields that can be mass-assigned
protected $fillable = [
    'customer_id',  // Add this to allow mass assignment
    'vat',
    'payable',
    'paid',
    'due',
    'creator',
    'editor',
];

public function products()
    {
        return $this->hasMany(Invoice_Product::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
}
