<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranKas extends Model
{
    use HasFactory;
    protected $table = 'tr_pengeluaranKas';
    protected $fillable = [
        'id',
        'id_pengeluaranKas',
        'total',
        'deskripsi',
        //'id_user',
        // 'status',
        'tgl_transaksi',
        'created_at',
    ];
}
