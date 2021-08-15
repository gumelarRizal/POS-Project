<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jasa extends Model
{
    use HasFactory;
    protected $table = 'mt_jasa';
    protected $fillable = [
        'id',
        'id_jasa',
        'nama_jasa',
        'harga_jasa',
        'satuan',
        'created_at',
    ];
}
