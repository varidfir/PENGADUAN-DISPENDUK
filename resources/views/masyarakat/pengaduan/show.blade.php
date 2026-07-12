@extends('layouts.masyarakat')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-2xl shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold font-outfit text-slate-900">
            {{ $pengaduan->judul }}
        </h2>
        <a href="{{ route('masyarakat.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-800 transition-colors">
            <i class="ph ph-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="flex items-center text-sm text-slate-600 mb-6">
        <span class="mr-2"><i class="ph ph-user"></i> {{ $pengaduan->user->name ?? 'Masyarakat' }}</span>
        <span class="mr-2">| <i class="ph ph-tag"></i> {{ $pengaduan->kategori->nama_kategori ?? '-' }}</span>
        <span class="mr-2">| Status: 
            @if($pengaduan->status == 'Menunggu')
                <span class="px-2 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-xs font-semibold">Menunggu</span>
            @elseif($pengaduan->status == 'Diproses')
                <span class="px-2 py-1 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded-full text-xs font-semibold">Diproses</span>
            @elseif($pengaduan->status == 'Selesai')
                <span class="px-2 py-1 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-full text-xs font-semibold">Selesai</span>
            @elseif($pengaduan->status == 'Ditolak')
                <span class="px-2 py-1 bg-red-50 text-red-700 border border-red-100 rounded-full text-xs font-semibold">Ditolak</span>
            @else
                <span class="px-2 py-1 bg-slate-50 text-slate-700 border border-slate-100 rounded-full text-xs font-semibold">{{ $pengaduan->status }}</span>
            @endif
        </span>
    </div>
    
    <div class="prose max-w-none text-slate-700 mb-6 bg-slate-50 p-5 rounded-xl border border-slate-100">
        <h3 class="text-sm font-semibold mb-2 text-slate-500 uppercase tracking-wider">Deskripsi Pengaduan</h3>
        <p class="whitespace-pre-line">{{ $pengaduan->deskripsi }}</p>
    </div>
    
    @if($pengaduan->lampirans->count() > 0)
        <div class="mb-8">
            <h3 class="text-sm font-semibold mb-3 text-slate-500 uppercase tracking-wider">Lampiran ({{ $pengaduan->lampirans->count() }})</h3>
            <div class="flex flex-wrap gap-4">
                @foreach($pengaduan->lampirans as $lampiran)
                    <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank" class="flex items-center gap-3 p-3 bg-white border border-slate-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all group">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <i class="ph-fill ph-file text-xl"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-700 truncate max-w-[150px]">Lampiran {{ $loop->iteration }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
    
    <hr class="my-6 border-slate-100">
    
    <h3 class="text-lg font-semibold font-outfit text-slate-900 mb-4">Riwayat Tanggapan & Balasan</h3>
    @if($pengaduan->tanggapans->count() > 0)
        <div class="space-y-5 mb-8">
            @foreach($pengaduan->tanggapans as $tanggapan)
                @php
                    $isPetugas = $tanggapan->user->role == 'petugas' || $tanggapan->user->role == 'superadmin';
                @endphp
                <div class="flex gap-4 {{ $isPetugas ? '' : 'flex-row-reverse' }}">
                    <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center font-bold {{ $isPetugas ? 'bg-indigo-100 text-indigo-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ strtoupper(substr($tanggapan->user->name ?? ($isPetugas ? 'P' : 'M'), 0, 1)) }}
                    </div>
                    <div class="flex-1 {{ $isPetugas ? 'bg-slate-50 border-slate-200 rounded-tr-2xl rounded-br-2xl rounded-bl-2xl' : 'bg-blue-50 border-blue-100 rounded-tl-2xl rounded-br-2xl rounded-bl-2xl' }} p-4 border relative">
                        <div class="flex justify-between items-start mb-2 {{ $isPetugas ? '' : 'flex-row-reverse' }}">
                            <div class="flex items-center gap-2 {{ $isPetugas ? '' : 'flex-row-reverse' }}">
                                <span class="font-semibold text-slate-900">{{ $tanggapan->user->name ?? 'Sistem' }}</span>
                                @if($isPetugas)
                                    <span class="px-2 py-0.5 bg-indigo-100 text-indigo-700 text-[10px] uppercase font-bold rounded">Petugas</span>
                                @endif
                            </div>
                            <span class="text-xs text-slate-400">{{ $tanggapan->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-700 text-sm whitespace-pre-line {{ $isPetugas ? '' : 'text-right' }}">{{ $tanggapan->tanggapan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center bg-slate-50 border border-slate-100 rounded-xl py-8 mb-8">
            <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-slate-300 mx-auto mb-3 shadow-sm">
                <i class="ph ph-chat-circle-dots text-2xl"></i>
            </div>
            <p class="text-slate-500 text-sm">Belum ada tanggapan atau balasan dari petugas.</p>
        </div>
    @endif
    
    <div class="bg-blue-50/50 p-5 rounded-xl border border-blue-100">
        <h3 class="text-sm font-semibold text-blue-900 mb-3"><i class="ph-fill ph-chat-teardrop-text"></i> Kirim Pesan (Chat)</h3>
        <form action="{{ route('masyarakat.pengaduan.chat', $pengaduan->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="tanggapan" rows="3" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 text-sm bg-white" placeholder="Tulis pesan atau pertanyaan Anda di sini..." required></textarea>
                @error('tanggapan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl transition-all shadow-md shadow-blue-500/20 hover:shadow-blue-500/30">
                    <i class="ph-paper-plane-right"></i> Kirim Pesan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
