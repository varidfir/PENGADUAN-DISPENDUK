<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = ['pengaduan_id', 'user_id', 'tanggapan'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
