<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regular User Login</title>
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

        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .login-container p {
            color: red;
            font-size: 14px;
            margin: 5px 0;
        }

        .login-container .info-message {
            color: orange;
            font-size: 14px;
            margin-top: 10px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
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

        .login-container button:hover {
            background-color: #0056b3;
        }

        .forgot-password, .register-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            text-decoration: none;
        }

        .forgot-password {
            color: #007bff;
        }

        .register-link {
            color: #28a745;
        }

        .forgot-password:hover,
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Regular User Login</h2>

        {{-- Session messages --}}
        @if (session('error'))
            <p>{{ session('error') }}</p>
        @endif

        @if (session('unverified'))
            <p class="info-message">{{ session('unverified') }}</p>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('regular_users.login') }}" autocomplete="off">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="off">
            @error('email')
                <p>{{ $message }}</p>
            @enderror

            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <p>{{ $message }}</p>
            @enderror

            <button type="submit">Login</button>
        </form>

        {{-- Corrected Forgot Password --}}
        <a href="{{ route('regular_users.password.request') }}" class="forgot-password">Forgot Password?</a>

        {{-- Register Redirect --}}
        <a href="{{ route('regular_users.register') }}" class="register-link">Don't have an account? Register here</a>
    </div>

</body>
</html>
