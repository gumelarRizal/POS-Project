<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Models\MasterData\COA;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class COAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $titleBreadcrump = 'Chart Of Account';
        return view('MasterData.COA.COA',['titleBreadcrump'=>$titleBreadcrump]);
    }

    public function read(Request $request){
        $where = "";
        if($request->id_coa){
            $where ="where id_coa like '%".$request->id_coa."%' and nama_coa like '%".$request->nama_coa."%'";
        }
        // dd($where);
        $listCOA = DB::select("
            Select * 
            from mt_coa
            ".$where." 
            ");
        // dd($listMenu);
        $html = view('MasterData.COA.COAList',compact('listCOA'))->render();
        return $html;
    }

    public function store(Request $request)
    {
        $msg = [];

        if($request->id==""){
            $result = COA::create([
                'id_coa' => $request->id_coa,
                'nama_coa' => $request->nama_coa,
                'CREATED_BY' => Auth::user()->name
            ]);
            if($result){
                $msg = ['msg'=>'Data Berhasil di Tambahkan'];
            }
        }
        else{  
            $result = COA::where('id',$request->id)->update([
                'id_coa' => $request->id_coa,
                'nama_coa' => $request->nama_coa,
            ]);
            if($result){
                $msg = ['msg'=>'Data Berhasil di Edit'];
            }
        }

        return Response()->json($msg);
    }
}
