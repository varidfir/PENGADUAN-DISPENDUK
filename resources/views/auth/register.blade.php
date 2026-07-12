<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
                <div class="input-group">
                    <label for="nik">NIK (16 Digit)</label>
                    <div class="input-icon">
                        <i class="ph ph-identification-card"></i>
                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16" placeholder="Masukkan NIK Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-icon">
                        <i class="ph ph-user"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Nama Lengkap Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="ph ph-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="telp">No. Telepon / WhatsApp</label>
                    <div class="input-icon">
                        <i class="ph ph-phone"></i>
                        <input type="text" id="telp" name="telp" value="{{ old('telp') }}" required placeholder="Contoh: 08123456789">
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
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
                <p style="margin-top: 8px;"><a href="{{ route('landing') }}" style="color: #6b7280; font-size: 0.85rem;"><i class="ph ph-arrow-left"></i> Kembali ke Beranda</a></p>
            </div>
        </div>
    </div>
</body>
</html>