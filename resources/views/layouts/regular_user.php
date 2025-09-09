<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regular User Authentication</title>
    <style>
        /* Common Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 350px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-container p {
            color: red;
            font-size: 14px;
            margin: 5px 0;
        }

        .form-container .info-message {
            color: orange;
            font-size: 14px;
            margin-top: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
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

        .form-container button:hover {
            background-color: #0056b3;
        }

        .form-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            text-decoration: none;
        }

        .login-link {
            color: #007bff;
        }

        .forgot-password {
            color: #007bff;
        }

        .register-link {
            color: #28a745;
        }

        .form-link:hover {
            text-decoration: underline;
        }
        
        /* Navigation Tabs */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #e9ecef;
            border-radius: 5px 5px 0 0;
            margin: 0 5px;
        }
        
        .tab.active {
            background-color: #007bff;
            color: white;
        }
        
        /* Form Display */
        .form-content {
            display: none;
        }
        
        .form-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="tabs">
            <div class="tab active" onclick="showForm('register')">Register</div>
            <div class="tab" onclick="showForm('login')">Login</div>
        </div>
        
        <!-- Registration Form -->
        <div id="register-form" class="form-content active">
            <h2>Register as Regular User</h2>
            
            <div id="register-messages">
                <!-- Validation errors would appear here -->
            </div>
            
            <form id="registration-form" autocomplete="off">
                <input type="text" name="name" placeholder="Full Name" required autocomplete="off">
                <p id="name-error" class="error-message"></p>

                <input type="email" name="email" placeholder="Email" required autocomplete="off">
                <p id="email-error" class="error-message"></p>

                <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                <p id="password-error" class="error-message"></p>

                <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">

                <button type="submit">Register</button>
            </form>
            
            <a href="#" onclick="showForm('login')" class="form-link login-link">Already have an account? Login</a>
        </div>
        
        <!-- Login Form -->
        <div id="login-form" class="form-content">
            <h2>Regular User Login</h2>
            
            <div id="login-messages">
                <!-- Session messages would appear here -->
            </div>
            
            <form id="login-form-element" autocomplete="off">
                <input type="email" name="email" placeholder="Email" required autocomplete="off">
                <p id="login-email-error" class="error-message"></p>

                <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                <p id="login-password-error" class="error-message"></p>

                <button type="submit">Login</button>
            </form>
            
            <a href="#" class="form-link forgot-password">Forgot Password?</a>
            <a href="#" onclick="showForm('register')" class="form-link register-link">Don't have an account? Register here</a>
        </div>
    </div>

    <script>
        function showForm(formType) {
            // Hide all forms
            document.querySelectorAll('.form-content').forEach(form => {
                form.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show the selected form
            document.getElementById(formType + '-form').classList.add('active');
            
            // Activate the selected tab
            event.target.classList.add('active');
        }
        
        // Form validation and submission would be handled here
        document.getElementById('registration-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Registration logic would go here
            alert('Registration form submitted! (This is a demo)');
        });
        
        document.getElementById('login-form-element').addEventListener('submit', function(e) {
            e.preventDefault();
            // Login logic would go here
            alert('Login form submitted! (This is a demo)');
        });
    </script>
</body>
</html>