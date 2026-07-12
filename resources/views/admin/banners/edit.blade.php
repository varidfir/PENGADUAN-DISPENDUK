@extends('layouts.admin')

@section('content')

<div class="page-header">
    <h1 class="page-title">Edit Banner</h1>
    <p class="page-subtitle">
        Perbarui informasi banner.
    </p>
</div>

<div class="widget-card">
    <div class="widget-body">

    <form class="crud-form"
          action="{{ route('admin.banners.update',$banner->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul Banner</label>

            <input type="text"
                   name="judul"
                   class="form-control"
                   value="{{ old('judul',$banner->judul) }}"
                   required>

            @error('judul')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="form-group">
            <label>Banner Saat Ini</label>

            <div style="margin-top:10px;">
                <img
                    src="{{ asset('storage/'.$banner->gambar) }}"
                    alt="{{ $banner->judul }}"
                    style="width:350px;border-radius:12px;">
            </div>
        </div>

        <div class="form-group">
            <label>Ganti Gambar (Opsional)</label>

            <input type="file"
                   name="gambar"
                   class="form-control"
                   accept=".jpg,.jpeg,.png,.webp">

            @error('gambar')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn-primary">
                <i class="ph ph-floppy-disk"></i>
                Update
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
