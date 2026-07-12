<?php

file_put_contents('app/Models/User.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        \'nik\', \'name\', \'email\', \'telp\', \'role\', \'password\',
    ];

    protected $hidden = [
        \'password\', \'remember_token\',
    ];

    protected function casts(): array
    {
        return [
            \'email_verified_at\' => \'datetime\',
            \'password\' => \'hashed\',
        ];
    }
}
');

file_put_contents('app/Models/Kategori.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [\'nama_kategori\', \'deskripsi\'];
}
');

file_put_contents('app/Models/PetugasKategori.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasKategori extends Model
{
    protected $fillable = [\'user_id\', \'kategori_id\'];
}
');

file_put_contents('app/Models/Pengaduan.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [\'user_id\', \'kategori_id\', \'judul\', \'deskripsi\', \'status\'];

    public function user() { return $this->belongsTo(User::class); }
    public function kategori() { return $this->belongsTo(Kategori::class); }
    public function lampirans() { return $this->hasMany(Lampiran::class); }
    public function tanggapans() { return $this->hasMany(Tanggapan::class); }
    public function logStatuses() { return $this->hasMany(LogStatus::class); }
}
');

file_put_contents('app/Models/Lampiran.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    protected $fillable = [\'pengaduan_id\', \'file_path\'];
}
');

file_put_contents('app/Models/Tanggapan.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = [\'pengaduan_id\', \'user_id\', \'tanggapan\'];
}
');

file_put_contents('app/Models/Notifikasi.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = [\'user_id\', \'pesan\', \'is_read\'];
}
');

file_put_contents('app/Models/LogStatus.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStatus extends Model
{
    protected $fillable = [\'pengaduan_id\', \'user_id\', \'status_lama\', \'status_baru\'];
}
');

file_put_contents('app/Models/Banner.php', '<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [\'judul\', \'gambar\', \'is_active\'];
}
');
