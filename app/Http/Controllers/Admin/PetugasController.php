<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->with('kategoris')->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.petugas.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'kategori_ids' => 'nullable|array',
            'kategori_ids.*' => 'exists:kategoris,id',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'petugas'
            ]);

            if ($request->has('kategori_ids')) {
                $user->kategoris()->sync($request->kategori_ids);
            }

            DB::commit();
            return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan beserta penugasannya');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        $kategoris = Kategori::all();
        $assignedKategoriIds = $petugas->kategoris->pluck('id')->toArray();
        return view('admin.petugas.edit', compact('petugas', 'kategoris', 'assignedKategoriIds'));
    }

    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$petugas->id,
            'kategori_ids' => 'nullable|array',
            'kategori_ids.*' => 'exists:kategoris,id',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name', 'email']);
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $petugas->update($data);
            $petugas->kategoris()->sync($request->kategori_ids ?? []);

            DB::commit();
            return redirect()->route('admin.petugas.index')->with('success', 'Data Petugas dan Penugasan berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
}