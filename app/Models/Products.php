<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'brand_id', 'name', 'code', 'price', 'cost',
        'unit', 'img_url', 'details', 'slug', 'status', 'creator', 'editor'
    ];

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    // Product belongs to a brand
    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }

    // Product created by a user (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    // Product edited by a user (editor)
    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
