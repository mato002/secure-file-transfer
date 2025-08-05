<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - Regular User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .message {
            margin-top: 10px;
            font-size: 14px;
            color: green;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Reset Password</h2>

        @if (session('status'))
            <div class="message">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('regular_user.password.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit">Send Password Reset Link</button>
        </form>
    </div>
</body>
</html>
