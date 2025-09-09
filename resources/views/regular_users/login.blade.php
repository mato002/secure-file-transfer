@extends('layouts.regular_user')

@section('title', 'Regular User Login')

@section('content')
    <h2 class="mb-4 text-center">Regular User Login</h2>

    {{-- Session messages --}}
    @if (session('error'))
        <p class="text-danger text-center">{{ session('error') }}</p>
    @endif

    @if (session('unverified'))
        <p class="text-warning text-center">{{ session('unverified') }}</p>
    @endif

    {{-- Login Form --}}
    <form method="POST" action="{{ route('regular_users.login') }}" autocomplete="off">
        @csrf

        <input type="email" 
               name="email" 
               placeholder="Email" 
               value="{{ old('email') }}" 
               required 
               class="form-control mb-3">
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <input type="password" 
               name="password" 
               placeholder="Password" 
               required 
               class="form-control mb-3">
        @error('password')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    {{-- Forgot Password --}}
    <div class="mt-3 text-center">
        <a href="{{ route('regular_users.password.request') }}">Forgot Password?</a>
    </div>

    {{-- Register Redirect --}}
    <div class="mt-2 text-center">
        Don’t have an account?  
        <a href="{{ route('regular_users.register') }}">Register here</a>
    </div>
@endsection
