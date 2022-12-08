<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        // $listPelanggan = Pelanggan::all();
        $titleBreadcrump = 'Pelanggan';
        return view('MasterData.Pelanggan.PelangganIndex',compact('titleBreadcrump'));
    }
    public function read(Request $request){
        $where = '1=1';
        if($request->notelp <> null || $request->notelp <> ""){
            $where = 'no_telp like "%'.$request->notelp.'%"';
        }
        if($request->nama_pelanggan <> null || $request->nama_pelanggan <> ""){
            $where = 'nama_pelanggan like "%'.$request->nama_pelanggan.'%"';
        }
        if($request->notelp <> null && $request->nama_pelanggan <> null){
            $where = 'nama_pelanggan like "%'.$request->nama_pelanggan.'%" && no_telp like "%'.$request->notelp.'%"';
        }
        $listPelanggan = DB::table('mt_pelanggan')->whereRaw($where)->get();
        $html = view('MasterData.Pelanggan.PelangganList',compact('listPelanggan'));
        return $html;
    }
    public function store(Request $request){
        $msg = [];
        $kodePelanggan = GenerateAutoIncrementCd('mt_pelanggan','id_pelanggan','PLG');
        if($request->id == ""){
            $result = Pelanggan::create([
                'id_pelanggan' => $kodePelanggan,
                'nama_pelanggan' =>$request->nama_pelanggan,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp
            ]);
            if($result){
                $msg = ['msg' => 'Data berhasil di simpan'];
            }
        }else{
            $result = Pelanggan::where('id',$request->id)->update([
                'nama_pelanggan' =>$request->nama_pelanggan,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp
            ]);
            if($result){
                $msg = ['msg' => 'Data berhasil di edit'];
            }
        }
        return Response()->json($msg);
    }
}
