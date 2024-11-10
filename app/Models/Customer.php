<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'number', 'address', 'pic', 'creator', 'editor', 'slug', 'status'
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
