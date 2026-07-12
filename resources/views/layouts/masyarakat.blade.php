<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masyarakat - SIPPEL DUKCAPIL</title>
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
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">
    <!-- Navbar / Header -->
    <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/80 premium-blur premium-shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <i class="ph-fill ph-shield-check text-2xl"></i>
                </div>
                <div>
                    <span class="text-lg font-bold font-outfit text-slate-900 tracking-tight">SIPPEL</span>
                    <span class="text-xs font-semibold text-blue-600 block -mt-1 uppercase tracking-widest font-outfit">Masyarakat</span>
                </div>
            </a>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                    <span class="text-xs text-slate-400 font-medium">Masyarakat</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-semibold font-outfit premium-shadow border border-blue-100">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
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
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-400">
            <p>&copy; 2026 SIPPEL DUKCAPIL. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
