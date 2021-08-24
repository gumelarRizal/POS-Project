<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranKasDetail extends Model
{
    use HasFactory;
    protected $table = 'dt_pengeluaranKas';
    protected $fillable = [
        'id',
        'id_dt_pengeluaranKas',
        'id_pengeluaranKas',
        'id_coa',
        'subtotal',
        'created_at',
    ];
}
