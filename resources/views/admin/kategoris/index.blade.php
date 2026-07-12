@extends('layouts.admin')
@section('content')
<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Kategori Pengaduan</h1>
        <p class="page-subtitle">Kelola kategori layanan pengaduan Dispendukcapil.</p>
    </div>
    <a href="{{ route('admin.kategoris.create') }}" class="btn-primary">
        <i class="ph ph-plus"></i> Tambah Kategori
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
                    <th style="width: 80px;">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $kategori->nama_kategori }}</strong></td>
                    <td class="text-muted">{{ $kategori->deskripsi ?? '-' }}</td>
                    <td class="table-actions">
                        <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="btn-icon text-blue" title="Edit"><i class="ph ph-pencil-simple"></i></a>
                        <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini? Semua relasi penugasan terkait akan ikut terhapus.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon text-red" title="Hapus"><i class="ph ph-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada kategori pengaduan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
