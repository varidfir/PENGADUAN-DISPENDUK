<?php

@mkdir('app/Http/Controllers/Auth', 0755, true);
@mkdir('app/Http/Middleware', 0755, true);

// 1. LoginController
file_put_contents('app/Http/Controllers/Auth/LoginController.php', '<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view(\'auth.login\');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            \'email\' => \'required|email\',
            \'password\' => \'required\',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            if ($role === \'superadmin\') {
                return redirect()->intended(\'/admin/dashboard\');
            } elseif ($role === \'petugas\') {
                return redirect()->intended(\'/petugas/dashboard\');
            } else {
                return redirect()->intended(\'/masyarakat/dashboard\');
            }
        }

        return back()->withErrors([
            \'email\' => \'Email atau password salah.\',
        ])->onlyInput(\'email\');
    }
}
');

// 2. RegisterController
file_put_contents('app/Http/Controllers/Auth/RegisterController.php', '<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view(\'auth.register\');
    }

    public function register(Request $request)
    {
        $request->validate([
            \'nik\' => \'required|string|size:16|unique:users\',
            \'name\' => \'required|string|max:255\',
            \'email\' => \'required|string|email|max:255|unique:users\',
            \'telp\' => \'required|string|max:15\',
            \'password\' => \'required|string|min:8|confirmed\',
        ]);

        $user = User::create([
            \'nik\' => $request->nik,
            \'name\' => $request->name,
            \'email\' => $request->email,
            \'telp\' => $request->telp,
            \'password\' => Hash::make($request->password),
            \'role\' => \'masyarakat\',
        ]);

        Auth::login($user);

        return redirect(\'/masyarakat/dashboard\');
    }
}
');

// 3. LogoutController
file_put_contents('app/Http/Controllers/Auth/LogoutController.php', '<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(\'/\');
    }
}
');

// 4. Middlewares
file_put_contents('app/Http/Middleware/SuperAdminMiddleware.php', '<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === \'superadmin\') {
            return $next($request);
        }
        return abort(403, \'Unauthorized access.\');
    }
}
');

file_put_contents('app/Http/Middleware/PetugasMiddleware.php', '<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PetugasMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === \'petugas\') {
            return $next($request);
        }
        return abort(403, \'Unauthorized access.\');
    }
}
');

file_put_contents('app/Http/Middleware/MasyarakatMiddleware.php', '<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MasyarakatMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === \'masyarakat\') {
            return $next($request);
        }
        return abort(403, \'Unauthorized access.\');
    }
}
');

// 5. Setup Routes in routes/web.php
$webRoutes = '<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

Route::get(\'/\', function () {
    return view(\'welcome\'); // Akan diganti Landing Page nanti
});

// Auth Routes
Route::middleware(\'guest\')->group(function () {
    Route::get(\'login\', [LoginController::class, \'showLoginForm\'])->name(\'login\');
    Route::post(\'login\', [LoginController::class, \'login\']);
    Route::get(\'register\', [RegisterController::class, \'showRegistrationForm\'])->name(\'register\');
    Route::post(\'register\', [RegisterController::class, \'register\']);
});

Route::post(\'logout\', [LogoutController::class, \'logout\'])->name(\'logout\')->middleware(\'auth\');
';
file_put_contents('routes/web.php', $webRoutes);

