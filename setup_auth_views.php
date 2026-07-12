<?php

@mkdir('resources/views/auth', 0755, true);
@mkdir('public/css', 0755, true);

$loginBlade = '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPPEL DUKCAPIL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset(\'css/auth.css\') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card glass-panel">
            <div class="auth-header">
                <div class="logo">
                    <i class="ph-fill ph-shield-check"></i>
                </div>
                <h2>Selamat Datang</h2>
                <p>Silakan masuk ke akun SIPPEL Anda.</p>
            </div>
            
            @if ($errors->any())
                <div class="alert-error">
                    <i class="ph-fill ph-warning-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route(\'login\') }}" class="auth-form">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="ph ph-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old(\'email\') }}" required autofocus placeholder="Masukkan email Anda">
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
                    Login <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>

            <div class="auth-footer">
                <p>Belum punya akun? <a href="{{ route(\'register\') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>';

file_put_contents('resources/views/auth/login.blade.php', $loginBlade);

$css = ':root {
    --primary: #4f46e5;
    --primary-hover: #4338ca;
    --text-main: #1f2937;
    --text-muted: #6b7280;
    --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: \'Inter\', sans-serif;
    background: var(--bg-gradient);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-main);
}

.auth-wrapper {
    width: 100%;
    max-width: 420px;
    padding: 20px;
}

.glass-panel {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px 30px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.4);
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.logo {
    width: 60px;
    height: 60px;
    background: var(--primary);
    color: white;
    font-size: 2rem;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
}

.auth-header h2 { font-size: 1.5rem; font-weight: 700; margin-bottom: 5px; }
.auth-header p { color: var(--text-muted); font-size: 0.9rem; }

.alert-error {
    background: #fef2f2;
    color: #b91c1c;
    padding: 12px 15px;
    border-radius: 8px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    border: 1px solid #fecaca;
}

.alert-error i { font-size: 1.2rem; }

.input-group { margin-bottom: 20px; }

.input-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: var(--text-main);
}

.input-icon {
    position: relative;
    display: flex;
    align-items: center;
}

.input-icon i {
    position: absolute;
    left: 15px;
    color: var(--text-muted);
    font-size: 1.1rem;
}

.input-icon input {
    width: 100%;
    padding: 12px 15px 12px 45px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-family: inherit;
    font-size: 0.95rem;
    transition: all 0.2s;
    background: #f9fafb;
}

.input-icon input:focus {
    border-color: var(--primary);
    outline: none;
    background: white;
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
}

.btn-primary {
    width: 100%;
    background: var(--primary);
    color: white;
    border: none;
    padding: 14px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s;
    margin-top: 10px;
}

.btn-primary:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
}

.auth-footer {
    text-align: center;
    margin-top: 25px;
    font-size: 0.9rem;
    color: var(--text-muted);
}

.auth-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
}

.auth-footer a:hover { text-decoration: underline; }
';
file_put_contents('public/css/auth.css', $css);
