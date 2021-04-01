<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\User;
use App\Models\RecipeIngredient;
use App\Models\Ingredient;
use Storage;

class UserController extends Controller
{
    //
    public function edit(Request $request,$user_id)
    {
        $user = User::where('id',$user_id)->first();
        $user->name =$request->userName;
        $user->save();
        return $user;
    }
}
