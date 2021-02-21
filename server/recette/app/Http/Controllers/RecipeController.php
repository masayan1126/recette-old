<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
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

        if ($uri == "recipes") {
            return view('top')->with(
                [
                    'user_id' => $id,
                    'recipes' => $recipes
                ]
            );
        }
        // リスト形式の一覧で全レシピを表示した場合
        return view('recipe.recipe_list')->with(
            [
                'user_id' => $id,
                'recipes' => $recipes
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
        //
        // dd("create");
        return view('recipe.create_recipe')->with('user_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $recipe = new Recipe();
        $imagefile = $request->file('imagefile');
        // $pathの中身は"products/ファイル名.jpeg"　等
        $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
        // $product->pathの中身は上記$pathの画像ファイル名含めたs3のURL
        $recipe->recipe_name = $request->recipe_name;
        $recipe->user_id = $id;
        $recipe->recipe_image_path = Storage::disk('s3')->url($path);
        // $recipe->price = $request->price;
        // $recipe->stock_quantity = $request->stock_quantity;
        $recipe->save();
        //
        $url = url("/users/{$id}/recipes");
        return redirect($url);

        return view('recipe.store_recipe')->with('user_id', $id);
        $recipe_id = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8);
        // dd($recipe_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$recipe_id)
    {
        $target_recipe = Recipe::find($recipe_id);
        // レシピ詳細画面
        return view('recipe.recipe_detail')->with('target_recipe', $target_recipe);

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
        $editing_target_recipe = Recipe::find($recipe_id);
        return view('recipe.edit_recipe')->with('editing_target_recipe', $editing_target_recipe);

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
        $revised_recipe = json_decode($request->revised_recipe);
        // dd($revised_recipe);
        $update_target_recipe = Recipe::where('id',$revised_recipe->id)->first();
        $update_target_recipe->recipe_name = $revised_recipe->revisedRecipeName;
        $update_target_recipe->recipe_image_path = $revised_recipe->revisedRecipeImage;
        // dd($update_target_recipe);
        $update_target_recipe->save();
        $url = url("/users/{$id}/recipes");
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
