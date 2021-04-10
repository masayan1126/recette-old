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
            $ingredient->recipe_ingredient_name = $veg->ingredientName;
            $ingredient->recipe_ingredient_image_path = "https://recipe-img-bucket.s3-ap-northeast-1.amazonaws.com/recipes/veg.jpeg";
            $ingredient->recipe_ingredient_category = $veg->category;
            $ingredient->save();
        }

        foreach ($meats as $meat){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->recipe_ingredient_name = $meat->ingredientName;
            $ingredient->recipe_ingredient_category = $meat->category;
            $ingredient->save();
        }

        foreach ($fishes as $fish){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->recipe_ingredient_name = $fish->ingredientName;
            $ingredient->recipe_ingredient_category = $fish->category;
            $ingredient->save();
        }

        foreach ($cereals as $cereal){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->recipe_ingredient_name = $cereal->ingredientName;
            $ingredient->recipe_ingredient_category = $cereal->category;
            $ingredient->save();
        }

        foreach ($potatoes_starches_beans_mushrooms as $potatoes_starches_beans_mushroom){
            $ingredient = new Ingredient();
            $ingredient->user_id = $id;
            $ingredient->recipe_ingredient_name = $potatoes_starches_beans_mushroom->ingredientName;
            $ingredient->recipe_ingredient_category = $potatoes_starches_beans_mushroom->category;
            $ingredient->save();
        }

        $ingredients = Ingredient::where('user_id', $id)->get();        
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
    public function update(Request $request, $id)
    {
        //
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
