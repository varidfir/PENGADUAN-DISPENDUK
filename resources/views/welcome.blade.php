<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        .hero { text-align: center; color: white; padding: 50px 20px; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 15px; }
        .hero p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 30px; max-width: 600px; margin-inline: auto; }
        .btn-group { display: flex; gap: 15px; justify-content: center; }
        .btn-light { background: white; color: var(--primary); padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: transform 0.2s; }
        .btn-outline { border: 2px solid white; color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.2s; }
        .btn-light:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .btn-outline:hover { background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>
    <div class="hero">
        <i class="ph-fill ph-shield-check" style="font-size: 4rem; margin-bottom: 20px; display: inline-block;"></i>
        <h1>SIPPEL DUKCAPIL</h1>
        <p>Sistem Informasi Pengaduan Pelayanan Dinas Kependudukan dan Pencatatan Sipil. Sampaikan aspirasi dan pengaduan Anda di sini.</p>
        <div class="btn-group">
            <a href="{{ route('login') }}" class="btn-light">Masuk (Login)</a>
            <a href="{{ route('register') }}" class="btn-outline">Daftar Akun Baru</a>
        </div>
    </div>
</body>
</html>