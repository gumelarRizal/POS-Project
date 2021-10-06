<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $listPelanggan = Pelanggan::all();
        $titleBreadcrump = 'Pelanggan';
        return view('MasterData.Pelanggan.PelangganIndex',compact('listPelanggan','titleBreadcrump'));
    }
}
