<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COA extends Model
{
    use HasFactory;
    protected $table = 'mt_coa';
    protected $fillable = [
        'id',
        'id_coa',
        'nama_coa',
        'CREATED_BY'
    ];
}
