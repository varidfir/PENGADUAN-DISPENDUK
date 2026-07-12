<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function petugas()
    {
        return $this->belongsToMany(User::class, 'petugas_kategoris', 'kategori_id', 'user_id');
    }
}
