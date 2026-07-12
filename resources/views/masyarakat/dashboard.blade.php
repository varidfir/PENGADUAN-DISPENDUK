<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat - SIPPEL DUKCAPIL</title>
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
        .gradient-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gradient-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.15);
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
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</span>
                    <span class="text-xs text-slate-400 font-medium">Masyarakat</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-semibold font-outfit premium-shadow border border-blue-100">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <form action="{{ route('logout') }}" method="POST" class="ml-2">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-red-50 text-slate-400 hover:text-red-500 transition-colors duration-200" title="Logout">
                        <i class="ph-bold ph-sign-out text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcoming Hero -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 premium-shadow border border-slate-100 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl -z-10"></div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold font-outfit text-slate-900 tracking-tight">Selamat Datang, {{ auth()->user()->name }}!</h1>
                <p class="text-slate-500 mt-2 max-w-xl text-sm sm:text-base">Laporkan segala kendala dan aspirasi Anda mengenai pelayanan kependudukan. Kami siap memproses pengaduan Anda dengan cepat.</p>
            </div>
            <div>
                <a href="{{ route('masyarakat.pengaduan.create') }}" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold font-outfit shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-300 transform active:scale-95">
                    <i class="ph-bold ph-plus-circle text-lg"></i>
                    Buat Pengaduan Baru
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <!-- Total -->
            <div class="bg-white rounded-3xl p-6 premium-shadow border border-slate-100 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-blue-200 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-400">Total Pengaduan</span>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="ph-bold ph-list-bullets text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-3xl font-bold font-outfit text-slate-900">{{ $totalPengaduan }}</span>
                </div>
            </div>

            <!-- Menunggu -->
            <div class="bg-white rounded-3xl p-6 premium-shadow border border-slate-100 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-amber-200 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-400">Menunggu</span>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="ph-bold ph-hourglass text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-3xl font-bold font-outfit text-amber-600">{{ $pengaduanMenunggu }}</span>
                </div>
            </div>

            <!-- Diproses -->
            <div class="bg-white rounded-3xl p-6 premium-shadow border border-slate-100 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-indigo-200 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-400">Diproses</span>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="ph-bold ph-gear text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-3xl font-bold font-outfit text-indigo-600">{{ $pengaduanDiproses }}</span>
                </div>
            </div>

            <!-- Selesai -->
            <div class="bg-white rounded-3xl p-6 premium-shadow border border-slate-100 flex flex-col justify-between h-36 relative overflow-hidden group hover:border-emerald-200 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-400">Selesai</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="ph-bold ph-check-circle text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-3xl font-bold font-outfit text-emerald-600">{{ $pengaduanSelesai }}</span>
                </div>
            </div>
        </div>

        <!-- Recent History Section -->
        <div class="bg-white rounded-3xl premium-shadow border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold font-outfit text-slate-900">Riwayat Pengaduan Terbaru</h2>
                    <p class="text-xs text-slate-400 mt-1">Daftar pengaduan yang Anda kirimkan baru-baru ini</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                            <th class="py-4 px-6">Tanggal</th>
                            <th class="py-4 px-6">Judul Pengaduan</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($riwayatTerbaru as $item)
                            <tr class="hover:bg-slate-50/40 transition-colors duration-200">
                                <td class="py-4 px-6 text-slate-500 font-medium">
                                    {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-800">
                                    {{ Str::limit($item->judul, 40) }}
                                </td>
                                <td class="py-4 px-6 text-slate-600">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </td>
                                <td class="py-4 px-6">
                                    @php
                                        $status = $item->status;
                                        $badgeClass = match($status) {
                                            'Menunggu' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'Diproses' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                            'Selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'Ditolak' => 'bg-red-50 text-red-700 border-red-100',
                                            default => 'bg-slate-50 text-slate-700 border-slate-100',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('masyarakat.pengaduan.show', $item->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 font-semibold border border-slate-200 hover:border-blue-200 transition-all duration-200 text-xs">
                                        <i class="ph ph-eye text-base"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-6 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                            <i class="ph ph-envelope-simple-open text-3xl"></i>
                                        </div>
                                        <span class="text-sm font-medium">Belum ada riwayat pengaduan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-400">
            <p>&copy; 2026 SIPPEL DUKCAPIL. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>

