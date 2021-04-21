<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ingredient_name',
        'ingredient_category',
        'ingredient_quantity',
    ];

    public function recipe()
    {
        return $this->belongTo(Recipe::class);
        //return $this->belongTo(InquerySubject::class, 'inquery_detail_id', 'id');
    }
}
