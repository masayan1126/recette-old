<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Ingredient;
use Storage;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //
        $ingredients = Ingredient::where('user_id',$user_id)->get();
        return $ingredients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $vegs = json_decode($request->initialIngredientList)->vegs;
        $meats = json_decode($request->initialIngredientList)->meats;
        $fishes = json_decode($request->initialIngredientList)->fishes;
        $cereals = json_decode($request->initialIngredientList)->cereals;
        $potatoes_starches_beans_mushrooms = json_decode($request->initialIngredientList)->potatoes_starches_beans_mushrooms;

        foreach ($vegs as $veg){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->ingredient_name = $veg->ingredientName;
            $ingredient->ingredient_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/veg.jpeg";
            $ingredient->ingredient_category = $veg->category;
            $ingredient->save();
        }

        
        foreach ($meats as $meat){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->ingredient_name = $meat->ingredientName;
            $ingredient->ingredient_category = $meat->category;
            $ingredient->save();
        }

        foreach ($fishes as $fish){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->ingredient_name = $fish->ingredientName;
            $ingredient->ingredient_category = $fish->category;
            $ingredient->save();
        }

        foreach ($cereals as $cereal){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->ingredient_name = $cereal->ingredientName;
            $ingredient->ingredient_category = $cereal->category;
            $ingredient->save();
        }

        foreach ($potatoes_starches_beans_mushrooms as $potatoes_starches_beans_mushroom){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->ingredient_name = $potatoes_starches_beans_mushroom->ingredientName;
            $ingredient->ingredient_category = $potatoes_starches_beans_mushroom->category;
            $ingredient->save();
        }

        $ingredients = Ingredient::where('user_id',$id)->get();
        return $ingredients;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $ingredient_id)
    {   
        $edited_ingredient = json_decode($request->newIngredient);

        // 新規追加
        if ($ingredient_id == "null") {
            $ingredient = new Ingredient();
            $ingredient->user_id = $user_id;
            $ingredient->ingredient_name = $edited_ingredient->ingredientName;
            $ingredient->ingredient_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/veg.jpeg";
            $ingredient->ingredient_category = $edited_ingredient->ingredientCategory;
            $ingredient->save();
            $ingredients = Ingredient::where('user_id',$user_id)->get();
            return $ingredients;
        }
        
        $update_target_ingredient = Ingredient::where('id',$ingredient_id)->first();
        $update_target_ingredient->ingredient_name = $edited_ingredient->ingredientName;
        $update_target_ingredient->ingredient_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/veg.jpeg";
        $update_target_ingredient->ingredient_category = $edited_ingredient->ingredientCategory;
        $update_target_ingredient->save();

        $ingredients = Ingredient::where('user_id',$user_id)->get();
        clock($ingredients);
        return $ingredients;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$ingredient_id)
    {
        $delete_target_ingredient = Ingredient::where('user_id', $user_id)->where('id', $ingredient_id)->first();
        $delete_target_ingredient->delete();
        $ingredients = Ingredient::where('user_id',$user_id)->get();
        return $ingredients;
    }
}
