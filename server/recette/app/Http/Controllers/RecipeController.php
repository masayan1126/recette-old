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
    // レシピ一覧を取得し表示する
    public function index($user_id)
    {   
        // 現在のURLを取得し、表示画面を分岐させる
        $uri = rtrim($_SERVER["REQUEST_URI"], '/');
        $uri = substr($uri, strrpos($uri, '/') + 1);

        // １.通常の一覧で全レシピを表示
        $recipes = Recipe::where('user_id', $user_id)->get();
        $ingredients = Ingredient::where('user_id', $user_id)->get();

        if ($uri == "recipes") {
            return view('top')->with(
                [
                    'user_id' => $user_id,
                    'recipes' => $recipes,
                    'ingredients' => $ingredients,
                ]
            );
        }
        // ２．リスト形式の一覧で全レシピを表示
        return view('recipe.recipe_list')->with(
            [
                'user_id' => $user_id,
                'recipes' => $recipes,
                'ingredients' => $ingredients,
            ]
        );
    }

    public function create($user_id)
    {
        $ingredients = Ingredient::where('user_id', $user_id)->get();
        $ingredients = json_encode($ingredients);
        return view('recipe.create_recipe')->with('ingredients' , $ingredients);
    }

    public function addFavorite($user_id, $recipe_id)
    {
        $target_recipe = Recipe::where('user_id', $user_id)->where('id', $recipe_id)->first();
        $target_recipe->is_favorite = true;
        $target_recipe->save();
    }

    public function removeFavorite($user_id, $recipe_id)
    {
        $target_recipe = Recipe::where('user_id', $user_id)->where('id', $recipe_id)->first();
        $target_recipe->is_favorite = false;
        $target_recipe->save();
    }

    public function store(Request $request,$user_id)
    {
        $new_recipe = json_decode($request->newRecipe);
        $imagefile = $request->file('imagefile');
        // $pathの中身は"products/ファイル名.jpeg"　等
        $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
        // $product->pathの中身は上記$pathの画像ファイル名含めたs3のURL
        
        $recipe = new Recipe();
        $recipe->recipe_name = $new_recipe->recipeName;
        $recipe->user_id = $user_id;
        $recipe->recipe_image_path = Storage::disk('s3')->url($path);
        // dd($new_recipe->recipeProcedure);

        $recipe->recipe_procedure = $new_recipe->recipeProcedure;
        $recipe->is_favorite = false;

        $recipe->save();
        $last_insert_id = $recipe->id; 
        $recipe = Recipe::find($last_insert_id);

        foreach ($new_recipe->ingredients as $ingredient) {
            $recipe->recipe_ingredients()->saveMany([
                new RecipeIngredient([
                    'user_id' => $ingredient->user_id,
                    'recipe_ingredient_name' => $ingredient->ingredient_name, 
                    'recipe_ingredient_category' => $ingredient->ingredient_category,
                ])
            ]);
        }

        $url = url("/users/{$user_id}/recipes");
        return redirect($url);
    }

    public function show($user_id,$recipe_id)
    {
        // $target_recipe = Recipe::find($recipe_id);
        // (with('モデルファイルのリレーション<メソッド>名'))
        $target_recipe = Recipe::where('id', $recipe_id)
        ->with('recipe_ingredients')->get();

        // dd($target_recipe);

        // レシピ詳細画面
        return view('recipe.recipe_detail')->with(
            [
                'target_recipe' => $target_recipe, 
                'target_recipe_ingredients' => $target_recipe[0]->recipe_ingredients
            ],
        );

    }

    public function edit($user_id,$recipe_id)
    {
        $editing_target_recipe = Recipe::where('id', $recipe_id)
        ->with('recipe_ingredients')->get();
        
        $ingredients = Ingredient::where('user_id', $user_id)->get();
        return view('recipe.edit_recipe')->with(
            [
                'editing_target_recipe' => $editing_target_recipe,
                'editing_target_recipe_ingredients' => $editing_target_recipe[0]->recipe_ingredients,
                'ingredients' => $ingredients,
            ]
        );
    }

    public function update(Request $request, $user_id)
    {
        $edited_recipe = json_decode($request->editedRecipe);
        $imagefile = $request->file('imagefile');
        $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
        $update_target_recipe = Recipe::where('id',$edited_recipe->id)->first();
        $update_target_recipe->recipe_name = $edited_recipe->editedRecipeName;
        $update_target_recipe->recipe_image_path = Storage::disk('s3')->url($path);
        $update_target_recipe->save();

        foreach ($edited_recipe->editedIngredients as $editedIngredient) {
            // 編集
            if(isset($editedIngredient->id)) {
                $target_recipe_ingredient = Recipeingredient::where('id', $editedIngredient->id)->get();
                $target_recipe_ingredient->recipe_ingredient_name = $editedIngredient->recipe_ingredient_name;
            
            } else {
                // 新規追加
                $recipe_ingredient = new RecipeIngredient;
                $recipe_ingredient->recipe_id = $edited_recipe->id;
                $recipe_ingredient->recipe_ingredient_name = $editedIngredient->recipe_ingredient_name;
                $recipe_ingredient->save();
            }
        }
        
        $url = url("/users/{$user_id}/recipes/{$edited_recipe->id}");
        return redirect($url);
    }

    public function destroy($user_id,$recipe_id)
    {
        $delete_target_recipe = Recipe::where('id', $recipe_id)->with('recipe_ingredients')->get();
        $delete_target_recipe[0]->delete();
        $recipes = Recipe::where('user_id', $user_id)->get();
        $ingredients = Ingredient::where('user_id', $user_id)->get();

        return view('recipe.recipe_list')->with(
            [
                'user_id' => $user_id,
                'recipes' => $recipes,
                'ingredients' => $ingredients,
            ]
        );
    }
}
