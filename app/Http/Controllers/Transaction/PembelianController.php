<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\KategoriBarang;
use App\Models\MasterData\Menu;

class PembelianController extends Controller
{
    public function index(){
        $kategori = KategoriBarang::select('id_kategori_barang', 'nama_kategori_barang')->orderBy('nama_kategori_barang')->get();
        return view('Transaction.Pembelian.index', ['kategori' => $kategori]);
    }

    public function barang(Request $request){
        $barang = Menu::where('id_kategori_barang', $request->id)->select('id_barang', 'nama_barang')->get();
        return response()->json($barang);
    }
}
