<?php

namespace App\Services;

use App\Models\Notifikasi;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\DB;

class DistribusiPengaduanService
{
    /**
     * Mengambil query builder untuk pengaduan yang sesuai dengan kategori petugas.
     *
     * @param int $petugasId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getPengaduanQueryForPetugas($petugasId)
    {
        // Ambil kategori yang ditugaskan ke petugas ini
        $kategoriIds = DB::table('petugas_kategoris')
            ->where('user_id', $petugasId)
            ->pluck('kategori_id');

        // Kembalikan query builder pengaduan dengan kategori tersebut
        return Pengaduan::whereIn('kategori_id', $kategoriIds);
    }

    /**
     * Mendistribusikan notifikasi ke seluruh petugas yang menangani kategori pengaduan baru.
     *
     * @param Pengaduan $pengaduan
     * @return void
     */
    public function notifyPetugasTerkait(Pengaduan $pengaduan)
    {
        // Cari petugas yang menangani kategori ini
        $petugasIds = DB::table('petugas_kategoris')
            ->where('kategori_id', $pengaduan->kategori_id)
            ->pluck('user_id');

        $notifikasis = [];
        $now = now();
        
        foreach ($petugasIds as $petugasId) {
            $notifikasis[] = [
                'user_id' => $petugasId,
                'pesan' => "Terdapat pengaduan baru masuk pada kategori Anda: '{$pengaduan->judul}'. Segera lakukan peninjauan.",
                'is_read' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Simpan semua notifikasi sekaligus
        if (!empty($notifikasis)) {
            Notifikasi::insert($notifikasis);
        }
    }
}
