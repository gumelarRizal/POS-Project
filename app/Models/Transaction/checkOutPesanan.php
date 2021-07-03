<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkOutPesanan extends Model
{
    use HasFactory;
    protected $table = 'tr_checkout';
    protected $fillable = [
        'id',
        'id_checkout',
        'id_detail_checkout',
        'subtotal',
        'id_user',
        'tgl_transaksi',
        'created_at',
    ];
}
