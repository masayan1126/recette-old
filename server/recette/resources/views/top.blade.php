@extends('layouts.app')
@extends('common.navbar')
@extends('common.navbar_top')
@extends('common.navbar_top_hamburger')

@section('content')
<div class="container">
    <!-- @if (Session::has('save_complete_message'))
    @endif -->
    <top-page :user-id ={{$user_id}} :recipes={{$recipes}} :ingredients={{$ingredients}}></top-page>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
    document.getElementById('logout-form').submit();"> Logout </a>
   
</div>
@endsection