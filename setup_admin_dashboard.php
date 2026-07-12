<?php

@mkdir('app/Http/Controllers/Admin', 0755, true);
@mkdir('resources/views/layouts', 0755, true);
@mkdir('resources/views/admin', 0755, true);
@mkdir('public/css', 0755, true);

// 1. Controller
file_put_contents('app/Http/Controllers/Admin/DashboardController.php', '<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMasyarakat = User::where(\'role\', \'masyarakat\')->count();
        $totalPetugas = User::where(\'role\', \'petugas\')->count();
        $totalKategori = Kategori::count();
        $totalPengaduan = Pengaduan::count();
        
        $pengaduanMenunggu = Pengaduan::where(\'status\', \'Menunggu\')->count();
        $pengaduanDiproses = Pengaduan::where(\'status\', \'Diproses\')->count();
        $pengaduanSelesai = Pengaduan::where(\'status\', \'Selesai\')->count();

        return view(\'admin.dashboard\', compact(
            \'totalMasyarakat\', \'totalPetugas\', \'totalKategori\', \'totalPengaduan\',
            \'pengaduanMenunggu\', \'pengaduanDiproses\', \'pengaduanSelesai\'
        ));
    }
}
');

// 2. Routing
file_put_contents('routes/admin.php', '<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware([\'auth\', \'role.superadmin\'])->name(\'admin.\')->group(function () {
    Route::get(\'dashboard\', [DashboardController::class, \'index\'])->name(\'dashboard\');
});
');

// 3. Layout Blade
$layoutBlade = '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(\'css/admin.css\') }}">
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
                <a href="{{ route(\'admin.dashboard\') }}" class="nav-link active">
                    <i class="ph ph-squares-four"></i> Dashboard
                </a>
                
                <p class="nav-title">MANAJEMEN PENGGUNA</p>
                <a href="#" class="nav-link">
                    <i class="ph ph-users"></i> Masyarakat
                </a>
                <a href="#" class="nav-link">
                    <i class="ph ph-user-circle-gear"></i> Petugas
                </a>
                
                <p class="nav-title">DATA MASTER</p>
                <a href="#" class="nav-link">
                    <i class="ph ph-folders"></i> Kategori
                </a>
                <a href="#" class="nav-link">
                    <i class="ph ph-link"></i> Penugasan
                </a>
                <a href="#" class="nav-link">
                    <i class="ph ph-image"></i> Banner Info
                </a>
                
                <p class="nav-title">PENGADUAN & LAPORAN</p>
                <a href="#" class="nav-link">
                    <i class="ph ph-envelope-open"></i> Semua Pengaduan
                </a>
                <a href="#" class="nav-link">
                    <i class="ph ph-printer"></i> Cetak Laporan
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
                    <button class="icon-btn">
                        <i class="ph ph-bell"></i>
                        <span class="badge">3</span>
                    </button>
                    <div class="user-profile">
                        <div class="avatar">SA</div>
                        <div class="user-info">
                            <span class="name">{{ Auth::user()->name }}</span>
                            <span class="role">Super Admin</span>
                        </div>
                    </div>
                    <form action="{{ route(\'logout\') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="icon-btn logout-btn" title="Logout">
                            <i class="ph ph-sign-out"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-container">
                @yield(\'content\')
            </div>
        </main>
    </div>
</body>
</html>';
file_put_contents('resources/views/layouts/admin.blade.php', $layoutBlade);

// 4. Dashboard Blade
$dashboardBlade = '@extends(\'layouts.admin\')

@section(\'content\')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Ringkasan statistik sistem pengaduan Dispendukcapil.</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card primary-gradient">
        <div class="stat-icon"><i class="ph-fill ph-envelope"></i></div>
        <div class="stat-details">
            <p class="stat-label">Total Pengaduan</p>
            <h2 class="stat-value">{{ $totalPengaduan }}</h2>
        </div>
    </div>
    <div class="stat-card success-gradient">
        <div class="stat-icon"><i class="ph-fill ph-check-circle"></i></div>
        <div class="stat-details">
            <p class="stat-label">Pengaduan Selesai</p>
            <h2 class="stat-value">{{ $pengaduanSelesai }}</h2>
        </div>
    </div>
    <div class="stat-card warning-gradient">
        <div class="stat-icon"><i class="ph-fill ph-clock-countdown"></i></div>
        <div class="stat-details">
            <p class="stat-label">Sedang Diproses</p>
            <h2 class="stat-value">{{ $pengaduanDiproses }}</h2>
        </div>
    </div>
    <div class="stat-card danger-gradient">
        <div class="stat-icon"><i class="ph-fill ph-warning-circle"></i></div>
        <div class="stat-details">
            <p class="stat-label">Menunggu Respon</p>
            <h2 class="stat-value">{{ $pengaduanMenunggu }}</h2>
        </div>
    </div>
</div>

<div class="dashboard-widgets">
    <div class="widget-card">
        <div class="widget-header">
            <h3>Statistik Pengguna</h3>
        </div>
        <div class="widget-body">
            <div class="user-stats">
                <div class="user-stat-item">
                    <div class="icon-box blue"><i class="ph ph-users"></i></div>
                    <div class="info">
                        <h4>{{ $totalMasyarakat }}</h4>
                        <span>Masyarakat</span>
                    </div>
                </div>
                <div class="user-stat-item">
                    <div class="icon-box purple"><i class="ph ph-user-gear"></i></div>
                    <div class="info">
                        <h4>{{ $totalPetugas }}</h4>
                        <span>Petugas</span>
                    </div>
                </div>
                <div class="user-stat-item">
                    <div class="icon-box green"><i class="ph ph-folders"></i></div>
                    <div class="info">
                        <h4>{{ $totalKategori }}</h4>
                        <span>Kategori</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection';
file_put_contents('resources/views/admin/dashboard.blade.php', $dashboardBlade);

// 5. CSS
$css = ':root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --bg-color: #f3f4f6;
    --surface-color: #ffffff;
    --text-main: #1f2937;
    --text-muted: #6b7280;
    --border-color: #e5e7eb;
    
    --grad-primary: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    --grad-success: linear-gradient(135deg, #34d399 0%, #10b981 100%);
    --grad-warning: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    --grad-danger: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
    
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: \'Inter\', sans-serif;
    background-color: var(--bg-color);
    color: var(--text-main);
    -webkit-font-smoothing: antialiased;
}

.app-container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background-color: var(--surface-color);
    border-right: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
    z-index: 10;
}

.sidebar-header {
    height: 70px;
    display: flex;
    align-items: center;
    padding: 0 24px;
    border-bottom: 1px solid var(--border-color);
}

.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
}

.logo i { font-size: 1.5rem; }

.sidebar-nav {
    padding: 24px 16px;
    overflow-y: auto;
}

.nav-title {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-muted);
    letter-spacing: 0.05em;
    margin: 16px 0 8px 12px;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    color: var(--text-muted);
    text-decoration: none;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.2s ease;
    margin-bottom: 4px;
}

.nav-link i { font-size: 1.25rem; }

.nav-link:hover {
    background-color: #f3f4f6;
    color: var(--primary-color);
}

.nav-link.active {
    background: var(--primary-color);
    color: white;
    box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.4);
}

/* Main Content */
.main-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-width: 0;
}

/* Topbar */
.topbar {
    height: 70px;
    background-color: var(--surface-color);
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 32px;
    position: sticky;
    top: 0;
    z-index: 5;
}

.topbar-search {
    display: flex;
    align-items: center;
    gap: 10px;
    background: var(--bg-color);
    padding: 8px 16px;
    border-radius: 20px;
    width: 300px;
}

.topbar-search input {
    border: none;
    background: none;
    outline: none;
    width: 100%;
    font-family: inherit;
    color: var(--text-main);
}

.topbar-search i { color: var(--text-muted); }

.topbar-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.icon-btn {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: var(--text-muted);
    cursor: pointer;
    position: relative;
    transition: color 0.2s;
}

.icon-btn:hover { color: var(--primary-color); }

.badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ef4444;
    color: white;
    font-size: 0.65rem;
    font-weight: bold;
    padding: 2px 5px;
    border-radius: 10px;
    border: 2px solid white;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-left: 20px;
    border-left: 1px solid var(--border-color);
}

.avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: var(--grad-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-info .name { font-weight: 600; font-size: 0.9rem; }
.user-info .role { font-size: 0.75rem; color: var(--text-muted); }

/* Page Content */
.page-container {
    padding: 32px;
    flex: 1;
    overflow-y: auto;
}

.page-header {
    margin-bottom: 32px;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 4px;
}

.page-subtitle {
    color: var(--text-muted);
    font-size: 0.95rem;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    border-radius: 16px;
    padding: 24px;
    color: white;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: var(--shadow-md);
    transition: transform 0.2s;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.primary-gradient { background: var(--grad-primary); }
.success-gradient { background: var(--grad-success); }
.warning-gradient { background: var(--grad-warning); }
.danger-gradient { background: var(--grad-danger); }

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

.stat-details {
    flex: 1;
}

.stat-label {
    font-size: 0.85rem;
    opacity: 0.9;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
}

/* Widgets */
.dashboard-widgets {
    display: grid;
    grid-template-columns: 1fr;
    gap: 24px;
}

.widget-card {
    background: var(--surface-color);
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    overflow: hidden;
}

.widget-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border-color);
}

.widget-header h3 {
    font-size: 1.1rem;
    font-weight: 600;
}

.widget-body {
    padding: 24px;
}

.user-stats {
    display: flex;
    gap: 24px;
}

.user-stat-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: var(--bg-color);
    border-radius: 12px;
    flex: 1;
}

.icon-box {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.icon-box.blue { background: #e0e7ff; color: #4f46e5; }
.icon-box.purple { background: #f3e8ff; color: #9333ea; }
.icon-box.green { background: #dcfce7; color: #16a34a; }

.user-stat-item .info h4 { font-size: 1.25rem; font-weight: 700; }
.user-stat-item .info span { font-size: 0.85rem; color: var(--text-muted); }
';
file_put_contents('public/css/admin.css', $css);

