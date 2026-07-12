<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPPEL DUKCAPIL - Sistem Pengaduan Pelayanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        html {
            scroll-behavior: smooth;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #0c4a6e 100%);
        }
        .banner-carousel {
            position: relative;
            width: 100%;
            height: 350px;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
        }
        .banner-item {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }
        .banner-item.active {
            opacity: 1;
        }
        .banner-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .banner-item-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0c4a6e 0%, #1e3a8a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-direction: column;
            gap: 15px;
        }
        .banner-placeholder-icon {
            font-size: 4rem;
            opacity: 0.8;
        }
        .banner-placeholder-text {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
        }
        .carousel-nav {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }
        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .carousel-dot:hover {
            background: rgba(255, 255, 255, 0.9);
        }
        .carousel-dot.active {
            background: white;
            width: 28px;
            border-radius: 5px;
        }
        .feature-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            background: white;
            padding: 28px 24px;
            border-radius: 12px;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #1e40af;
            background: #f8fafc;
        }
        .feature-icon {
            font-size: 2.8rem;
            color: #1e40af;
            margin-bottom: 16px;
        }
        .step-card {
            text-align: center;
            padding: 24px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .step-card:hover {
            background: white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        .step-number {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0 auto 16px;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }
        .stat-box {
            background: linear-gradient(135deg, #1e40af 0%, #0c4a6e 100%);
            color: white;
            padding: 32px 24px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .stat-box:hover {
            transform: translateY(-4px);
        }
        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 8px;
            line-height: 1;
        }
        .stat-label {
            font-size: 0.95rem;
            opacity: 0.95;
        }
        .btn-primary {
            background: #1e40af;
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            border: 2px solid #1e40af;
            cursor: pointer;
        }
        .btn-primary:hover {
            background: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(30, 64, 175, 0.3);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .btn-secondary {
            background: white;
            color: #1e40af;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            border: 2px solid white;
            cursor: pointer;
        }
        .btn-secondary:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-secondary:active {
            transform: translateY(0);
        }
        .nav-header {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .footer {
            background: #1f2937;
            color: #d1d5db;
        }
        .footer-link {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer-link:hover {
            color: white;
        }
        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 50px;
            text-align: center;
        }
        .nav-link {
            color: #374151;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 10px 16px;
            border-radius: 8px;
        }
        .nav-link:hover {
            color: #1e40af;
            background: #f0f9ff;
        }
        @media (max-width: 768px) {
            .section-title {
                font-size: 1.875rem;
                margin-bottom: 40px;
            }
            .feature-card, .step-card {
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="nav-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="ph-fill ph-shield-check text-2xl text-blue-600"></i>
                <span class="text-xl font-bold text-gray-900">SIPPEL DUKCAPIL</span>
            </div>
            <div class="flex gap-3">
                @if (auth()->check())
                    <span class="text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-primary">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-primary">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    @php
        $dashboardRoute = 'masyarakat.dashboard';
        if (auth()->check()) {
            $role = auth()->user()->role ?? null;
            if ($role === 'superadmin') {
                $dashboardRoute = 'admin.dashboard';
            } elseif ($role === 'petugas') {
                $dashboardRoute = 'petugas.dashboard';
            } else {
                $dashboardRoute = 'masyarakat.dashboard';
            }
        }
    @endphp

    <!-- Hero Section with Banner Carousel -->
    <section class="hero-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Banner Carousel -->
                <div class="banner-carousel">
                    @if ($banners->count() > 0)
                        @foreach ($banners as $index => $banner)
                            <div class="banner-item {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                @if ($banner->gambar)
                                    <img src="{{ asset('storage/' . $banner->gambar) }}" alt="{{ $banner->judul }}">
                                @else
                                    <div class="banner-item-placeholder">
                                        <div class="banner-placeholder-icon">
                                            <i class="ph-fill ph-megaphone"></i>
                                        </div>
                                        <div class="banner-placeholder-text">{{ $banner->judul }}</div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @if ($banners->count() > 1)
                            <div class="carousel-nav">
                                @foreach ($banners as $index => $banner)
                                    <span class="carousel-dot {{ $index === 0 ? 'active' : '' }}" onclick="switchBanner({{ $index }})"></span>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="banner-item active">
                            <div class="banner-item-placeholder">
                                <div class="banner-placeholder-icon">
                                    <i class="ph-fill ph-megaphone"></i>
                                </div>
                                <div class="banner-placeholder-text">Belum ada banner</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Hero Text -->
                <div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Sistem Pengaduan Pelayanan DISPENDUKCAPIL</h1>
                    <p class="text-lg text-blue-100 mb-8">Sampaikan pengaduan, saran, dan aspirasi Anda tentang pelayanan Dinas Kependudukan dan Pencatatan Sipil dengan mudah melalui platform digital kami.</p>
                    <div class="flex flex-col gap-4">
                        @if (!auth()->check())
                            <div class="flex flex-wrap gap-3 items-center">
                                <a href="{{ route('login') }}" class="btn-secondary">Buat Pengaduan</a>
                            </div>
                            <p class="text-blue-200 text-sm">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-white font-semibold underline hover:text-blue-100">Daftar di sini</a>
                            </p>
                        @else
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route($dashboardRoute) }}" class="btn-secondary">Buat Pengaduan</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title">Keunggulan Sistem Kami</h2>
            <div class="grid md:grid-cols-4 gap-8">
                @foreach ($features as $feature)
                    <div class="feature-card bg-white p-8 rounded-lg text-center">
                        <div class="feature-icon">
                            <i class="ph-fill {{ $feature['icon'] }}"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                        <p class="text-gray-600">{{ $feature['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title">Cara Kerja Sistem</h2>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="step-number">1</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Daftar Akun</h3>
                    <p class="text-gray-600">Buat akun baru untuk mengakses sistem pengaduan dengan data diri yang lengkap.</p>
                </div>
                <div class="text-center">
                    <div class="step-number">2</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Ajukan Pengaduan</h3>
                    <p class="text-gray-600">Isi formulir pengaduan dengan detail lengkap dan unggah bukti pendukung.</p>
                </div>
                <div class="text-center">
                    <div class="step-number">3</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pantau Status</h3>
                    <p class="text-gray-600">Lacak perkembangan pengaduan Anda melalui dashboard dengan status real-time.</p>
                </div>
                <div class="text-center">
                    <div class="step-number">4</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Dapatkan Tanggapan</h3>
                    <p class="text-gray-600">Terima tanggapan resmi dan penyelesaian masalah dari petugas terkait.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="stat-box">
                    <div class="stat-number">500+</div>
                    <p class="text-lg">Pengaduan Tertangani</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">98%</div>
                    <p class="text-lg">Tingkat Kepuasan Masyarakat</p>
                </div>
                <div class="stat-box">
                    <div class="stat-number">24/7</div>
                    <p class="text-lg">Dukungan Sistem Online</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="hero-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Menyampaikan Pengaduan?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan masyarakat yang telah menyampaikan pengaduan mereka melalui sistem kami dan mendapatkan respons yang cepat.</p>
            <div class="flex justify-center gap-4">
                @if (!auth()->check())
                    <a href="{{ route('register') }}" class="btn-secondary">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-lg font-600 transition inline-block">Masuk ke Akun</a>
                @else
                    <a href="{{ route($dashboardRoute) }}" class="btn-secondary">Pergi ke Dashboard</a>
                @endif
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 flex items-center gap-3">
                        <i class="ph ph-question text-blue-600 text-xl"></i>
                        Apakah pengaduan saya akan ditangani dengan serius?
                    </h3>
                    <p class="text-gray-600 ml-9">Ya, semua pengaduan yang masuk akan ditangani oleh petugas DISPENDUKCAPIL dengan serius dan profesional sesuai dengan prosedur yang berlaku.</p>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 flex items-center gap-3">
                        <i class="ph ph-question text-blue-600 text-xl"></i>
                        Berapa lama waktu yang diperlukan untuk mendapat tanggapan?
                    </h3>
                    <p class="text-gray-600 ml-9">Waktu respons rata-rata adalah 5-7 hari kerja tergantung kompleksitas pengaduan dan proses verifikasi yang diperlukan.</p>
                </div>
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 flex items-center gap-3">
                        <i class="ph ph-question text-blue-600 text-xl"></i>
                        Apakah data pribadi saya dijaga kerahasiaannya?
                    </h3>
                    <p class="text-gray-600 ml-9">Semua data pribadi Anda dijaga dengan standar keamanan tinggi dan hanya digunakan untuk keperluan penanganan pengaduan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <i class="ph-fill ph-shield-check text-xl text-blue-400"></i>
                        <span class="font-bold">SIPPEL DUKCAPIL</span>
                    </div>
                    <p class="text-sm">Sistem Informasi Pengaduan Pelayanan Dinas Kependudukan dan Pencatatan Sipil</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="footer-link">Beranda</a></li>
                        <li><a href="#" class="footer-link">Tentang Kami</a></li>
                        <li><a href="#" class="footer-link">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('login') }}" class="footer-link">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link">Daftar</a></li>
                        <li><a href="#" class="footer-link">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="ph-phone text-blue-400 mr-2"></i>+62-XXX-XXXX-XXXX</li>
                        <li><i class="ph-envelope text-blue-400 mr-2"></i>info@dispendukcapil.id</li>
                        <li><i class="ph-map-pin text-blue-400 mr-2"></i>Jln. Pendudukan No. 1</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-sm">
                <p>&copy; 2026 SIPPEL DUKCAPIL. Hak Cipta Dilindungi. Dikembangkan oleh Dinas Kependudukan dan Pencatatan Sipil.</p>
            </div>
        </div>
    </footer>

    <script>
        const banners = document.querySelectorAll('.banner-item');
        const dots = document.querySelectorAll('.carousel-dot');
        let currentBanner = 0;
        let autoPlayInterval;

        function showBanner(index) {
            banners.forEach(banner => banner.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            if (banners[index]) {
                banners[index].classList.add('active');
            }
            if (dots[index]) {
                dots[index].classList.add('active');
            }
            
            currentBanner = index;
        }

        function switchBanner(index) {
            showBanner(index);
            clearInterval(autoPlayInterval);
            startAutoPlay();
        }

        function autoNext() {
            let next = (currentBanner + 1) % banners.length;
            if (banners.length > 0) {
                showBanner(next);
            }
        }

        function startAutoPlay() {
            if (banners.length > 1) {
                autoPlayInterval = setInterval(autoNext, 5000);
            }
        }

        // Start auto play on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', startAutoPlay);
        } else {
            startAutoPlay();
        }
    </script>
</body>
</html>
