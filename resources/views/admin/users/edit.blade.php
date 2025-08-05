@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
    <div class="edit-user-container">
        <h2>Edit User</h2>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="edit-user-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <button type="submit">Update User</button>
        </form>
    </div>

    <style>
        /* Center the form */
        .edit-user-container {
            width: 100%;
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Form styling */
        .edit-user-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
@endsection
