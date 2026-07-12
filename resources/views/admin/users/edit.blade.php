@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Masyarakat</h1>
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
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="crud-form">
        @csrf @method('PUT')
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" required maxlength="16" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>No. Telp</label>
            <input type="text" name="telp" value="{{ old('telp', $user->telp) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection