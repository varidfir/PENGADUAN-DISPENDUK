<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="ph-fill ph-shield-check"></i>
                    <span>SIPPEL</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <p class="nav-title">MAIN MENU</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="ph ph-squares-four"></i> Dashboard
                </a>

                <p class="nav-title">MANAJEMEN PENGGUNA</p>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="ph ph-users"></i> Masyarakat
                </a>
                <a href="{{ route('admin.petugas.index') }}" class="nav-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                    <i class="ph ph-user-circle-gear"></i> Petugas & Penugasan
                </a>

                <p class="nav-title">DATA MASTER</p>
                <a href="{{ route('admin.kategoris.index') }}" class="nav-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}">
                    <i class="ph ph-folders"></i> Kategori
                </a>
                <a href="{{ route('admin.banners.index') }}"
                   class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                    <i class="ph ph-image"></i> Banner Info
                </a>

                <p class="nav-title">PENGADUAN & LAPORAN</p>
                <a href="{{ route('admin.pengaduan.index') }}" class="nav-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    <i class="ph ph-envelope-open"></i> Semua Pengaduan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-search">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" placeholder="Cari sesuatu...">
                </div>
                <div class="topbar-actions">
                    <div class="user-profile">
                        <div class="avatar">SA</div>
                        <div class="user-info">
                            <span class="name">{{ Auth::user()->name }}</span>
                            <span class="role">Super Admin</span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="icon-btn logout-btn" title="Logout">
                            <i class="ph ph-sign-out"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>