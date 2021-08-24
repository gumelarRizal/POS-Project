<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Transaction\Presensi;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Read(){
        date_default_timezone_set("Asia/Bangkok");
        $listData = Presensi::select('jam_masuk','jam_keluar','total_jam')
                ->whereRaw('id_user = "'.Auth::user()->id.'"')
                ->whereRaw('tgl_transaksi = "'.date('Y-m-d').'"')
                ->get();
        return view('Transaction.Presensi.Presensi',compact('listData'));
    }

    public function Masuk(){
        date_default_timezone_set("Asia/Bangkok");
        $idUsr = Auth::user()->id;
        $idPresensi = GenerateAutoIncrementCd('tr_presensi','id_presensi','ABS');
        $return = Presensi::create([
            'id_presensi'=>$idPresensi,
            'id_user'=>$idUsr,
            'jam_masuk'=>date('H:i:s'),
            'tgl_transaksi'=>date('Y-m-d')
        ]);
        $checkExist = Presensi::where('id_user','=',''.Auth::user()->id.'')
                                ->where('tgl_transaksi','=',''.date('Y-m-d').'')
                                ->first();
        $resp = [
            'msg'=>'Anda sudah Absen',
            'check'=>$checkExist->id_user   
        ];
        return response()->json($resp);
    }

    public function Keluar(){
        date_default_timezone_set("Asia/Bangkok");
        $checkExist = Presensi::where('id_user','=',''.Auth::user()->id.'')
                                ->where('tgl_transaksi','=',''.date('Y-m-d').'')
                                ->first();
        $currentTime = strtotime(date('H:i:s'));
        $prevTime = strtotime($checkExist->jam_masuk);
        $diff = $currentTime - $prevTime;
        $jam = floor($diff/(60*60));
        $menit = $diff-$jam*(60*60);
        $total_jam = 'Jam = '.$jam.' Menit = '.floor($menit/60).' Detik = '.number_format($diff,0,",",".").'';

        $result = Presensi::where('id_user','=',''.Auth::user()->id.'')
                ->where('tgl_transaksi','=',''.date('Y-m-d').'')
                ->update([
                    'jam_keluar'=>date('H:i:s'),
                    'total_jam'=>$total_jam
                ]);

        $resp = [
            'msg'=>'Anda sudah Pulang, Terimakasih',
            'check'=>$checkExist->id_user   
        ];
        return response()->json($resp);
    }

    public function IsExistsPresensi(){
        date_default_timezone_set("Asia/Bangkok");
        $check = '';
        $checkExist = Presensi::whereRaw('id_user = "'.Auth::user()->id.'"')
                                ->whereRaw('tgl_transaksi = "'.date('Y-m-d').'"')
                                ->first();
        if($checkExist != null){
            $check = $checkExist->id_user ;
        }

        $resp = [
            'check'=>$check   
        ];
        return response()->json($resp);
    }
}
