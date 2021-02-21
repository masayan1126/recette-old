@extends('layouts.app')
@extends('common.navbar')

@section('content')
<div class="container-fluid w-95 mx-auto pt-4">
    <!-- @if (Session::has('save_complete_message'))
    @endif -->
    <top-page :user-id ={{$user_id}} :recipes={{$recipes}} ></top-page>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
    document.getElementById('logout-form').submit();"> Logout </a>
   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
   {{ csrf_field() }}
   </form>
</div>
@endsection