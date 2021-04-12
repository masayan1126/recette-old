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
    public function index()
    {   
        $recipes = Recipe::with(['recipe_ingredients'])->get();
        
        return $recipes;

        // // 現在のURLを取得し、表示画面を分岐させる
        // $uri = rtrim($_SERVER["REQUEST_URI"], '/');
        // $uri = substr($uri, strrpos($uri, '/') + 1);

        // // １.通常の一覧で全レシピを表示
        // $recipes = Recipe::where('user_id', $user_id)->get();
        // $ingredients = Ingredient::where('user_id', $user_id)->get();

        // if ($uri == "recipes") {
        //     return view('top')->with(
        //         [
        //             'user_id' => $user_id,
        //             'recipes' => $recipes,
        //             'ingredients' => $ingredients,
        //         ]
        //     );
        // }
        // // ２．リスト形式の一覧で全レシピを表示
        // return view('recipe.recipe_list')->with(
        //     [
        //         'user_id' => $user_id,
        //         'recipes' => $recipes,
        //         'ingredients' => $ingredients,
        //     ]
        // );
    }

    public function create($user_id)
    {
        // $ingredients = Ingredient::where('user_id', $user_id)->get();
        // $ingredients = json_encode($ingredients);
        // return view('recipe.create_recipe')->with('ingredients' , $ingredients);
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
        $recipe->recipe_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/no_image.png";

        clock($request->file('recipe-image-file'));
        if ($request->file('recipe-image-file') != null) {
            $imagefile = $request->file('recipe-image-file');
            // $imagefile =$request->imagefile;
            // $pathの中身は"products/ファイル名.jpeg"　等
            $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
            // $product->pathの中身は上記$pathの画像ファイル名含めたs3のURL
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
        // $editing_target_recipe = Recipe::where('id', $recipe_id)
        // ->with('recipe_ingredients')->get();
        
        // $ingredients = Ingredient::where('user_id', $user_id)->get();
        // return view('recipe.edit_recipe')->with(
        //     [
        //         'editing_target_recipe' => $editing_target_recipe,
        //         'editing_target_recipe_ingredients' => $editing_target_recipe[0]->recipe_ingredients,
        //         'ingredients' => $ingredients,
        //     ]
        // );
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

        clock($request->file('recipe-image-file'));
        if ($request->file('recipe-image-file') == null) {
           return;
        } else {
            $imagefile = $request->file('recipe-image-file');
            // $imagefile =$request->imagefile;
            // $pathの中身は"products/ファイル名.jpeg"　等
            $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
            // $product->pathの中身は上記$pathの画像ファイル名含めたs3のURL
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
