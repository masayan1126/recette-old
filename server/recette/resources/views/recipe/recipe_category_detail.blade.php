@extends('layouts.app')

@section('content')
<div class="container-fluid w-95 mx-auto pt-4">
    <!-- @if (Session::has('save_complete_message'))
    @endif -->
    <recipe-category-detail :recipes={{$recipes}}></recipe-category-detail>
</div>
@endsection