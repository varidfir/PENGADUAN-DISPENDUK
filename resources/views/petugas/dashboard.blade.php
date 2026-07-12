@extends('layouts.petugas')

@section('content')
<div class="space-y-8">
    <!-- Header/Title (Optional, as Topbar already has some context, but good for page title) -->
    <div>
        <h1 class="text-2xl font-bold font-outfit text-slate-900">Dashboard</h1>
        <p class="text-slate-500 mt-1">Ringkasan pengaduan yang menjadi tanggung jawab Anda.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                <i class="ph-fill ph-envelope"></i>
            </div>
            <div>
                <div class="text-3xl font-bold font-outfit text-slate-900">{{ $newCount }}</div>
                <div class="text-sm font-medium text-slate-500">Pengaduan Baru</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center text-2xl">
                <i class="ph-fill ph-spinner-gap"></i>
            </div>
            <div>
                <div class="text-3xl font-bold font-outfit text-slate-900">{{ $processCount }}</div>
                <div class="text-sm font-medium text-slate-500">Sedang Diproses</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-green-50 text-green-600 flex items-center justify-center text-2xl">
                <i class="ph-fill ph-check-circle"></i>
            </div>
            <div>
                <div class="text-3xl font-bold font-outfit text-slate-900">{{ $completedCount }}</div>
                <div class="text-sm font-medium text-slate-500">Selesai</div>
            </div>
        </div>
    </div>

    <!-- Kategori Tugas Petugas -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h2 class="text-lg font-semibold font-outfit text-slate-900 mb-4 flex items-center gap-2">
            <i class="ph-fill ph-tag text-blue-500"></i> Kategori Tugas Anda
        </h2>
        <div class="flex flex-wrap gap-2">
            @forelse($kategoriList as $kategori)
                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-md text-sm font-medium border border-slate-200">{{ $kategori->nama_kategori }}</span>
            @empty
                <span class="text-sm text-slate-500 italic">Belum ada kategori tugas yang ditetapkan untuk Anda.</span>
            @endforelse
        </div>
        </div>
    </div>

    <!-- Statistik Pengaduan per Kategori -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-6">
        <h2 class="text-lg font-semibold font-outfit text-slate-900 mb-4 flex items-center gap-2">
            <i class="ph ph-chart-pie text-blue-500"></i> Statistik Pengaduan per Kategori
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm">
                        <th class="font-semibold py-3 px-6">Kategori</th>
                        <th class="font-semibold py-3 px-6">Menunggu</th>
                        <th class="font-semibold py-3 px-6">Diproses</th>
                        <th class="font-semibold py-3 px-6">Selesai</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    @forelse($kategoriList as $kategori)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-6 text-slate-900">{{ $kategori->nama_kategori }}</td>
                            <td class="py-3 px-6 text-slate-600">
                                {{ $stats[$kategori->id]['Menunggu'] ?? 0 }}
                            </td>
                            <td class="py-3 px-6 text-slate-600">
                                {{ $stats[$kategori->id]['Diproses'] ?? 0 }}
                            </td>
                            <td class="py-3 px-6 text-slate-600">
                                {{ $stats[$kategori->id]['Selesai'] ?? 0 }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-500">Tidak ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daftar Pengaduan -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
            <h2 class="text-lg font-semibold font-outfit text-slate-900">Daftar Pengaduan Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-sm">
                        <th class="font-semibold py-3 px-6">#</th>
                        <th class="font-semibold py-3 px-6">Judul</th>
                        <th class="font-semibold py-3 px-6">Kategori</th>
                        <th class="font-semibold py-3 px-6">Status</th>
                        <th class="font-semibold py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    @forelse($pengaduanList as $pengaduan)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-6 text-slate-500">{{ $loop->iteration + ($pengaduanList->currentPage() - 1) * $pengaduanList->perPage() }}</td>
                            <td class="py-3 px-6 font-medium text-slate-900">{{ $pengaduan->judul }}</td>
                            <td class="py-3 px-6 text-slate-600">{{ $pengaduan->kategori->nama_kategori ?? '-' }}</td>
                            <td class="py-3 px-6">
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
                            <td colspan="5" class="py-8 px-6 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="ph-light ph-folder-open text-4xl mb-2 text-slate-300"></i>
                                    <p>Tidak ada pengaduan terkait tugas Anda saat ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-200">
            {{ $pengaduanList->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
