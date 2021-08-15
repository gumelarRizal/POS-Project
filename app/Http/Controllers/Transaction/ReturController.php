<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Models\Transaction\Retur;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction\detailRetur;
use App\Models\Transaction\CustomPesanan;

class ReturController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $kode_trans = '';
        $titleBreadcrump = 'Retur Barang';
        return view('Transaction.Retur.Retur',compact('titleBreadcrump'));
    }
    public function read(Request $request){
        $YearMonth = date('Y').date('m');
        $listData = DB::table('tr_retur')
                    ->select(DB::Raw('tr_retur.id_retur ,tr_custompesanan.id_customPesanan , mt_pelanggan.nama_pelanggan, tr_retur.tgl_transaksi,tr_retur.total'))
                    ->join('tr_custompesanan','tr_retur.id_customPesanan','=','tr_custompesanan.id_customPesanan')
                    ->join('mt_pelanggan','tr_custompesanan.id_pelanggan','=','mt_pelanggan.id_pelanggan')
                    ->whereRaw('concat(date_format(tr_retur.tgl_transaksi,"%Y"),date_format(tr_retur.tgl_transaksi,"%m")) = '.$YearMonth.'')
                    ->get();
        return view('Transaction.Retur.ReturRead',compact('listData'));
    }               
    public function add(){
        $idRetur = GenerateAutoIncrementCd('tr_retur', 'id_retur', 'RTR');
        $titleBreadcrump = 'Retur Barang';
        $dropDownIdTrans = DB::table('tr_custompesanan')
                            ->select(DB::raw('id_customPesanan , mt_pelanggan.nama_pelanggan , tr_custompesanan.total,users.name as Cashier,alamat'))
                            ->join('mt_pelanggan','mt_pelanggan.id_pelanggan','=','tr_custompesanan.id_pelanggan')
                            ->join('users','users.id','=','tr_custompesanan.id_user')
                            ->get();
        return view('Transaction.Retur.ReturAdd',compact('idRetur','titleBreadcrump','dropDownIdTrans'));
    }
    public function GetDetailRetur(Request $request){
        $id = $request->id;
        $Data = DB::table('tr_retur')
                    ->select(DB::Raw('tr_retur.id_retur ,tr_custompesanan.id_customPesanan , mt_pelanggan.nama_pelanggan, tr_retur.tgl_transaksi'))
                    ->join('tr_custompesanan','tr_retur.id_customPesanan','=','tr_custompesanan.id_customPesanan')
                    ->join('mt_pelanggan','tr_custompesanan.id_pelanggan','=','mt_pelanggan.id_pelanggan')
                    ->whereRaw('tr_retur.id_retur = "'.$id.'"')
                    ->first();
        $listData = DB::select('
        select dr.id_dt_retur , mb.nama_barang ,dr.qty ,dr.harga_barang, dr.subtotal 
        from dt_retur dr 
        join tr_retur tr 
            on dr.id_retur = tr.id_retur 
        join mt_barang mb 
            on dr.id_barang = mb.id_barang 
        where dr.id_retur = "'.$id.'"
        ');
        return view('Transaction.Retur.ReturDetail',compact('Data','listData'));
    }
    public function GetByIdTrans(Request $request){
        $idTrans = $request->id_trans;
        $listData = DB::select('
        select tc.id_customPesanan ,mb.id_barang,mb.nama_barang ,dc.harga_barang ,dc.qty ,dc.subtotal 
        from tr_custompesanan tc 
        join dt_custompesanan dc 
            on tc.id_customPesanan = dc.id_customPesanan 
        join mt_barang mb 
            on mb.id_barang = dc.id_barang 
        where tc.id_customPesanan = "'.$idTrans.'"');
        $html = view('Transaction.Retur.ReturListDetail',compact('listData'))->render();
        return $html;
    }

    public function SaveProcess(Request $request){
        $idRetur = GenerateAutoIncrementCd('tr_retur', 'id_retur', 'RTR');
        $total = 0;
        $count = count($request->id_customPesanan);
        for($t=0;$t<$count;$t++){
            $total += preg_replace('/\D/','',$request->subtotal[$t]);
        }
        $result = Retur::create([
            'id_retur' => $idRetur,
            'id_customPesanan' => $request->idTrans,
            'total'=>$total
        ]);
        for($i=0;$i<$count;$i++){
            $idDtRetur = GenerateAutoIncrementCd('dt_retur', 'id_dt_retur', 'DTR');
            $result = detailRetur::create([
                'id_dt_retur' => $idDtRetur,
                'id_retur' => $idRetur,
                'id_barang'=> $request->id_barang[$i],
                'harga_barang'=> preg_replace('/\D/','',$request->harga_barang[$i]),
                'qty'=> $request->qty[$i],
                'subtotal'=>preg_replace('/\D/','',$request->subtotal[$i])
            ]);
        }
        if ($result) {
            $msg = ['msg' => 'Transaksi berhasil'];
        }
        return response()->json($msg);
    }
}
