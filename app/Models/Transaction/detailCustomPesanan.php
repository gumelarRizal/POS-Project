<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailCustomPesanan extends Model
{
    use HasFactory;
    protected $table = 'dt_custompesanan';
    protected $fillable = [
        'id',
        'id_dt_customPesanan',
        'id_customPesanan',
        'id_barang',
        'id_kategori_barang',
        'id_jasa',
        'harga_barang',
        'harga_jasa',
        'discount',
        'subtotal',
        'subtotal2',
        'qty',
        'deskripsi',
        'created_at',
    ];
}
