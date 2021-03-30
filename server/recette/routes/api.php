<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function() {
    Route::get('recipes', [RecipeController::class, 'index'])->name('');
});

Route::group(['middleware' => 'api'], function() {
    Route::post('users/{id?}/ingredients/add', [IngredientController::class, 'store'])->name('ingredient.store');
});

Route::group(['middleware' => 'api'], function() {
    Route::post('users/{user_id?}/recipes/{recipe_id?}/add/favorite', [RecipeController::class, 'addFavorite'])->name('recipe.favorite.add');
});

Route::group(['middleware' => 'api'], function() {
    Route::post('users/{user_id?}/recipes/{recipe_id?}/remove/favorite', [RecipeController::class, 'removeFavorite'])->name('recipe.favorite.remove');
});