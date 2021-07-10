<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianHeader extends Model
{
    use HasFactory;
    protected $table = 'tr_pembelian';
    protected $fillable = [
        'id',
        'id_pembelian',
        'total',
        'tgl_transaksi'
    ];
}
