<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\Menu;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode_kelas = '';
        $titleBreadcrump = 'Menu';
        $listMenu = Menu::all();
        return view('MasterData.Menu.menu',['titleBreadcrump'=>$titleBreadcrump,'listMenu'=>$listMenu]);
    }
    
    public function read(Request $request){
        
        $where = "";
        if($request->id_menu){
            $where ="where id_menu like '%".$request->id_menu."%' and nama_menu like '%".$request->nama_menu."%'";
        }
        // dd($where);
        $listMenu = DB::select("
            Select * 
            from mt_menu
            ".$where." 
            ");
        // dd($listMenu);
        $html = view('MasterData.Menu.menuList',compact('listMenu'))->render();
        return $html;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $msg = [];

        if($request->id==""){
            $result = Menu::create($request->all());
            if($result){
                $msg = ['msg'=>'Data Berhasil di Tambahkan'];
            }
        }
        else{  
            $result = Menu::where('id',$request->id)->update($request->except(['_token']));
            if($result){
                $msg = ['msg'=>'Data Berhasil di Edit'];
            }
        }

        return Response()->json($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
