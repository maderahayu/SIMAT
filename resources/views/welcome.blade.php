@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-color: #164B60; height:563px; width:100%">
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-4 text-right z-10 pt-4" >
        @auth
            @if(auth()->user()->is_admin == 1)
                <a href="{{ url('/supervisor/home') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            @else
                <a href="{{ url('/magang/home') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
            @endif

            @else
                <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endauth
    </div>
    @endif
    
    <div class="col-md-12 text-center pt-5">
        <img src="{{ asset('img/logo.png') }}" alt="logo">
    </div>
</div>
@endsection