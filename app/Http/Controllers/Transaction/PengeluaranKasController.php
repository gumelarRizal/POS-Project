<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Models\MasterData\COA;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction\PengeluaranKas;
use App\Models\Transaction\PengeluaranKasDetail;

class PengeluaranKasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $titleBreadcrump = 'Pengeluaran Kas';
        return view('Transaction.PengeluaranKas.PengeluaranKas', compact('titleBreadcrump'));
    }
    public function read(){
        $YearMonth = date('Y').date('m');
        $listData = PengeluaranKas::whereRaw('concat(date_format(tgl_transaksi,"%Y"),date_format(tgl_transaksi,"%m")) = '.$YearMonth.'')->get();
        return view('Transaction.PengeluaranKas.PengeluaranKasRead',compact('listData'));
    }
    public function Add(){
        $COA = COA::where('id_coa','like','5%')->get();
        $titleBreadcrump = 'Pengeluaran Kas';
        $idPengeluaranKas = GenerateAutoIncrementCd('tr_pengeluaranKas','id_pengeluaranKas','PNG');
        return view('Transaction.PengeluaranKas.PengeluaranKasAdd',compact('idPengeluaranKas','titleBreadcrump','COA'));
    }
    public function simpan(Request $request){
        $total = 0;
        $count = count($request->total);

        for($t=0;$t<$count;$t++){
            $total += preg_replace('/\D/','',$request->total[$t]);
        }
        $result = PengeluaranKas::create([
            'id_pengeluaranKas' => $request->idTrans,
            'total'=>$total,
            'deskripsi'=>$request->deskripsi
        ]);

        for($t=0;$t<$count;$t++){
            $idDtpengeluaranKas = GenerateAutoIncrementCd('dt_pengeluaranKas','id_dt_pengeluaranKas','PNGD');
            PengeluaranKasDetail::create([
                'id_pengeluaranKas' => $request->idTrans,
                'id_dt_pengeluaranKas' => $idDtpengeluaranKas,
                'id_coa' => $request->coa[$t],
                'subtotal' => preg_replace('/\D/','',$request->total[$t])
            ]);
        }

        return response()->json(['msg' => 'Transaksi berhasil disimpan']);
    }
}
