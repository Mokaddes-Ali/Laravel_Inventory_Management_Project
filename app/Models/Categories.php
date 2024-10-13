<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'remarks',
        'creator',
        'editor',
        'slug',
        'status'
    ];

    // Relationship with User (Creator)
    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    // Relationship with User (Editor)
    public function editorUser()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}
