<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'dt_pembelian';
    protected $fillable = [
        'id_dt_pembelian',
        'id_pembelian',
        'id_barang',
        'id_kategori_barang',
        'subtotal',
        'qty'

    ];
}
