<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'tr_presensi';
    protected $fillable = [
        'id',
        'id_presensi',
        'id_user',
        'jam_masuk',
        'jam_keluar',
        'total_jam',
        'tgl_transaksi',
        'created_at',
    ];
}
