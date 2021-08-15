<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPesanan extends Model
{
    use HasFactory;
    protected $table = 'tr_custompesanan';
    protected $fillable = [
        'id',
        'id_customPesanan',
        'id_pelanggan',
        'jumlahByr',
        'total',
        'id_user',
        'status',
        'tgl_transaksi',
        'created_at',
    ];
}
