<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    public function recipes()
    {
        return $this->belongTo(Recipe::class);
        //return $this->belongTo(InquerySubject::class, 'inquery_detail_id', 'id');
    }
}
