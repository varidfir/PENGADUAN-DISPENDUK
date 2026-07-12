@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Tambah Banner</h1>
    <p class="page-subtitle">
        Tambahkan banner baru untuk landing page SIPPEL-DUKCAPIL.
    </p>
</div>

<div class="widget-card">
    <div class="widget-body">

    <form class="crud-form"
          action="{{ route('admin.banners.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label>Judul Banner</label>

            <input type="text"
                   name="judul"
                   class="form-control"
                   value="{{ old('judul') }}"
                   required>

            @error('judul')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="form-group">
            <label>Gambar Banner</label>

            <input type="file"
                   name="gambar"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp"
                   required>

            @error('gambar')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-primary">
                <i class="ph ph-floppy-disk"></i>
                Simpan
            </button>

            <a href="{{ route('admin.banners.index') }}"
               class="btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

</div>

@endsection
