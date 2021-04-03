<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Ingredient;
use Storage;

class RecipeFavoriteController extends Controller
{
    public function addFavorite($user_id, $recipe_id)
    {
        $target_recipe = Recipe::where('user_id', $user_id)->where('id', $recipe_id)->first();
        $target_recipe->is_favorite = true;
        $target_recipe->save();
        $recipes = Recipe::with(['recipe_ingredients'])->get();
        
        return $recipes;
    }

    public function removeFavorite($user_id, $recipe_id)
    {
        $target_recipe = Recipe::where('user_id', $user_id)->where('id', $recipe_id)->first();
        $target_recipe->is_favorite = false;
        $target_recipe->save();
        $recipes = Recipe::with(['recipe_ingredients'])->get();
        
        return $recipes;
    }
}
