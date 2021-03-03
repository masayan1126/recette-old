@extends('layouts.app')

@section('content')
<div class="container-fluid w-95 mx-auto pt-4">
    <!-- @if (Session::has('save_complete_message'))
    @endif -->
    <h3>レシピ詳細</h3>
    <recipe-detail :target-recipe = {{$target_recipe}} 
    :target-recipe-ingredients = {{$target_recipe_ingredients}}></recipe-detail>
</div>
@endsection