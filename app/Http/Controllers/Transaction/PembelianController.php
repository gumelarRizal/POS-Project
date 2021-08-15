<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\KategoriBarang;
use App\Models\MasterData\Menu;
use App\Models\Transaction\PembelianHeader;
use App\Models\Transaction\PembelianDetail;

class PembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $kategori = KategoriBarang::select('id_kategori_barang', 'nama_kategori_barang')->orderBy('nama_kategori_barang')->get();
        return view('Transaction.Pembelian.index', ['kategori' => $kategori]);
    }

    public function barang(Request $request){
        $barang = Menu::where('id_kategori_barang', $request->id)->select('id_barang', 'nama_barang')->get();
        return response()->json($barang);
    }

    public function simpan(Request $request){
        $data = json_decode($request->obj);
        $total = $request->total;
        $idPembelian = GenerateAutoIncrementCd('tr_pembelian','id_pembelian','PEMBH');
        PembelianHeader::create([
            'id_pembelian' => $idPembelian,
            'total' => $total,
        ]);
        
        foreach($data as $item){
            $idDtPembelian = GenerateAutoIncrementCd('dt_pembelian','id_dt_pembelian','PEMBD');
            PembelianDetail::create([
                'id_pembelian' => $idPembelian,
                'id_dt_pembelian' => $idDtPembelian,
                'id_kategori_barang' => $item->ktg,
                'id_barang' => $item->brg,
                'subtotal' => $item->sbtl,
                'qty' => $item->jml
            ]);

            Menu::where('id_kategori_barang', '=', $item->ktg)
                ->where('id_barang', '=', $item->brg)
                ->increment('stok', $item->jml)
            ;
        }

        return response()->json(['msg' => 'Transaksi berhasil disimpan']);

    }
}
