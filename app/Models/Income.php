<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

   protected $table = 'incomes';

   protected $primaryKey = 'id';

    public function income()
    {
        return $this->belongsTo(Project::class , 'project_id');
    }


    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }


}
