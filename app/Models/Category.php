<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'remarks', 'creator', 'editor', 'status'
    ];

    public function creatorUser()
    {
        return $this->belongsTo(User::class, 'creator');
    }

    public function editorUser()
    {
        return $this->belongsTo(User::class, 'editor');
    }
}

