<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchRecipeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/reset-password/{token}', [ResetPasswordController::class,'resetPassword'])->name('reset-password');

Route::get('/{any}', function() {
    return view('layouts.app');
})->where('any', '.*');

// // ログイン直後のリダイレクト
// Route::get('/', [HomeController::class, 'redirect']
// );

// // レシピ一覧(検索リスト)
// Route::get('/users/{user_id?}/recipes/category', [SearchRecipeController::class, 'showRecipeCategoryList'])->name('recipe.category')->middleware('auth');

// Route::post('/users/{user_id?}/recipes/category/{category_name?}', [SearchRecipeController::class, 'showRecipeCategoryDetailList'])->name('recipe.category.detail')->middleware('auth');

// // レシピ作成
// Route::get('/users/{user_id?}/recipes/create',[RecipeController::class, 'create'])->name('recipe.create')->middleware('auth');
// // レシピ保存
// Route::post('/users/{user_id?}/recipes/store',[RecipeController::class, 'store'])->name('recipe.store')->middleware('auth');
// // レシピ一覧
// Route::get('/users/{user_id?}/recipes', [RecipeController::class, 'index'])->name('recipe')->middleware('auth');
// // レシピ一覧(リスト)
// Route::get('/users/{user_id?}/recipes/list', [RecipeController::class, 'index'])->name('recipe.list')->middleware('auth');
// // レシピ詳細(1つ)
// Route::get('/users/{user_id?}/recipes/{recipe_id?}', [RecipeController::class, 'show'])->name('recipes.detail')->middleware('auth');
// // レシピ編集
// Route::get('/users/{user_id?}/recipes/edit/{recipe_id?}', [RecipeController::class, 'edit'])->name('recipe.edit')->middleware('auth');
// // レシピ更新
// Route::post('/users/{user_id?}/recipes/update', [RecipeController::class, 'update'])->name('recipe.update')->middleware('auth');
// // レシピ削除
// Route::post('/users/{user_id?}/recipes/delete/{recipe_id?}', [RecipeController::class, 'destroy'])->name('recipe.delete')->middleware('auth');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

