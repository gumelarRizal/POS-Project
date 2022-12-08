<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'mt_pelanggan';
    protected $fillable = [
        'id',
        'id_pelanggan',
        'nama_pelanggan',
        'alamat',
        'email',
        'no_telp',
        'created_at',
    ];
}
