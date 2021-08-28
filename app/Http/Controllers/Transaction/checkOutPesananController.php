<?php

namespace App\Http\Controllers\Transaction;

use Auth;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Models\MasterData\Menu;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterData\KategoriBarang;
use App\Models\Transaction\checkOutPesanan;
use App\Models\Transaction\detailCheckoutPesanan;

class checkOutPesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kode_trans = '';
        $titleBreadcrump = 'Checkout';
        $dropDownKtgBarang = DB::select('
        select 
            DISTINCT a.id_kategori_barang,
            nama_kategori_barang 
        from mt_kategori_barang a
        join mt_barang b 
            on a.id_kategori_barang = b.id_kategori_barang
            ');
        return view('Transaction.Checkout.CheckoutPesanan', ['titleBreadcrump' => $titleBreadcrump, 'dropDownKtgBarang' => $dropDownKtgBarang]);
    }

    public function getParentKtgBrg(Request $request)
    {
        $html = "<option value='' selected disabled>--Pilih--</option>";
        $listData = Menu::where('id_kategori_barang', $request->id_kategori_barang)->get();
        foreach ($listData as $row) {
            $html .= "<option value='" . $row->id_barang . "' data-nmbrg='" . $row->nama_barang . "' data-harga='" . $row->harga_jual . "'>" . $row->nama_barang . "</option>";
        }
        return $html;
    }

    public function selesaiPesan(Request $request)
    {
        $data = json_decode($request->obj);
        $idCheckout = GenerateAutoIncrementCd('tr_checkout', 'id_checkout', 'TRXCK');
        // dd($idDtCheckout);
        $total = $request->total;
        $result = checkOutPesanan::create([
            'id_checkout' => $idCheckout,
            'total' => $total,
            'id_user' => Auth::user()->id
        ]);

        foreach ($data as $item) {
            $idDtCheckout = GenerateAutoIncrementCd('dt_checkout', 'id_dt_checkout', 'DTCK');
            $result = detailCheckoutPesanan::create([
                'id_dt_checkout' => $idDtCheckout,
                'id_checkout' => $idCheckout,
                'id_barang' => $item->brg,
                'id_kategori_barang' => $item->ktgBrg,
                'harga_barang' => $item->hrg,
                'subtotal' => $item->sbtl,
                'qty' => $item->qty,
                'disc' => $item->disc,
                'id_user' => Auth::user()->id
            ]);

            Menu::where('id_kategori_barang', '=', $item->ktgBrg)
                ->where('id_barang', '=', $item->brg)
                ->decrement('stok', $item->qty);
        }
        
        if ($result) {
            $msg = ['msg' => 'Transaksi berhasil'];
        }
        return response()->json($msg);
    }

    public function cetakStruk(){
        $listHeader = DB::table('tr_checkout')
                        ->select(
                            DB::raw('
                                    DISTINCT(name) Cashier,
                                    tr_checkout.id_checkout,
                                    total,(select sum(disc) from dt_checkout dc where id_checkout = (select id_checkout from tr_checkout tc order by id desc limit 1)) Diskon'))
                        ->join('users','tr_checkout.id_user','=','users.id')
                        ->orderByRaw('tr_checkout.id DESC')
                        ->limit(1)
                        ->first();
        $listDetail = DB::table('dt_checkout')
                        ->select(DB::raw('mt_barang.nama_barang , dt_checkout.harga_barang ,dt_checkout.qty ,(dt_checkout.subtotal + dt_checkout.disc) total'))
                        ->join('mt_barang','dt_checkout.id_barang','=','mt_barang.id_barang')
                        ->where('dt_checkout.id_checkout',function($query){
                            $query->select(DB::raw('id_checkout from tr_checkout tc order by id desc limit 1'));
                        })->get();
        // dd($listDetail);
        $customPaper = array(0,0,400.00,283.80);
        $pdf = PDF::loadview('Transaction.Checkout.Struk',compact('listHeader','listDetail'))->setPaper($customPaper, 'landscape');
        return $pdf->stream();
    }
}
