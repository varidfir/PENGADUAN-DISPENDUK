<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Services\DistribusiPengaduanService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        // Service to get query for petugas
        $service = app(DistribusiPengaduanService::class);
        $query = $service->getPengaduanQueryForPetugas($userId);

        // Count per status
        $newCount = (clone $query)->where('status', 'Menunggu')->count();
        $processCount = (clone $query)->where('status', 'Diproses')->count();
        $completedCount = (clone $query)->where('status', 'Selesai')->count();

        // Clone query for grouped statistics (no ordering)
        $grouped = (clone $query)
            ->select('kategori_id', 'status', DB::raw('count(*) as total'))
            ->groupBy('kategori_id', 'status')
            ->get();

        // Transform grouped data into a nested associative array for easy lookup in view
        $stats = [];
        foreach ($grouped as $row) {
            $stats[$row->kategori_id][$row->status] = $row->total;
        }

        // List of pengaduan for table
        $pengaduanList = $query->orderBy('created_at', 'desc')->paginate(10);

        $kategoriIds = DB::table('petugas_kategoris')->where('user_id', $userId)->pluck('kategori_id');
        $kategoriList = Kategori::whereIn('id', $kategoriIds)->get();

        return view('petugas.dashboard', [
            'newCount' => $newCount,
            'processCount' => $processCount,
            'completedCount' => $completedCount,
            'pengaduanList' => $pengaduanList,
            'kategoriList' => $kategoriList,
            'grouped' => $grouped,
            'stats' => $stats,
        ]);
    }
}

?>
