<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> <!-- ✅ Add custom.css -->

    @stack('styles') <!-- ✅ Ensures Blade-styled content loads properly -->

    <style>
        /* ✅ General Reset */
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        /* ✅ Sidebar Styling */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover, .sidebar ul li a.active {
            background: #1a252f;
        }

        /* ✅ Top Bar */
        .top-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px;
            background: #ecf0f1;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: calc(100% - 250px);
            top: 0;
            left: 250px;
            height: 50px;
            z-index: 10;
        }

        /* ✅ Profile Dropdown */
        .profile-dropdown {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-dropdown img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background: #2c3e50;
            width: 220px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            overflow: hidden;
            z-index: 100;
        }

        .dropdown-menu.active {
            display: block;
        }

        .dropdown-menu div {
            padding: 12px;
            color: white;
            border-bottom: 1px solid #34495e;
        }

        .dropdown-menu div:last-child {
            border-bottom: none;
        }

        .dropdown-menu .logout a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
            display: block;
            text-align: center;
            padding: 12px;
        }

        .dropdown-menu .logout a:hover {
            background: #c0392b;
        }

        /* ✅ Main Content */
        .main-content {
            margin-left: 250px;
            margin-top: 60px; /* Adjust for top bar */
            padding: 20px;
            width: calc(100% - 250px);
            min-height: calc(100vh - 60px);
            display: flex;
            justify-content: center;
        }

        .content-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            text-align: center;
        }

        /* ✅ Table Styling */
        .table {
            width: 100%;
            margin-top: 20px;
            font-size: 14px;
        }

        .table th, .table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background: #34495e;
            color: white;
            text-transform: uppercase;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>SECURE FILE TRANSFER SYSTEM</h2>
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li>
            <li><a href="{{ route('admin.files.index') }}">File Uploads</a></li>
            <li><a href="{{ route('admin.logs.index') }}">System Logs</a></li>
            <li><a href="{{ route('admin.reports.file_transfer.index') }}">File Transfer Report</a></li>
            <li><a href="{{ route('admin.reports.storage_usage.index') }}">Storage Usage Report</a></li>
            <li><a href="{{ route('admin.settings.index') }}">Settings</a></li>
        </ul>
    </div>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="profile-dropdown" onclick="toggleDropdown()">
            <img src="{{ asset('images/admin-avatar.png') }}" alt="Admin">
            <div class="dropdown-menu" id="dropdownMenu">
                <div><strong>{{ Auth::user()->name }}</strong></div>
                <div>{{ Auth::user()->email }}</div>
                <div>Role: {{ Auth::user()->role }}</div>
                <div class="logout">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-box">
            @yield('content')
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        function toggleDropdown() {
            document.getElementById("dropdownMenu").classList.toggle("active");
        }

        document.addEventListener("click", function(event) {
            let dropdown = document.getElementById("dropdownMenu");
            let profile = document.querySelector(".profile-dropdown img");
            if (!profile.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove("active");
            }
        });
    </script>

</body>
</html>
