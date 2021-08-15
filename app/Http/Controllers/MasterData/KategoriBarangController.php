<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\KategoriBarang;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class KategoriBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $titleBreadcrump = 'Kategori Barang';
        return view('MasterData.KategoriBarang.ktgBrg',['titleBreadcrump'=>$titleBreadcrump]);
    }

    public function read(Request $request){
        $where = "";
        if($request->id_kategori_barang){
            $where ="where id_kategori_barang like '%".$request->id_kategori_barang."%' and nama_kategori_barang like '%".$request->nama_kategori_barang."%'";
        }
        // dd($where);
        $listKtgBrg = DB::select("
            Select * 
            from mt_kategori_barang
            ".$where." 
            ");
        // dd($listMenu);
        $html = view('MasterData.KategoriBarang.ktgBrgList',compact('listKtgBrg'))->render();
        return $html;
    }

    public function store(Request $request)
    {
        $msg = [];

        if($request->id==""){
            $result = KategoriBarang::create([
                'id_kategori_barang' => $request->id_kategori_barang,
                'nama_kategori_barang' => $request->nama_kategori_barang,
                'CREATED_BY' => Auth::user()->name
            ]);
            if($result){
                $msg = ['msg'=>'Data Berhasil di Tambahkan'];
            }
        }
        else{  
            $result = KategoriBarang::where('id',$request->id)->update([
                'id_kategori_barang' => $request->id_kategori_barang,
                'nama_kategori_barang' => $request->nama_kategori_barang,
            ]);
            if($result){
                $msg = ['msg'=>'Data Berhasil di Edit'];
            }
        }

        return Response()->json($msg);
    }
}
