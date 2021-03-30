<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_favorite'
    ];

    protected $casts = [
        'recipe_procedure'  => 'json',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function recipe_ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}

