<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    // Show list of all pengaduans for admin
    public function index()
    {
        $pengaduans = Pengaduan::with(['user', 'kategori', 'lampirans', 'tanggapans.user', 'logStatuses'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    // Show detailed view of a specific pengaduan
    public function show($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'lampirans', 'tanggapans.user', 'logStatuses'])
            ->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }
}
