@extends('layouts.admin')

@section('content')
<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Semua Pengaduan</h1>
        <p class="page-subtitle">Daftar semua pengaduan yang masuk dari masyarakat.</p>
    </div>
</div>

<div class="widget-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengirim</th>
                    <th>Status</th>
                    <th style="width: 100px;" class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $pengaduan)
                <tr>
                    <td>{{ $loop->iteration + ($pengaduans->currentPage() - 1) * $pengaduans->perPage() }}</td>
                    <td><strong>{{ $pengaduan->judul }}</strong></td>
                    <td class="text-muted">{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                    <td class="text-muted">{{ $pengaduan->user->name ?? '-' }}</td>
                    <td>
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
                    </td>
                    <td class="table-actions text-right">
                        <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="btn-icon text-blue" title="Detail"><i class="ph ph-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">Tidak ada data pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-24" style="border-top: 1px solid var(--border-color);">
        {{ $pengaduans->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
