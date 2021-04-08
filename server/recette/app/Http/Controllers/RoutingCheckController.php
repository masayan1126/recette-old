<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RoutingCheckController extends Controller
{
    //
    public function check(Request $request)
    {   
        clock($request->id);
        $data = Recipe::where('id', $request->id)->get();
        return $data;
    }
}
