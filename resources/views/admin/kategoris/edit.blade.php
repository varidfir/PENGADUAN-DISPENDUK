@extends('layouts.admin')
@section('content')
<div class="page-header">
    <h1 class="page-title">Edit Kategori</h1>
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
    <form action="{{ route('admin.kategoris.update', $kategori->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route('admin.kategoris.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
