<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products';

    protected $fillable = [
        'name', 'category_id', 'brand_id', 'price', 'cost', 'code', 'unit', 'details', 'img_url', 'creator', 'slug', 'status'
    ];
public function creatorUser()
{
    return $this->belongsTo(User::class, 'creator');
}

public function editorUser()
{
    return $this->belongsTo(User::class, 'editor');
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function brand()
{
    return $this->belongsTo(Brand::class);
}
}
