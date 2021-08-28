<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\Menu;
use App\Models\MasterData\KategoriBarang;
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
        $titleBreadcrump = 'Barang';
        $dropDownKtgBarang = KategoriBarang::all();
        
        return view('MasterData.Menu.menu',['titleBreadcrump'=>$titleBreadcrump,'dropDownKtgBarang'=>$dropDownKtgBarang]);
    }
    
    public function read(Request $request){
        
        $where = "";
        if($request->id_barang){
            $where ="and a.id_barang like '%".$request->id_barang."%' and a.nama_barang like '%".$request->nama_barang."%'";
        }
        // dd($where);
        $listbarang = DB::select("
            Select 
                a.id,
                a.id_barang,
                a.nama_barang,
                a.harga,
                a.harga_jual,
                a.satuan,
                a.stok,
                b.id_kategori_barang,
                b.nama_kategori_barang 
            from mt_barang a
            join mt_kategori_barang b
                on a.id_kategori_barang = b.id_kategori_barang
            where 1=1 
                ".$where." 
            ");
        // dd($listMenu);
        $html = view('MasterData.Menu.menuList',compact('listbarang'))->render();
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
        $kd_barang = GenerateAutoIncrementCd('mt_barang','id_barang','BRG');
        $msg = [];
        if($request->id==""){
            $result = Menu::create([
                'id_barang' => $kd_barang,
                'id_kategori_barang' => $request->id_kategori_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->hargaMask,
                'harga_jual' => $request->hargaJual,
                'stok' => $request->stokMask,
                'satuan' => $request->satuan
            ]);
            if($result){
                $msg = ['msg'=>'Data Berhasil di Tambahkan'];
            }
        }
        else{  
            $result = Menu::where('id',$request->id)->update([
                'id_kategori_barang' => $request->id_kategori_barang,
                'nama_barang' => $request->nama_barang,
                'harga' => $request->hargaMask,
                'harga_jual' => $request->hargaJual,
                'stok' => $request->stokMask,
                'satuan' => $request->satuan
            ]);
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
