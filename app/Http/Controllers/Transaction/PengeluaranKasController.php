<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction\PengeluaranKas;

class PengeluaranKasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $COA = COA::where('id_coa','like','5%')->get();
        return view('Transaction.PengeluaranKas.index', compact('COA'));
    }
    public function read(){
        $listData = DB::table('');
    }
    public function simpan(Request $request){
        $data = json_decode($request->obj);
        $total = $request->total;
        $idPengeluaranKas = GenerateAutoIncrementCd('tr_pengeluaranKas','id_pengeluaranKas','PNG');
        PengeluaranKas::create([
            'id_pengeluaranKas' => $idpengeluaranKas,
            'total' => $total,
        ]);
        
        foreach($data as $item){
            $idDtpengeluaranKas = GenerateAutoIncrementCd('dt_pengeluaranKas','id_dt_pengeluaranKas','PNGD');
            pengeluaranKasDetail::create([
                'id_pengeluaranKas' => $idpengeluaranKas,
                'id_dt_pengeluaranKas' => $idDtpengeluaranKas,
                'id_coa' => $item->coa,
                'subtotal' => $item->sbtl,
                'qty' => $item->jml
            ]);
        }

        return response()->json(['msg' => 'Transaksi berhasil disimpan']);
    }
}
