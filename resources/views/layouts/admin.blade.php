<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | LDII Sumedang</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    <style>
        body,
        .nav-sidebar .nav-link,
        .brand-text {
            font-family: 'Inter', sans-serif !important;
        }

        .brand-link {
            background-color: #15803d !important;
        }

        .main-sidebar {
            background-color: #166534 !important;
        }

        .nav-sidebar .nav-link.active {
            background-color: #16a34a !important;
        }

        .nav-sidebar .nav-link:hover {
            background-color: #15803d !important;
        }

        .nav-sidebar .nav-link,
        .nav-sidebar .nav-header {
            color: #dcfce7 !important;
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- NAVBAR TOP --}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fas fa-user-circle mr-1"></i>
                        {{ auth()->user()->full_name }}
                        <span class="badge badge-success ml-1">{{ auth()->user()->getRoleNames()->first() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit mr-2"></i> Edit Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        {{-- SIDEBAR --}}
        <aside class="main-sidebar sidebar-dark-success elevation-4">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-bold">LDII Sumedang</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header">KONTEN</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.berita.index') }}"
                                class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>Berita</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.event.index') }}"
                                class="nav-link {{ request()->routeIs('admin.event.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Event</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.portfolio.index') }}"
                                class="nav-link {{ request()->routeIs('admin.portfolio.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>Portfolio</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.galeri.index') }}"
                                class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-images"></i>
                                <p>Galeri</p>
                            </a>
                        </li>

                        <li class="nav-header">INTERAKSI</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.komentar.index') }}"
                                class="nav-link {{ request()->routeIs('admin.komentar.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>Komentar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.feedback.index') }}"
                                class="nav-link {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Kritik & Saran</p>
                            </a>
                        </li>

                        {{-- Hanya Admin --}}
                        @role('admin')
                        <li class="nav-header">MANAJEMEN</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Kelola User</p>
                            </a>
                        </li>
                        @endrole

                        <li class="nav-header">WEBSITE</li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                                <i class="nav-icon fas fa-external-link-alt"></i>
                                <p>Lihat Website</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        {{-- CONTENT WRAPPER --}}
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">

                    {{-- Flash Messages --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <footer class="main-footer">
            <strong>&copy; {{ date('Y') }} LDII Sumedang.</strong> All rights reserved.
        </footer>

    </div>

    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

    @stack('scripts')
</body>

</html>