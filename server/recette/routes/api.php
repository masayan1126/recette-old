<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeFavoriteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});

Route::post('/register', [RegisterController::class,'register']);
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class,'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function() {
    Route::get('recipes', [RecipeController::class, 'index'])->name('');
});


Route::group(['middleware' => 'api'], function() {
    Route::post('users/{user_id?}/recipes/add', [RecipeController::class, 'store']);
});

Route::group(['middleware' => 'api'], function() {
    Route::put('users/{user_id?}/recipes/{recipe_id?}/edit', [RecipeController::class, 'update']);
});

Route::group(['middleware' => 'api'], function() {
    Route::delete('users/{user_id?}/recipes/{recipe_id?}/delete', [RecipeController::class, 'destroy']);
});

Route::group(['middleware' => 'api'], function() {
    Route::get('users/{user_id?}/ingredients', [IngredientController::class, 'index'])->name('');
});


Route::group(['middleware' => 'api'], function() {
    Route::post('users/{id?}/ingredients/add', [IngredientController::class, 'store'])->name('ingredient.store');
});

Route::group(['middleware' => 'api'], function() {
    Route::put('account/{user_id?}/edit', [UserController::class, 'edit'])->name('');
});

Route::group(['middleware' => 'api'], function() {
    Route::post('users/{user_id?}/recipes/{recipe_id?}/favorite/add', [RecipeFavoriteController::class, 'addFavorite'])->name('recipe.favorite.add');
});

Route::group(['middleware' => 'api'], function() {
    Route::post('users/{user_id?}/recipes/{recipe_id?}/favorite/remove', [RecipeFavoriteController::class, 'removeFavorite'])->name('recipe.favorite.remove');
});
