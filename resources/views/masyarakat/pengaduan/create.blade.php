<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan Baru - SIPPEL DUKCAPIL</title>
    <!-- Google Fonts: Outfit & Inter -->
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
    <style>
        .premium-blur {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.85);
        }
        .premium-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04), 0 1px 3px -1px rgba(0, 0, 0, 0.02);
        }
        .gradient-blue {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">
    <!-- Navbar / Header -->
    <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/80 premium-blur premium-shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <i class="ph-fill ph-shield-check text-2xl"></i>
                </div>
                <div>
                    <span class="text-lg font-bold font-outfit text-slate-900 tracking-tight">SIPPEL</span>
                    <span class="text-xs font-semibold text-blue-600 block -mt-1 uppercase tracking-widest font-outfit">Masyarakat</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('masyarakat.dashboard') }}" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors mr-4">
                    <i class="ph-bold ph-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</span>
                    <span class="text-xs text-slate-400 font-medium">Masyarakat</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-semibold font-outfit premium-shadow border border-blue-100">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl relative mb-6 premium-shadow" role="alert">
                <div class="flex gap-3">
                    <i class="ph-fill ph-warning-circle text-xl text-red-500"></i>
                    <div>
                        <strong class="font-bold font-outfit block mb-1">Terdapat Kesalahan!</strong>
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl relative mb-6 premium-shadow" role="alert">
                <div class="flex gap-3 items-center">
                    <i class="ph-fill ph-warning-circle text-xl text-red-500"></i>
                    <span class="block sm:inline text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-3xl premium-shadow border border-slate-100 overflow-hidden">
            <div class="p-6 sm:p-8 border-b border-slate-100">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4">
                    <i class="ph-fill ph-paper-plane-tilt text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold font-outfit text-slate-900">Buat Pengaduan Baru</h1>
                <p class="text-slate-500 text-sm mt-1">Sampaikan keluhan atau aspirasi Anda secara detail agar petugas dapat memprosesnya dengan cepat.</p>
            </div>

            <form action="{{ route('masyarakat.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
                @csrf
                
                <div class="space-y-6">
                    <!-- Judul Pengaduan -->
                    <div>
                        <label for="judul" class="block text-sm font-semibold text-slate-700 mb-2 font-outfit">Judul Pengaduan</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required placeholder="Contoh: Kesalahan Data pada KTP" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm text-slate-800 bg-slate-50/50 focus:bg-white placeholder:text-slate-400">
                    </div>

                    <!-- Kategori Pengaduan -->
                    <div>
                        <label for="kategori_id" class="block text-sm font-semibold text-slate-700 mb-2 font-outfit">Kategori Layanan</label>
                        <select name="kategori_id" id="kategori_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm text-slate-800 bg-slate-50/50 focus:bg-white cursor-pointer appearance-none">
                            <option value="" disabled selected>Pilih Kategori Layanan...</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <!-- Custom Select Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 pt-8 text-slate-400">
                            <!-- Optional arrow icon can be placed here if needed but Tailwind forms plugin usually handles this. Let's just rely on default appearance or a custom wrapper if needed. -->
                        </div>
                    </div>

                    <!-- Deskripsi Pengaduan -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-slate-700 mb-2 font-outfit">Detail Pengaduan</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" required placeholder="Jelaskan secara rinci permasalahan yang Anda alami..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-sm text-slate-800 bg-slate-50/50 focus:bg-white placeholder:text-slate-400 resize-y">{{ old('deskripsi') }}</textarea>
                    </div>

                    <!-- Upload Lampiran -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2 font-outfit">Lampiran Bukti (Opsional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl hover:border-blue-400 hover:bg-blue-50/50 transition-all cursor-pointer group" id="drop-area">
                            <div class="space-y-2 text-center">
                                <div class="w-12 h-12 mx-auto bg-slate-100 group-hover:bg-blue-100 text-slate-400 group-hover:text-blue-500 rounded-full flex items-center justify-center transition-colors">
                                    <i class="ph-bold ph-upload-simple text-xl"></i>
                                </div>
                                <div class="flex text-sm text-slate-600 justify-center">
                                    <label for="lampiran" class="relative cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Unggah file</span>
                                        <input id="lampiran" name="lampiran[]" type="file" class="sr-only" multiple accept=".jpg,.jpeg,.png,.pdf" onchange="updateFileName(this)">
                                    </label>
                                    <p class="pl-1">atau seret dan lepas di sini</p>
                                </div>
                                <p class="text-xs text-slate-400">
                                    PNG, JPG, PDF (Maks. 2MB per file)
                                </p>
                            </div>
                        </div>
                        <div id="file-list" class="mt-3 flex flex-col gap-2"></div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('masyarakat.dashboard') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold font-outfit shadow-lg shadow-blue-500/30 hover:shadow-blue-500/40 transition-all transform active:scale-95 flex items-center gap-2">
                        <i class="ph-bold ph-paper-plane-right"></i>
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function updateFileName(input) {
            const fileListContainer = document.getElementById('file-list');
            fileListContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach(file => {
                    const item = document.createElement('div');
                    item.className = 'flex items-center gap-2 text-sm text-slate-600 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100';
                    item.innerHTML = `
                        <i class="ph-fill ph-file text-blue-500 text-lg"></i>
                        <span class="truncate max-w-[200px] sm:max-w-[400px]">${file.name}</span>
                        <span class="text-xs text-slate-400 ml-auto">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                    `;
                    fileListContainer.appendChild(item);
                });
            }
        }
    </script>
</body>
</html>
