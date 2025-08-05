@extends('admin.layout')

@section('title', 'Create User')

@section('content')
    <h2>Create New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Create User</button>
    </form>
@endsection
