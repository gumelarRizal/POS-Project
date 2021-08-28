<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Models\MasterData\jasa;
use App\Models\MasterData\Menu;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterData\Pelanggan;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterData\KategoriBarang;
use App\Models\Transaction\CustomPesanan;
use App\Models\Transaction\detailCustomPesanan;

class CustomPesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $kode_trans = '';
        $titleBreadcrump = 'custom';
		$idPlg = GenerateAutoIncrementCd('mt_pelanggan', 'id_pelanggan', 'PLG');
        // $dropDownKtgBarang = KategoriBarang::all();
        $dropDownKtgBarang = DB::select('
            select 
                DISTINCT a.id_kategori_barang,
                nama_kategori_barang 
            from mt_kategori_barang a
            join mt_barang b 
                on a.id_kategori_barang = b.id_kategori_barang
                ');
        $dropDownJasa = jasa::all(); 
        return view('Transaction.CustomPesanan.CustomPesanan', [
            'titleBreadcrump' => $titleBreadcrump, 
            'dropDownKtgBarang' => $dropDownKtgBarang,
            'dropDownJasa' => $dropDownJasa,
			'idPlg' => $idPlg
        ]);
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
    public function selesaiPesan(Request $request){
        $data = json_decode($request->obj);
        $idCustom = GenerateAutoIncrementCd('tr_custompesanan', 'id_customPesanan', 'TRXCP');
        $status = $request->total == $request->sisa ? 0 : 1;
        $checkExist = self::chechExistPelanggan($request->email);
        $idPelanggan = $request->idPlg;

        if(!$checkExist){
            Pelanggan::create([
                'id_pelanggan'=>$request->idPlg,
                'nama_pelanggan'=>$request->nmPlg,
                'email'=>$request->email,
                'alamat'=>$request->almt,
            ]);
        }else{
            $idPelanggan = $checkExist->id_pelanggan;
        }
        
        $result = CustomPesanan::create([
            'id_customPesanan'  => $idCustom,
            'id_pelanggan'      => $idPelanggan,
            'jumlahByr'         => $request->sisa,
            'total'             => $request->total,
            'status'            => $status,
            'id_user'           => Auth::user()->id
        ]);
        foreach($data as $item){
            $idDetailCustom = GenerateAutoIncrementCd('dt_custompesanan', 'id_dt_customPesanan', 'DTCP');
            detailCustomPesanan::create([
                'id_dt_customPesanan'   => $idDetailCustom,
                'id_customPesanan'      => $idCustom,
                'id_barang'             => $item->brg,
                'id_kategori_barang'    => $item->ktgBrg,
                'id_jasa'               => $item->jasa,
                'harga_jasa'            => $item->hrgjasa,
                'harga_barang'          => $item->hrg,
                'subtotal'              => $item->sbtl,
                'subtotal2'             => $item->sbtl2,
                'discount'              => $item->diskon,
                'deskripsi'             => $item->deskripsi,
                'qty'                   => $item->qty,
            ]);
        }
        if ($result) {
            $msg = ['msg' => 'Transaksi berhasil'];
        }
        return response()->json($msg);

    }
    public function generateInvoice(){
        $getDiskon = DB::table('dt_custompesanan')
                        ->select(DB::raw('SUM(discount) Disc'))
                        ->where('id_customPesanan',function($query){
                            $query->select(DB::raw('id_customPesanan from tr_custompesanan order by id DESC Limit 1'));
                        })->first();
        $listDataHeader = DB::table('tr_custompesanan')
                            ->select(DB::raw('tr_custompesanan.id_customPesanan , tr_custompesanan.jumlahByr , tr_custompesanan.total , tr_custompesanan.status,mt_pelanggan.nama_pelanggan , mt_pelanggan.alamat , mt_pelanggan.email '))
                            ->join('mt_pelanggan','tr_custompesanan.id_pelanggan','=','mt_pelanggan.id_pelanggan')
                            ->where('tr_custompesanan.id_customPesanan',function($query){
                                $query->select(DB::raw('id_customPesanan from tr_custompesanan order by id DESC Limit 1'));
                            })->first();
        $listDataBody = DB::select('
        select c.nama_barang Deskripsi, b.qty kuantitas,b.harga_barang Harga, (b.harga_barang *b.qty) Subtotal 
        from pos_project.tr_custompesanan a
        join pos_project.dt_custompesanan b
            on a.id_customPesanan = b.id_customPesanan 
        join pos_project.mt_barang c
            on b.id_barang = c.id_barang
        where a.id_customPesanan = (select
                                        id_customPesanan 
                                    from tr_custompesanan 
                                    order by id desc
                                    limit 1)');
        $dataJasa = DB::table('tr_custompesanan')
                    ->select(DB::raw('mt_jasa.nama_jasa , dt_custompesanan.deskripsi ,dt_custompesanan.harga_jasa , dt_custompesanan.subtotal2'))
                    ->join('dt_custompesanan','tr_custompesanan.id_customPesanan','=','dt_custompesanan.id_customPesanan')
                    ->join('mt_jasa','dt_custompesanan.id_jasa','=','mt_jasa.id_jasa')
                    ->where('tr_custompesanan.id_customPesanan',function($query){
                        $query->select(DB::raw('id_customPesanan from tr_custompesanan order by id DESC Limit 1'));
                    })->first();
        
        return view('Transaction.CustomPesanan.Invoice',['listDataBody'=>$listDataBody,'listDataHeader'=>$listDataHeader,'getDiskon'=>$getDiskon,'dataJasa'=>$dataJasa]);

        // $pdf = PDF::loadview('Transaction.CustomPesanan.Invoice',['listData'=>$listData])->setPaper('a4', 'landscape');
        // return $pdf->stream();
    }

    public function chechExistPelanggan($email){
        $result = Pelanggan::where('email','=',$email)->first();
        return $result ;
    }
}
