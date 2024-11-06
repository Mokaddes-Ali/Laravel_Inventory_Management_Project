<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'vat',
        'payable',
        'paid',
        'due',
        'creator',
        'editor',
        'customer_id',
    ];

    // Define relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
