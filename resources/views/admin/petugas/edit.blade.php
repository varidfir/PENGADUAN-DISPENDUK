@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Petugas</h1>
</div>

@if($errors->any())
<div class="alert-error mb-4" style="background:#fef2f2;color:#b91c1c;padding:15px;border-radius:8px;">
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="widget-card p-24">
    <form action="{{ route('admin.petugas.update', $petugas->id) }}" method="POST" class="crud-form">
        @csrf @method('PUT')

        <h3 style="font-size: 1.1rem; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid var(--border-color);">Informasi Akun</h3>
        <div class="form-group">
            <label>Nama Petugas <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $petugas->name) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email', $petugas->email) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password <span class="text-muted" style="font-weight: normal; font-size: 0.8rem;">(Kosongkan jika tidak ingin mengubah password)</span></label>
            <input type="password" name="password" class="form-control" minlength="8">
        </div>

        <h3 style="font-size: 1.1rem; margin-top: 32px; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 1px solid var(--border-color);">Penugasan Kategori Pengaduan</h3>
        <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 16px;">Pilih kategori pengaduan yang akan ditangani oleh petugas ini.</p>

        <div class="form-group" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 12px; background: #f9fafb; padding: 16px; border-radius: 8px; border: 1px solid var(--border-color);">
            @foreach($kategoris as $kategori)
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: normal; margin: 0;">
                    <input type="checkbox" name="kategori_ids[]" value="{{ $kategori->id }}"
                           {{ (is_array(old('kategori_ids', $assignedKategoriIds)) && in_array($kategori->id, old('kategori_ids', $assignedKategoriIds))) ? 'checked' : '' }}
                           style="width: 16px; height: 16px; accent-color: var(--primary-color);">
                    <span>{{ $kategori->nama_kategori }}</span>
                </label>
            @endforeach
        </div>

        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary"><i class="ph ph-floppy-disk"></i> Update Data</button>
            <a href="{{ route('admin.petugas.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection