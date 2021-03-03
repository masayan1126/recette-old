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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // レシピ一覧を取得し表示する
    public function index($id)
    {   
        // 現在のURLを取得し、表示画面を分岐させる
        $uri = rtrim($_SERVER["REQUEST_URI"], '/');
        $uri = substr($uri, strrpos($uri, '/') + 1);

        // 通常のトップ画面の一覧で全レシピを表示した場合
        $recipes = Recipe::where('user_id', $id)->get();
        $ingredients = Ingredient::where('user_id', $id)->get();

        if ($uri == "recipes") {
            return view('top')->with(
                [
                    'user_id' => $id,
                    'recipes' => $recipes,
                    'ingredients' => $ingredients,
                ]
            );
        }
        // リスト形式の一覧で全レシピを表示した場合
        return view('recipe.recipe_list')->with(
            [
                'user_id' => $id,
                'recipes' => $recipes,
                'ingredients' => $ingredients,
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ingredients = Ingredient::where('user_id', $id)->get();
        $ingredients = json_encode($ingredients);
        // dd($ingredients);
        return view('recipe.create_recipe')->with('ingredients' , $ingredients);

        // return view('recipe.recipe_detail')->with(
        //     ['target_recipe' => $target_recipe, 'target_ingredients' => $target_ingredients],
        // );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $new_recipe = json_decode($request->newRecipe);
        $recipe = new Recipe();
        $imagefile = $request->file('imagefile');
        // $pathの中身は"products/ファイル名.jpeg"　等
        $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
        // $product->pathの中身は上記$pathの画像ファイル名含めたs3のURL
        $recipe->recipe_name = $request->recipe_name;
        $recipe->user_id = $id;
        $recipe->recipe_image_path = Storage::disk('s3')->url($path);
        $recipe->save();
        $last_insert_id = $recipe->id; 
        $recipe = Recipe::find($last_insert_id);

        foreach ($new_recipe->ingredients as $ingredient) {
            $recipe->recipe_ingredients()->saveMany([
                new RecipeIngredient([
                    'recipe_ingredient_name' => $ingredient->ingredientName, 
                    'recipe_ingredient_type' => 'testtype'
                ])
            ]);
        }

        $url = url("/users/{$id}/recipes");
        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$recipe_id)
    
    {
        // $target_recipe = Recipe::find($recipe_id);
        // (widh('モデルファイルのリレーション<メソッド>名'))
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$recipe_id)
    {
        //
        $editing_target_recipe = Recipe::where('id', $recipe_id)
        ->with('recipe_ingredients')->get();
        // dd($editing_target_recipe);

        // $editing_target_recipe = Recipe::find($recipe_id);
        // $editing_target_ingredients = Recipe::find($recipe_id)->ingredients()
        // ->where('recipe_id', $recipe_id)
        // ->get();
        return view('recipe.edit_recipe')->with(
            [
                'editing_target_recipe' => $editing_target_recipe,
                'editing_target_recipe_ingredients' => $editing_target_recipe[0]->recipe_ingredients
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edited_recipe = json_decode($request->editedRecipe);
        $imagefile = $request->file('imagefile');
        $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
        $update_target_recipe = Recipe::where('id',$edited_recipe->id)->first();
        $update_target_recipe->recipe_name = $edited_recipe->editedRecipeName;
        $update_target_recipe->recipe_image_path = Storage::disk('s3')->url($path);
        $update_target_recipe->save();
        $url = url("/users/{$id}/recipes/{$edited_recipe->id}");
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
