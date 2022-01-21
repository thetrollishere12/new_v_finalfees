@extends('layouts.noapp')
@section('title')
    Login
@endsection()
@section('others')
<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
    <div class="header">{{ __('Login') }}</div>
    <x-jet-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="flex items-center">
                <x-jet-checkbox id="remember_me" name="remember" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-jet-button class="ml-4">
                {{ __('Log in') }}
            </x-jet-button>
        </div>

        <a href="{{ url('google-login') }}">
            <x-google-login-button></x-google-login-button>
        </a>

        <br>
        <hr>
        <div class="text-center text-sm py-5 text-gray-600">Don't have an account?</div>
        <div class="text-center pb-2">
            <a href="{{ url('register') }}">
                <button type="button" class="border rounded-full px-10 py-1 main-bg-c text-white text-sm main-b-c duration-100 focus:outline-none">Sign Up</button>
            </a>
        </div>


    </form>
</div>



@endsection
