@extends('layouts.default')
@section('miq')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
            <div class="formclass"> 
                 <h1 id="SignUpTitle" >Sign up with your email address</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
                <p><input  type="text" placeholder="name" name="name" :value="old('name')" required autofocus /></p>
                <p><input  type="text" placeholder="surname" name="surname" :value="old('surname')" required autofocus /></p>
            <!-- Email Address -->
                <p><input  id="email" type="email" placeholder="E-mail" name="email" :value="old('email')" required/></p>
            <!-- Password -->
                <p><input id="password" type="password"  placeholder="password" name="password" required autocomplete="new-password" /></p>
            <!-- Confirm Password -->
            <p><input id="password_confirmation" placeholder="password confirmation"  type="password" name="password_confirmation" required/></p>
            <!--   après   -->
                <p><a class="RoadToLogIn" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                    <br/>
                </a></p>
                <x-button id="formSend">{{ __('Register') }}</x-button>
                <p id="privacy">By creating an account, you agree to KatchMyPastimes's Conditions of Use and Privacy Notice.</p>
        </form>
    </div> 
    </x-auth-card>
</x-guest-layout>
@endsection

