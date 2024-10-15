<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator', 'editor', 'category_id', 'brand_id', 'name', 'code', 'price', 'cost',
        'unit', 'img_url', 'details', 'slug', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }
}
