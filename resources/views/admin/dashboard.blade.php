@extends('layouts.admin')

@section('content')
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
@endsection