<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_ingredient_name',
        'recipe_ingredient_image',
        'recipe_ingredient_type',
    ];

    public function recipe()
    {
        return $this->belongTo(Recipe::class);
        //return $this->belongTo(InquerySubject::class, 'inquery_detail_id', 'id');
    }
}
