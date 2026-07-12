<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Lampiran;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('masyarakat.pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Max 2MB per file
        ]);

        DB::beginTransaction();
        try {
            $pengaduan = Pengaduan::create([
                'user_id' => Auth::id(),
                'kategori_id' => $request->kategori_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => 'Menunggu',
            ]);

            if ($request->hasFile('lampiran')) {
                foreach ($request->file('lampiran') as $file) {
                    $path = $file->store('pengaduan', 'public');
                    Lampiran::create([
                        'pengaduan_id' => $pengaduan->id,
                        'file_path' => $path,
                    ]);
                }
            }

            // Distribusikan Notifikasi ke Petugas Terkait
            $distribusiService = app(\App\Services\DistribusiPengaduanService::class);
            $distribusiService->notifyPetugasTerkait($pengaduan);

            DB::commit();
            return redirect()->route('masyarakat.dashboard')->with('success', 'Pengaduan berhasil dikirim.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pengaduan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'lampirans', 'tanggapans.user', 'logStatuses'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }

    public function chat(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::where('user_id', Auth::id())->findOrFail($id);

        \App\Models\Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => Auth::id(),
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('masyarakat.pengaduan.show', $id)->with('success', 'Pesan berhasil dikirim.');
    }
}
