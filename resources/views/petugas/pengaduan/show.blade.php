<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-md">
                    <i class="ph-fill ph-file-text text-2xl"></i>
                </div>
                <div>
                    <span class="text-lg font-bold font-outfit text-slate-900 tracking-tight">Detail Pengaduan</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('petugas.dashboard') }}" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">
                    <i class="ph-bold ph-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                <i class="ph-fill ph-check-circle text-xl"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-center gap-3">
                <i class="ph-fill ph-warning-circle text-xl"></i>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Column: Details -->
            <div class="md:col-span-2 space-y-6">
                <!-- Main Info Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold font-outfit text-slate-900">{{ $pengaduan->judul }}</h1>
                            <p class="text-sm text-slate-500 mt-1">Oleh: <span class="font-medium text-slate-700">{{ $pengaduan->user->name ?? 'Masyarakat' }}</span> (NIK: {{ $pengaduan->user->nik ?? '-' }}) - Telp: {{ $pengaduan->user->telp ?? '-' }} &bull; {{ $pengaduan->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            @if($pengaduan->status == 'Menunggu')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Menunggu</span>
                            @elseif($pengaduan->status == 'Diproses')
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Diproses</span>
                            @elseif($pengaduan->status == 'Selesai')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Selesai</span>
                            @elseif($pengaduan->status == 'Ditolak')
                                <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">Ditolak</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-sm font-medium border border-slate-200">
                            Kategori: {{ $pengaduan->kategori->nama_kategori ?? '-' }}
                        </span>
                    </div>

                    <div class="prose max-w-none text-slate-700">
                        <h3 class="text-lg font-semibold mb-2">Deskripsi Pengaduan</h3>
                        <p class="whitespace-pre-line">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    @if($pengaduan->lampirans->count() > 0)
                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <h3 class="text-lg font-semibold mb-4">Lampiran ({{ $pengaduan->lampirans->count() }})</h3>
                            <div class="flex flex-wrap gap-4">
                                @foreach($pengaduan->lampirans as $lampiran)
                                    <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank" class="flex items-center gap-2 p-3 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition">
                                        <i class="ph-fill ph-file text-blue-500 text-xl"></i>
                                        <span class="text-sm font-medium text-slate-700 truncate max-w-[150px]">Lampiran {{ $loop->iteration }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Tanggapan History -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                    <h3 class="text-lg font-semibold font-outfit text-slate-900 mb-4">Riwayat Tanggapan</h3>

                    @if($pengaduan->tanggapans->count() > 0)
                        <div class="space-y-6">
                            @foreach($pengaduan->tanggapans as $tanggapan)
                                <div class="flex gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold shrink-0">
                                        {{ strtoupper(substr($tanggapan->user->name ?? 'P', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 bg-slate-50 p-4 rounded-2xl rounded-tl-none border border-slate-100">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="font-medium text-slate-900">{{ $tanggapan->user->name ?? 'Petugas' }}</span>
                                            <span class="text-xs text-slate-500">{{ $tanggapan->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-slate-700 text-sm whitespace-pre-line">{{ $tanggapan->tanggapan }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-slate-500">
                            <i class="ph-light ph-chats text-4xl mb-2"></i>
                            <p>Belum ada tanggapan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Form Tanggapan -->
            <div class="md:col-span-1 space-y-6">
                <!-- Action Form -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 sticky top-24">
                    <h3 class="text-lg font-semibold font-outfit text-slate-900 mb-4 border-b border-slate-100 pb-3">Tindakan Petugas</h3>

                    <!-- Status Update Form -->
                    <form action="{{ route('petugas.pengaduan.respond', $pengaduan->id) }}" method="POST" class="mb-6">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                <i class="ph ph-tag text-blue-500"></i> Update Status Pengaduan
                            </label>
                            <select name="status" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 bg-slate-50 text-sm mb-3">
                                <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak" {{ $pengaduan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="w-full bg-slate-100 hover:bg-slate-200 border border-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-xl transition-colors text-sm flex items-center justify-center gap-2">
                                <i class="ph-bold ph-arrows-clockwise"></i> Update Status Saja
                            </button>
                        </div>
                    </form>

                    <hr class="border-slate-100 my-6">

                    <!-- Tanggapan Form -->
                    <form action="{{ route('petugas.pengaduan.respond', $pengaduan->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="{{ $pengaduan->status }}">
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                                <i class="ph ph-chat-text text-blue-500"></i> Tambah Tanggapan
                            </label>
                            <textarea name="tanggapan" rows="4" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 bg-slate-50 text-sm" placeholder="Ketik tanggapan Anda di sini..." required></textarea>
                            @error('tanggapan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors shadow-sm shadow-blue-500/20 text-sm flex items-center justify-center gap-2">
                            <i class="ph-bold ph-paper-plane-right"></i> Kirim Tanggapan
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>
</body>
</html>
