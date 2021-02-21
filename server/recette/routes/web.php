<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'redirect']
);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// レシピ一覧を取得するルーティング
Route::get('/users/{id?}/recipes', [RecipeController::class, 'index'])->name('recipes')->middleware('auth');
Route::get('/users/{id?}/recipes/list', [RecipeController::class, 'index'])->name('recipes')->middleware('auth');
Route::get('/users/{id?}/recipes/create',[RecipeController::class, 'create'])->name('recipe.create')->middleware('auth');
Route::post('/users/{id?}/recipes/store',[RecipeController::class, 'store'])->name('recipe.store')->middleware('auth');
Route::post('/users/{id?}/recipes/update', [RecipeController::class, 'update'])->name('recipe.update')->middleware('auth');
Route::get('/users/{id?}/recipes/{recipe_id?}', [RecipeController::class, 'show'])->name('recipes.detail')->middleware('auth');
Route::get('/users/{id?}/recipes/edit/{recipe_id?}', [RecipeController::class, 'edit'])->name('recipe.edit')->middleware('auth');

// Route::get('/', function () {
//     return view('home');
// });

// // Route::get('/inquiry-list', function () {
// //     return view('inquirylist');
// // });

// Route::get('/input-inquiry', function () {
//     return view('inquiryinput');
// });

// Route::get('/input-inquiry-sub', [GetInquiryController::class, 'getInquiry']);
// // Route::get('/inquiry-list', [GetInquiryController::class, 'getTargetInquiry']);

// Route::get('/inquiry-edit', [EditInquiryController::class, 'getEditTargetInquiry']);
// // Route::get('/inquiry-list', [GetInquiryController::class, 'getTargetInquiry']);

// Route::post('/input-inquiry-complete', [SaveInquiryController::class, 'saveInquiry']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
