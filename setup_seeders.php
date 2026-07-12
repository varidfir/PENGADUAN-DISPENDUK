<?php

file_put_contents('database/seeders/AdminSeeder.php', '<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            \'name\' => \'Super Admin\',
            \'email\' => \'admin@sippel.com\',
            \'password\' => Hash::make(\'password\'),
            \'role\' => \'superadmin\',
        ]);
    }
}
');

file_put_contents('database/seeders/KategoriSeeder.php', '<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [\'nama_kategori\' => \'KTP Elektronik (e-KTP)\', \'deskripsi\' => \'Layanan terkait e-KTP\'],
            [\'nama_kategori\' => \'Kartu Keluarga (KK)\', \'deskripsi\' => \'Layanan terkait Kartu Keluarga\'],
            [\'nama_kategori\' => \'Akta Kelahiran\', \'deskripsi\' => \'Layanan terkait Akta Kelahiran\']
        ];
        
        foreach ($kategoris as $kat) {
            Kategori::create($kat);
        }
    }
}
');

file_put_contents('database/seeders/PetugasSeeder.php', '<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            \'name\' => \'Petugas 1\',
            \'email\' => \'petugas1@sippel.com\',
            \'password\' => Hash::make(\'password\'),
            \'role\' => \'petugas\',
        ]);
    }
}
');

file_put_contents('database/seeders/PetugasKategoriSeeder.php', '<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetugasKategori;

class PetugasKategoriSeeder extends Seeder
{
    public function run(): void
    {
        PetugasKategori::create([
            \'user_id\' => 2, // Petugas 1
            \'kategori_id\' => 1, // KTP
        ]);
    }
}
');

file_put_contents('database/seeders/DatabaseSeeder.php', '<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            KategoriSeeder::class,
            PetugasSeeder::class,
            PetugasKategoriSeeder::class,
        ]);
    }
}
');
