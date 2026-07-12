<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMasyarakat = User::where('role', 'masyarakat')->count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $totalKategori = Kategori::count();
        $totalPengaduan = Pengaduan::count();
        
        $pengaduanMenunggu = Pengaduan::where('status', 'Menunggu')->count();
        $pengaduanDiproses = Pengaduan::where('status', 'Diproses')->count();
        $pengaduanSelesai = Pengaduan::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact(
            'totalMasyarakat', 'totalPetugas', 'totalKategori', 'totalPengaduan',
            'pengaduanMenunggu', 'pengaduanDiproses', 'pengaduanSelesai'
        ));
    }
}
