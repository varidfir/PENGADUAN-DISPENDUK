@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.pengaduan.index') }}" class="btn-secondary text-sm inline-flex align-center gap-2" style="background: transparent; padding: 0; color: var(--text-muted);">
        <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar Pengaduan
    </a>
</div>

<div class="dashboard-widgets" style="grid-template-columns: 2fr 1fr; align-items: start;">
    <!-- Left Column: Details -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <!-- Main Info Card -->
        <div class="widget-card">
            <div class="widget-body">
                <div class="d-flex justify-between align-center mb-4">
                    <div>
                        <h1 class="page-title" style="margin-bottom: 4px;">{{ $pengaduan->judul }}</h1>
                        <p class="text-muted" style="font-size: 0.9rem;">
                            {{ $pengaduan->created_at->translatedFormat('d M Y, H:i') }}
                        </p>
                    </div>
                    <div>
                        @if($pengaduan->status == 'Menunggu')
                            <span class="status-badge" style="background: #fef08a; color: #854d0e;"><i class="ph-fill ph-clock-circle" style="margin-right: 4px;"></i> Menunggu</span>
                        @elseif($pengaduan->status == 'Diproses')
                            <span class="status-badge" style="background: #bfdbfe; color: #1e40af;"><i class="ph-fill ph-spinner-gap" style="margin-right: 4px;"></i> Diproses</span>
                        @elseif($pengaduan->status == 'Selesai')
                            <span class="status-badge completed"><i class="ph-fill ph-check-circle" style="margin-right: 4px;"></i> Selesai</span>
                        @elseif($pengaduan->status == 'Ditolak')
                            <span class="status-badge rejected"><i class="ph-fill ph-x-circle" style="margin-right: 4px;"></i> Ditolak</span>
                        @else
                            <span class="status-badge bg-slate-200">{{ $pengaduan->status }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <span class="status-badge" style="background: var(--bg-color); color: var(--text-main); border: 1px solid var(--border-color);">
                        Kategori: {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                    </span>
                </div>

                <div style="color: var(--text-main);">
                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 8px;">Deskripsi Pengaduan</h3>
                    <p style="white-space: pre-line; line-height: 1.6; color: var(--text-muted);">{{ $pengaduan->deskripsi }}</p>
                </div>

                @if($pengaduan->lampirans && $pengaduan->lampirans->count() > 0)
                    <div class="mt-4 pt-4" style="border-top: 1px solid var(--border-color);">
                        <h3 style="font-size: 1rem; font-weight: 600; margin-bottom: 16px;">Lampiran ({{ $pengaduan->lampirans->count() }})</h3>
                        <div class="d-flex" style="flex-wrap: wrap; gap: 16px;">
                            @foreach($pengaduan->lampirans as $lampiran)
                                <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank" class="btn-secondary d-flex align-center gap-2" style="padding: 8px 16px;">
                                    <i class="ph-fill ph-file text-blue" style="font-size: 1.2rem;"></i>
                                    <span style="font-size: 0.9rem;">Lampiran {{ $loop->iteration }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tanggapan History -->
        <div class="widget-card">
            <div class="widget-header">
                <h3>Riwayat Tanggapan</h3>
            </div>
            <div class="widget-body">
                @if($pengaduan->tanggapans && $pengaduan->tanggapans->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 20px;">
                        @foreach($pengaduan->tanggapans as $tanggapan)
                            <div class="d-flex" style="gap: 16px;">
                                <div class="avatar" style="flex-shrink: 0; width: 40px; height: 40px; background: #e0e7ff; color: #4f46e5;">
                                    {{ strtoupper(substr($tanggapan->user->name ?? 'P', 0, 1)) }}
                                </div>
                                <div style="flex: 1; background: var(--bg-color); padding: 16px; border-radius: 0 12px 12px 12px; border: 1px solid var(--border-color);">
                                    <div class="d-flex justify-between align-center" style="margin-bottom: 8px;">
                                        <span style="font-weight: 600; color: var(--text-main);">{{ $tanggapan->user->name ?? 'Petugas' }}</span>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">{{ $tanggapan->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p style="white-space: pre-line; line-height: 1.5; font-size: 0.95rem; color: var(--text-main);">{{ $tanggapan->tanggapan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph-light ph-chats text-muted" style="font-size: 3rem; margin-bottom: 8px;"></i>
                        <p style="font-size: 0.9rem;">Belum ada tanggapan untuk pengaduan ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column: Sender Info & Log Status -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <!-- Sender Profile Card -->
        <div class="widget-card">
            <div class="widget-header d-flex align-center gap-2">
                <i class="ph ph-user text-blue" style="font-size: 1.2rem;"></i>
                <h3 style="margin: 0;">Informasi Pengirim</h3>
            </div>
            <div class="widget-body">
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div>
                        <span style="display: block; font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Nama Lengkap</span>
                        <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-main);">{{ $pengaduan->user->name ?? '-' }}</span>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">NIK</span>
                        <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-main);">{{ $pengaduan->user->nik ?? '-' }}</span>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">No. Telepon</span>
                        <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-main);">{{ $pengaduan->user->telp ?? '-' }}</span>
                    </div>
                    <div>
                        <span style="display: block; font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Email</span>
                        <span style="font-size: 0.95rem; font-weight: 500; color: var(--text-main);">{{ $pengaduan->user->email ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log Status Card -->
        <div class="widget-card">
            <div class="widget-header d-flex align-center gap-2">
                <i class="ph ph-clock-counter-clockwise text-blue" style="font-size: 1.2rem;"></i>
                <h3 style="margin: 0;">Log Aktivitas Status</h3>
            </div>
            <div class="widget-body">
                @if($pengaduan->logStatuses && $pengaduan->logStatuses->count() > 0)
                    <div style="position: relative; padding-left: 20px; border-left: 2px solid var(--border-color); display: flex; flex-direction: column; gap: 20px;">
                        @foreach($pengaduan->logStatuses as $log)
                            <div style="position: relative;">
                                <!-- Dot -->
                                <div style="position: absolute; left: -27px; top: 4px; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; background: var(--primary-color);"></div>

                                <div>
                                    <div class="d-flex align-center gap-2">
                                        <span style="font-size: 0.95rem; font-weight: 600; color: var(--text-main);">{{ $log->status }}</span>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">{{ $log->created_at->translatedFormat('d M, H:i') }}</span>
                                    </div>
                                    @if($log->keterangan)
                                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px; line-height: 1.5;">{{ $log->keterangan }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph-light ph-clock text-muted" style="font-size: 2.5rem; margin-bottom: 8px;"></i>
                        <p style="font-size: 0.85rem;">Belum ada riwayat aktivitas status.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
