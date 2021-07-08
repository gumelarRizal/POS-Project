<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\KategoriBarang;
use App\Models\Transaction\checkOutPesanan;
use App\Models\Transaction\detailCheckoutPesanan;
use Illuminate\Support\Facades\DB;
use App\Models\MasterData\Menu;
use Auth;
use App\User;

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
        $listData = Menu::where('id_kategori_barang',$request->id_kategori_barang)->get();
        foreach($listData as $row){
            $html .= "<option value='".$row->id_barang."' data-nmbrg='".$row->nama_barang."'>".$row->nama_barang."</option>";
        }
        return $html;
    }

    public function selesaiPesan(Request $request){
        $data = json_decode($request->obj);
        $idCheckout = GenerateAutoIncrementCd('tr_checkout','id_checkout','TRXCK');
        // dd($idDtCheckout);
        $total = 0;
        foreach($data as $item){
            $idDtCheckout = GenerateAutoIncrementCd('dt_checkout','id_dt_checkout','DTCK');
            $result = detailCheckoutPesanan::create([
                'id_dt_checkout' =>$idDtCheckout,
                'id_checkout' =>$idCheckout,
                'id_barang' =>$item->brg,
                'id_kategori_barang' =>$item->ktgBrg,
                'subtotal'=>$item->sbtl,
                'qty'=>$item->qty,
                'id_user'=>Auth::user()->id
            ]);
            $total += $item->sbtl;
        }
        $result = checkOutPesanan::create([
            'id_checkout' =>$idCheckout,
            'subtotal'=>$total,
            'id_user'=>Auth::user()->id
        ]);
        if($result){
            $msg = ['msg'=>'Transaksi berhasil'];
        }
        return response()->json($msg);
        
    }
}
