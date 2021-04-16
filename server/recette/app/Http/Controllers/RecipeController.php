<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Ingredient;
use Storage;

class RecipeController extends Controller
{
    public function index()
    {   
        $recipes = Recipe::with(['recipe_ingredients'])->get();
        return $recipes;
    }

    public function create()
    {
    }

    public function store(Request $request,$user_id)
    {
        $new_recipe = json_decode($request->newRecipe);
        $recipe = new Recipe();
        $recipe->recipe_name = $new_recipe->recipeName;
        $recipe->user_id = $user_id;
        $recipe->recipe_category = $new_recipe->recipeCategory->recipe_category_name;
        $recipe->recipe_category_sub = $new_recipe->recipeCategory->recipe_category_name_sub;
        $recipe->recipe_category_image = $new_recipe->recipeCategory->recipe_category_image;
        $recipe->recipe_procedure = $new_recipe->recipeProcedure;
        $recipe->is_favorite = false;
        $recipe->recipe_url = $new_recipe->recipeUrl;
        $recipe->recipe_genre_index = $new_recipe->recipeGenre->index;
        $recipe->cooking_time_index = $new_recipe->cookingTime->index;
        $recipe->recipe_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png";

        clock($request->file('recipe-image-file'));
        if ($request->file('recipe-image-file') != null) {
            $imagefile = $request->file('recipe-image-file');
            $recipe->recipe_image_path = Storage::disk('s3')->url($path);
        }
        
        $recipe->save();
        $last_insert_id = $recipe->id; 
        $recipe = Recipe::find($last_insert_id);
    
        foreach ($new_recipe->recipeIngredientList as $recipeIngredient) {
            $recipe->recipe_ingredients()->saveMany([
                new RecipeIngredient([
                    'user_id' => $recipeIngredient->user_id,
                    'recipe_ingredient_name' => $recipeIngredient->recipe_ingredient_name, 
                    'recipe_ingredient_image_path' => $recipeIngredient->recipe_ingredient_image_path, 
                    'recipe_ingredient_category' => $recipeIngredient->recipe_ingredient_category,
                    'recipe_ingredient_quantity' => $recipeIngredient->recipe_ingredient_quantity,
                ])
            ]);
        }

        $recipes = Recipe::with(['recipe_ingredients'])->get();
        return $recipes;
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update(Request $request, $user_id,$recipe_id)
    {
        $edited_recipe = json_decode($request->editedRecipe);
        $update_target_recipe = Recipe::where('id',$edited_recipe->id)->first();
        $update_target_recipe->recipe_name = $edited_recipe->recipeName;
        $update_target_recipe->recipe_procedure = $edited_recipe->recipeProcedure;
        $update_target_recipe->recipe_category = $edited_recipe->recipeCategory->recipe_category_name;
        $update_target_recipe->recipe_category_sub = $edited_recipe->recipeCategory->recipe_category_name_sub;
        $update_target_recipe->recipe_category_image = $edited_recipe->recipeCategory->recipe_category_image;
        $update_target_recipe->recipe_url = $edited_recipe->recipeUrl;
        $update_target_recipe->recipe_genre_index = $edited_recipe->recipeGenre->index;
        $update_target_recipe->cooking_time_index = $edited_recipe->cookingTime->index;

        if ($request->file('recipe-image-file') != null) {
            $imagefile = $request->file('recipe-image-file');
            $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
            $update_target_recipe->recipe_image_path = Storage::disk('s3')->url($path);
        }
        
        $update_target_recipe->save();
        $last_insert_id = $update_target_recipe->id; 
        $recipe = Recipe::find($last_insert_id);
        
        foreach ($edited_recipe->recipeIngredientList as $recipeIngredient) {
            // 編集
            if(isset($recipeIngredient->recipe_id)) {
                
                $update_target_recipe_ingredient = Recipeingredient::where('user_id', $user_id)->where('id', $recipeIngredient->id)->get();
                $update_target_recipe_ingredient->recipe_ingredient_name = $recipeIngredient->recipe_ingredient_name;
                $update_target_recipe_ingredient->recipe_ingredient_image_path = $recipeIngredient->recipe_ingredient_image_path;
                $update_target_recipe_ingredient->recipe_ingredient_category = $recipeIngredient->recipe_ingredient_category;
                $update_target_recipe_ingredient->recipe_ingredient_quantity = $recipeIngredient->recipe_ingredient_quantity;
            
            } else {
                // 新規追加
                $recipe->recipe_ingredients()->saveMany([
                    new RecipeIngredient([
                        'user_id' => $recipeIngredient->user_id,
                        'recipe_ingredient_name' => $recipeIngredient->recipe_ingredient_name, 
                        'recipe_ingredient_image_path' => $recipeIngredient->recipe_ingredient_image_path, 
                        'recipe_ingredient_category' => $recipeIngredient->recipe_ingredient_category,
                        'recipe_ingredient_quantity' => $recipeIngredient->recipe_ingredient_quantity,
                    ])
                ]);
            }
        }
        
        $recipes = Recipe::with(['recipe_ingredients'])->get();
        clock($recipes);
        return $recipes;
    }

    public function destroy($user_id,$recipe_id)
    {
        $delete_target_recipe = Recipe::where('user_id', $user_id)->where('id', $recipe_id)->first();
        $delete_target_recipe->delete();
        $recipes = Recipe::with(['recipe_ingredients'])->get();
        return $recipes;
    }
}
