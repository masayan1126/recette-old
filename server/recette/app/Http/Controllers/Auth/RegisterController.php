<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => 'https://recipe-img-bucket.s3.ap-northeast-1.amazonaws.com/recipes/0pdUPVdJClFiXVfTDLyKymHqKHDXbSSPWUOLnuDC.png',
        ]);

        $user = User::find($user->id);
        Auth::login($user, true);
    }
}
