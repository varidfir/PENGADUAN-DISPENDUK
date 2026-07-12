@extends('layouts.petugas')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-6">
    <h2 class="text-lg font-semibold font-outfit text-slate-900 mb-4 flex items-center gap-2">
        <i class="ph ph-folder-open text-blue-500"></i> Daftar Pengaduan
    </h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm">
                    <th class="font-semibold py-3 px-6">#</th>
                    <th class="font-semibold py-3 px-6">Judul</th>
                    <th class="font-semibold py-3 px-6">Kategori</th>
                    <th class="font-semibold py-3 px-6">Pengirim</th>
                    <th class="font-semibold py-3 px-6">Status</th>
                    <th class="font-semibold py-3 px-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse($pengaduans as $pengaduan)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="py-3 px-6 text-slate-900">{{ $loop->iteration + ($pengaduans->currentPage() - 1) * $pengaduans->perPage() }}</td>
                    <td class="py-3 px-6 text-slate-800 font-medium">{{ $pengaduan->judul }}</td>
                    <td class="py-3 px-6 text-slate-600">{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                    <td class="py-3 px-6 text-slate-600">{{ $pengaduan->user->name ?? '-' }}</td>
                    <td class="py-3 px-6 text-slate-600">
                        @if($pengaduan->status == 'Menunggu')
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span>
                        @elseif($pengaduan->status == 'Diproses')
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800">Diproses</span>
                        @elseif($pengaduan->status == 'Selesai')
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-green-100 text-green-800">Selesai</span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-800">{{ $pengaduan->status }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-right">
                        <a href="{{ route('petugas.pengaduan.show', $pengaduan->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition-colors shadow-sm">
                            <i class="ph ph-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-slate-500">Tidak ada pengaduan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-slate-200">
        {{ $pengaduans->links('pagination::tailwind') }}
    </div>
</div>
@endsection
