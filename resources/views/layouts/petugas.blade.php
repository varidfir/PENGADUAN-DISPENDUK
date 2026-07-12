<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="app-container flex h-screen bg-slate-50">
        <!-- Sidebar -->
        <aside class="sidebar w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex">
            <div class="sidebar-header h-16 flex items-center px-6 border-b border-slate-200">
                <div class="logo flex items-center gap-3">
                    <div class="w-8 h-8 rounded bg-blue-600 flex items-center justify-center text-white">
                        <i class="ph-fill ph-shield-check text-xl"></i>
                    </div>
                    <span class="font-bold text-lg font-outfit text-slate-800">SIPPEL</span>
                </div>
            </div>

            <nav class="sidebar-nav flex-1 overflow-y-auto py-4 px-3">
                <p class="nav-title text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2 px-3">MENU UTAMA</p>
                <a href="{{ route('petugas.dashboard') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors {{ request()->routeIs('petugas.dashboard') ? 'bg-blue-50 text-blue-600 font-medium' : '' }}">
                    <i class="ph ph-squares-four text-lg"></i> Dashboard
                </a>
                <a href="{{ route('petugas.pengaduan.index') }}" class="nav-link flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-colors {{ request()->routeIs('petugas.pengaduan.*') ? 'bg-blue-50 text-blue-600 font-medium' : '' }}">
                    <i class="ph ph-folder-open text-lg"></i> Pengaduan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="topbar h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0">
                <div class="topbar-search flex items-center gap-2 bg-slate-50 px-4 py-2 rounded-lg w-64 border border-slate-200 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition-all">
                    <i class="ph ph-magnifying-glass text-slate-400"></i>
                    <input type="text" placeholder="Cari sesuatu..." class="bg-transparent border-none outline-none w-full text-sm text-slate-700">
                </div>
                <div class="topbar-actions flex items-center gap-4">
                    <div class="user-profile flex items-center gap-3 border-l border-slate-200 pl-4">
                        <div class="avatar w-8 h-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="user-info hidden md:block">
                            <div class="name text-sm font-semibold text-slate-800 leading-none mb-1">{{ Auth::user()->name }}</div>
                            <div class="role text-xs text-slate-500 leading-none">Petugas</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="icon-btn logout-btn text-slate-400 hover:text-red-500 transition-colors ml-2" title="Logout">
                            <i class="ph ph-sign-out text-xl"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-container flex-1 overflow-y-auto p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
