<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Ingredient;

class SearchRecipeController extends Controller
{
    //
    public function showRecipeCategoryList($user_id)
    {   
        // $recipes = Recipe::with([
        //     'recipe_ingredients',
        // ])->where('user_id', $user_id)->get();

        $recipes = Recipe::with(['recipe_ingredients' => function ($query) use($user_id) {
            $query->where('user_id',$user_id);
        }])->get();
        
        // dd($recipes);
        
        return view('recipe.recipe_category_list')->with('recipes' , $recipes);
    }

    public function showRecipeCategoryDetailList(Request $request,$user_id,$category_name)
    {   
        dd($request->all());
        // $recipes = Recipe::where('recipe_category',$category_name)->get();

        $recipes = Recipe::where('recipe_category',$category_name)->with(['recipe_ingredients' => function ($query) use($user_id) {
            $query->where('user_id',$user_id);
        }])->get();
        
        return view('recipe.recipe_category_detail_list')->with('recipes' , $recipes);
    }

    public function showRecipeCategoryDetail(Request $request,$user_id,$category_name)
    {   
        dd($request->all());
        // $recipes = Recipe::where('recipe_category',$category_name)->get();

        $recipes = Recipe::where('recipe_category',$category_name)->with(['recipe_ingredients' => function ($query) use($user_id) {
            $query->where('user_id',$user_id);
        }])->get();
        
        return view('recipe.recipe_category_detail')->with('recipes' , $recipes);
    }
}
