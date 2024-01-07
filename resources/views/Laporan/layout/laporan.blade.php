<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('.../.../.../img/logo.png')}}" type="image/x-icon">
    <title>Your Admin Panel</title>
    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous">
    </script>

<!-- Datatable from CDN -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <!-- AdminLTE CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item ml-auto">
                    <a  href="#" class="btn btn-danger">Logout</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Add your custom navbar items here -->
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="brand">
                    <img src="{{ asset('img/logo-full.png') }}" alt="Your Logo" class="logo-img mb-3 mt-3" style="width: 100%">
                </div>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <!-- Master User Menu Item -->
                    <li class="nav-item">
                        <a href="/laporan/penjualan" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Laporan Penjualan
                            </p>
                        </a>
                    </li>

                    <!-- Master Supplier Menu Item -->
                    <li class="nav-item">
                        <a href="/laporan/product" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Laporan Product
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/laporan/retur" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Laporan Retur
                            </p>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <!-- Add Content Header Content Here -->
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Add Main Content Here -->
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Add Footer Content Here -->
        </footer>
    </div>

    <!-- Tambahkan JS AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>


    let table = new DataTable('#myTable');
    </script>
</body>
</html>
