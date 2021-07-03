<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;
    protected $table = 'mt_kategori_barang';
    protected $fillable = [
        'id',
        'id_kategori_barang',
        'nama_kategori_barang',
        'CREATED_BY'
    ];
}
