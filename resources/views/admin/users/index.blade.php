@extends('layouts.admin')
@section('content')
<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Data Masyarakat</h1>
        <p class="page-subtitle">Kelola data masyarakat yang terdaftar di sistem.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-primary">
        <i class="ph ph-plus"></i> Tambah Masyarakat
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
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telp }}</td>
                    <td class="table-actions">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-icon text-blue"><i class="ph ph-pencil-simple"></i></a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus masyarakat ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-icon text-red"><i class="ph ph-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data masyarakat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection