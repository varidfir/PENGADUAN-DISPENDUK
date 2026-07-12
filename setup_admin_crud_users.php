<?php

@mkdir('app/Http/Controllers/Admin', 0755, true);
@mkdir('resources/views/admin/users', 0755, true);
@mkdir('resources/views/admin/petugas', 0755, true);

// 1. UserController (Masyarakat)
$userController = '<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where(\'role\', \'masyarakat\')->get();
        return view(\'admin.users.index\', compact(\'users\'));
    }

    public function create()
    {
        return view(\'admin.users.create\');
    }

    public function store(Request $request)
    {
        $request->validate([
            \'nik\' => \'required|string|size:16|unique:users\',
            \'name\' => \'required|string|max:255\',
            \'email\' => \'required|email|unique:users\',
            \'telp\' => \'required|string|max:15\',
            \'password\' => \'required|string|min:8\',
        ]);

        User::create([
            \'nik\' => $request->nik,
            \'name\' => $request->name,
            \'email\' => $request->email,
            \'telp\' => $request->telp,
            \'password\' => Hash::make($request->password),
            \'role\' => \'masyarakat\'
        ]);

        return redirect()->route(\'admin.users.index\')->with(\'success\', \'Masyarakat berhasil ditambahkan\');
    }

    public function edit(User $user)
    {
        return view(\'admin.users.edit\', compact(\'user\'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            \'nik\' => \'required|string|size:16|unique:users,nik,\'.$user->id,
            \'name\' => \'required|string|max:255\',
            \'email\' => \'required|email|unique:users,email,\'.$user->id,
            \'telp\' => \'required|string|max:15\',
        ]);

        $data = $request->only([\'nik\', \'name\', \'email\', \'telp\']);
        if ($request->filled(\'password\')) {
            $data[\'password\'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route(\'admin.users.index\')->with(\'success\', \'Data Masyarakat berhasil diupdate\');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route(\'admin.users.index\')->with(\'success\', \'Masyarakat berhasil dihapus\');
    }
}';
file_put_contents('app/Http/Controllers/Admin/UserController.php', $userController);

// 2. PetugasController
$petugasController = '<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where(\'role\', \'petugas\')->get();
        return view(\'admin.petugas.index\', compact(\'petugas\'));
    }

    public function create()
    {
        return view(\'admin.petugas.create\');
    }

    public function store(Request $request)
    {
        $request->validate([
            \'name\' => \'required|string|max:255\',
            \'email\' => \'required|email|unique:users\',
            \'password\' => \'required|string|min:8\',
        ]);

        User::create([
            \'name\' => $request->name,
            \'email\' => $request->email,
            \'password\' => Hash::make($request->password),
            \'role\' => \'petugas\'
        ]);

        return redirect()->route(\'admin.petugas.index\')->with(\'success\', \'Petugas berhasil ditambahkan\');
    }

    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        return view(\'admin.petugas.edit\', compact(\'petugas\'));
    }

    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);
        $request->validate([
            \'name\' => \'required|string|max:255\',
            \'email\' => \'required|email|unique:users,email,\'.$petugas->id,
        ]);

        $data = $request->only([\'name\', \'email\']);
        if ($request->filled(\'password\')) {
            $data[\'password\'] = Hash::make($request->password);
        }

        $petugas->update($data);
        return redirect()->route(\'admin.petugas.index\')->with(\'success\', \'Data Petugas berhasil diupdate\');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route(\'admin.petugas.index\')->with(\'success\', \'Petugas berhasil dihapus\');
    }
}';
file_put_contents('app/Http/Controllers/Admin/PetugasController.php', $petugasController);

// 3. Views Users Index
$userIndex = '@extends(\'layouts.admin\')
@section(\'content\')
<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Data Masyarakat</h1>
        <p class="page-subtitle">Kelola data masyarakat yang terdaftar di sistem.</p>
    </div>
    <a href="{{ route(\'admin.users.create\') }}" class="btn-primary">
        <i class="ph ph-plus"></i> Tambah Masyarakat
    </a>
</div>

@if(session(\'success\'))
<div class="alert-success mb-4">
    <i class="ph-fill ph-check-circle"></i> {{ session(\'success\') }}
</div>
@endif

<div class="widget-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->nik }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telp }}</td>
                    <td class="table-actions">
                        <a href="{{ route(\'admin.users.edit\', $user->id) }}" class="btn-icon text-blue"><i class="ph ph-pencil-simple"></i></a>
                        <form action="{{ route(\'admin.users.destroy\', $user->id) }}" method="POST" class="inline" onsubmit="return confirm(\'Hapus masyarakat ini?\')">
                            @csrf @method(\'DELETE\')
                            <button type="submit" class="btn-icon text-red"><i class="ph ph-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data masyarakat</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection';
file_put_contents('resources/views/admin/users/index.blade.php', $userIndex);

$userCreate = '@extends(\'layouts.admin\')
@section(\'content\')
<div class="page-header">
    <h1 class="page-title">Tambah Masyarakat</h1>
</div>

@if($errors->any())
<div class="alert-error mb-4" style="background:#fef2f2;color:#b91c1c;padding:15px;border-radius:8px;">
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="widget-card p-24">
    <form action="{{ route(\'admin.users.store\') }}" method="POST" class="crud-form">
        @csrf
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ old(\'nik\') }}" required maxlength="16" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old(\'name\') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old(\'email\') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>No. Telp</label>
            <input type="text" name="telp" value="{{ old(\'telp\') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route(\'admin.users.index\') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection';
file_put_contents('resources/views/admin/users/create.blade.php', $userCreate);

$userEdit = '@extends(\'layouts.admin\')
@section(\'content\')
<div class="page-header">
    <h1 class="page-title">Edit Masyarakat</h1>
</div>

@if($errors->any())
<div class="alert-error mb-4" style="background:#fef2f2;color:#b91c1c;padding:15px;border-radius:8px;">
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="widget-card p-24">
    <form action="{{ route(\'admin.users.update\', $user->id) }}" method="POST" class="crud-form">
        @csrf @method(\'PUT\')
        <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ old(\'nik\', $user->nik) }}" required maxlength="16" class="form-control">
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old(\'name\', $user->name) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old(\'email\', $user->email) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>No. Telp</label>
            <input type="text" name="telp" value="{{ old(\'telp\', $user->telp) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route(\'admin.users.index\') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection';
file_put_contents('resources/views/admin/users/edit.blade.php', $userEdit);

// Petugas Views
$petugasIndex = '@extends(\'layouts.admin\')
@section(\'content\')
<div class="page-header d-flex justify-between align-center">
    <div>
        <h1 class="page-title">Data Petugas</h1>
        <p class="page-subtitle">Kelola petugas yang menangani pengaduan.</p>
    </div>
    <a href="{{ route(\'admin.petugas.create\') }}" class="btn-primary">
        <i class="ph ph-plus"></i> Tambah Petugas
    </a>
</div>

@if(session(\'success\'))
<div class="alert-success mb-4">
    <i class="ph-fill ph-check-circle"></i> {{ session(\'success\') }}
</div>
@endif

<div class="widget-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Petugas</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td class="table-actions">
                        <a href="{{ route(\'admin.petugas.edit\', $p->id) }}" class="btn-icon text-blue"><i class="ph ph-pencil-simple"></i></a>
                        <form action="{{ route(\'admin.petugas.destroy\', $p->id) }}" method="POST" class="inline" onsubmit="return confirm(\'Hapus petugas ini?\')">
                            @csrf @method(\'DELETE\')
                            <button type="submit" class="btn-icon text-red"><i class="ph ph-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted">Belum ada data petugas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection';
file_put_contents('resources/views/admin/petugas/index.blade.php', $petugasIndex);

$petugasCreate = '@extends(\'layouts.admin\')
@section(\'content\')
<div class="page-header">
    <h1 class="page-title">Tambah Petugas</h1>
</div>

@if($errors->any())
<div class="alert-error mb-4" style="background:#fef2f2;color:#b91c1c;padding:15px;border-radius:8px;">
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="widget-card p-24">
    <form action="{{ route(\'admin.petugas.store\') }}" method="POST" class="crud-form">
        @csrf
        <div class="form-group">
            <label>Nama Petugas</label>
            <input type="text" name="name" value="{{ old(\'name\') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old(\'email\') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Simpan</button>
            <a href="{{ route(\'admin.petugas.index\') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection';
file_put_contents('resources/views/admin/petugas/create.blade.php', $petugasCreate);

$petugasEdit = '@extends(\'layouts.admin\')
@section(\'content\')
<div class="page-header">
    <h1 class="page-title">Edit Petugas</h1>
</div>

@if($errors->any())
<div class="alert-error mb-4" style="background:#fef2f2;color:#b91c1c;padding:15px;border-radius:8px;">
    <ul>
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="widget-card p-24">
    <form action="{{ route(\'admin.petugas.update\', $petugas->id) }}" method="POST" class="crud-form">
        @csrf @method(\'PUT\')
        <div class="form-group">
            <label>Nama Petugas</label>
            <input type="text" name="name" value="{{ old(\'name\', $petugas->name) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old(\'email\', $petugas->email) }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-actions mt-4">
            <button type="submit" class="btn-primary">Update</button>
            <a href="{{ route(\'admin.petugas.index\') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection';
file_put_contents('resources/views/admin/petugas/edit.blade.php', $petugasEdit);

// Update routes/admin.php
$routes = '<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PetugasController;

Route::middleware([\'auth\', \'role.superadmin\'])->prefix(\'admin\')->name(\'admin.\')->group(function () {
    Route::get(\'dashboard\', [DashboardController::class, \'index\'])->name(\'dashboard\');
    Route::resource(\'users\', UserController::class);
    Route::resource(\'petugas\', PetugasController::class);
});
';
file_put_contents('routes/admin.php', $routes);

// Add missing CSS to admin.css
$cssAppend = '
/* Utilities */
.d-flex { display: flex; }
.justify-between { justify-content: space-between; }
.align-center { align-items: center; }
.mb-4 { margin-bottom: 1rem; }
.mt-4 { margin-top: 1rem; }
.p-24 { padding: 24px; }
.text-center { text-align: center; }
.inline { display: inline-block; }

.text-blue { color: #3b82f6; }
.text-red { color: #ef4444; }

/* Tables */
.table-responsive { overflow-x: auto; }
.table {
    width: 100%;
    border-collapse: collapse;
}
.table th, .table td {
    padding: 16px 24px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}
.table th {
    background-color: #f9fafb;
    font-weight: 600;
    color: var(--text-muted);
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
.table tbody tr:hover {
    background-color: #f9fafb;
}

/* Alerts */
.alert-success {
    background: #dcfce7;
    color: #16a34a;
    padding: 16px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
    border: 1px solid #bbf7d0;
}

/* Forms */
.crud-form .form-group {
    margin-bottom: 20px;
}
.crud-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 0.9rem;
}
.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-family: inherit;
    font-size: 0.95rem;
    transition: all 0.2s;
}
.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

/* Buttons */
.btn-primary {
    background: var(--primary-color);
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    border: none;
    font-family: inherit;
    font-weight: 500;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}
.btn-primary:hover {
    background: var(--primary-hover);
    transform: translateY(-1px);
}
.btn-secondary {
    background: #e5e7eb;
    color: #374151;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    border: none;
    font-family: inherit;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-secondary:hover {
    background: #d1d5db;
}
.btn-icon {
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    padding: 6px;
    border-radius: 6px;
    transition: all 0.2s;
}
.btn-icon:hover {
    background: rgba(0,0,0,0.05);
}
';
file_put_contents('public/css/admin.css', $cssAppend, FILE_APPEND);

// Update layout sidebar links
$layout = file_get_contents('resources/views/layouts/admin.blade.php');
$layout = str_replace(
    '<a href="#" class="nav-link">
                    <i class="ph ph-users"></i> Masyarakat
                </a>',
    '<a href="{{ route(\'admin.users.index\') }}" class="nav-link {{ request()->routeIs(\'admin.users.*\') ? \'active\' : \'\' }}">
                    <i class="ph ph-users"></i> Masyarakat
                </a>',
    $layout
);
$layout = str_replace(
    '<a href="#" class="nav-link">
                    <i class="ph ph-user-circle-gear"></i> Petugas
                </a>',
    '<a href="{{ route(\'admin.petugas.index\') }}" class="nav-link {{ request()->routeIs(\'admin.petugas.*\') ? \'active\' : \'\' }}">
                    <i class="ph ph-user-circle-gear"></i> Petugas
                </a>',
    $layout
);
file_put_contents('resources/views/layouts/admin.blade.php', $layout);
