<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Regular User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .register-container p {
            color: red;
            font-size: 14px;
            margin: 5px 0;
        }

        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .register-container button:hover {
            background-color: #0056b3;
        }

        .login-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Register as Regular User</h2>

        {{-- Display general validation error --}}
        @if ($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('regular_users.register') }}" autocomplete="off">
            @csrf

            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autocomplete="off">
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="off">
            @error('email')
                <p>{{ $message }}</p>
            @enderror

            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <p>{{ $message }}</p>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

            <button type="submit">Register</button>
        </form>

        {{-- Login Redirect --}}
        <a href="{{ route('regular_users.login') }}" class="login-link">Already have an account? Login</a>
    </div>

</body>
</html>
