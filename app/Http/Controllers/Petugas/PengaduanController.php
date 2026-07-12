<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\LogStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\DistribusiPengaduanService;

class PengaduanController extends Controller {

    public function show($id)
    {
        // Get the specific pengaduan, ensuring it's one the petugas can access
        $pengaduan = Pengaduan::with(['kategori', 'lampirans', 'tanggapans.user', 'user'])->findOrFail($id);

        // Mark as "Diproses" if it was "Menunggu" when Petugas opens it for the first time
        if ($pengaduan->status == 'Menunggu') {
            $pengaduan->update(['status' => 'Diproses']);
            LogStatus::create([
                'pengaduan_id' => $pengaduan->id,
                'status_sebelumnya' => 'Menunggu',
                'status_baru' => 'Diproses',
                'user_id' => Auth::id(),
            ]);

            // Send notification (placeholder for actual notification implementation)
            $distribusiService = app(DistribusiPengaduanService::class);
            // $distribusiService->notifyMasyarakat($pengaduan, "Pengaduan Anda sedang diproses oleh petugas."); // Assuming this method exists or will be added
        }

        return view('petugas.pengaduan.show', compact('pengaduan'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'nullable|string',
            'status' => 'required|in:Diproses,Selesai,Ditolak',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        DB::beginTransaction();
        try {
            // Save tanggapan if provided
            if ($request->filled('tanggapan')) {
                Tanggapan::create([
                    'pengaduan_id' => $pengaduan->id,
                    'user_id' => Auth::id(),
                    'tanggapan' => $request->tanggapan,
                ]);
            }

            // Update status if changed
            if ($pengaduan->status != $request->status) {
                $oldStatus = $pengaduan->status;
                $pengaduan->update(['status' => $request->status]);

                LogStatus::create([
                    'pengaduan_id' => $pengaduan->id,
                    'status_sebelumnya' => $oldStatus,
                    'status_baru' => $request->status,
                    'user_id' => Auth::id(),
                ]);
            }

            DB::commit();

            $message = 'Berhasil memperbarui pengaduan.';
            if ($request->filled('tanggapan') && $pengaduan->status != $request->status) {
                $message = 'Tanggapan dikirim dan status diperbarui.';
            } elseif ($request->filled('tanggapan')) {
                $message = 'Tanggapan berhasil dikirim.';
            } elseif ($pengaduan->status != $request->status) {
                $message = 'Status berhasil diperbarui.';
            }

            return redirect()->route('petugas.pengaduan.show', $id)->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function index()
    {
        // Fetch all complaints (you may limit to categories assigned to the petugas)
        $pengaduans = Pengaduan::with(['kategori', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('petugas.pengaduan.index', compact('pengaduans'));
    }

}
