<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card glass-panel">
            <div class="auth-header">
                <div class="logo">
                    <i class="ph-fill ph-shield-check"></i>
                </div>
                <h2>Masuk</h2>
                <p>Silakan masuk ke akun Anda untuk mulai menyampaikan pengaduan.</p>
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

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="ph ph-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="ph ph-lock-key"></i>
                        <input type="password" id="password" name="password" required placeholder="Masukkan password Anda">
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    Masuk <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>

            <div class="auth-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
                <p style="margin-top: 8px;"><a href="{{ route('landing') }}" style="color: #6b7280; font-size: 0.85rem;"><i class="ph ph-arrow-left"></i> Kembali ke Beranda</a></p>
            </div>
        </div>
    </div>
</body>
</html>
