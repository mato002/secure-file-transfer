<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Secure File Transfer System')</title>
    <style>
        /* Modern CSS Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Color Variables */
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #3498db;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #1abc9c;
        }

        /* Typography */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f7fa;
            display: flex;
            min-height: 100vh;
        }

        h1, h2, h3, h4 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        /* Sidebar - Professional Style */
        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 1.5rem;
            color: white;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            text-decoration: none;
            margin-bottom: 0.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .sidebar a::before {
            content: "→";
            margin-right: 10px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .sidebar a:hover::before {
            opacity: 1;
        }

        /* Main content area */
        .content {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Top bar - Modern Style */
        .topbar {
            background: white;
            color: var(--dark);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .topbar h1 {
            margin: 0;
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
        }

        /* User dropdown - Enhanced */
        .user-dropdown {
            position: relative;
        }

        .dropdown-btn {
            background: var(--accent);
            border: none;
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dropdown-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .dropdown-btn::after {
            content: "▼";
            font-size: 0.6rem;
            margin-left: 8px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background-color: white;
            min-width: 250px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-content p {
            padding: 0.8rem 1rem;
            margin: 0;
            color: var(--dark);
            border-bottom: 1px solid #eee;
            font-size: 0.9rem;
        }

        .dropdown-content p strong {
            display: inline-block;
            width: 80px;
            color: var(--secondary);
        }

        .dropdown-content form {
            margin: 0;
        }

        .dropdown-content button {
            width: 100%;
            border: none;
            background: var(--danger);
            color: white;
            padding: 0.8rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .dropdown-content button:hover {
            background: #c0392b;
        }

        .user-dropdown:hover .dropdown-content {
            display: block;
        }

        /* Main content container */
        .main-content {
            padding: 2rem;
            flex: 1;
            background-color: white;
            margin: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Professional Table Styling */
        .file-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            margin: 1.5rem 0;
        }

        .file-table th, .file-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .file-table th {
            background-color: var(--accent);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .file-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .file-table tr:hover {
            background-color: #f1f9ff;
        }

        .file-table td {
            vertical-align: middle;
        }

        /* Footer - Professional Style */
        .footer {
            background: var(--primary);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
            font-size: 0.9rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 1rem 0.5rem;
                overflow-x: hidden;
            }
            
            .sidebar h2 {
                font-size: 0;
                padding: 0;
                margin-bottom: 1.5rem;
            }
            
            .sidebar h2::after {
                content: "SFTS";
                font-size: 1rem;
                color: white;

                
            }
            
            .sidebar a {
                justify-content: center;
                padding: 0.8rem 0.2rem;
                font-size: 0;
                margin-bottom: 0.3rem;
            }
            
            .sidebar a::before {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .content {
                margin-left: 70px;
            }
            
            .topbar h1 {
                font-size: 1.2rem;
            }
        }

        /* Utility classes */
        .card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            font-weight: 500;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <!-- Professional Sidebar -->
    <div class="sidebar">
        <h2>Secure File Transfer</h2>
        <a href="{{ route('regular_users.home') }}" title="Home">
            <span>Home</span>
        </a>
        <a href="{{ route('regular_users.key_features') }}" title="Key Features">
            <span>Key Features</span>
        </a>
        <a href="{{ route('regular_users.faqs') }}" title="FAQs">
            <span>FAQs</span>
        </a>
        <a href="{{ route('regular_users.testimonials') }}" title="Testimonials">
            <span>Testimonials</span>
        </a>
        <a href="{{ route('regular_users.contact_us') }}" title="Contact Us">
            <span>Contact Us</span>
        </a>
        <a href="{{ route('regular_users.download_files') }}" title="Download Files">
            <span>Download Files</span>
        </a>
        <a href="{{ route('regular_users.about_us') }}" title="About Us">
            <span>About Us</span>
        </a>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <!-- Top Navigation Bar -->
        <div class="topbar">
            <h1>Secure File Transfer System</h1>

            <!-- User Profile Dropdown -->
            @php
                $user = Auth::guard('regular_user')->user();
            @endphp

            @if($user)
                <div class="user-dropdown">
                    <button class="dropdown-btn">
                        <span>{{ $user->name }}</span>
                    </button>
                    <div class="dropdown-content">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> Regular User</p>
                        <form method="POST" action="{{ route('regular_users.logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="user-dropdown">
                    <button class="dropdown-btn">Guest</button>
                    <div class="dropdown-content">
                        <p>You are not logged in.</p>
                        <a href="{{ route('regular_users.login') }}" class="btn btn-primary" style="display: block; text-align: center; margin: 0.5rem;">Login</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Dynamic Content Section -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Professional Footer -->
        <div class="footer">
            &copy; 2025 Secure File Transfer System | All Rights Reserved | v1.0.0
        </div>
    </div>

</body>
</html>