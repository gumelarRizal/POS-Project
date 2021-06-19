<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'mt_menu';
    protected $fillable = [
        'id',
        'id_menu',
        'id_kategori_menu',
        'nama_menu',
        'harga',
        'created_at',
    ];
}
