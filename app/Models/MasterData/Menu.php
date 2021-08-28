<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'mt_barang';
    protected $fillable = [
        'id',
        'id_barang',
        'id_kategori_barang',
        'nama_barang',
        'stok',
        'harga',
        'harga_jual',
        'satuan',
        'created_at',
    ];
}
