<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Secure File Transfer System</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            flex-direction: column;
            background-color: #f5f7fa;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 15px 5px;
            height: 100vh;
            position: fixed;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            text-align: center;
            padding: 20px 10px;
            margin-bottom: 30px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ecf0f1;
        }

        .sidebar-header p {
            margin: 5px 0 0;
            font-size: 0.85rem;
            color: #bdc3c7;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px 15px;
            font-size: 16px;
            margin-bottom: 8px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar ul li:hover {
            background: #1a252f;
        }

        .sidebar ul li.active {
            background: #3498db;
        }
        
        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: calc(100% - 250px);
            top: 0;
            left: 250px;
            height: 70px;
            z-index: 10;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
        }

        .top-bar-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-left: 15px;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item a {
            color: #7f8c8d;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #3498db;
        }

        /* Admin Profile Section */
        .profile-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .profile-info {
            margin-right: 15px;
            text-align: right;
        }

        .profile-info .name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .profile-info .role {
            font-size: 0.8rem;
            color: #7f8c8d;
        }

        .profile-dropdown img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid #ecf0f1;
            cursor: pointer;
            object-fit: cover;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 60px;
            background: #fff;
            width: 220px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            z-index: 100;
            border: none;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-menu div {
            padding: 12px 15px;
            color: #2c3e50;
            border-bottom: 1px solid #ecf0f1;
        }

        .dropdown-menu div:last-child {
            border-bottom: none;
        }

        .dropdown-menu .logout a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: 600;
            display: block;
            text-align: center;
            padding: 12px;
        }

        .dropdown-menu .logout a:hover {
            background: #fdecea;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            margin-top: 70px; /* Adjust for top bar */
            padding: 25px;
            width: calc(100% - 250px);
            min-height: calc(100vh - 120px); /* Adjusted for footer */
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .content-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .content-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            margin-bottom: 30px;
        }

        /* Table Styling */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .file-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .file-table th, .file-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        .file-table th {
            background: #3498db;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        .file-table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .file-table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .file-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .no-records {
            text-align: center;
            color: #95a5a6;
            font-weight: 500;
            padding: 30px;
            font-size: 1.1rem;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .pagination a {
            padding: 8px 15px;
            margin: 0 5px;
            text-decoration: none;
            background: #3498db;
            color: white;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .pagination a:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .pagination .active {
            background: #2980b9;
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            margin-left: 250px;
            width: calc(100% - 250px);
            font-size: 0.9rem;
        }

        .footer p {
            margin: 0;
        }

        /* Badges */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-success {
            background: #2ecc71;
            color: white;
        }

        .badge-warning {
            background: #f39c12;
            color: white;
        }

        .badge-danger {
            background: #e74c3c;
            color: white;
        }

        /* Buttons */
        .btn {
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #3498db;
            color: white;
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-shield-alt"></i> SFTS</h2>
            <p>Secure File Transfer System</p>
        </div>
        <ul>
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Manage Users</a>
            </li>
            <li class="{{ request()->routeIs('admin.files.*') ? 'active' : '' }}">
                <a href="{{ route('admin.files.index') }}"><i class="fas fa-file-upload"></i> File Uploads</a>
            </li>
            <li class="{{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                <a href="{{ route('admin.logs.index') }}"><i class="fas fa-clipboard-list"></i> System Logs</a>
            </li>
            <li class="{{ request()->routeIs('admin.reports.file_transfer.*') ? 'active' : '' }}">
                <a href="{{ route('admin.reports.file_transfer.index') }}"><i class="fas fa-exchange-alt"></i> Transfer Reports</a>
            </li>
            <li class="{{ request()->routeIs('admin.reports.storage_usage.*') ? 'active' : '' }}">
                <a href="{{ route('admin.reports.storage_usage.index') }}"><i class="fas fa-database"></i> Storage Reports</a>
            </li>
            <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a href="{{ route('admin.settings.index') }}"><i class="fas fa-cog"></i> Settings</a>
            </li>
        </ul>
    </div>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @yield('breadcrumbs')
                </ol>
            </nav>
        </div>
        
        <div class="profile-dropdown" onclick="toggleDropdown()">
            <div class="profile-info">
                <div class="name">{{ Auth::user()->name }}</div>
                <div class="role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
            <img src="{{ asset('images/admin-avatar.png') }}" alt="Admin">
            <div class="dropdown-menu" id="dropdownMenu">
                <div><i class="fas fa-user-circle me-2"></i> My Profile</div>
                <div><i class="fas fa-envelope me-2"></i> Messages</div>
                <div><i class="fas fa-cog me-2"></i> Account Settings</div>
                <div class="view-website">
                    <a href="{{ route('regular_users.dashboard') }}" target="_blank"><i class="fas fa-external-link-alt me-2"></i> View Website</a>
                </div>
                <div class="logout">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-header">
            <h1 class="content-title">@yield('title')</h1>
            @yield('actions')
        </div>
        
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Secure File Transfer System. Developed by Stephen. All rights reserved.</p>
    </footer>

    <script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.classList.toggle("active");
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        var dropdown = document.getElementById("dropdownMenu");
        var profileDropdown = document.querySelector(".profile-dropdown");
        
        if (!profileDropdown.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove("active");
        }
    });
    </script>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>