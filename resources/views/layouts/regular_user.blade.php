<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Regular User')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            height: 100vh;
            display: flex;
            background: #f8f9fa;
        }

        .overlay {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        .left-side {
            flex: 1;
            background: linear-gradient(135deg, rgba(78, 115, 223, 0.85), rgba(34, 74, 190, 0.9)), 
                        url('https://images.unsplash.com/photo-1621905252507-b35492cc74b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 50px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,218.7C672,224,768,160,864,138.7C960,117,1056,139,1152,149.3C1248,160,1344,160,1392,160L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") bottom/cover no-repeat;
        }

        .left-content {
            position: relative;
            z-index: 1;
            max-width: 500px;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 32px;
            margin-right: 15px;
            color: white;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
        }

        .left-side h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .left-side p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .features-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        .features-list i {
            margin-right: 12px;
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right-side {
            flex: 1;
            background: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-top: 5px solid #4e73df;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            color: #4e73df;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #6c757d;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            padding: 12px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #3b5cc9;
            border-color: #3b5cc9;
        }

        .auth-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
        }

        .auth-footer a {
            color: #4e73df;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .overlay {
                flex-direction: column;
            }
            
            .left-side {
                padding: 30px;
                text-align: center;
                align-items: center;
            }
            
            .left-content {
                max-width: 100%;
            }
            
            .right-side {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="overlay">
        <!-- Left section with background -->
        <div class="left-side">
            <div class="left-content">
                <div class="logo">
                    <div class="logo-icon"><i class="fas fa-lock"></i></div>
                    <div class="logo-text">SFT</div>
                </div>
                <h1>Secure File Transfer</h1>
                <p>Access your account, register, or log in to continue using our secure platform.</p>
                
                <ul class="features-list">
                    <li><i class="fas fa-shield-alt"></i> Military-grade encryption</li>
                    <li><i class="fas fa-bolt"></i> Lightning-fast transfers</li>
                    <li><i class="fas fa-chart-line"></i> Detailed activity reports</li>
                    <li><i class="fas fa-cloud-upload-alt"></i> Easy file sharing</li>
                </ul>
            </div>
        </div>

        <!-- Right section with form -->
        <div class="right-side">
            <div class="auth-container">
                <div class="auth-header">
                    <h2>@yield('form-title', 'User Authentication')</h2>
                    <p>@yield('form-subtitle', 'Access your account to continue')</p>
                </div>
                
                @yield('content')
                
                <div class="auth-footer">
                    @yield('auth-footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>