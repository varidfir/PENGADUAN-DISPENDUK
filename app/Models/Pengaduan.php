<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = ['user_id', 'kategori_id', 'judul', 'deskripsi', 'status'];

    public function user() { return $this->belongsTo(User::class); }
    public function kategori() { return $this->belongsTo(Kategori::class); }
    public function lampirans() { return $this->hasMany(Lampiran::class); }
    public function tanggapans() { return $this->hasMany(Tanggapan::class); }
    public function logStatuses() { return $this->hasMany(LogStatus::class); }
}
