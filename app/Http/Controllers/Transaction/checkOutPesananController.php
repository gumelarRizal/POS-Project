<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\KategoriBarang;
use App\Models\Transaction\checkOutPesanan;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\Menu;

class checkOutPesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $kode_trans = '';
        $titleBreadcrump = 'Checkout';
        $dropDownKtgBarang = KategoriBarang::all();
        return view('Transaction.Checkout.CheckoutPesanan',['titleBreadcrump'=>$titleBreadcrump,'dropDownKtgBarang'=>$dropDownKtgBarang]);
    }

    public function getParentKtgBrg(Request $request){
        $html = "";
        // $listData = Menu::where('id_kategori_barang',$request->id_kategori_barang)->get();
        $listData = DB::select('
            Select * from mt_barang where id_kategori_barang = "'.$request->id_kategori_barang.'"
        ');
        // dd($listData);
        foreach($listData as $row){
            $html .= "<option value='".$row->id_barang."'>".$row->nama_barang."</option>";
        }
        return $html;
    }
}
