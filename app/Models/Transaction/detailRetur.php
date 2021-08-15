<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailRetur extends Model
{
    use HasFactory;
    protected $table = 'dt_retur';
    protected $fillable = [
        'id',
        'id_dt_retur',
        'id_retur',
        'id_kategori_barang',
        'id_barang',
        'id_jasa',
        'deskripsi',
        'harga_barang',
        'harga_jasa',
        'subtotal',
        'qty',
        'created_at',
    ];
}
