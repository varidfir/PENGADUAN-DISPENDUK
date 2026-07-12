<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $pengaduanSaya = Pengaduan::where('user_id', $userId);

        $totalPengaduan = (clone $pengaduanSaya)->count();

        $pengaduanMenunggu = (clone $pengaduanSaya)->where('status', 'Menunggu')->count();
        $pengaduanDiproses = (clone $pengaduanSaya)->where('status', 'Diproses')->count();
        $pengaduanSelesai = (clone $pengaduanSaya)->where('status', 'Selesai')->count();

        $riwayatTerbaru = $pengaduanSaya
            ->with('kategori')
            ->latest('id')
            ->limit(5)
            ->get();

        return view('masyarakat.dashboard', compact(
            'totalPengaduan',
            'pengaduanMenunggu',
            'pengaduanDiproses',
            'pengaduanSelesai',
            'riwayatTerbaru'
        ));
    }
}

