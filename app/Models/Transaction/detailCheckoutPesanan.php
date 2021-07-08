<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailCheckoutPesanan extends Model
{
    use HasFactory;
    protected $table = 'dt_checkout';
    protected $fillable = [
        'id',
        'id_dt_checkout',
        'id_checkout',
        'id_barang',
        'id_kategori_barang',
        'subtotal',
        'qty',
        'created_at',
    ];
}
