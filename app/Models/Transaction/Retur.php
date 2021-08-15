<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = 'tr_retur';
    protected $fillable = [
        'id',
        'id_retur',
        'id_customPesanan',
        'total',
        //'id_user',
        // 'status',
        'tgl_transaksi',
        'created_at',
    ];
}
