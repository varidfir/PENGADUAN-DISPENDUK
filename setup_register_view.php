<?php

$registerBlade = '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(\'css/auth.css\') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="auth-wrapper" style="max-width: 500px;">
        <div class="auth-card glass-panel">
            <div class="auth-header" style="margin-bottom: 20px;">
                <div class="logo">
                    <i class="ph-fill ph-user-plus"></i>
                </div>
                <h2>Registrasi Akun</h2>
                <p>Daftar untuk membuat pengaduan layanan.</p>
            </div>
            
            @if ($errors->any())
                <div class="alert-error">
                    <i class="ph-fill ph-warning-circle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route(\'register\') }}" class="auth-form">
                @csrf
                <div class="input-group">
                    <label for="nik">NIK (16 Digit)</label>
                    <div class="input-icon">
                        <i class="ph ph-identification-card"></i>
                        <input type="text" id="nik" name="nik" value="{{ old(\'nik\') }}" required maxlength="16" placeholder="Masukkan NIK Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-icon">
                        <i class="ph ph-user"></i>
                        <input type="text" id="name" name="name" value="{{ old(\'name\') }}" required placeholder="Nama Lengkap Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="ph ph-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old(\'email\') }}" required placeholder="Masukkan email Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="telp">No. Telepon / WhatsApp</label>
                    <div class="input-icon">
                        <i class="ph ph-phone"></i>
                        <input type="text" id="telp" name="telp" value="{{ old(\'telp\') }}" required placeholder="Contoh: 08123456789">
                    </div>
                </div>

                <div style="display:flex; gap:15px;">
                    <div class="input-group" style="flex:1;">
                        <label for="password">Password</label>
                        <div class="input-icon">
                            <i class="ph ph-lock-key"></i>
                            <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter">
                        </div>
                    </div>

                    <div class="input-group" style="flex:1;">
                        <label for="password_confirmation">Ulangi Password</label>
                        <div class="input-icon">
                            <i class="ph ph-lock-key"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Konfirmasi Password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    Daftar Sekarang <i class="ph-bold ph-paper-plane-right"></i>
                </button>
            </form>

            <div class="auth-footer">
                <p>Sudah punya akun? <a href="{{ route(\'login\') }}">Login di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>';

file_put_contents('resources/views/auth/register.blade.php', $registerBlade);

$welcomeBlade = '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(\'css/auth.css\') }}">
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
            <a href="{{ route(\'login\') }}" class="btn-light">Masuk (Login)</a>
            <a href="{{ route(\'register\') }}" class="btn-outline">Daftar Akun Baru</a>
        </div>
    </div>
</body>
</html>';
file_put_contents('resources/views/welcome.blade.php', $welcomeBlade);
