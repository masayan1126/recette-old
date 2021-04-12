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
        $newUserData = json_decode($request->newUserData);
        clock($newUserData);
        $user = User::where('id',$user_id)->first();
        $user->name =$newUserData->userName;
        $user->email =$newUserData->email;

        if ($request->file('profile-image-file') != null) {
            $imagefile = $request->file('profile-image-file');
            // $pathの中身は"products/ファイル名.jpeg"　等
            $path = Storage::disk('s3')->putFile('/recipes', $imagefile, 'public');
            // $product->pathの中身は上記$pathの画像ファイル名含めたs3のURL
            $user->profile_photo_path = Storage::disk('s3')->url($path);
        }

        $user->save();
        return $user;
    }
}
