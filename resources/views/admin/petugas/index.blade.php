@extends('layouts.admin')
@section('content')
<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Data Petugas & Penugasan</h1>
        <p class="page-subtitle">Kelola petugas dan kategori pengaduan yang ditanganinya.</p>
    </div>
    <a href="{{ route('admin.petugas.create') }}" class="btn-primary">
        <i class="ph ph-plus"></i> Tambah Petugas
    </a>
</div>

@if(session('success'))
<div class="alert-success mb-4">
    <i class="ph-fill ph-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="widget-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Petugas</th>
                    <th>Email</th>
                    <th>Kategori Ditangani</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                <tr>
                    <td><strong>{{ $p->name }}</strong></td>
                    <td class="text-muted">{{ $p->email }}</td>
                    <td>
                        @if($p->kategoris->count() > 0)
                            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                @foreach($p->kategoris as $kategori)
                                    <span style="font-size: 0.75rem; background: var(--bg-color); border: 1px solid var(--border-color); padding: 4px 10px; border-radius: 20px; color: var(--text-main);">
                                        {{ $kategori->nama_kategori }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <span style="font-size: 0.8rem; color: #ef4444; background: #fee2e2; padding: 4px 10px; border-radius: 20px;">Belum ada penugasan</span>
                        @endif
                    </td>
                    <td class="table-actions">
                        <a href="{{ route('admin.petugas.edit', $p->id) }}" class="btn-icon text-blue" title="Edit Petugas & Penugasan"><i class="ph ph-pencil-simple"></i></a>
                        <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus petugas ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon text-red" title="Hapus"><i class="ph ph-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada data petugas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection