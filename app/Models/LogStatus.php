<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStatus extends Model
{
    protected $fillable = ['pengaduan_id', 'user_id', 'status_lama', 'status_baru'];
}
