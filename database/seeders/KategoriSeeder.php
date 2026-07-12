<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'KTP Elektronik (e-KTP)', 'deskripsi' => 'Layanan terkait perekaman, cetak, dan data e-KTP'],
            ['nama_kategori' => 'Kartu Keluarga (KK)', 'deskripsi' => 'Layanan terkait pembuatan dan perubahan Kartu Keluarga'],
            ['nama_kategori' => 'Akta Kelahiran', 'deskripsi' => 'Layanan pembuatan Akta Kelahiran baru atau hilang/rusak'],
            ['nama_kategori' => 'Akta Kematian', 'deskripsi' => 'Layanan penerbitan Akta Kematian'],
            ['nama_kategori' => 'Kartu Identitas Anak (KIA)', 'deskripsi' => 'Layanan pembuatan Kartu Identitas Anak'],
            ['nama_kategori' => 'Surat Pindah Datang', 'deskripsi' => 'Layanan administrasi pindah alamat masuk atau keluar daerah'],
            ['nama_kategori' => 'Perubahan Data Kependudukan', 'deskripsi' => 'Layanan pembetulan atau update data kependudukan'],
            ['nama_kategori' => 'Layanan Administrasi Kependudukan Lainnya', 'deskripsi' => 'Layanan kependudukan lainnya yang tidak termasuk kategori di atas']
        ];
        
        foreach ($kategoris as $kat) {
            Kategori::create($kat);
        }
    }
}
