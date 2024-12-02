<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Pegawai')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            padding-top: 20px;
            padding-left: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar .nav-item {
            margin: 10px 0;
        }

        .sidebar .nav-item a {
            color: #ecf0f1;
            font-size: 16px;
            text-decoration: none;
        }

        .sidebar .nav-item a:hover {
            background-color: #34495e;
            border-radius: 5px;
            color: #fff;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
        }

        /* Content Styles */
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .content.collapsed {
            margin-left: 0;
        }

        header {
            background-color: #34495e;
            padding: 15px;
            color: #ecf0f1;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        .toggle-btn {
            font-size: 30px;
            color: #ecf0f1;
            cursor: pointer;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            width: 18rem;
        }

        .card-header {
            background-color: #ffcc00;
            color: #fff;
            font-weight: bold;
        }

        .card-body {
            background-color: #fff;
        }

        .notification {
            background-color: #ffeb3b;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3 class="text-center" style="color: white;">Admin Panel</h3>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="/pegawai/dashboard" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('pegawai.barang.index') }}" class="nav-link">Kelola Barang</a></li>
            <li class="nav-item"><a href="{{ route('pegawai.transaksi.dashboard') }}" class="nav-link">Kelola Transaksi</a></li>
            <li class="nav-item"><a href="{{ route('pegawai.transaksi.masuk') }}" class="nav-link">Kelola Barang Masuk</a></li>
            <li class="nav-item"><a href="{{ route('pegawai.transaksi.keluar') }}" class="nav-link">Kelola Barang Keluar</a></li>

        </ul>
    </div>

    <!-- Content Area -->
    <div class="content" id="content">
        <!-- Navbar with Toggle Button -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="btn btn-outline-dark" id="sidebarToggleBtn">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="d-flex">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-success" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <header>
            <h1>@yield('header', 'Dashboard Pegawai')</h1>
        </header>
        <div class="content-body">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar visibility
        document.getElementById("sidebarToggleBtn").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("collapsed");
            document.getElementById("content").classList.toggle("collapsed");
        });
    </script>
</body>
</html>
