<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetugasKategori;

class PetugasKategoriSeeder extends Seeder
{
    public function run(): void
    {
        PetugasKategori::create([
            'user_id' => 2, // Petugas 1
            'kategori_id' => 1, // KTP
        ]);
    }
}
