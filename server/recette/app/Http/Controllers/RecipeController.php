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
        // ユーザーID、レシピ名
        $recipe->user_id = $user_id;
        $recipe->recipe_name = $new_recipe->recipeName;
        // レシピ画像
        $recipe->recipe_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png";
        $recipe->is_favorite = false;

        if ($request->file('recipe-image-file') != null) {
            $imagefile = $request->file('recipe-image-file');
            $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
            $recipe->recipe_image_path = Storage::disk('s3')->url($path);
        }

        // レシピURL
        if (isset($new_recipe->recipeUrl)) {
            $recipe->recipe_url = $new_recipe->recipeUrl;
        }

        // レシピ作成手順
        if (isset($new_recipe->recipeProcedure)) {
            $recipe->recipe_procedure = $new_recipe->recipeProcedure;
        }
        
        // 調理時間
        if (isset($new_recipe->cookingTime)) {
            $recipe->cooking_time_index = $new_recipe->cookingTime->index;
        }
        
        // レシピジャンル
        if (isset($new_recipe->recipeGenre)) {
            $recipe->recipe_genre_index = $new_recipe->recipeGenre->index;
        }

        // レシピカテゴリー
        if (isset($new_recipe->recipeCategory)) {
            $recipe->recipe_category_index = $new_recipe->recipeCategory->index;
        }
        
        $recipe->save();
        $last_insert_id = $recipe->id; 
        $recipe = Recipe::find($last_insert_id);

        clock($new_recipe->recipeIngredientList);

        if (isset($new_recipe->recipeIngredientList)) {
            foreach ($new_recipe->recipeIngredientList as $recipeIngredient) {
                $recipe->recipe_ingredients()->saveMany([
                    new RecipeIngredient([
                        'user_id' => $user_id,
                        'ingredient_name' => $recipeIngredient->ingredient_name,  
                        'ingredient_category' => $recipeIngredient->ingredient_category,
                        'ingredient_quantity' => $recipeIngredient->ingredient_quantity,
                    ])
                ]);
            }
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
        clock($edited_recipe);
        $update_target_recipe = Recipe::where('user_id',$user_id)->where('id',$recipe_id)->first();
        // レシピ名
        $update_target_recipe->recipe_name = $edited_recipe->recipeName;

        // レシピ画像
        if ($request->file('recipe-image-file') != null) {
            $imagefile = $request->file('recipe-image-file');
            $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
            $update_target_recipe->recipe_image_path = Storage::disk('s3')->url($path);
        }

        // レシピURL
        $update_target_recipe->recipe_url = $edited_recipe->recipeUrl;

        // レシピ作成手順
        $update_target_recipe->recipe_procedure = $edited_recipe->recipeProcedure;

        // 調理時間
        if (isset($edited_recipe->cookingTime)) {
            $update_target_recipe->cooking_time_index = $edited_recipe->cookingTime->index;
        }

        // レシピジャンル
        if (isset($edited_recipe->recipeGenre)) {
            $update_target_recipe->recipe_genre_index = $edited_recipe->recipeGenre->index;
        }

        // レシピカテゴリー
        if (isset($edited_recipe->recipeCategory)) {
            $update_target_recipe->recipe_category = $edited_recipe->recipeCategory->index;
        }

        $update_target_recipe->save();
        $last_insert_id = $update_target_recipe->id; 
        $recipe = Recipe::find($last_insert_id);
        
        foreach ($edited_recipe->recipeIngredientList as $recipeIngredient) {
            // 編集
            if(isset($recipeIngredient->recipe_id)) {
                
                $update_target_recipe_ingredient = Recipeingredient::where('user_id', $user_id)->where('id', $recipeIngredient->id)->get();
                $update_target_recipe_ingredient->ingredient_name = $recipeIngredient->ingredient_name;
                $update_target_recipe_ingredient->ingredient_category = $recipeIngredient->ingredient_category;
                $update_target_recipe_ingredient->ingredient_quantity = $recipeIngredient->ingredient_quantity;
            
            } else {
                // 新規追加
                $recipe->recipe_ingredients()->saveMany([
                    new RecipeIngredient([
                        'user_id' => $recipeIngredient->user_id,
                        'ingredient_name' => $recipeIngredient->ingredient_name, 
                        'ingredient_category' => $recipeIngredient->ingredient_category,
                        'ingredient_quantity' => $recipeIngredient->ingredient_quantity,
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
