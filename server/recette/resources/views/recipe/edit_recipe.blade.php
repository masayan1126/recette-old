@extends('layouts.app')

@section('content')
<div class="container-fluid w-95 mx-auto pt-4">
    <!-- @if (Session::has('save_complete_message'))
    @endif -->
    <edit-recipe 
        :editing-target-recipe={{$editing_target_recipe}} 
        :editing-target-recipe-ingredients={{$editing_target_recipe_ingredients}}>
    </edit-recipe>
</div>
@endsection