<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Manajemen HKI') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .main-footer {
            box-shadow: 0px 2px 10px rgba(0, 123, 255, 0.3);
        }

        .navbar {
            box-shadow: 0px 2px 10px rgba(0, 123, 255, 0.3);
        }
	.main-sidebar {
  background: linear-gradient(to right, #192A56,#0056b3);
}
   </style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{ asset('profile/' . Auth::user()->image) }}" alt="Profile Image" class="rounded-circle" height="30" width="30">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profil') }}">
                            <i class="fas fa-user"></i> {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item lo" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-white elevation-4" style="background-color: #192A56;">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image" style="margin-right: 20px;">
                <span class="brand-text font-weight-light">SENTRA HKI</span>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link @if ($page == 1) active @endif">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        @auth
                        @auth('admin')
                        <li class="nav-item">
                            <a href="{{ route('users') }}" class="nav-link @if ($page == 5) active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Kelola User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permohonan') }}" class="nav-link @if ($page == 2) active @endif">
                                <i class="nav-icon fas fa-check"></i>
                                <p>
                                    Konfirmasi Permohonan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hakcipta') }}" class="nav-link @if ($page == 4) active @endif">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Sertifikat
                                </p>
                            </a>
                        </li>
                        @elseauth('web')
                        <li class="nav-item">
                            <a href="{{ route('permohonan-form') }}" class="nav-link @if ($page == 3) active @endif">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>
                                    Formulir Permohonan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permohonan') }}" class="nav-link @if ($page == 2) active @endif">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Daftar Permohonan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hakcipta') }}" class="nav-link @if ($page == 4) active @endif">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Sertifikat
                                </p>
                            </a>
                        </li>
                        @endauth
                        @endauth
                    </ul>
                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <br>
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer d-flex justify-content-center">
            <div class="d-none d-sm-inline">
                Sentra HKI Polibatam @2023
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('script')
    <script>
        $(document).ready(function() {
            let table = new DataTable('#datatable');
            $('.lo').on('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Kamu akan keluar dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            });
            $('.alrt').click(function(event) {
                event.preventDefault(); // Mencegah tindakan default dari tombol
                Swal.fire({
                    title: 'Apakah Kamu yakin?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna menekan tombol "Ya", redirect ke halaman action data
                        window.location.href = $(this).attr('href');
                    }
                });
            });
        });
    </script>
    @if (session('success'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('
                success ') }}',
                icon: 'success'
            });
        });
    </script>
    @endif

</body>

</html>
