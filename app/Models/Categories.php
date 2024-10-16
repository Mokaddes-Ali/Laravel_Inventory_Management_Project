<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'remarks',
        'creator',
        'editor',
        'slug',
        'status',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
