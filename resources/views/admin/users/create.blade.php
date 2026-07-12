@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">Tambah Masyarakat</h1>
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
    <form action="{{ route('admin.users.store') }}" method="POST" class="crud-form">
        @csrf
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>No. Telp</label>
            <input type="text" name="telp" value="{{ old('telp') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection