@extends('layouts.regular_user')

@section('title', 'Register as Regular User')

@section('content')
    <h2 class="mb-4 text-center">Register as Regular User</h2>

    {{-- Display general validation error --}}
    @if ($errors->any())
        <p class="text-danger text-center">{{ $errors->first() }}</p>
    @endif

    {{-- Registration Form --}}
    <form method="POST" action="{{ route('regular_users.register') }}" autocomplete="off">
        @csrf

        <input type="text" 
               name="name" 
               placeholder="Full Name" 
               value="{{ old('name') }}" 
               required 
               class="form-control mb-3">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror

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

        <input type="password" 
               name="password_confirmation" 
               placeholder="Confirm Password" 
               required 
               class="form-control mb-3">

        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>

    {{-- Login Redirect --}}
    <div class="mt-3 text-center">
        Already have an account?  
        <a href="{{ route('regular_users.login') }}">Login</a>
    </div>
@endsection
