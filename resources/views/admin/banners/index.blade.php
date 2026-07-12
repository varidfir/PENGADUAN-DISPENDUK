@extends('layouts.admin')

@section('content')

<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Banner Informasi</h1>
        <p class="page-subtitle">
            Kelola banner yang ditampilkan pada halaman utama SIPPEL-DUKCAPIL.
        </p>
    </div>

<a href="{{ route('admin.banners.create') }}" class="btn-primary">
    <i class="ph ph-plus"></i>
    Tambah Banner
</a>

</div>

@if(session('success'))

<div class="alert-success mb-4">
    <i class="ph-fill ph-check-circle"></i>
    {{ session('success') }}
</div>
@endif

<div class="widget-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:80px;">No</th>
                    <th>Banner</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th style="width:180px;">Aksi</th>
                </tr>
            </thead>

        <tbody>
            @forelse($banners as $index => $banner)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>
                    <img
                        src="{{ asset('storage/'.$banner->gambar) }}"
                        alt="{{ $banner->judul }}"
                        class="banner-preview">
                </td>

                <td>
                    <strong>{{ $banner->judul }}</strong>
                </td>

                <td>
                    @if($banner->is_active)
                        <span class="status-badge completed">
                            Aktif
                        </span>
                    @else
                        <span class="status-badge rejected">
                            Nonaktif
                        </span>
                    @endif
                </td>

                <td>
                    <div class="table-actions">

                        <form action="{{ route('admin.banners.toggle',$banner->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn-icon text-yellow"
                                    title="{{ $banner->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                <i class="ph {{ $banner->is_active ? 'ph-eye-slash' : 'ph-eye' }}"></i>
                            </button>
                        </form>

                        <a href="{{ route('admin.banners.edit',$banner->id) }}"
                           class="btn-icon text-blue"
                           title="Edit">
                            <i class="ph ph-pencil-simple"></i>
                        </a>

                        <form action="{{ route('admin.banners.destroy',$banner->id) }}"
                              method="POST"
                              class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus banner ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn-icon text-red"
                                    title="Hapus">
                                <i class="ph ph-trash"></i>
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    Belum ada banner informasi.
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>
</div>

</div>
@endsection
